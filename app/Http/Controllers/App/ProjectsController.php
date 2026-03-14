<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\SubmitProjectRequest;
use App\Models\Project;
use App\Models\ProjectDocument;
use App\Models\ProjectImage;
use App\Models\RefDictionary;
use App\Models\RefDictionaryItem;
use App\Services\ProjectNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * |KB 2026-03-13 Проекты инициатора: пошаговая форма, черновики, модерация.
 */
class ProjectsController extends Controller
{
    public function __construct(
        private ProjectNotificationService $notifications
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
            ...$this->projectFormDictionaries(),
        ]);
    }

    /**
     * Сохранение черновика (создание или обновление).
     */
    public function store(StoreProjectRequest $request): RedirectResponse|JsonResponse
    {
        $data = $request->validated();
        unset($data['step'], $data['image_cover'], $data['image_card'],
            $data['document_presentation'], $data['document_business_plan'], $data['document_financial_model']);

        $project = new Project([
            'user_id' => $request->user()->id,
            'status' => Project::STATUS_DRAFT,
        ]);
        $project->fill(array_filter($data));
        $project->save();

        $createdImages = $this->handleProjectFiles($request, $project);

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
        if ($project->user_id !== auth()->id()) {
            abort(403, __('Доступ запрещён.'));
        }

        if (! $project->canEdit()) {
            return redirect()
                ->route('lk.projects.my')
                ->with('alert_warning', __('Редактирование недоступно: проект на модерации или уже рассмотрен.'));
        }

        $project->load('documents', 'images');

        return view('app.pages.projects.create', [
            'project' => $project,
            ...$this->projectFormDictionaries(),
        ]);
    }

    /**
     * Справочники для формы проекта (шаг 1).
     */
    private function projectFormDictionaries(): array
    {
        $dictCodes = [
            'regions' => 'territorial',
            'sector_directions' => 'sectors',
            'industries' => 'sectors',
            'project_statuses' => 'projects',
            'project_types' => 'projects',
            'project_categories' => 'projects',
        ];

        $result = [];
        foreach ($dictCodes as $code => $groupCode) {
            $dict = RefDictionary::whereHas('group', fn ($q) => $q->where('code', $groupCode))
                ->where('code', $code)
                ->first();
            $items = $dict
                ? RefDictionaryItem::where('ref_dictionary_id', $dict->id)
                    ->where(function ($q) {
                        $q->where('is_active', true)->orWhereNull('is_active');
                    })
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get(['id', 'code', 'name'])
                : collect();
            $result[$code] = $items;
        }

        return $result;
    }

    /**
     * Обновление черновика.
     */
    public function update(StoreProjectRequest $request, Project $project): RedirectResponse|JsonResponse
    {
        if ($project->user_id !== auth()->id() || ! $project->canEdit()) {
            abort(403, __('Доступ запрещён.'));
        }

        $data = $request->validated();
        unset($data['step'], $data['image_cover'], $data['image_card'],
            $data['document_presentation'], $data['document_business_plan'], $data['document_financial_model']);

        $project->fill(array_filter($data));
        $project->save();

        $createdImages = $this->handleProjectFiles($request, $project);

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
     * Обработка загрузки картинок и документов.
     */
    private function handleProjectFiles(StoreProjectRequest $request, Project $project): array
    {
        $createdImages = [];

        $maxSortCover = $project->coverImages()->max('sort_order') ?? -1;
        foreach (\Illuminate\Support\Arr::wrap($request->file('image_cover')) as $file) {
            if (! $file) continue;
            $path = $file->store("projects/{$project->id}/images", 'public');
            $img = ProjectImage::create([
                'project_id' => $project->id,
                'type' => ProjectImage::TYPE_COVER,
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'sort_order' => ++$maxSortCover,
            ]);
            $createdImages[] = [
                'id' => $img->id,
                'type' => ProjectImage::TYPE_COVER,
                'url' => asset('storage/'.$img->path),
                'delete_url' => url('/lk/projects/' . $project->id . '/images/' . $img->id),
            ];
        }

        $maxSortCard = $project->cardImages()->max('sort_order') ?? -1;
        foreach (\Illuminate\Support\Arr::wrap($request->file('image_card')) as $file) {
            if (! $file) continue;
            $path = $file->store("projects/{$project->id}/images", 'public');
            $img = ProjectImage::create([
                'project_id' => $project->id,
                'type' => ProjectImage::TYPE_CARD,
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'sort_order' => ++$maxSortCard,
            ]);
            $createdImages[] = [
                'id' => $img->id,
                'type' => ProjectImage::TYPE_CARD,
                'url' => asset('storage/'.$img->path),
                'delete_url' => url('/lk/projects/' . $project->id . '/images/' . $img->id),
            ];
        }

        foreach ([
            'document_presentation' => ProjectDocument::TYPE_PRESENTATION,
            'document_business_plan' => ProjectDocument::TYPE_BUSINESS_PLAN,
            'document_financial_model' => ProjectDocument::TYPE_FINANCIAL_MODEL,
        ] as $key => $type) {
            if ($request->file($key)) {
                $project->documents()->where('type', $type)->each(fn (ProjectDocument $d) => $d->deleteFile());
                ProjectDocument::storeFile($project, $request->file($key), $type);
            }
        }

        return $createdImages;
    }

    /**
     * Удаление изображения проекта (AJAX — без перезагрузки).
     */
    public function deleteImage(Request $request, Project $project, ProjectImage $image): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        if ($project->user_id !== auth()->id() || ! $project->canEdit()) {
            abort(403, __('Доступ запрещён.'));
        }
        if ($image->project_id !== $project->id) {
            abort(404);
        }
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
        if ($project->user_id !== auth()->id() || ! $project->canEdit()) {
            abort(403, __('Доступ запрещён.'));
        }
        if ($document->project_id !== $project->id) {
            abort(404);
        }
        $document->deleteFile();

        return back()->with('status', __('Документ удалён.'));
    }

    /**
     * Отправка на модерацию.
     */
    public function submit(SubmitProjectRequest $request, Project $project): RedirectResponse
    {
        if ($project->coverImages()->count() < 1 || $project->cardImages()->count() < 1) {
            return back()
                ->with('alert_error', __('Для отправки на модерацию добавьте хотя бы одно изображение обложки (1:1) и одно изображение карточки (16:9).'))
                ->with('project_form_step', 1);
        }

        $project->fill($request->validated());
        $project->status = Project::STATUS_MODERATION;
        $project->submitted_at = now();
        $project->save();

        $this->notifications->notifyModeratorsNewProject($project);
        $this->notifications->notifyInitiatorSubmitted($project);

        return redirect()
            ->route('lk.projects.my')
            ->with('alert_success', __('Проект отправлен на модерацию. Вы получите уведомление о результате.'));
    }
}
