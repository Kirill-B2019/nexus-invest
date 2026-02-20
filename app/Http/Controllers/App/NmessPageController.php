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
        if (! $user->can('use-messenger') || ! $user->messenger_access) {
            return view('app.pages.messenger-no-access', [
                'is_admin' => $user->hasRole('messenger-admin'),
            ]);
        }

        $useTrueConf = (bool) config('trueconf.client_id');

        return view('app.pages.messenger', ['use_trueconf' => $useTrueConf]);
    }
}
