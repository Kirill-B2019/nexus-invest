<?php

namespace App\Services;

use App\Models\Project;
use App\Models\User;
use App\Notifications\LkNotification;

/**
 * |KB 2026-03-13 Уведомления по проектам: модератору и инициатору.
 */
class ProjectNotificationService
{
    /**
     * Уведомление модераторам о новом проекте на модерации.
     */
    public function notifyModeratorsNewProject(Project $project): void
    {
        $link = route('lk.admin.projects.moderation.show', $project);
        $notification = new LkNotification(
            title: __('Новый проект на модерации'),
            body: __('Инициатор :name отправил проект «:title» на модерацию.', [
                'name' => $project->user?->name ?? __('Неизвестно'),
                'title' => $project->name,
            ]),
            link: $link,
            type: LkNotification::TYPE_SYSTEM,
            importance: LkNotification::IMPORTANCE_HIGH ?? 'high',
            expiresAt: now()->addDays(7),
        );

        $admins = User::role('super-admin')->get();
        try {
            $moderators = User::permission('moderate-projects')->get();
            $admins = $admins->merge($moderators)->unique('id');
        } catch (\Throwable) {
            // разрешение moderate-projects может отсутствовать
        }
        $admins->each(fn (User $u) => $u->notify($notification));
    }

    /**
     * Уведомление инициатору: проект отправлен на модерацию.
     */
    public function notifyInitiatorSubmitted(Project $project): void
    {
        $link = route('lk.projects.edit', $project);
        $notification = new LkNotification(
            title: __('Проект отправлен на модерацию'),
            body: __('Ваш проект «:title» успешно отправлен на проверку. Ожидайте решения модератора.', ['title' => $project->name]),
            link: $link,
            type: LkNotification::TYPE_SYSTEM,
            importance: 'normal',
            expiresAt: now()->addDays(7),
        );
        $project->user?->notify($notification);
    }

    /**
     * Уведомление инициатору: проект одобрен.
     */
    public function notifyInitiatorApproved(Project $project): void
    {
        $link = route('lk.projects.edit', $project);
        $notification = new LkNotification(
            title: __('Проект одобрен'),
            body: __('Ваш проект «:title» одобрен модератором и опубликован на платформе.', ['title' => $project->name]),
            link: $link,
            type: LkNotification::TYPE_SYSTEM,
            importance: 'high',
            expiresAt: now()->addDays(14),
        );
        $project->user?->notify($notification);
    }

    /**
     * Уведомление инициатору: проект отклонён.
     */
    public function notifyInitiatorRejected(Project $project): void
    {
        $link = route('lk.projects.edit', $project);
        $comment = $project->moderation_comment ? __(' Причина: :comment', ['comment' => $project->moderation_comment]) : '';
        $notification = new LkNotification(
            title: __('Проект отклонён'),
            body: __('Ваш проект «:title» отклонён модератором.:comment', ['title' => $project->name, 'comment' => $comment]),
            link: $link,
            type: LkNotification::TYPE_SYSTEM,
            importance: 'high',
            expiresAt: now()->addDays(14),
        );
        $project->user?->notify($notification);
    }
}
