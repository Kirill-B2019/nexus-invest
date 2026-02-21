<?php

namespace App\Console\Commands;

use App\Models\NewsFeedItem;
use App\Services\DzenFeedService;
use Illuminate\Console\Command;

/**
 * Проставить дату публикации у записей без неё (из created_at) и скачать картинки в storage.
 * Запуск: php artisan news-feed:fix
 */
class NewsFeedFixCommand extends Command
{
    protected $signature = 'news-feed:fix';

    protected $description = 'Проставить published_at у новостей без даты и скачать картинки в storage/app/public/news-feed';

    public function handle(): int
    {
        $fixed = 0;
        NewsFeedItem::whereNull('published_at')->get()->each(function (NewsFeedItem $item) use (&$fixed) {
            $item->update(['published_at' => $item->created_at]);
            $fixed++;
        });
        if ($fixed > 0) {
            $this->info("Проставлена дата публикации у записей: {$fixed}.");
        }

        $this->info('Скачивание картинок по внешним URL из БД...');
        $updated = DzenFeedService::make()->refreshImagesForExistingItems();
        $this->info("Скачано и сохранено в storage: {$updated} картинок.");

        $this->info('Готово.');
        return self::SUCCESS;
    }
}
