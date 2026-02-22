<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Редирект на главную с сообщением, если у пользователя нет разрешения на вход в личный кабинет.
 */
class EnsureLkAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->can('access-lk')) {
            return redirect()
                ->route('welcome')
                ->with('info', __('Личные кабинеты будут доступны в ближайшем релизе.'));
        }

        return $next($request);
    }
}
