<?php

namespace App\Services\Indicators;

use App\Models\CfaMarketRu;
use App\Models\CfaRisk;
use App\Models\IndicatorSourceFetch;
use App\Models\RwaGlobal;
use App\Models\SmeFinance;
use App\Services\Indicators\Parsers\CoinsharesParser;
use App\Services\Indicators\Parsers\NcrCfaParser;
use App\Services\Indicators\Parsers\ProcfaParser;
use App\Services\Indicators\Parsers\RwaXyzParser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Обновление снимков индикаторов в таблицах БД по периодам.
 *
 * Источник истины для API — только таблицы:
 * cfa_market_ru, rwa_global, sme_finance, cfa_risks.
 */
class IndicatorRefreshService
{
    /** @var array<string, class-string> */
    private array $parserMap = [
        'ncr' => NcrCfaParser::class,
        'procfa' => ProcfaParser::class,
        'rwa_xyz' => RwaXyzParser::class,
        'coinshares' => CoinsharesParser::class,
    ];

    public function __construct(
        private readonly CfaMarketCalculator $cfaCalculator,
        private readonly RwaCalculator $rwaCalculator,
        private readonly SmeFinanceCalculator $smeCalculator,
    ) {}

    /**
     * @param  'monthly'|'quarterly'|'semiannual'|'all'|null  $frequency
     * @return array{updated: list<string>, skipped: list<string>, parsers: array<string, mixed>, errors: array<string, string>}
     */
    public function refresh(?string $frequency = 'all', bool $force = false): array
    {
        $due = $this->dueIndicators($frequency);
        $parsersNeeded = [];
        foreach ($due as $slug => $meta) {
            foreach ($meta['parsers'] ?? [] as $code) {
                $parsersNeeded[$code] = true;
            }
        }

        $parserResults = $this->runParsers(array_keys($parsersNeeded));
        $updated = [];
        $errors = $parserResults['errors'];

        foreach ($due as $slug => $meta) {
            try {
                $this->syncIndicator($slug, $parserResults['ran'], $force);
                $updated[] = $slug;
                Cache::forget('indicators.'.$slug);
            } catch (\Throwable $e) {
                $errors[$slug] = $e->getMessage();
                Log::warning('Indicator refresh failed', [
                    'indicator' => $slug,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $allSlugs = array_keys(config('indicators.indicators', []));
        $skipped = array_values(array_diff($allSlugs, $updated, array_keys($errors)));

        return [
            'updated' => $updated,
            'skipped' => $skipped,
            'parsers' => $parserResults['ran'],
            'errors' => $errors,
        ];
    }

    /**
     * @param  'monthly'|'quarterly'|'semiannual'|'all'|null  $frequency
     * @return array<string, array<string, mixed>>
     */
    public function dueIndicators(?string $frequency): array
    {
        $all = config('indicators.indicators', []);
        if ($frequency === null || $frequency === 'all') {
            return $all;
        }

        return array_filter(
            $all,
            fn (array $meta) => ($meta['update_frequency'] ?? null) === $frequency
        );
    }

    /**
     * Нужно ли обновлять индикатор по дате последнего снимка.
     */
    public function isDue(string $slug, bool $force = false): bool
    {
        if ($force) {
            return true;
        }

        $meta = config("indicators.indicators.$slug");
        if (! $meta) {
            return false;
        }

        $freq = $meta['update_frequency'] ?? 'monthly';
        $last = $this->lastSnapshotAt($slug);
        if ($last === null) {
            return true;
        }

        return match ($freq) {
            'monthly' => $last->lt(now()->startOfMonth()),
            'quarterly' => $last->lt(now()->firstOfQuarter()),
            'semiannual' => $last->lt($this->currentHalfStart()),
            'event' => false,
            default => $last->lt(now()->subMonth()),
        };
    }

    /**
     * @param  list<string>  $codes
     * @return array{ran: array<string, mixed>, errors: array<string, string>}
     */
    public function runParsers(array $codes): array
    {
        $ran = [];
        $errors = [];

        foreach ($codes as $code) {
            if (! isset($this->parserMap[$code])) {
                continue;
            }
            try {
                $parser = app($this->parserMap[$code]);
                $ran[$code] = $parser->parse();
            } catch (\Throwable $e) {
                $errors[$code] = $e->getMessage();
            }
        }

        return compact('ran', 'errors');
    }

    /**
     * @param  array<string, mixed>  $parserResults
     */
    public function syncIndicator(string $slug, array $parserResults, bool $force = false): void
    {
        match ($slug) {
            'cfa-temperature', 'liquidity-light' => $this->syncCfaMarket($slug, $parserResults),
            'rwa-vs-defi' => $this->syncRwaVsDefi($parserResults),
            'rwa-global' => $this->syncRwaGlobal($parserResults),
            'sme-cost' => $this->syncSmeCost(),
            'risk-map' => $this->syncRiskMap($parserResults),
            default => null,
        };
    }

    /**
     * @param  array<string, mixed>  $parserResults
     */
    private function syncCfaMarket(string $slug, array $parserResults): void
    {
        $prev = CfaMarketRu::latestSnapshot();
        $freq = config("indicators.indicators.$slug.update_frequency", 'monthly');
        $period = $freq === 'quarterly' ? $this->currentQuarterLabel() : $this->currentMonthLabel();
        $date = $freq === 'quarterly' ? now()->endOfQuarter()->toDateString() : now()->endOfMonth()->toDateString();

        $row = CfaMarketRu::query()->firstOrNew([
            'snapshot_date' => $date,
            'period_label' => $period,
        ]);

        if (! $row->exists && $prev) {
            $row->fill($prev->only([
                'placement_volume_3m',
                'placement_volume_prev_3m',
                'primary_turnover',
                'secondary_turnover',
                'issues_rated_or_secured',
                'issues_total',
                'active_users',
                'active_users_prev',
                'spread_avg_pct',
                'time_to_exit_days',
            ]));
            // Сдвиг окна: текущие 3м становятся предыдущими
            if ($prev->placement_volume_3m !== null) {
                $row->placement_volume_prev_3m = $prev->placement_volume_3m;
            }
            if ($prev->active_users !== null) {
                $row->active_users_prev = $prev->active_users;
            }
        }

        $ncr = $parserResults['ncr']['data'] ?? [];
        $procfa = $parserResults['procfa']['data'] ?? [];

        if (! empty($ncr['secondary_share_hint']) && $row->primary_turnover) {
            $share = (float) $ncr['secondary_share_hint'];
            $total = (float) $row->primary_turnover;
            // secondary / (primary + secondary) = share → secondary = share * primary / (1 - share)
            if ($share > 0 && $share < 1) {
                $row->secondary_turnover = round($share * $total / (1 - $share), 4);
            }
        }

        if (! empty($procfa['total_placed_bln_rub'])) {
            $placed = (float) $procfa['total_placed_bln_rub'];
            // Эвристика: ~12% совокупного объёма как размещения за 3 мес
            $row->placement_volume_3m = round($placed * 0.12, 4);
            if ($row->primary_turnover === null) {
                $row->primary_turnover = round($placed * 0.25, 4);
            }
        }

        $fetchId = $this->latestOkFetchId(['ncr', 'procfa']);
        $row->fetch_id = $fetchId;
        $row->meta = array_filter([
            'updated_via' => $slug,
            'ncr' => $ncr ?: null,
            'procfa' => $procfa ?: null,
            'refreshed_at' => now()->toIso8601String(),
        ]);

        $this->cfaCalculator->compute($row);
        $row->save();
    }

    /**
     * @param  array<string, mixed>  $parserResults
     */
    private function syncRwaVsDefi(array $parserResults): void
    {
        $prev = RwaGlobal::query()
            ->whereNotNull('rwa_deposits_b')
            ->orderByDesc('snapshot_date')
            ->first();

        $period = $this->currentQuarterLabel();
        $date = now()->endOfQuarter()->toDateString();

        $row = RwaGlobal::query()->firstOrNew([
            'snapshot_date' => $date,
            'period_label' => $period,
        ]);

        if (! $row->exists && $prev) {
            $row->fill($prev->only([
                'rwa_deposits_b',
                'defi_deposits_b',
                'rwa_deposits_yoy_pct',
                'defi_deposits_yoy_pct',
                'rwa_spot_volume_yoy_pct',
                'dex_total_volume_yoy_pct',
                'rwa_distributed_value_b',
                'rwa_holders_m',
                'daily_transfer_volume_b',
                'tokenized_treasuries_b',
                'tokenized_private_credit_b',
                'rwa_spot_volume_b',
                'structure_funds_pct',
                'structure_commodities_pct',
                'structure_stocks_pct',
                'deltas_30d',
            ]));
        }

        $coin = $parserResults['coinshares']['data'] ?? [];
        if (! empty($coin['rwa_deposits_b_hint'])) {
            $row->rwa_deposits_b = (float) $coin['rwa_deposits_b_hint'];
        }

        $row->fetch_id = $this->latestOkFetchId(['coinshares']);
        $row->meta = [
            'updated_via' => 'rwa-vs-defi',
            'coinshares' => $coin ?: null,
            'refreshed_at' => now()->toIso8601String(),
        ];

        $this->rwaCalculator->compute($row);
        $row->save();
    }

    /**
     * @param  array<string, mixed>  $parserResults
     */
    private function syncRwaGlobal(array $parserResults): void
    {
        $prev = RwaGlobal::query()
            ->whereNotNull('rwa_distributed_value_b')
            ->orderByDesc('snapshot_date')
            ->first();

        $period = $this->currentMonthLabel();
        $date = now()->endOfMonth()->toDateString();

        $row = RwaGlobal::query()->firstOrNew([
            'snapshot_date' => $date,
            'period_label' => $period,
        ]);

        if (! $row->exists && $prev) {
            // Месячный трекер: без депозитов RWA/DeFi (они только в квартальном rwa-vs-defi)
            $row->fill($prev->only([
                'rwa_distributed_value_b',
                'rwa_holders_m',
                'daily_transfer_volume_b',
                'tokenized_treasuries_b',
                'tokenized_private_credit_b',
                'rwa_spot_volume_b',
                'structure_funds_pct',
                'structure_commodities_pct',
                'structure_stocks_pct',
                'deltas_30d',
            ]));
        }

        $rwa = $parserResults['rwa_xyz']['data'] ?? [];
        if (! empty($rwa['rwa_distributed_value_b_hint'])) {
            $hint = (float) $rwa['rwa_distributed_value_b_hint'];
            // Защита от ложных «$1B» из HTML: принимаем только разумный масштаб
            if ($hint >= 5 && $hint <= 500) {
                $row->rwa_distributed_value_b = $hint;
            }
        }

        // Не дублировать столбцы графика RWA vs DeFi на месячных снимках
        $row->rwa_deposits_b = null;
        $row->defi_deposits_b = null;
        $row->rwa_deposits_yoy_pct = null;
        $row->defi_deposits_yoy_pct = null;
        $row->rwa_deposit_share = null;
        $row->growth_spread_pct = null;
        $row->rwa_momentum_pct = null;

        $row->fetch_id = $this->latestOkFetchId(['rwa_xyz']);
        $row->meta = [
            'updated_via' => 'rwa-global',
            'rwa_xyz' => $rwa ?: null,
            'refreshed_at' => now()->toIso8601String(),
        ];

        $this->rwaCalculator->compute($row);
        $row->save();
    }

    private function syncSmeCost(): void
    {
        $prev = SmeFinance::latestSnapshot();
        $period = $this->currentQuarterLabel();
        $date = now()->endOfQuarter()->toDateString();

        $row = SmeFinance::query()->firstOrNew([
            'snapshot_date' => $date,
            'period_label' => $period,
        ]);

        if (! $row->exists && $prev) {
            $row->sme_loan_rate_pct = $prev->sme_loan_rate_pct;
            $row->cfa_yield_nexus_pct = $prev->cfa_yield_nexus_pct;
        } elseif (! $row->exists) {
            $row->sme_loan_rate_pct = 18.5;
            $row->cfa_yield_nexus_pct = 16.2;
        }

        $row->fetch_id = $this->latestOkFetchId(['cbr', 'nexus']);
        $row->meta = [
            'updated_via' => 'sme-cost',
            'refreshed_at' => now()->toIso8601String(),
            'note' => 'Ставки из предыдущего снимка / внутренней статистики; внешний парсер ЦБ — по событию.',
        ];

        $this->smeCalculator->compute($row);
        $row->save();
    }

    /**
     * @param  array<string, mixed>  $parserResults
     */
    private function syncRiskMap(array $parserResults): void
    {
        $ncrOk = ($parserResults['ncr']['ok'] ?? false) === true;
        $meta = [
            'updated_via' => 'risk-map',
            'ncr_status' => $parserResults['ncr']['message'] ?? null,
            'refreshed_at' => now()->toIso8601String(),
        ];

        CfaRisk::query()->active()->each(function (CfaRisk $risk) use ($ncrOk, $parserResults, $meta) {
            $risk->fetched_at = now();
            $risk->published_at = $ncrOk
                ? ($parserResults['ncr']['published_at'] ?? now()->toDateString())
                : now()->toDateString();
            $risk->meta = $meta;
            $risk->save();
        });
    }

    private function lastSnapshotAt(string $slug): ?Carbon
    {
        $value = match ($slug) {
            'cfa-temperature', 'liquidity-light' => CfaMarketRu::latestSnapshot()?->updated_at
                ?? CfaMarketRu::latestSnapshot()?->snapshot_date,
            'rwa-vs-defi', 'rwa-global' => RwaGlobal::latestSnapshot()?->updated_at
                ?? RwaGlobal::latestSnapshot()?->snapshot_date,
            'sme-cost' => SmeFinance::latestSnapshot()?->updated_at
                ?? SmeFinance::latestSnapshot()?->snapshot_date,
            'risk-map' => CfaRisk::query()->active()->max('fetched_at'),
            default => null,
        };

        if ($value === null) {
            return null;
        }

        return $value instanceof Carbon ? $value : Carbon::parse($value);
    }

    private function currentMonthLabel(): string
    {
        return now()->format('Y-m');
    }

    private function currentQuarterLabel(): string
    {
        return now()->format('Y').'-Q'.now()->quarter;
    }

    private function currentHalfStart(): Carbon
    {
        return now()->month <= 6
            ? now()->copy()->startOfYear()
            : now()->copy()->month(7)->startOfMonth();
    }

    /**
     * @param  list<string>  $sourceCodes
     */
    private function latestOkFetchId(array $sourceCodes): ?int
    {
        return IndicatorSourceFetch::query()
            ->whereHas('source', fn ($q) => $q->whereIn('code', $sourceCodes))
            ->whereIn('status', ['ok', 'warning'])
            ->latest('fetched_at')
            ->value('id');
    }
}
