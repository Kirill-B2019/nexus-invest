<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Console\Command;

/**
 * Проверить и при необходимости выдать пользователю разрешение update-news-feed.
 * Запуск: php artisan news-feed:grant k@test.ru
 */
class EnsureNewsFeedPermission extends Command
{
    protected $signature = 'news-feed:grant {email : Email пользователя}';

    protected $description = 'Проверить/выдать разрешение update-news-feed пользователю по email';

    public function handle(): int
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("Пользователь с email «{$email}» не найден.");
            return self::FAILURE;
        }

        $this->info("Пользователь: {$user->name} ({$user->email}), id={$user->id}");
        $roles = $user->roles->pluck('name')->toArray();
        $this->line('Роли: ' . (empty($roles) ? 'нет' : implode(', ', $roles)));

        $permission = Permission::where('name', 'update-news-feed')->where('guard_name', 'web')->first();
        if (! $permission) {
            $this->warn('Разрешение update-news-feed не найдено в БД. Запустите: php artisan db:seed --class=PermissionUpdateNewsFeedSeeder');
            return self::FAILURE;
        }

        $hasPermission = $user->hasPermissionTo('update-news-feed');
        $this->line('Разрешение update-news-feed: ' . ($hasPermission ? 'да' : 'нет'));

        if (! $hasPermission) {
            $user->givePermissionTo($permission);
            $this->info('Разрешение update-news-feed выдано пользователю.');
        } else {
            $this->info('Разрешение уже есть.');
        }

        $this->line('Сброс кэша разрешений...');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->info('Готово. Пользователю нужно перелогиниться, чтобы меню обновилось.');
        return self::SUCCESS;
    }
}
