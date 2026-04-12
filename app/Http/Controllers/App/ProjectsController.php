<?php

namespace App\Http\Controllers\App;

use App\Application\Projects\SaveProjectDraftAction;
use App\Application\Projects\SubmitProjectForModerationAction;
use App\Application\Projects\UpdateProjectDraftAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\SubmitProjectRequest;
use App\Models\Project;
use App\Models\ProjectDocument;
use App\Models\ProjectImage;
use App\Services\ProjectFormDictionaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * |KB 2026-03-13 Проекты инициатора: пошаговая форма, черновики, модерация.
 */
class ProjectsController extends Controller
{
    public function __construct(
        private readonly SaveProjectDraftAction $saveProjectDraftAction,
        private readonly UpdateProjectDraftAction $updateProjectDraftAction,
        private readonly SubmitProjectForModerationAction $submitProjectForModerationAction,
        private readonly ProjectFormDictionaryService $projectFormDictionaryService
    ) {}

    /**
     * Мой портфель (инвестор).
     */
    public function portfolio(): View
    {
        return view('app.pages.projects.portfolio');
    }

    /**
     * Все проекты (инвестор).
     */
    public function all(): View
    {
        return view('app.pages.projects.all');
    }

    /**
     * Мои проекты (инициатор).
     */
    public function my(): View
    {
        $projects = Project::where('user_id', auth()->id())
            ->orderByDesc('updated_at')
            ->paginate(15);

        return view('app.pages.projects.my', compact('projects'));
    }

    /**
     * Форма создания нового проекта.
     */
    public function create(): View
    {
        $project = new Project(['user_id' => auth()->id(), 'status' => Project::STATUS_DRAFT]);

        return view('app.pages.projects.create', [
            'project' => $project,
            ...$this->projectFormDictionaryService->getDictionaries(),
        ]);
    }

    /**
     * Сохранение черновика (создание или обновление).
     */
    public function store(StoreProjectRequest $request): RedirectResponse|JsonResponse
    {
        $result = $this->saveProjectDraftAction->handle($request, $request->validated());
        /** @var Project $project */
        $project = $result['project'];
        $createdImages = $result['created_images'];

        $step = (int) $request->input('step', 1);
        if ($step < 1 || $step > 5) $step = 1;

        if ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'step' => $step,
                'form_action' => route('lk.projects.update', $project),
                'created_images' => $createdImages,
            ]);
        }

        return redirect()
            ->route('lk.projects.edit', $project)
            ->with('status', __('Черновик сохранён.'))
            ->with('project_form_step', $step);
    }

    /**
     * Форма редактирования проекта (только черновик).
     */
    public function edit(Project $project): View|RedirectResponse
    {
        $this->authorize('update', $project);

        if (! $project->canEdit()) {
            return redirect()
                ->route('lk.projects.my')
                ->with('alert_warning', __('Редактирование недоступно: проект на модерации или уже рассмотрен.'));
        }

        $project->load('documents', 'images');

        return view('app.pages.projects.create', [
            'project' => $project,
            ...$this->projectFormDictionaryService->getDictionaries(),
        ]);
    }

    /**
     * Обновление черновика.
     */
    public function update(StoreProjectRequest $request, Project $project): RedirectResponse|JsonResponse
    {
        $this->authorize('update', $project);
        $result = $this->updateProjectDraftAction->handle($request, $project, $request->validated());
        $createdImages = $result['created_images'];

        $step = (int) $request->input('step', 1);
        if ($step < 1 || $step > 5) $step = 1;

        if ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'step' => $step,
                'created_images' => $createdImages,
            ]);
        }

        return back()
            ->with('status', __('Черновик сохранён.'))
            ->with('project_form_step', $step);
    }

    /**
     * Удаление изображения проекта (AJAX — без перезагрузки).
     */
    public function deleteImage(Request $request, Project $project, ProjectImage $image): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->authorize('deleteImage', [$project, $image]);
        $image->deleteFile();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('status', __('Изображение удалено.'));
    }

    /**
     * Удаление документа проекта.
     */
    public function deleteDocument(Project $project, ProjectDocument $document): RedirectResponse
    {
        $this->authorize('deleteDocument', [$project, $document]);
        $document->deleteFile();

        return back()->with('status', __('Документ удалён.'));
    }

    /**
     * Отправка на модерацию.
     */
    public function submit(SubmitProjectRequest $request, Project $project): RedirectResponse
    {
        $this->authorize('submit', $project);

        if ($project->coverImages()->count() < 1 || $project->cardImages()->count() < 1) {
            return back()
                ->with('alert_error', __('Для отправки на модерацию добавьте хотя бы одно изображение обложки (1:1) и одно изображение карточки (16:9).'))
                ->with('project_form_step', 1);
        }

        $this->submitProjectForModerationAction->handle($project, $request->validated());

        return redirect()
            ->route('lk.projects.my')
            ->with('alert_success', __('Проект отправлен на модерацию. Вы получите уведомление о результате.'));
    }
}
