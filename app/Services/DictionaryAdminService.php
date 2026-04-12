<?php

namespace App\Services;

use App\Models\RefDictionary;
use App\Models\RefDictionaryGroup;
use App\Models\RefDictionaryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Запросы и операции CRUD для админки справочников (логика вынесена из DictionariesAdminController).
 */
class DictionaryAdminService
{
    /**
     * @return array{groups: \Illuminate\Support\Collection, searchQuery: string, sortBy: string, sortDir: string}
     */
    public function buildIndexData(Request $request): array
    {
        $query = RefDictionaryGroup::with('dictionaries');

        $q = $request->input('q', '');
        if ($q !== '') {
            $search = '%'.str_replace(['%', '_'], ['\\%', '\\_'], $q).'%';
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', $search)
                    ->orWhere('code', 'like', $search)
                    ->orWhere('description', 'like', $search)
                    ->orWhereHas('dictionaries', function ($d) use ($search) {
                        $d->where('name', 'like', $search)->orWhere('code', 'like', $search);
                    });
            });
        }

        $sortBy = $request->input('sort', 'sort_order');
        $sortDir = strtolower($request->input('dir', 'asc')) === 'desc' ? 'desc' : 'asc';
        if (! in_array($sortBy, ['sort_order', 'name', 'code'], true)) {
            $sortBy = 'sort_order';
        }
        $query->orderBy($sortBy, $sortDir)->orderBy('id');

        $groups = $query->get();

        if ($q !== '') {
            $qLower = mb_strtolower($q);
            foreach ($groups as $group) {
                $group->setRelation('dictionaries', $group->dictionaries->filter(function ($d) use ($qLower) {
                    return mb_strpos(mb_strtolower($d->name), $qLower) !== false
                        || mb_strpos(mb_strtolower($d->code), $qLower) !== false;
                })->values());
            }
        }

        return [
            'groups' => $groups,
            'searchQuery' => $q,
            'sortBy' => $sortBy,
            'sortDir' => $sortDir,
        ];
    }

    /**
     * @return array<int, array{name: string, code: string, group_name: string, url: string}>
     */
    public function searchDictionariesForDropdown(string $q): array
    {
        $q = mb_substr(trim($q), 0, 200);
        if ($q === '') {
            return [];
        }
        $search = '%'.str_replace(['%', '_'], ['\\%', '\\_'], $q).'%';
        $dictionaries = RefDictionary::with('group')
            ->where(function ($builder) use ($search) {
                $builder->where('name', 'like', $search)
                    ->orWhere('code', 'like', $search)
                    ->orWhereHas('group', function ($g) use ($search) {
                        $g->where('name', 'like', $search)->orWhere('code', 'like', $search);
                    });
            })
            ->orderBy('name')
            ->limit(20)
            ->get();

        return $dictionaries->map(function (RefDictionary $d) {
            return [
                'name' => $d->name,
                'code' => $d->code,
                'group_name' => $d->group ? $d->group->name : '',
                'url' => route('lk.admin.settings.dictionaries.show', $d),
            ];
        })->all();
    }

    /**
     * @return array{items: Collection, searchQuery: string, sortBy: string, sortDir: string}
     */
    public function buildShowData(RefDictionary $dictionary, Request $request): array
    {
        $dictionary->load('group');
        $query = $dictionary->items();

        $q = $request->input('q', '');
        if ($q !== '') {
            $search = '%'.str_replace(['%', '_'], ['\\%', '\\_'], $q).'%';
            $query->where(function ($builder) use ($search) {
                $builder->where('code', 'like', $search)
                    ->orWhere('name', 'like', $search)
                    ->orWhere('description', 'like', $search)
                    ->orWhere('item_type', 'like', $search)
                    ->orWhere('country_code', 'like', $search)
                    ->orWhere('map_code', 'like', $search);
            });
        }

        $sortBy = $request->input('sort', 'sort_order');
        $sortDir = strtolower($request->input('dir', 'asc')) === 'desc' ? 'desc' : 'asc';
        $allowedSort = ['code', 'name', 'sort_order', 'is_active', 'is_ru', 'item_type', 'country_code', 'map_code'];
        if (! in_array($sortBy, $allowedSort, true)) {
            $sortBy = 'sort_order';
        }
        $query->orderBy($sortBy, $sortDir)->orderBy('id');

        return [
            'items' => $query->get(),
            'searchQuery' => $q,
            'sortBy' => $sortBy,
            'sortDir' => $sortDir,
        ];
    }

    /**
     * @return array<int, array{id: int|null, code: string, name: string, edit_url: string}>
     */
    public function searchItemsForDropdown(RefDictionary $dictionary, string $q): array
    {
        $q = mb_substr(trim($q), 0, 200);
        if ($q === '') {
            return [];
        }
        $search = '%'.str_replace(['%', '_'], ['\\%', '\\_'], $q).'%';
        $items = $dictionary->items()
            ->where(function ($builder) use ($search) {
                $builder->where('code', 'like', $search)
                    ->orWhere('name', 'like', $search)
                    ->orWhere('description', 'like', $search)
                    ->orWhere('item_type', 'like', $search)
                    ->orWhere('country_code', 'like', $search)
                    ->orWhere('map_code', 'like', $search);
            })
            ->orderBy('name')
            ->limit(20)
            ->get(['id', 'code', 'name']);

        $dictId = (int) $dictionary->id;

        return $items->map(function ($item) use ($dictId) {
            $itemId = (int) ($item->id ?? 0);
            $editUrl = $itemId > 0
                ? url('/lk/admin/settings/dictionaries/'.$dictId.'/items/'.$itemId.'/edit')
                : '#';

            return [
                'id' => $item->id,
                'code' => $item->code,
                'name' => $item->name,
                'edit_url' => $editUrl,
            ];
        })->all();
    }

    public function createGroup(array $data): RefDictionaryGroup
    {
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return RefDictionaryGroup::create($data);
    }

    public function updateGroup(RefDictionaryGroup $group, array $data): void
    {
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $group->update($data);
    }

    public function createDictionary(array $data): RefDictionary
    {
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return RefDictionary::create($data);
    }

    public function updateDictionary(RefDictionary $dictionary, array $data): void
    {
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $dictionary->update($data);
    }

    public function dictionaryCodeExistsInGroup(int $groupId, string $code, ?int $exceptDictionaryId = null): bool
    {
        $q = RefDictionary::where('ref_dictionary_group_id', $groupId)->where('code', $code);
        if ($exceptDictionaryId !== null) {
            $q->where('id', '!=', $exceptDictionaryId);
        }

        return $q->exists();
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function createItem(RefDictionary $dictionary, array $data, Request $request): RefDictionaryItem
    {
        $data['ref_dictionary_id'] = $dictionary->id;
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['item_type'] = $request->input('item_type') ?: null;
        $data['country_code'] = $request->input('country_code') ?: null;
        $data['map_code'] = $request->input('map_code') ?: null;
        if ($dictionary->code === 'regulatory_documents') {
            $data['document_url'] = $request->input('document_url') ?: null;
            $data['is_ru'] = $request->boolean('is_ru', false);
        }

        return RefDictionaryItem::create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function updateItem(RefDictionary $dictionary, RefDictionaryItem $item, array $data, Request $request): void
    {
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['item_type'] = $request->input('item_type') ?: null;
        $data['country_code'] = $request->input('country_code') ?: null;
        $data['map_code'] = $request->input('map_code') ?: null;
        if ($dictionary->code === 'regulatory_documents') {
            $data['document_url'] = $request->input('document_url') ?: null;
            $data['is_ru'] = $request->boolean('is_ru', false);
        }
        $item->update($data);
    }

    public function itemCodeExistsInDictionary(int $dictionaryId, string $code, ?int $exceptItemId = null): bool
    {
        $q = RefDictionaryItem::where('ref_dictionary_id', $dictionaryId)->where('code', $code);
        if ($exceptItemId !== null) {
            $q->where('id', '!=', $exceptItemId);
        }

        return $q->exists();
    }
}
