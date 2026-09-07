<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

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
        ];

        $urls = [];
        foreach ($pages as $page) {
            if (! \Illuminate\Support\Facades\Route::has($page['route'])) {
                continue;
            }

            $urls[] = [
                'loc' => route($page['route']),
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority'],
                'lastmod' => now()->toAtomString(),
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
