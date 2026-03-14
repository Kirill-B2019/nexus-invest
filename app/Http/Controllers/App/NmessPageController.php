<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Страница мессенджера в ЛК. При настроенном TrueConf — веб-клиент TrueConf, иначе iframe Nmess.
 * Доступ: messenger-admin или (use-messenger + messenger_access).
 */
class NmessPageController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();
        $isAdmin = $user->hasRole('super-admin') || $user->hasRole('messenger-admin');
        $hasPermission = $user->can('use-messenger');
        $hasAccess = (bool) ($user->messenger_access ?? false);

        // Админ мессенджера всегда может открыть мессенджер (чтобы выдать доступ себе и другим)
        if (! $isAdmin && (! $hasPermission || ! $hasAccess)) {
            throw new HttpException(403, __('Доступ к мессенджеру не предоставлен. Обратитесь к администратору платформы.'));
        }

        $useTrueConf = (bool) config('trueconf.client_id');

        return view('app.pages.messenger', ['use_trueconf' => $useTrueConf]);
    }
}
