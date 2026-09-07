<?php

namespace App\Contracts;

/**
 * Контракт синхронизации внешнего источника новостей в news_feed_items.
 */
interface NewsSourceSync
{
    /** Ключ источника: dzen, agency, … */
    public function key(): string;

    /** Число добавленных/обновлённых записей. */
    public function fetchAndSync(): int;
}
