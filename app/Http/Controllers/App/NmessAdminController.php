<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * |KB Заглушка раздела админки: управление правами мессенджера Nmess.
 * TODO: роли/права, назначение пользователям, логи звонков.
 */
class NmessAdminController extends Controller
{
    public function __invoke(): View
    {
        return view('app.pages.messenger-admin');
    }
}
