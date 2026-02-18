<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * |KB 2025-02-18 Главная страница личного кабинета (/lk). Требует verified.
 */
class LkController extends Controller
{
    public function __invoke(): View
    {
        return view('app-sections.lk');
    }
}
