<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Services\LkRoleSwitchService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * |KB 2025-02-18 Главная страница личного кабинета (/lk). Требует verified.
 * |KB 2025-03-12 Редирект на дашборд по роли: Инвестор, Инициатор, Эксперт.
 * |KB 2025-03-12 Супер-админ: редирект по выбранной роли в сессии.
 */
class LkController extends Controller
{
    public function __invoke(LkRoleSwitchService $roleSwitch): View|RedirectResponse
    {
        $user = auth()->user();
        $effectiveRole = $roleSwitch->getEffectiveRole($user);

        $preserveFlash = function (RedirectResponse $redirect): RedirectResponse {
            foreach (['alert_error', 'alert_success', 'alert_warning', 'info'] as $key) {
                if (session()->has($key)) {
                    $redirect->with($key, session($key));
                }
            }
            return $redirect;
        };

        $roleToRoute = [
            'investor' => 'lk.dashboard.investor',
            'initiator' => 'lk.dashboard.initiator',
            'expert' => 'lk.dashboard.expert',
        ];

        if ($effectiveRole && isset($roleToRoute[$effectiveRole])) {
            return $preserveFlash(redirect()->route($roleToRoute[$effectiveRole]));
        }

        if ($effectiveRole === null) {
            if ($user->hasRole('investor')) {
                return $preserveFlash(redirect()->route('lk.dashboard.investor'));
            }
            if ($user->hasRole('initiator')) {
                return $preserveFlash(redirect()->route('lk.dashboard.initiator'));
            }
            if ($user->hasRole('expert')) {
                return $preserveFlash(redirect()->route('lk.dashboard.expert'));
            }
        }

        return view('app.pages.lk');
    }
}
