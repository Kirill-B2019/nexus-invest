<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
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

        // Счётчик непрочитанных уведомлений для шапки ЛК (колокольчик).
        View::composer('layouts.app.topbar', function ($view) {
            $count = 0;
            if (Auth::check()) {
                $now = now()->toIso8601String();
                $count = Auth::user()->notifications()
                    ->whereNull('read_at')
                    ->where(function ($q) use ($now) {
                        $q->whereNull('data->expires_at')->orWhere('data->expires_at', '>', $now);
                    })
                    ->count();
            }
            $view->with('unreadNotificationsCount', $count);
        });
    }
}
