<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Services\LkRoleSwitchService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * |KB 2025-03-12 Переключение роли для супер-админа.
 */
class LkRoleSwitchController extends Controller
{
    public function __invoke(Request $request, LkRoleSwitchService $service): RedirectResponse
    {
        $role = $request->input('role');

        if (! $request->user()->hasRole('super-admin')) {
            abort(403, __('Переключение ролей доступно только супер-админу.'));
        }

        $service->setRole($role ?? 'super-admin');

        return redirect()->route('lk');
    }
}
