<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'lk.access' => \App\Http\Middleware\EnsureLkAccess::class,
        ]);
        // Редирект неавторизованных пользователей на страницу входа
        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Неавторизованный пользователь — только редирект на логин (без сообщения)
        $exceptions->renderable(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('Необходима авторизация.')], 401);
            }
            return redirect()->guest(route('login'));
        });

        // 403 в закрытой части — SweetAlert2 + редирект на главную ЛК
        $exceptions->renderable(function (AuthorizationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $e->getMessage() ?: __('Доступ запрещён.')], 403);
            }
            if ($request->user() && $request->is(['lk*', 'profile*', 'app/*', 'dashboard'])) {
                return redirect()->route('lk')
                    ->with('alert_error', $e->getMessage() ?: __('Доступ к этому разделу запрещён. Недостаточно прав или роли.'));
            }
            abort(403, $e->getMessage());
        });

        $exceptions->renderable(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() !== 403) {
                return null;
            }
            if ($request->expectsJson()) {
                return response()->json(['message' => $e->getMessage() ?: __('Доступ запрещён.')], 403);
            }
            if ($request->user() && $request->is(['lk*', 'profile*', 'app/*', 'dashboard'])) {
                return redirect()->route('lk')
                    ->with('alert_error', $e->getMessage() ?: __('Доступ к этому разделу запрещён. Недостаточно прав или роли.'));
            }
            return null;
        });
    })->create();
