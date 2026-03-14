<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModerateProjectRequest;
use App\Models\Project;
use App\Services\ProjectNotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * |KB 2026-03-13 Модерация проектов: одобрение/отклонение. Доступ: super-admin или moderate-projects.
 */
class ProjectModerationController extends Controller
{
    public function __construct(
        private ProjectNotificationService $notifications
    ) {}

    /**
     * Список проектов на модерации.
     */
    public function index(): View
    {
        $projects = Project::whereIn('status', [Project::STATUS_MODERATION, Project::STATUS_APPROVED, Project::STATUS_REJECTED])
            ->with('user')
            ->orderByRaw("CASE WHEN status = 'moderation' THEN 0 ELSE 1 END")
            ->orderByDesc('submitted_at')
            ->paginate(20);

        return view('app.pages.projects-moderation.index', compact('projects'));
    }

    /**
     * Просмотр проекта для модерации.
     */
    public function show(Project $project): View
    {
        $project->load('user', 'documents', 'images');

        return view('app.pages.projects-moderation.show', compact('project'));
    }

    /**
     * Одобрение или отклонение проекта.
     */
    public function moderate(ModerateProjectRequest $request, Project $project): RedirectResponse
    {
        if ($project->status !== Project::STATUS_MODERATION) {
            return redirect()
                ->route('lk.admin.projects.moderation.index')
                ->with('alert_warning', __('Проект уже рассмотрен.'));
        }

        $action = $request->validated('action');

        if ($action === 'approve') {
            $project->status = Project::STATUS_APPROVED;
            $project->moderation_comment = null;
        } else {
            $project->status = Project::STATUS_REJECTED;
            $project->moderation_comment = $request->validated('moderation_comment');
        }

        $project->moderated_at = now();
        $project->moderated_by = $request->user()->id;
        $project->save();

        if ($action === 'approve') {
            $this->notifications->notifyInitiatorApproved($project);
        } else {
            $this->notifications->notifyInitiatorRejected($project);
        }

        $message = $action === 'approve'
            ? __('Проект одобрен. Инициатор уведомлён.')
            : __('Проект отклонён. Инициатор уведомлён.');

        return redirect()
            ->route('lk.admin.projects.moderation.index')
            ->with('alert_success', $message);
    }
}
