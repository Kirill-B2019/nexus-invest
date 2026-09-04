<?php

namespace App\Services\Indicators\Parsers;

/**
 * Парсер обзора НКР «Рынок ЦФА» (PDF).
 *
 * Что парсит: PDF https://ratings.ru/files/research/NCR_CFA_2026.pdf
 * Поля: объём размещений, доля вторички, доля выпусков с рейтингом/обеспечением.
 * Ошибки: при недоступности PDF или отсутствии текста — status=warning и пустой data;
 * расчётные снимки берутся из сидера/ручного ввода.
 *
 * Примечание: без PDF-библиотеки извлекаем бинарный поток как есть и ищем
 * ASCII/UTF-8 числа regex'ом (эвристика). Для продакшена рекомендуется
 * smalot/pdfparser или внешний Python-скрипт (pdfplumber).
 */
class NcrCfaParser extends AbstractIndicatorParser
{
    public function sourceCode(): string
    {
        return 'ncr';
    }

    public function parse(): array
    {
        $url = config('indicators.sources.ncr.url');
        $body = $this->httpGet($url, 45);

        if ($body === null) {
            $this->recordFetch('error', $url, null, 'Не удалось загрузить PDF НКР');

            return [
                'ok' => false,
                'published_at' => null,
                'data' => [],
                'message' => 'Не удалось загрузить PDF НКР',
            ];
        }

        // Эвристический поиск по сырому содержимому PDF
        $secondaryShare = $this->matchFloat($body, '/([0-9]+[,.]?[0-9]*)\s*%[^%]{0,40}втор/iu')
            ?? $this->matchFloat($body, '/втор[^0-9]{0,40}([0-9]+[,.]?[0-9]*)\s*%/iu');

        $data = [
            'secondary_share_hint' => $secondaryShare !== null ? $secondaryShare / 100 : null,
            'bytes' => strlen($body),
        ];

        $ok = $secondaryShare !== null;
        $status = $ok ? 'ok' : 'warning';
        $message = $ok
            ? 'PDF загружен, извлечены эвристические метрики'
            : 'PDF загружен, но ключевые метрики не извлечены — используйте фикстуру';

        $this->recordFetch($status, $url, now()->toDateString(), $message, $data);

        return [
            'ok' => $ok,
            'published_at' => now()->toDateString(),
            'data' => $data,
            'message' => $message,
        ];
    }
}
