<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * |KB 2025-02-18 Пустая страница ЛК (/app/blank). Шаблон для контента.
 */
class BlankPageController extends Controller
{
    public function __invoke(): View
    {
        return view('app.pages.blank', ['title' => __('Страница')]);
    }
}
