<?php

namespace App\Console\Commands;

use App\Services\Indicators\IndicatorRefreshService;
use Illuminate\Console\Command;

/**
 * Обновление снимков отраслевых индикаторов в таблицах БД по периодам.
 */
class RefreshIndustryIndicatorsCommand extends Command
{
    protected $signature = 'indicators:refresh
                            {--frequency=all : monthly|quarterly|semiannual|all}
                            {--force : Обновить даже если период ещё не истёк}
                            {--due-only : Только индикаторы, у которых подошёл срок}
                            {--seed : Перезалить базовые фикстуры сидера}';

    protected $description = 'Сохранить/обновить индикаторы ЦФА/RWA в таблицах БД по периоду каждого';

    public function handle(IndicatorRefreshService $refresh): int
    {
        if ($this->option('seed')) {
            $this->call('db:seed', [
                '--class' => \Database\Seeders\IndustryIndicatorsSeeder::class,
                '--force' => true,
            ]);
            $this->info('Сидер IndustryIndicatorsSeeder выполнен.');
        }

        $frequency = (string) $this->option('frequency');
        if (! in_array($frequency, ['monthly', 'quarterly', 'semiannual', 'all'], true)) {
            $this->error('Некорректный --frequency. Допустимо: monthly, quarterly, semiannual, all');

            return self::FAILURE;
        }

        $force = (bool) $this->option('force');
        $dueOnly = (bool) $this->option('due-only');

        $candidates = $refresh->dueIndicators($frequency);
        if ($dueOnly && ! $force) {
            $candidates = array_filter(
                $candidates,
                fn (array $meta, string $slug) => $refresh->isDue($slug, false),
                ARRAY_FILTER_USE_BOTH
            );
        }

        if ($candidates === []) {
            $this->warn('Нет индикаторов для обновления (частота: '.$frequency.').');

            return self::SUCCESS;
        }

        $this->info('К обновлению: '.implode(', ', array_keys($candidates)));

        // refresh() сам фильтрует по frequency; для due-only синхронизируем точечно
        if ($dueOnly && ! $force && $frequency !== 'all') {
            $parserCodes = [];
            foreach ($candidates as $meta) {
                foreach ($meta['parsers'] ?? [] as $code) {
                    $parserCodes[$code] = true;
                }
            }
            $parserResults = $refresh->runParsers(array_keys($parserCodes));
            $updated = [];
            $errors = $parserResults['errors'];
            foreach (array_keys($candidates) as $slug) {
                try {
                    $refresh->syncIndicator($slug, $parserResults['ran'], true);
                    $updated[] = $slug;
                    \Illuminate\Support\Facades\Cache::forget('indicators.'.$slug);
                } catch (\Throwable $e) {
                    $errors[$slug] = $e->getMessage();
                }
            }
            $result = [
                'updated' => $updated,
                'skipped' => [],
                'parsers' => $parserResults['ran'],
                'errors' => $errors,
            ];
        } else {
            $result = $refresh->refresh($frequency, $force || $frequency !== 'all');
        }

        foreach ($result['parsers'] as $code => $payload) {
            $status = ($payload['ok'] ?? false) ? 'ok' : 'warn';
            $this->line(sprintf('  парсер [%s] %s — %s', $status, $code, $payload['message'] ?? ''));
        }

        foreach ($result['updated'] as $slug) {
            $freq = config("indicators.indicators.$slug.update_frequency", '?');
            $this->info("✓ $slug (период: $freq) — снимок сохранён в БД");
        }

        foreach ($result['skipped'] as $slug) {
            $this->line("· $slug — пропущен");
        }

        foreach ($result['errors'] as $key => $message) {
            $this->error("✗ $key — $message");
        }

        $this->info('Готово. API читает данные только из таблиц.');

        return empty($result['errors']) ? self::SUCCESS : self::FAILURE;
    }
}
