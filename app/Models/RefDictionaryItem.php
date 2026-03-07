<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Элемент (значение) справочника.
 */
class RefDictionaryItem extends Model
{
    protected $table = 'ref_dictionary_items';

    protected $fillable = [
        'ref_dictionary_id',
        'code',
        'name',
        'description',
        'item_type',
        'country_code',
        'map_code',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function dictionary(): BelongsTo
    {
        return $this->belongsTo(RefDictionary::class, 'ref_dictionary_id');
    }
}
