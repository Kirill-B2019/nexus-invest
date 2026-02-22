<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Создать или обновить пользователя-администратора (роль roles-admin + доступ в ЛК).
 * Использование: php artisan make:admin admin@example.com
 * Опции: --password=... (иначе password), --name="Admin"
 */
class MakeAdminUser extends Command
{
    protected $signature = 'make:admin
                            {email : Email пользователя}
                            {--password= : Пароль (по умолчанию password)}
                            {--name= : Имя пользователя}';

    protected $description = 'Создать или назначить администратора (роль roles-admin, доступ в личный кабинет)';

    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->option('password') ?? 'password';
        $name = $this->option('name') ?? 'Administrator';

        $this->ensureRolesAndPermissions();

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );

        if (!$user->wasRecentlyCreated) {
            $user->update([
                'name' => $name,
                'password' => Hash::make($password),
            ]);
        }

        if (!$user->hasRole('roles-admin')) {
            $user->assignRole('roles-admin');
            $this->info("Роль roles-admin назначена пользователю {$email}");
        } else {
            $this->line("Пользователь {$email} уже имеет роль roles-admin.");
        }

        $this->newLine();
        $this->info('Вход в личный кабинет и админку:');
        $this->line("  URL: " . url('/login'));
        $this->line("  Email: {$email}");
        $this->line('  Пароль: ' . ($this->option('password') ? '***' : 'password'));
        $this->line('  Админка ролей: /lk/admin/roles');

        return self::SUCCESS;
    }

    private function ensureRolesAndPermissions(): void
    {
        $permission = Permission::firstOrCreate(
            ['name' => 'access-lk', 'guard_name' => 'web'],
            ['name' => 'access-lk', 'guard_name' => 'web', 'slug' => 'Вход в личный кабинет']
        );

        $role = Role::firstOrCreate(
            ['name' => 'roles-admin', 'guard_name' => 'web'],
            ['name' => 'roles-admin', 'guard_name' => 'web']
        );

        if (!$role->hasPermissionTo($permission)) {
            $role->givePermissionTo($permission);
        }
    }
}
