<?php

namespace App\Http\Controllers\App;

use App\Application\Projects\ModerateProjectAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModerateProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * |KB 2026-03-13 Модерация проектов: одобрение/отклонение. Доступ: super-admin или moderate-projects.
 */
class ProjectModerationController extends Controller
{
    public function __construct(
        private readonly ModerateProjectAction $moderateProjectAction
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
        $this->authorize('view', $project);
        $project->load('user', 'documents', 'images');

        return view('app.pages.projects-moderation.show', compact('project'));
    }

    /**
     * Одобрение или отклонение проекта.
     */
    public function moderate(ModerateProjectRequest $request, Project $project): RedirectResponse
    {
        $this->authorize('moderate', $project);

        $action = $request->validated('action');
        $this->moderateProjectAction->handle(
            project: $project,
            moderator: $request->user(),
            action: $action,
            comment: $request->validated('moderation_comment')
        );

        $message = $action === 'approve'
            ? __('Проект одобрен. Инициатор уведомлён.')
            : __('Проект отклонён. Инициатор уведомлён.');

        return redirect()
            ->route('lk.admin.projects.moderation.index')
            ->with('alert_success', $message);
    }
}
