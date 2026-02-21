<?php

namespace App\Http\Controllers;

use App\Models\NewsFeedItem;
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

        return view('welcome', compact('newsFeedItems'));
    }
}
