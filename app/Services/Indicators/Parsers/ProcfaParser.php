<?php

namespace App\Services\Indicators\Parsers;

/**
 * Парсер портала цфа.рф (procfa.ru).
 *
 * Что парсит: HTML главной / новостей о совокупном объёме размещений ЦФА.
 * Поля: совокупный объём размещённых ЦФА (трлн/млрд руб.), упоминания пользователей.
 * Ошибки: при недоступности сайта — status=error; при отсутствии чисел — warning.
 */
class ProcfaParser extends AbstractIndicatorParser
{
    public function sourceCode(): string
    {
        return 'procfa';
    }

    public function parse(): array
    {
        $url = config('indicators.sources.procfa.url');
        $body = $this->httpGet($url);

        if ($body === null) {
            $this->recordFetch('error', $url, null, 'Не удалось загрузить цфа.рф');

            return [
                'ok' => false,
                'published_at' => null,
                'data' => [],
                'message' => 'Не удалось загрузить цфа.рф',
            ];
        }

        $text = html_entity_decode(strip_tags($body), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // «2 трлн» / «2,0 трлн рублей»
        $trillion = $this->matchFloat($text, '/([0-9]+[,.]?[0-9]*)\s*трлн/iu');
        $billion = $this->matchFloat($text, '/([0-9]+[,.]?[0-9]*)\s*млрд/iu');

        $volumeBln = null;
        if ($trillion !== null) {
            $volumeBln = $trillion * 1000;
        } elseif ($billion !== null) {
            $volumeBln = $billion;
        }

        $data = [
            'total_placed_bln_rub' => $volumeBln,
        ];

        $ok = $volumeBln !== null;
        $status = $ok ? 'ok' : 'warning';
        $message = $ok
            ? 'Извлечён совокупный объём размещений'
            : 'Страница загружена, объём не найден';

        $this->recordFetch($status, $url, now()->toDateString(), $message, $data);

        return [
            'ok' => $ok,
            'published_at' => now()->toDateString(),
            'data' => $data,
            'message' => $message,
        ];
    }
}
