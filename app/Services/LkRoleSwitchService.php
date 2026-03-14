<?php

namespace App\Services;

use App\Models\User;

/**
 * |KB 2025-03-12 Переключение ролей для супер-админа. Сохраняет выбранную роль в сессии.
 */
class LkRoleSwitchService
{
    public const SESSION_KEY = 'lk_impersonate_role';

    /** Роли, между которыми можно переключаться (для отображения интерфейса). */
    public const SWITCHABLE_ROLES = [
        'super-admin' => 'Супер админ',
        'investor' => 'Инвестор',
        'initiator' => 'Инициатор',
        'expert' => 'Эксперт',
        'cabinet-user' => 'По умолчанию',
    ];

    public function getEffectiveRole(User $user): ?string
    {
        if (! $user->hasRole('super-admin')) {
            return null;
        }

        $selected = session(self::SESSION_KEY);

        if ($selected && array_key_exists($selected, self::SWITCHABLE_ROLES)) {
            return $selected;
        }

        return 'super-admin';
    }

    public function setRole(string $role): void
    {
        if (array_key_exists($role, self::SWITCHABLE_ROLES)) {
            session([self::SESSION_KEY => $role]);
        }
    }

    public function clearRole(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public function hasEffectiveRole(User $user, string $role): bool
    {
        $effective = $this->getEffectiveRole($user);
        if ($effective === null) {
            return $user->hasRole($role);
        }
        if ($effective === 'super-admin') {
            return in_array($role, ['investor', 'initiator', 'expert'], true);
        }
        return $effective === $role;
    }

    public function hasEffectiveManagementAccess(User $user): bool
    {
        $effective = $this->getEffectiveRole($user);
        if ($effective === null) {
            return $user->can('manage-dictionaries')
                || $user->hasRole('roles-admin')
                || $user->can('update-news-feed')
                || $user->can('manage-notifications')
                || $user->hasRole('messenger-admin');
        }
        if ($effective === 'super-admin') {
            return true;
        }
        return false;
    }

    public function hasEffectiveMessengerAccess(User $user): bool
    {
        $effective = $this->getEffectiveRole($user);
        if ($effective === null) {
            return $user->hasRole('messenger-admin')
                || ($user->can('use-messenger') && (bool) ($user->messenger_access ?? false));
        }
        if ($effective === 'super-admin') {
            return true;
        }
        return false;
    }
}
