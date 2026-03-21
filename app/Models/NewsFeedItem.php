<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsFeedItem extends Model
{
    protected $table = 'news_feed_items';

    protected $fillable = [
        'external_id',
        'title',
        'url',
        'image_url',
        'description',
        'published_at',
        'source',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * URL картинки: для локального пути (news-feed/...) — через storage, иначе как есть (внешний URL).
     */
    public function getImageUrlAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }
        if (Str::startsWith($value, 'http://') || Str::startsWith($value, 'https://')) {
            return $value;
        }
        return asset('storage/' . ltrim($value, '/'));
    }

    /**
     * Новости для публичной ленты: по дате публикации (сначала новые), записи без даты — в конце по id.
     */
    public static function scopeForFeed($query, int $limit = 12)
    {
        return $query
            ->orderByRaw('published_at IS NULL')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit($limit);
    }
}
