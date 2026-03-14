<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * |KB 2025-03-12 Дашборды по ролям платформы: Инвестор, Инициатор, Эксперт.
 */
class DashboardController extends Controller
{
    /**
     * Дашборд инвестора.
     */
    public function investor(): View
    {
        return view('app.pages.dashboard-investor');
    }

    /**
     * Дашборд инициатора.
     */
    public function initiator(): View
    {
        return view('app.pages.dashboard-initiator');
    }

    /**
     * Дашборд эксперта.
     */
    public function expert(): View
    {
        return view('app.pages.dashboard-expert');
    }
}
