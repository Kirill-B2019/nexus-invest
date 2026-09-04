<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndicatorSourceFetch extends Model
{
    protected $table = 'indicator_source_fetches';

    protected $fillable = [
        'source_id',
        'source_url',
        'published_at',
        'fetched_at',
        'status',
        'message',
        'raw_payload',
    ];

    protected $casts = [
        'published_at' => 'date',
        'fetched_at' => 'datetime',
        'raw_payload' => 'array',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(IndicatorSource::class, 'source_id');
    }
}
