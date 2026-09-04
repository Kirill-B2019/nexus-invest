<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CfaMarketRu extends Model
{
    protected $table = 'cfa_market_ru';

    protected $fillable = [
        'snapshot_date',
        'period_label',
        'placement_volume_3m',
        'placement_volume_prev_3m',
        'primary_turnover',
        'secondary_turnover',
        'issues_rated_or_secured',
        'issues_total',
        'active_users',
        'active_users_prev',
        'spread_avg_pct',
        'time_to_exit_days',
        'placement_growth',
        'secondary_share',
        'quality_share',
        'user_growth',
        'placement_norm',
        'secondary_norm',
        'quality_norm',
        'user_norm',
        'cfa_temp_index',
        'liquidity_index',
        'fetch_id',
        'meta',
    ];

    protected $casts = [
        'snapshot_date' => 'date',
        'meta' => 'array',
        'placement_volume_3m' => 'float',
        'placement_volume_prev_3m' => 'float',
        'primary_turnover' => 'float',
        'secondary_turnover' => 'float',
        'placement_growth' => 'float',
        'secondary_share' => 'float',
        'quality_share' => 'float',
        'user_growth' => 'float',
        'placement_norm' => 'float',
        'secondary_norm' => 'float',
        'quality_norm' => 'float',
        'user_norm' => 'float',
        'cfa_temp_index' => 'float',
        'liquidity_index' => 'float',
        'spread_avg_pct' => 'float',
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
