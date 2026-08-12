<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

/**
 * Получить сырой ответ API Дзен и сохранить в storage для отладки парсинга даты и картинок.
 * Запуск: php artisan dzen:dump-response
 */
class DzenDumpResponseCommand extends Command
{
    protected $signature = 'dzen:dump-response {--save : сохранить JSON в storage/app/dzen-response.json}';

    protected $description = 'Запросить API Дзен и вывести/сохранить сырой ответ для отладки';

    public function handle(): int
    {
        $channelUrl = rtrim(config('dzen.channel_url', 'https://dzen.ru/digital_fintech'), '/');
        $channelId = config('dzen.channel_id');
        $path = parse_url($channelUrl, PHP_URL_PATH);
        $channelSlug = $path ? trim($path, '/') : 'digital_fintech';
        $apiUrls = array_values(array_unique(array_merge(
            [config('dzen.api_url', 'https://dzen.ru/api/v3/launcher/export')],
            config('dzen.api_url_fallbacks', [])
        )));
        $apiQuery = config('dzen.api_query', []);

        $paramVariants = [
            ['channel_name' => $channelSlug],
            ['channel_name' => $channelUrl],
        ];
        if ($channelId) {
            $paramVariants[] = ['channel_id' => $channelId];
        }

        $this->info('Канал: ' . $channelUrl . ' (slug: ' . $channelSlug . ')');
        if ($channelId) {
            $this->info('Channel ID: ' . $channelId);
        }

        $body = '';
        $data = [];
        $usedApi = '';
        $usedParams = [];
        $count = 0;

        foreach ($apiUrls as $apiUrl) {
            foreach ($paramVariants as $params) {
                $paramStr = key($params) . '=' . current($params);
                $this->line('Запрос: ' . $apiUrl . ' ? ' . $paramStr . ' ...');
                $response = Http::timeout(20)
                    ->withHeaders([
                        'Accept' => 'application/json',
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    ])
                    ->get($apiUrl, array_merge($apiQuery, $params));
                $status = $response->status();
                $body = $response->body();
                $data = $response->json();
                $items = $data['items'] ?? [];
                $count = is_array($items) ? count($items) : 0;
                $this->line('  HTTP ' . $status . ', items: ' . $count);
                if ($count > 0) {
                    $usedApi = $apiUrl;
                    $usedParams = $params;
                    break 2;
                }
            }
        }

        if ($count === 0) {
            $this->warn('Ни один вариант не вернул непустой items. Последний ответ (первые 500 символов):');
            $this->line(substr($body, 0, 500));
            if ($this->option('save')) {
                \Illuminate\Support\Facades\Storage::put('dzen-response.json', $body);
                $this->info('Ответ сохранён в storage/app/dzen-response.json');
            }
            return self::FAILURE;
        }

        $this->info('Успех: ' . $usedApi . ' с ' . json_encode($usedParams) . ' — элементов: ' . $count);
        $first = $items[0];
        $this->line('');
        $this->info('Ключи первого элемента (верхний уровень):');
        $this->line(implode(', ', array_keys($first)));
        $this->line('');
        $this->info('Пример полей для отладки (первый элемент):');
        foreach (['creation_time', 'published_at', 'timestamp', 'publication_date', 'created_at', 'date', 'creation_timestamp', 'time'] as $key) {
            if (array_key_exists($key, $first)) {
                $this->line("  {$key}: " . json_encode($first[$key], JSON_UNESCAPED_UNICODE));
            }
        }
        foreach (['image', 'cover', 'thumbnail', 'main_image', 'preview', 'image_url', 'cover_image'] as $key) {
            if (array_key_exists($key, $first)) {
                $val = $first[$key];
                $this->line("  {$key}: " . (is_array($val) ? json_encode($val, JSON_UNESCAPED_UNICODE) : (string) $val));
            }
        }

        if ($this->option('save')) {
            $path = 'dzen-response.json';
            \Illuminate\Support\Facades\Storage::put($path, $body);
            $fullPath = storage_path('app/' . $path);
            $this->info("Полный ответ сохранён: {$fullPath}");
        } else {
            $this->line('');
            $this->comment('Для сохранения полного JSON в storage запустите с --save');
        }

        return self::SUCCESS;
    }
}