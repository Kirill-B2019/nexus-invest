<?php

namespace App\Providers;

use App\View\Components\App\AppLayout;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
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

        // Компонент ЛК в App\View\Components\App — алиас <x-app-layout>
        Blade::component(AppLayout::class, 'app-layout');
    }
}
