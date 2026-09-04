<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RwaGlobal extends Model
{
    protected $table = 'rwa_global';

    protected $fillable = [
        'snapshot_date',
        'period_label',
        'rwa_deposits_b',
        'defi_deposits_b',
        'rwa_deposit_share',
        'rwa_deposits_yoy_pct',
        'defi_deposits_yoy_pct',
        'growth_spread_pct',
        'rwa_spot_volume_yoy_pct',
        'dex_total_volume_yoy_pct',
        'rwa_momentum_pct',
        'rwa_distributed_value_b',
        'rwa_holders_m',
        'daily_transfer_volume_b',
        'tokenized_treasuries_b',
        'tokenized_private_credit_b',
        'rwa_spot_volume_b',
        'structure_funds_pct',
        'structure_commodities_pct',
        'structure_stocks_pct',
        'deltas_30d',
        'fetch_id',
        'meta',
    ];

    protected $casts = [
        'snapshot_date' => 'date',
        'deltas_30d' => 'array',
        'meta' => 'array',
        'rwa_deposits_b' => 'float',
        'defi_deposits_b' => 'float',
        'rwa_deposit_share' => 'float',
        'rwa_deposits_yoy_pct' => 'float',
        'defi_deposits_yoy_pct' => 'float',
        'growth_spread_pct' => 'float',
        'rwa_spot_volume_yoy_pct' => 'float',
        'dex_total_volume_yoy_pct' => 'float',
        'rwa_momentum_pct' => 'float',
        'rwa_distributed_value_b' => 'float',
        'rwa_holders_m' => 'float',
        'daily_transfer_volume_b' => 'float',
        'tokenized_treasuries_b' => 'float',
        'tokenized_private_credit_b' => 'float',
        'rwa_spot_volume_b' => 'float',
        'structure_funds_pct' => 'float',
        'structure_commodities_pct' => 'float',
        'structure_stocks_pct' => 'float',
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
