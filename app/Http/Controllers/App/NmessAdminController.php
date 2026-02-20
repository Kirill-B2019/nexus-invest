<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

/**
 * |KB Заглушка раздела админки: управление правами мессенджера Nmess.
 * TODO: роли/права, назначение пользователям, логи звонков.
 */
class NmessAdminController extends Controller
{
    public function __invoke(): View
    {
        $users = User::query()
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'messenger_access', 'trueconf_login', 'created_at']);

        return view('app.pages.messenger-admin', [
            'users' => $users,
            'trueconf_configured' => (bool) config('trueconf.client_id'),
        ]);
    }
}
