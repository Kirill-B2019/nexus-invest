<?php

namespace App\Services;

use App\Contracts\NewsSourceSync;

/**
 * Заглушка синхронизации информагентства (включается через config/news.php).
 */
class AgencyFeedService implements NewsSourceSync
{
    public function key(): string
    {
        return 'agency';
    }

    public function fetchAndSync(): int
    {
        if (! config('news.sources.agency.enabled', false)) {
            throw new \RuntimeException(__('Синхронизация информагентства отключена. Включите news.sources.agency.enabled в конфигурации.'));
        }

        // Реальный коннектор будет добавлен при подключении API агентства.
        return 0;
    }
}
