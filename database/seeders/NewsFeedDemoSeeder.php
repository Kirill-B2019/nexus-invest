<?php

namespace Database\Seeders;

use App\Models\NewsFeedItem;
use Illuminate\Database\Seeder;

/**
 * Демо-новости для главной, если лента пуста (API Дзен не отдаёт канал).
 * Запуск: php artisan db:seed --class=NewsFeedDemoSeeder
 */
class NewsFeedDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (NewsFeedItem::exists()) {
            return;
        }

        $items = [
            [
                'external_id' => 'demo-1',
                'title' => 'Платформа НЕКСУС: обновления и возможности',
                'url' => 'https://dzen.ru/digital_fintech',
                'description' => 'Актуальные материалы о развитии платформы и инструментах для инвесторов и проектов.',
                'published_at' => now()->subDays(2),
            ],
            [
                'external_id' => 'demo-2',
                'title' => 'Цифровой финтех и инвестиции',
                'url' => 'https://dzen.ru/digital_fintech',
                'description' => 'Как технологии меняют подход к инвестициям и управлению проектами.',
                'published_at' => now()->subDays(5),
            ],
            [
                'external_id' => 'demo-3',
                'title' => 'Новости и истории платформы',
                'url' => 'https://dzen.ru/digital_fintech',
                'description' => 'Следите за обновлениями в разделе новостей. Картинки и даты подтягиваются при обновлении ленты из Дзен.',
                'published_at' => now()->subDays(10),
            ],
        ];

        foreach ($items as $data) {
            $data['source'] = 'dzen';
            $data['image_url'] = null;
            NewsFeedItem::create($data);
        }
    }
}
