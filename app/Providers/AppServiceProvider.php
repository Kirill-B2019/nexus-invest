<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale(config('app.locale'));

        // Папка для картинок новостей (лента Дзен): создаётся при старте.
        if (! Storage::disk('public')->exists('news-feed')) {
            Storage::disk('public')->makeDirectory('news-feed');
        }
    }
}
