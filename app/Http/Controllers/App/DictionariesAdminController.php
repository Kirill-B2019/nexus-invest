<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\RefDictionary;
use App\Models\RefDictionaryGroup;
use App\Models\RefDictionaryItem;
use App\Services\DictionaryAdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Управление справочниками: группы, справочники, элементы (доступ по разрешению manage-dictionaries).
 * Бизнес-логика — {@see DictionaryAdminService}.
 */
class DictionariesAdminController extends Controller
{
    public function __construct(
        private readonly DictionaryAdminService $dictionaryAdmin
    ) {}

    public function index(Request $request): View
    {
        return view('app.pages.dictionaries-admin.index', $this->dictionaryAdmin->buildIndexData($request));
    }

    public function searchIndex(Request $request): JsonResponse
    {
        $q = $request->input('q', '');

        return response()->json(['items' => $this->dictionaryAdmin->searchDictionariesForDropdown($q)]);
    }

    public function show(Request $request, RefDictionary $dictionary): View
    {
        $data = $this->dictionaryAdmin->buildShowData($dictionary, $request);

        return view('app.pages.dictionaries-admin.items', [
            'dictionary' => $dictionary,
            'items' => $data['items'],
            'searchQuery' => $data['searchQuery'],
            'sortBy' => $data['sortBy'],
            'sortDir' => $data['sortDir'],
        ]);
    }

    public function searchItems(Request $request, RefDictionary $dictionary): JsonResponse
    {
        $q = $request->input('q', '');

        return response()->json(['items' => $this->dictionaryAdmin->searchItemsForDropdown($dictionary, $q)]);
    }

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
        $group = $this->dictionaryAdmin->createGroup($data);

        return redirect()
            ->route('lk.admin.settings.dictionaries.index')
            ->with('status', __('Группа «:name» создана.', ['name' => $group->name]));
    }

    public function editGroup(RefDictionaryGroup $group): View
    {
        return view('app.pages.dictionaries-admin.group-form', ['group' => $group]);
    }

    public function updateGroup(Request $request, RefDictionaryGroup $group): RedirectResponse
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|regex:/^[a-z0-9_-]+$/|unique:ref_dictionary_groups,code,'.$group->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $this->dictionaryAdmin->updateGroup($group, $data);

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

        if ($this->dictionaryAdmin->dictionaryCodeExistsInGroup((int) $data['ref_dictionary_group_id'], $data['code'])) {
            return back()->withErrors(['code' => __('В этой группе уже есть справочник с таким кодом.')])->withInput();
        }

        $dict = $this->dictionaryAdmin->createDictionary($data);

        return redirect()
            ->route('lk.admin.settings.dictionaries.index')
            ->with('status', __('Справочник «:name» создан.', ['name' => $dict->name]));
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

        if ($this->dictionaryAdmin->dictionaryCodeExistsInGroup((int) $data['ref_dictionary_group_id'], $data['code'], (int) $dictionary->id)) {
            return back()->withErrors(['code' => __('В этой группе уже есть справочник с таким кодом.')])->withInput();
        }

        $this->dictionaryAdmin->updateDictionary($dictionary, $data);

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
        if ($dictionary->code === 'regulatory_documents') {
            $rules['document_url'] = 'nullable|url|max:500';
        }
        $data = $request->validate($rules);

        if ($this->dictionaryAdmin->itemCodeExistsInDictionary((int) $dictionary->id, $data['code'])) {
            return back()->withErrors(['code' => __('В этом справочнике уже есть элемент с таким кодом.')])->withInput();
        }

        $this->dictionaryAdmin->createItem($dictionary, $data, $request);

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
        if ($dictionary->code === 'regulatory_documents') {
            $rules['document_url'] = 'nullable|url|max:500';
        }
        $data = $request->validate($rules);

        if ($this->dictionaryAdmin->itemCodeExistsInDictionary((int) $dictionary->id, $data['code'], (int) $item->id)) {
            return back()->withErrors(['code' => __('В этом справочнике уже есть элемент с таким кодом.')])->withInput();
        }

        $this->dictionaryAdmin->updateItem($dictionary, $item, $data, $request);

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
