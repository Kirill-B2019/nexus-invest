<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * |KB Страница мессенджера в ЛК. SPA загружается из /nmess/ (сборка Nmess/client).
 */
class NmessPageController extends Controller
{
    public function __invoke(): View
    {
        return view('app.pages.messenger');
    }
}
