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
        'document_url',
        'is_ru',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'is_ru' => 'boolean',
    ];

    public function dictionary(): BelongsTo
    {
        return $this->belongsTo(RefDictionary::class, 'ref_dictionary_id');
    }

    /**
     * Получить название элемента по коду справочника и коду элемента.
     */
    public static function labelByCode(string $dictCode, ?string $itemCode): ?string
    {
        if (! $itemCode) {
            return null;
        }

        $dict = RefDictionary::where('code', $dictCode)->first();

        if (! $dict) {
            return null;
        }

        $item = self::where('ref_dictionary_id', $dict->id)
            ->where('code', $itemCode)
            ->first();

        return $item?->name;
    }
}
