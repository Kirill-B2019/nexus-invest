<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Страница «Настройки» — меню администратора ЛК.
 * Доступ: пользователи с хотя бы одним из прав/ролей (manage-dictionaries, roles-admin, update-news-feed, manage-notifications, messenger-admin).
 * Управление и настройки системы находятся здесь; из бокового меню в этот раздел ведёт только пункт «Настройки».
 */
class AdminSettingsController extends Controller
{
    public function __invoke(Request $request): View|Response
    {
        $user = $request->user();
        $hasAccess = $user->hasRole('super-admin')
            || $user->can('manage-dictionaries')
            || $user->hasRole('roles-admin')
            || $user->can('update-news-feed')
            || $user->can('manage-notifications')
            || $user->hasRole('messenger-admin')
            || $user->can('moderate-projects');

        if (! $hasAccess) {
            abort(403, __('Доступ к настройкам запрещён.'));
        }

        return view('app.pages.admin-settings.index');
    }
}
