<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * |KB 2026-03-13 Проект инициатора: черновик, модерация, одобрение/отклонение.
 */
class Project extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_MODERATION = 'moderation';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'user_id',
        'status',
        'moderation_comment',
        'name',
        'pitch',
        'description',
        'industry',
        'region',
        'sector_direction',
        'stage',
        'project_type',
        'category',
        'target_amount',
        'min_investment',
        'duration_months',
        'investment_form',
        'company_name',
        'inn',
        'contact_person',
        'phone',
        'email',
        'website',
        'submitted_at',
        'moderated_at',
        'moderated_by',
    ];

    protected $casts = [
        'target_amount' => 'integer',
        'min_investment' => 'integer',
        'duration_months' => 'integer',
        'submitted_at' => 'datetime',
        'moderated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'moderated_by');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ProjectDocument::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function coverImages(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->where('type', ProjectImage::TYPE_COVER)->orderBy('sort_order');
    }

    public function cardImages(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->where('type', ProjectImage::TYPE_CARD)->orderBy('sort_order');
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isModeration(): bool
    {
        return $this->status === self::STATUS_MODERATION;
    }

    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function canEdit(): bool
    {
        return $this->isDraft();
    }

    public function canSubmit(): bool
    {
        return $this->isDraft() && $this->name && $this->pitch && $this->description;
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            self::STATUS_DRAFT => __('Черновик'),
            self::STATUS_MODERATION => __('На модерации'),
            self::STATUS_APPROVED => __('Одобрен'),
            self::STATUS_REJECTED => __('Отклонён'),
            default => $status,
        };
    }
}
