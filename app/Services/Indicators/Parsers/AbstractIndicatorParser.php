<?php

namespace App\Services\Indicators\Parsers;

use App\Models\IndicatorSource;
use App\Models\IndicatorSourceFetch;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Базовый HTTP-парсер источников индикаторов.
 *
 * Живой парсинг внешних сайтов может быть нестабилен (PDF, JS-SPA).
 * При ошибке фиксируется fetch со status=error|warning; сидер/фикстуры
 * остаются источником истины до появления стабильного API.
 */
abstract class AbstractIndicatorParser
{
    abstract public function sourceCode(): string;

    /**
     * @return array{ok: bool, published_at: ?string, data: array<string, mixed>, message: ?string}
     */
    abstract public function parse(): array;

    protected function httpGet(string $url, int $timeout = 20): ?string
    {
        try {
            $response = Http::timeout($timeout)
                ->withHeaders([
                    'User-Agent' => 'NexusInvestIndicators/1.0 (+https://nexus-invest.fund)',
                    'Accept' => 'text/html,application/xhtml+xml,application/pdf,*/*',
                ])
                ->get($url);

            if (! $response->successful()) {
                return null;
            }

            return $response->body();
        } catch (\Throwable $e) {
            Log::warning('Indicator parser HTTP error', [
                'source' => $this->sourceCode(),
                'url' => $url,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Записать результат загрузки в indicator_source_fetches.
     *
     * @param  array<string, mixed>|null  $payload
     */
    public function recordFetch(
        string $status,
        ?string $sourceUrl = null,
        ?string $publishedAt = null,
        ?string $message = null,
        ?array $payload = null
    ): ?IndicatorSourceFetch {
        $source = IndicatorSource::query()->where('code', $this->sourceCode())->first();
        if (! $source) {
            return null;
        }

        return IndicatorSourceFetch::query()->create([
            'source_id' => $source->id,
            'source_url' => $sourceUrl ?? $source->url,
            'published_at' => $publishedAt,
            'fetched_at' => now(),
            'status' => $status,
            'message' => $message,
            'raw_payload' => $payload,
        ]);
    }

    /**
     * Извлечь первое совпадение float из текста по regex.
     */
    protected function matchFloat(string $text, string $pattern): ?float
    {
        if (! preg_match($pattern, $text, $m)) {
            return null;
        }
        $raw = str_replace([' ', ','], ['', '.'], $m[1]);

        return is_numeric($raw) ? (float) $raw : null;
    }
}
