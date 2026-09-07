<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class NewsFeedItem extends Model
{
    public const SOURCE_DZEN = 'dzen';

    public const SOURCE_EDITORIAL = 'editorial';

    public const SOURCE_AGENCY = 'agency';

    public const STATUS_DRAFT = 'draft';

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_HIDDEN = 'hidden';

    protected $table = 'news_feed_items';

    protected $fillable = [
        'external_id',
        'title',
        'slug',
        'url',
        'image_url',
        'description',
        'body',
        'published_at',
        'source',
        'status',
        'author_id',
        'source_meta',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'source_meta' => 'array',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

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

    public function getCoverUrlAttribute(): ?string
    {
        return $this->image_url;
    }

    public function getIsExternalAttribute(): bool
    {
        return $this->source !== self::SOURCE_EDITORIAL;
    }

    /**
     * Публичная ссылка: внешний URL или внутренняя страница статьи.
     */
    public function getPermalinkAttribute(): string
    {
        if ($this->source === self::SOURCE_EDITORIAL && $this->slug) {
            return route('news.show', $this->slug);
        }

        return (string) ($this->attributes['url'] ?? '#');
    }

    public function getSourceLabelAttribute(): string
    {
        return match ($this->source) {
            self::SOURCE_DZEN => __('Дзен'),
            self::SOURCE_EDITORIAL => __('НЕКСУС'),
            self::SOURCE_AGENCY => __('Агентство'),
            default => (string) $this->source,
        };
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    /**
     * Сортировка ленты по дате публикации (новые сверху).
     * Если published_at пустой — используется created_at.
     */
    public function scopeOrderedForFeed(Builder $query): Builder
    {
        return $query
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->orderByDesc('id');
    }

    /**
     * Новости для публичной ленты: только published, сначала новые.
     */
    public function scopeForFeed(Builder $query, int $limit = 12): Builder
    {
        return $query->published()->orderedForFeed()->limit($limit);
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title, '-', 'ru');
        if ($base === '') {
            $base = Str::slug($title);
        }
        if ($base === '') {
            $base = 'news';
        }
        $base = Str::limit($base, 180, '');
        $slug = $base;
        $i = 2;
        while (
            static::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn (Builder $q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
