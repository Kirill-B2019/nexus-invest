<?php

namespace App\Http\Controllers;

use App\Models\NewsFeedItem;
use App\Models\RefDictionaryItem;
use App\Models\RefDictionary;
use Illuminate\Support\Facades\DB;

/**
 * |KB 2025-02-18 Главная страница сайта (после входа). Публичная часть.
 */
class WelcomeController extends Controller
{
    public function __invoke()
    {
        NewsFeedItem::whereNull('published_at')->update(['published_at' => DB::raw('created_at')]);

        $newsFeedItems = NewsFeedItem::forFeed(12)->get();

        $regionsForMap = [];
        $dict = RefDictionary::whereHas('group', fn ($q) => $q->where('code', 'territorial'))
            ->where('code', 'regions')
            ->first();
        if ($dict) {
            $regionsForMap = RefDictionaryItem::where('ref_dictionary_id', $dict->id)
                ->whereNotNull('map_code')
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name', 'code', 'map_code'])
                ->keyBy('map_code')
                ->toArray();
        }

        $mapSvg = '';
        $svgPath = public_path('assets/svg/russia-regions.svg');
        if (file_exists($svgPath)) {
            $mapSvg = file_get_contents($svgPath);
        }

        // Справочники для фильтров карты регионов (в порядке отображения)
        $mapFilterDictCodes = [
            'industries',
            'sector_directions',
            'funding_types',
            'investment_stages',
            'project_categories',
            'project_types',
            'investment_rating',
            'product_types',
        ];
        $mapFilterDictionaries = [];
        $dicts = RefDictionary::whereIn('code', $mapFilterDictCodes)->get()->keyBy('code');
        foreach ($mapFilterDictCodes as $code) {
            $dict = $dicts->get($code);
            $mapFilterDictionaries[] = [
                'code' => $code,
                'name' => $dict ? $dict->name : $code,
                'items' => $dict
                    ? RefDictionaryItem::where('ref_dictionary_id', $dict->id)
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('name')
                        ->get(['id', 'name', 'code'])
                        ->toArray()
                    : [],
            ];
        }

        return view('welcome', compact('newsFeedItems', 'regionsForMap', 'mapSvg', 'mapFilterDictionaries'));
    }
}
