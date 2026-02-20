<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Страница мессенджера в ЛК. При настроенном TrueConf — веб-клиент TrueConf, иначе iframe Nmess.
 */
class NmessPageController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();
        $isAdmin = $user->hasRole('messenger-admin');
        $hasPermission = $user->can('use-messenger');
        $hasAccess = (bool) ($user->messenger_access ?? false);

        // Админ мессенджера всегда может открыть мессенджер (чтобы выдать доступ себе и другим)
        if ($isAdmin) {
            // разрешаем доступ
        } elseif (! $hasPermission || ! $hasAccess) {
            return view('app.pages.messenger-no-access', [
                'is_admin' => $isAdmin,
            ]);
        }

        $useTrueConf = (bool) config('trueconf.client_id');

        return view('app.pages.messenger', ['use_trueconf' => $useTrueConf]);
    }
}
