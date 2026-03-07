<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Группа справочников (территориальные, экономические и т.д.).
 */
class RefDictionaryGroup extends Model
{
    protected $table = 'ref_dictionary_groups';

    protected $fillable = [
        'code',
        'name',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function dictionaries(): HasMany
    {
        return $this->hasMany(RefDictionary::class, 'ref_dictionary_group_id')->orderBy('sort_order')->orderBy('name');
    }
}
