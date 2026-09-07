<?php

namespace App\Http\Controllers;

use App\Models\NewsFeedItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Публичная лента новостей и страница редакционной статьи.
 */
class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $viewMode = (string) $request->cookie('news_view', 'list');
        if (! in_array($viewMode, ['blocks', 'list'], true)) {
            $viewMode = 'list';
        }

        $items = NewsFeedItem::query()
            ->published()
            ->orderedForFeed()
            ->paginate(12)
            ->withQueryString();

        return view('public-sections.news', [
            'title' => __('Новости'),
            'description' => __('Актуальные материалы экосистемы НЕКСУС: публикации редакции и канала Дзен.'),
            'items' => $items,
            'viewMode' => $viewMode,
            'channelUrl' => config('dzen.channel_url', 'https://dzen.ru/digital_fintech'),
        ]);
    }

    public function show(string $slug): View
    {
        $item = NewsFeedItem::query()
            ->where('slug', $slug)
            ->where('source', NewsFeedItem::SOURCE_EDITORIAL)
            ->published()
            ->firstOrFail();

        return view('public-sections.news-show', [
            'title' => $item->title,
            'item' => $item,
        ]);
    }
}
