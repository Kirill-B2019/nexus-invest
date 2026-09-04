<?php

namespace App\Services\Indicators\Parsers;

/**
 * Парсер RWA.xyz (SPA-дашборд).
 *
 * Что парсит: попытка HTML/embed; SPA часто отдаёт оболочку без метрик.
 * Поля: RWA Distributed Value, holders, daily transfer, treasuries, private credit.
 * Ошибки: при отсутствии данных в HTML — warning; расчёт идёт по фикстуре сидера.
 *
 * Для продакшена: официальный API RWA.xyz или headless-браузер / Dune mirror.
 */
class RwaXyzParser extends AbstractIndicatorParser
{
    public function sourceCode(): string
    {
        return 'rwa_xyz';
    }

    public function parse(): array
    {
        $url = config('indicators.sources.rwa_xyz.url');
        $body = $this->httpGet($url);

        if ($body === null) {
            $this->recordFetch('error', $url, null, 'Не удалось загрузить RWA.xyz');

            return [
                'ok' => false,
                'published_at' => null,
                'data' => [],
                'message' => 'Не удалось загрузить RWA.xyz',
            ];
        }

        $text = html_entity_decode(strip_tags($body), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Ищем паттерны вида $43.8B / 43.8 billion
        $valueB = $this->matchFloat($text, '/\$?\s*([0-9]+[,.]?[0-9]*)\s*[Bb]/iu')
            ?? $this->matchFloat($text, '/([0-9]+[,.]?[0-9]*)\s*billion/iu');

        $data = [
            'rwa_distributed_value_b_hint' => $valueB,
            'html_bytes' => strlen($body),
        ];

        $ok = $valueB !== null;
        $status = $ok ? 'ok' : 'warning';
        $message = $ok
            ? 'Извлечена эвристическая оценка RWA value'
            : 'SPA без числовых метрик в HTML — используйте фикстуру';

        $this->recordFetch($status, $url, now()->toDateString(), $message, $data);

        return [
            'ok' => $ok,
            'published_at' => now()->toDateString(),
            'data' => $data,
            'message' => $message,
        ];
    }
}
