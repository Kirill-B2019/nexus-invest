<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Notifications\LkNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Админ-раздел уведомлений: создание и рассылка. Доступ по разрешению manage-notifications.
 */
class NotificationsAdminController extends Controller
{
    /**
     * Список отправленных уведомлений (история) — опционально, заглушка с формой создания.
     */
    public function index(): View
    {
        return view('app.pages.notifications-admin.index');
    }

    /**
     * Форма создания уведомления.
     */
    public function create(): View
    {
        return view('app.pages.notifications-admin.create', [
            'roles' => Role::where('guard_name', 'web')->orderBy('name')->get(),
            'importanceLevels' => $this->importanceLevels(),
        ]);
    }

    /**
     * Сохранение и рассылка уведомления.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:5000'],
            'link' => ['nullable', 'string', 'max:500'],
            'importance' => ['required', 'string', 'in:low,normal,high,urgent'],
            'expires_at' => ['nullable', 'date', 'after:now'],
            'audience' => ['required', 'string', 'in:all,role,user'],
            'role_id' => ['required_if:audience,role', 'nullable', 'exists:roles,id'],
            'user_id' => ['required_if:audience,user', 'nullable', 'exists:users,id'],
        ], [], [
            'title' => __('Заголовок'),
            'body' => __('Текст'),
            'link' => __('Ссылка'),
            'importance' => __('Важность'),
            'expires_at' => __('Срок действия'),
            'audience' => __('Аудитория'),
            'role_id' => __('Роль'),
            'user_id' => __('Пользователь'),
        ]);

        $recipients = $this->getRecipients(
            $validated['audience'],
            $validated['role_id'] ?? null,
            $validated['user_id'] ?? null
        );

        $expiresAt = isset($validated['expires_at'])
            ? \Carbon\Carbon::parse($validated['expires_at']) : null;

        $notification = new LkNotification(
            title: $validated['title'],
            body: $validated['body'],
            link: $validated['link'] ?: null,
            type: LkNotification::TYPE_MANUAL,
            importance: $validated['importance'],
            expiresAt: $expiresAt,
            createdBy: $request->user()->id,
        );

        foreach ($recipients as $user) {
            $user->notify($notification);
        }

        $count = $recipients->count();
        return redirect()
            ->route('lk.admin.notifications.index')
            ->with('status', __('Уведомление отправлено получателям: :count.', ['count' => $count]));
    }

    /**
     * Получить список получателей по аудитории.
     *
     * @return \Illuminate\Support\Collection<int, User>
     */
    private function getRecipients(string $audience, ?int $roleId, ?int $userId): \Illuminate\Support\Collection
    {
        if ($audience === 'user' && $userId) {
            $user = User::find($userId);
            return $user ? collect([$user]) : collect();
        }
        if ($audience === 'role' && $roleId) {
            return User::role(Role::find($roleId))->get();
        }
        // all — все пользователи с доступом в ЛК
        return User::permission('access-lk')->get();
    }

    /**
     * Важность для выпадающего списка.
     *
     * @return array<string, string>
     */
    private function importanceLevels(): array
    {
        return [
            'low' => __('Низкая'),
            'normal' => __('Обычная'),
            'high' => __('Высокая'),
            'urgent' => __('Срочная'),
        ];
    }
}
