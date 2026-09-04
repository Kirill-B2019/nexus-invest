<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndicatorSource extends Model
{
    protected $table = 'indicator_sources';

    protected $fillable = [
        'code',
        'name',
        'url',
        'update_frequency',
        'notes',
    ];

    public function fetches(): HasMany
    {
        return $this->hasMany(IndicatorSourceFetch::class, 'source_id');
    }
}
