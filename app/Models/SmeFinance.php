<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmeFinance extends Model
{
    protected $table = 'sme_finance';

    protected $fillable = [
        'snapshot_date',
        'period_label',
        'sme_loan_rate_pct',
        'cfa_yield_nexus_pct',
        'spread_sme_pct',
        'fetch_id',
        'meta',
    ];

    protected $casts = [
        'snapshot_date' => 'date',
        'meta' => 'array',
        'sme_loan_rate_pct' => 'float',
        'cfa_yield_nexus_pct' => 'float',
        'spread_sme_pct' => 'float',
    ];

    public function fetch(): BelongsTo
    {
        return $this->belongsTo(IndicatorSourceFetch::class, 'fetch_id');
    }

    public static function latestSnapshot(): ?self
    {
        return static::query()->orderByDesc('snapshot_date')->orderByDesc('id')->first();
    }
}
