<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CfaRisk extends Model
{
    protected $table = 'cfa_risks';

    protected $fillable = [
        'risk_code',
        'name',
        'level',
        'manifestation',
        'control',
        'sort_order',
        'is_active',
        'published_at',
        'fetched_at',
        'source_id',
        'meta',
    ];

    protected $casts = [
        'published_at' => 'date',
        'fetched_at' => 'datetime',
        'is_active' => 'boolean',
        'meta' => 'array',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(IndicatorSource::class, 'source_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
