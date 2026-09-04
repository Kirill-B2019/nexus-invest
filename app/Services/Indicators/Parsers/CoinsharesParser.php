<?php

namespace App\Services\Indicators\Parsers;

/**
 * Парсер обзоров CoinShares / Crypto.News (RWA vs DeFi).
 *
 * Что парсит: HTML-статьи с цифрами RWA deposits / DeFi deposits.
 * Поля: rwa_deposits_b, упоминания YoY.
 * Ошибки: warning при отсутствии чисел.
 */
class CoinsharesParser extends AbstractIndicatorParser
{
    public function sourceCode(): string
    {
        return 'coinshares';
    }

    public function parse(): array
    {
        $url = config('indicators.sources.coinshares.url');
        $body = $this->httpGet($url);

        if ($body === null) {
            $this->recordFetch('error', $url, null, 'Не удалось загрузить статью CoinShares');

            return [
                'ok' => false,
                'published_at' => null,
                'data' => [],
                'message' => 'Не удалось загрузить статью CoinShares',
            ];
        }

        $text = html_entity_decode(strip_tags($body), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $rwaDeposits = $this->matchFloat($text, '/\$?\s*([0-9]+[,.]?[0-9]*)\s*[Bb].{0,20}RWA/iu')
            ?? $this->matchFloat($text, '/RWA.{0,40}\$?\s*([0-9]+[,.]?[0-9]*)\s*[Bb]/iu')
            ?? $this->matchFloat($text, '/([0-9]+[,.]?[0-9]*)\s*billion/iu');

        $data = [
            'rwa_deposits_b_hint' => $rwaDeposits,
        ];

        $ok = $rwaDeposits !== null;
        $status = $ok ? 'ok' : 'warning';
        $message = $ok ? 'Извлечены RWA deposits' : 'Статья загружена, ключевые цифры не найдены';

        $this->recordFetch($status, $url, now()->toDateString(), $message, $data);

        return [
            'ok' => $ok,
            'published_at' => now()->toDateString(),
            'data' => $data,
            'message' => $message,
        ];
    }
}
