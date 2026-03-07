<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Справочник (одна «таблица» справочных значений) с привязкой к группе.
 */
class RefDictionary extends Model
{
    protected $table = 'ref_dictionaries';

    protected $fillable = [
        'ref_dictionary_group_id',
        'code',
        'name',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(RefDictionaryGroup::class, 'ref_dictionary_group_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(RefDictionaryItem::class, 'ref_dictionary_id')->orderBy('sort_order')->orderBy('name');
    }
}
