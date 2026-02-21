<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TrueConfApiService;
use Database\Seeders\PermissionUseMessengerSeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Permission;

/**
 * Управление доступом к мессенджеру (TrueConf): список пользователей, назначение доступа.
 */
class MessengerAdminController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'messenger_access', 'trueconf_login', 'created_at']);

        return view('app.pages.messenger-admin', [
            'users' => $users,
            'trueconf_configured' => (bool) config('trueconf.client_id'),
        ]);
    }

    public function updateAccess(Request $request): RedirectResponse
    {
        $request->validate([
            'users' => 'sometimes|array',
            'users.*' => 'integer|exists:users,id',
        ]);

        $grantedIds = array_map('intval', $request->input('users', []));
        $permission = Permission::firstOrCreate(
            ['name' => PermissionUseMessengerSeeder::PERMISSION_NAME, 'guard_name' => 'web'],
            ['name' => PermissionUseMessengerSeeder::PERMISSION_NAME, 'guard_name' => 'web']
        );

        $service = null;
        if (config('trueconf.client_id')) {
            $service = TrueConfApiService::fromConfig();
        }

        foreach (User::all() as $user) {
            $shouldHave = in_array((int) $user->id, $grantedIds, true);

            if ($shouldHave && ! $user->messenger_access) {
                $user->givePermissionTo($permission);
                $user->messenger_access = true;
                $login = TrueConfApiService::normalizeLogin($user->trueconf_login ?? 'nexus_'.$user->id);
                $user->trueconf_login = $login;
                if ($service) {
                    $password = Str::random(24);
                    $displayName = trim($user->name ?: $user->email ?: '') ?: $login;
                    $email = trim($user->email ?? '') ?: $login.'@nexus.local';
                    $ok = $service->createOrUpdateUser($login, $email, $displayName, $password);
                    if ($ok) {
                        $user->trueconf_password_encrypted = $password;
                    }
                }
                $user->save();
            } elseif (! $shouldHave && $user->messenger_access) {
                $user->revokePermissionTo($permission);
                $user->messenger_access = false;
                $user->trueconf_login = null;
                $user->trueconf_user_id = null;
                $user->trueconf_password_encrypted = null;
                $user->save();
            }
        }

        return redirect()->route('lk.admin.messenger')->with('status', __('Доступ к мессенджеру обновлён.'));
    }

    /**
     * Синхронизировать пользователей с доступом к мессенджеру с сервером TrueConf
     * (создать или обновить учётные записи на TrueConf).
     */
    public function syncWithServer(): RedirectResponse
    {
        if (! config('trueconf.client_id')) {
            return redirect()->route('lk.admin.messenger')
                ->with('error', __('TrueConf не настроен. Укажите TRUECONF_CLIENT_ID и TRUECONF_CLIENT_SECRET в .env.'));
        }

        $service = TrueConfApiService::fromConfig();
        $permission = Permission::firstOrCreate(
            ['name' => PermissionUseMessengerSeeder::PERMISSION_NAME, 'guard_name' => 'web'],
            ['name' => PermissionUseMessengerSeeder::PERMISSION_NAME, 'guard_name' => 'web']
        );

        $synced = 0;
        $users = User::where('messenger_access', true)->get();

        if ($users->isEmpty()) {
            return redirect()->route('lk.admin.messenger')
                ->with('error', __('Пользователей с доступом к мессенджеру нет. Назначьте доступ в таблице выше (включите переключатели) и нажмите «Сохранить», затем запустите синхронизацию с TrueConf.'));
        }

        foreach ($users as $user) {
            $login = TrueConfApiService::normalizeLogin($user->trueconf_login ?? 'nexus_'.$user->id);
            $user->trueconf_login = $login;
            $password = $user->trueconf_password_encrypted ?? Str::random(24);
            $displayName = trim($user->name ?: $user->email ?: '') ?: $login;
            $email = trim($user->email ?? '') ?: $login.'@nexus.local';
            $ok = $service->createOrUpdateUser($login, $email, $displayName, $password);
            if ($ok) {
                $user->trueconf_password_encrypted = $password;
                $user->save();
                if (! $user->hasPermissionTo($permission)) {
                    $user->givePermissionTo($permission);
                }
                $synced++;
            }
        }

        if ($synced > 0) {
            return redirect()->route('lk.admin.messenger')
                ->with('status', __('Синхронизировано с TrueConf: :count пользователей.', ['count' => $synced]));
        }

        $hint = $service->lastError
            ? __('Синхронизация с TrueConf не удалась. :details', ['details' => $service->lastError])
            : __('Синхронизация с TrueConf не удалась. Проверьте в .env: TRUECONF_BASE_URL, TRUECONF_CLIENT_ID, TRUECONF_CLIENT_SECRET; доступность сервера и логи приложения (storage/logs).');

        return redirect()->route('lk.admin.messenger')->with('error', $hint);
    }
}
