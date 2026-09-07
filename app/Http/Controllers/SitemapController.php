<?php

namespace App\Http\Controllers;

use App\Models\NewsFeedItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/**
 * XML-карта сайта для поисковых систем (публичные HTML-страницы).
 */
class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $pages = [
            ['route' => 'welcome', 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['route' => 'features', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['route' => 'compliance', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['route' => 'documentation', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['route' => 'ganimed', 'changefreq' => 'monthly', 'priority' => '0.9'],
            ['route' => 'ignd', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['route' => 'nexus-ai', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['route' => 'news.index', 'changefreq' => 'daily', 'priority' => '0.7'],
        ];

        $urls = [];
        foreach ($pages as $page) {
            if (! Route::has($page['route'])) {
                continue;
            }

            $urls[] = [
                'loc' => route($page['route']),
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority'],
                'lastmod' => now()->toAtomString(),
            ];
        }

        $articles = NewsFeedItem::query()
            ->published()
            ->where('source', NewsFeedItem::SOURCE_EDITORIAL)
            ->whereNotNull('slug')
            ->orderedForFeed()
            ->get(['slug', 'updated_at', 'published_at']);

        foreach ($articles as $article) {
            $urls[] = [
                'loc' => route('news.show', $article->slug),
                'changefreq' => 'monthly',
                'priority' => '0.6',
                'lastmod' => optional($article->updated_at ?? $article->published_at)->toAtomString() ?? now()->toAtomString(),
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
