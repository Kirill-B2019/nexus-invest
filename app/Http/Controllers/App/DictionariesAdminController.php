<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\RefDictionary;
use App\Models\RefDictionaryGroup;
use App\Models\RefDictionaryItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * | KB 2026-03-07 Управление справочниками: группы, справочники, элементы (доступ по разрешению manage-dictionaries).
 */
class DictionariesAdminController extends Controller
{
    /**
     * Список групп и справочников (поиск %like%, сортировка групп).
     */
    public function index(Request $request): View
    {
        $query = RefDictionaryGroup::with('dictionaries');

        $q = $request->input('q', '');
        if ($q !== '') {
            $search = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
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

        return view('app.pages.dictionaries-admin.index', [
            'groups' => $groups,
            'searchQuery' => $q,
            'sortBy' => $sortBy,
            'sortDir' => $sortDir,
        ]);
    }

    /**
     * Поиск групп и справочников для интерактивного выпадающего списка на главной (JSON).
     */
    public function searchIndex(Request $request): JsonResponse
    {
        $q = $request->input('q', '');
        $q = mb_substr(trim($q), 0, 200);
        if ($q === '') {
            return response()->json(['items' => []]);
        }
        $search = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
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

        $result = $dictionaries->map(function (RefDictionary $d) {
            return [
                'name' => $d->name,
                'code' => $d->code,
                'group_name' => $d->group ? $d->group->name : '',
                'url' => route('lk.admin.settings.dictionaries.show', $d),
            ];
        });

        return response()->json(['items' => $result]);
    }

    /**
     * Элементы выбранного справочника (поиск %like%, сортировка по колонкам).
     */
    public function show(Request $request, RefDictionary $dictionary): View
    {
        $dictionary->load('group');
        $query = $dictionary->items()->where('id', '>', 0);

        $q = $request->input('q', '');
        if ($q !== '') {
            $search = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
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
        $allowedSort = ['code', 'name', 'sort_order', 'is_active', 'item_type', 'country_code', 'map_code'];
        if (! in_array($sortBy, $allowedSort, true)) {
            $sortBy = 'sort_order';
        }
        $query->orderBy($sortBy, $sortDir)->orderBy('id');

        $items = $query->get();

        return view('app.pages.dictionaries-admin.items', [
            'dictionary' => $dictionary,
            'items' => $items,
            'searchQuery' => $q,
            'sortBy' => $sortBy,
            'sortDir' => $sortDir,
        ]);
    }

    /**
     * Поиск элементов справочника для интерактивного выпадающего списка (JSON).
     */
    public function searchItems(Request $request, RefDictionary $dictionary): JsonResponse
    {
        $q = $request->input('q', '');
        $q = mb_substr(trim($q), 0, 200);
        if ($q === '') {
            return response()->json(['items' => []]);
        }
        $search = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
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

        $result = $items->map(function ($item) use ($dictionary) {
            return [
                'id' => $item->id,
                'code' => $item->code,
                'name' => $item->name,
                'edit_url' => route('lk.admin.settings.dictionaries.item.edit', ['dictionary' => $dictionary, 'item' => $item]),
            ];
        });

        return response()->json(['items' => $result]);
    }

    // --- Группы ---

    public function createGroup(): View
    {
        return view('app.pages.dictionaries-admin.group-form', ['group' => null]);
    }

    public function storeGroup(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:ref_dictionary_groups,code|regex:/^[a-z0-9_-]+$/',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        RefDictionaryGroup::create($data);

        return redirect()
            ->route('lk.admin.settings.dictionaries.index')
            ->with('status', __('Группа «:name» создана.', ['name' => $data['name']]));
    }

    public function editGroup(RefDictionaryGroup $group): View
    {
        return view('app.pages.dictionaries-admin.group-form', ['group' => $group]);
    }

    public function updateGroup(Request $request, RefDictionaryGroup $group): RedirectResponse
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|regex:/^[a-z0-9_-]+$/|unique:ref_dictionary_groups,code,' . $group->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $group->update($data);

        return redirect()
            ->route('lk.admin.settings.dictionaries.index')
            ->with('status', __('Группа «:name» обновлена.', ['name' => $group->name]));
    }

    public function destroyGroup(RefDictionaryGroup $group): RedirectResponse
    {
        $name = $group->name;
        $group->delete();

        return redirect()
            ->route('lk.admin.settings.dictionaries.index')
            ->with('status', __('Группа «:name» удалена.', ['name' => $name]));
    }

    // --- Справочники ---

    public function createDictionary(Request $request): View
    {
        $group = null;
        if ($request->has('group_id')) {
            $group = RefDictionaryGroup::find($request->input('group_id'));
        }
        $groups = RefDictionaryGroup::orderBy('sort_order')->orderBy('name')->get();

        return view('app.pages.dictionaries-admin.dictionary-form', [
            'dictionary' => null,
            'groups' => $groups,
            'selectedGroup' => $group,
        ]);
    }

    public function storeDictionary(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'ref_dictionary_group_id' => 'required|exists:ref_dictionary_groups,id',
            'code' => 'required|string|max:50|regex:/^[a-z0-9_-]+$/',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $exists = RefDictionary::where('ref_dictionary_group_id', $data['ref_dictionary_group_id'])
            ->where('code', $data['code'])
            ->exists();
        if ($exists) {
            return back()->withErrors(['code' => __('В этой группе уже есть справочник с таким кодом.')])->withInput();
        }

        RefDictionary::create($data);

        return redirect()
            ->route('lk.admin.settings.dictionaries.index')
            ->with('status', __('Справочник «:name» создан.', ['name' => $data['name']]));
    }

    public function editDictionary(RefDictionary $dictionary): View
    {
        $dictionary->load('group');
        $groups = RefDictionaryGroup::orderBy('sort_order')->orderBy('name')->get();

        return view('app.pages.dictionaries-admin.dictionary-form', [
            'dictionary' => $dictionary,
            'groups' => $groups,
            'selectedGroup' => $dictionary->group,
        ]);
    }

    public function updateDictionary(Request $request, RefDictionary $dictionary): RedirectResponse
    {
        $data = $request->validate([
            'ref_dictionary_group_id' => 'required|exists:ref_dictionary_groups,id',
            'code' => 'required|string|max:50|regex:/^[a-z0-9_-]+$/',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $exists = RefDictionary::where('ref_dictionary_group_id', $data['ref_dictionary_group_id'])
            ->where('code', $data['code'])
            ->where('id', '!=', $dictionary->id)
            ->exists();
        if ($exists) {
            return back()->withErrors(['code' => __('В этой группе уже есть справочник с таким кодом.')])->withInput();
        }

        $dictionary->update($data);

        return redirect()
            ->route('lk.admin.settings.dictionaries.index')
            ->with('status', __('Справочник «:name» обновлён.', ['name' => $dictionary->name]));
    }

    public function destroyDictionary(RefDictionary $dictionary): RedirectResponse
    {
        $name = $dictionary->name;
        $dictionary->delete();

        return redirect()
            ->route('lk.admin.settings.dictionaries.index')
            ->with('status', __('Справочник «:name» удалён.', ['name' => $name]));
    }

    // --- Элементы справочника ---

    public function createItem(RefDictionary $dictionary): View
    {
        $dictionary->load('group');

        return view('app.pages.dictionaries-admin.item-form', [
            'dictionary' => $dictionary,
            'item' => null,
        ]);
    }

    public function storeItem(Request $request, RefDictionary $dictionary): RedirectResponse
    {
        $rules = [
            'code' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ];
        $rules['item_type'] = 'nullable|string|max:50|in:country,region,city';
        $rules['country_code'] = 'nullable|string|max:10';
        $rules['map_code'] = 'nullable|string|max:20';
        $data = $request->validate($rules);
        $data['ref_dictionary_id'] = $dictionary->id;
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['item_type'] = $request->input('item_type') ?: null;
        $data['country_code'] = $request->input('country_code') ?: null;
        $data['map_code'] = $request->input('map_code') ?: null;

        $exists = RefDictionaryItem::where('ref_dictionary_id', $dictionary->id)->where('code', $data['code'])->exists();
        if ($exists) {
            return back()->withErrors(['code' => __('В этом справочнике уже есть элемент с таким кодом.')])->withInput();
        }

        RefDictionaryItem::create($data);

        return redirect()
            ->route('lk.admin.settings.dictionaries.show', $dictionary)
            ->with('status', __('Элемент «:name» добавлен.', ['name' => $data['name']]));
    }

    public function editItem(RefDictionary $dictionary, RefDictionaryItem $item): View
    {
        if ($item->ref_dictionary_id !== $dictionary->id) {
            abort(404);
        }
        $dictionary->load('group');

        return view('app.pages.dictionaries-admin.item-form', [
            'dictionary' => $dictionary,
            'item' => $item,
        ]);
    }

    public function updateItem(Request $request, RefDictionary $dictionary, RefDictionaryItem $item): RedirectResponse
    {
        if ($item->ref_dictionary_id !== $dictionary->id) {
            abort(404);
        }

        $rules = [
            'code' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ];
        $rules['item_type'] = 'nullable|string|max:50|in:country,region,city';
        $rules['country_code'] = 'nullable|string|max:10';
        $rules['map_code'] = 'nullable|string|max:20';
        $data = $request->validate($rules);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['item_type'] = $request->input('item_type') ?: null;
        $data['country_code'] = $request->input('country_code') ?: null;
        $data['map_code'] = $request->input('map_code') ?: null;

        $exists = RefDictionaryItem::where('ref_dictionary_id', $dictionary->id)
            ->where('code', $data['code'])
            ->where('id', '!=', $item->id)
            ->exists();
        if ($exists) {
            return back()->withErrors(['code' => __('В этом справочнике уже есть элемент с таким кодом.')])->withInput();
        }

        $item->update($data);

        return redirect()
            ->route('lk.admin.settings.dictionaries.show', $dictionary)
            ->with('status', __('Элемент «:name» обновлён.', ['name' => $item->name]));
    }

    public function destroyItem(RefDictionary $dictionary, RefDictionaryItem $item): RedirectResponse
    {
        if ($item->ref_dictionary_id !== $dictionary->id) {
            abort(404);
        }
        $name = $item->name;
        $item->delete();

        return redirect()
            ->route('lk.admin.settings.dictionaries.show', $dictionary)
            ->with('status', __('Элемент «:name» удалён.', ['name' => $name]));
    }
}
