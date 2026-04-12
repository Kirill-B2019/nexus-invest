<?php

namespace App\Services;

use App\Models\RefDictionary;
use App\Models\RefDictionaryItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProjectFormDictionaryService
{
    private const CACHE_KEY = 'project_form_dictionaries_v1';
    private const TTL_SECONDS = 3600;

    public function getDictionaries(): array
    {
        return Cache::remember(self::CACHE_KEY, self::TTL_SECONDS, function (): array {
            $dictCodes = [
                'regions' => 'territorial',
                'sector_directions' => 'sectors',
                'industries' => 'sectors',
                'project_statuses' => 'projects',
                'project_types' => 'projects',
                'project_categories' => 'projects',
            ];

            $result = [];
            foreach ($dictCodes as $code => $groupCode) {
                $dict = RefDictionary::whereHas('group', fn ($q) => $q->where('code', $groupCode))
                    ->where('code', $code)
                    ->first();

                $result[$code] = $dict
                    ? RefDictionaryItem::where('ref_dictionary_id', $dict->id)
                        ->where(function ($q) {
                            $q->where('is_active', true)->orWhereNull('is_active');
                        })
                        ->orderBy('sort_order')
                        ->orderBy('name')
                        ->get(['id', 'code', 'name'])
                    : collect();
            }

            return $result;
        });
    }

    public function flushCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
