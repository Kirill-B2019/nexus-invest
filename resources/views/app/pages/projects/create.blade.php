@extends('layouts.app.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('app/css/vendor/cropper.min.css') }}">
    <style>
    /* Пошаговая форма: индикатор шагов */
    .project-form-stepper { border-bottom: 1px solid var(--separator-color, #e5e5e0); padding-bottom: 1rem; }
    .project-form-stepper-title { font-weight: 500; }
    .nav-pills-project-steps { display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: stretch; }
    .project-step-item { flex: 1; min-width: 0; }
    .project-step-link { display: flex !important; align-items: center; gap: 0.5rem; padding: 0.5rem 0.75rem; border-radius: 0.35rem; text-decoration: none !important; transition: background-color 0.2s, color 0.2s; }
    .project-step-link:hover { background-color: rgba(0,0,0,0.05); }
    #app-container.body-theme-dark .project-step-link:hover { background-color: rgba(255,255,255,0.08); }
    .project-step-num { display: inline-flex; align-items: center; justify-content: center; min-width: 1.5rem; height: 1.5rem; border-radius: 50%; font-size: 0.75rem; font-weight: 600; background: rgba(0,0,0,0.1); color: inherit; }
    #app-container.body-theme-dark .project-step-num { background: rgba(255,255,255,0.15); }
    .project-step-link.active .project-step-num { background: var(--theme-color-1, #4B7B5B); color: #fff !important; }
    #app-container.body-theme-dark .project-step-link.active .project-step-num { background: var(--app-color-primary, #C5FF41); color: #191919 !important; }
    .project-step-link.completed .project-step-num { background: var(--theme-color-1, #4B7B5B); color: #fff !important; }
    #app-container.body-theme-dark .project-step-link.completed .project-step-num { background: rgba(197,255,65,0.3); color: #C5FF41 !important; }
    .project-step-label { font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .project-advanced-toggle { cursor: pointer; user-select: none; }
    .project-advanced-box { border: 1px dashed var(--separator-color, #e5e5e0); border-radius: 0.5rem; padding: 1rem; }
    @media (max-width: 767.98px) {
        .project-step-label { font-size: 0.75rem; }
        .nav-pills-project-steps { flex-direction: column; }
    }
    </style>
@endpush

@section('title', $project->exists ? ($project->canEdit() ? __('Редактирование проекта') : __('Просмотр проекта')) : __('Новый проект'))

@section('header')
    <h1>{{ $project->exists ? ($project->canEdit() ? __('Редактирование проекта') : __('Просмотр проекта')) : __('Новый проект') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Проекты'), 'url' => route('lk.projects.my')],
        ['label' => $project->exists ? __('Редактирование') : __('Новый проект')],
    ]" separator-margin="mb-5" />
    @include('layouts.app.flash')

    @php
        $isReadOnly = $project->exists && !$project->canEdit();
        $projectData = $project->toArray();
        $initialStep = (int) (session('project_form_step') ?? 1);
    @endphp
    <div class="card" x-data="projectForm({{ $project->exists ? 'true' : 'false' }}, {{ json_encode($projectData) }}, {{ $isReadOnly ? 'true' : 'false' }}, {{ $initialStep }})">
        <div class="card-body">
            @if($isReadOnly)
                <div class="mb-3">
                    <span class="badge {{ $project->status === 'moderation' ? 'badge-warning' : ($project->status === 'approved' ? 'badge-success' : 'badge-danger') }}">
                        {{ \App\Models\Project::statusLabel($project->status) }}
                    </span>
                    @if($project->moderation_comment)
                        <div class="alert alert-warning mt-2 mb-0">{{ __('Комментарий модератора:') }} {{ $project->moderation_comment }}</div>
                    @endif
                </div>
            @endif
            {{-- Пошаговая форма: индикатор шагов --}}
            <div class="project-form-stepper mb-4">
                <p class="project-form-stepper-title text-muted small mb-2">{{ __('Шаг') }} <span x-text="step"></span> {{ __('из') }} 5</p>
                <p class="text-muted small mb-3">{{ __('Обязательные поля отмечены звездочкой. Остальные данные можно заполнить позже и сохранить как черновик.') }}</p>
                <ul class="nav nav-pills nav-pills-project-steps" role="tablist">
                    <li class="nav-item project-step-item">
                        <a class="nav-link project-step-link" :class="{ active: step === 1, completed: step > 1 }" href="#" @click.prevent="goToStep(1)">
                            <span class="project-step-num" x-text="step > 1 ? '✓' : '1'"></span>
                            <span class="project-step-label">{{ __('Основные сведения') }}</span>
                        </a>
                    </li>
                    <li class="nav-item project-step-item">
                        <a class="nav-link project-step-link" :class="{ active: step === 2, completed: step > 2 }" href="#" @click.prevent="goToStep(2)">
                            <span class="project-step-num" x-text="step > 2 ? '✓' : '2'"></span>
                            <span class="project-step-label">{{ __('Контакты') }}</span>
                        </a>
                    </li>
                    <li class="nav-item project-step-item">
                        <a class="nav-link project-step-link" :class="{ active: step === 3, completed: step > 3 }" href="#" @click.prevent="goToStep(3)">
                            <span class="project-step-num" x-text="step > 3 ? '✓' : '3'"></span>
                            <span class="project-step-label">{{ __('Финансы') }}</span>
                        </a>
                    </li>
                    <li class="nav-item project-step-item">
                        <a class="nav-link project-step-link" :class="{ active: step === 4, completed: step > 4 }" href="#" @click.prevent="goToStep(4)">
                            <span class="project-step-num" x-text="step > 4 ? '✓' : '4'"></span>
                            <span class="project-step-label">{{ __('Проверка') }}</span>
                        </a>
                    </li>
                    <li class="nav-item project-step-item">
                        <a class="nav-link project-step-link" :class="{ active: step === 5, completed: false }" href="#" @click.prevent="goToStep(5)">
                            <span class="project-step-num">5</span>
                            <span class="project-step-label">{{ __('Заявитель') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <form method="post" action="{{ $project->exists ? route('lk.projects.update', $project) : route('lk.projects.store') }}" id="project-form" enctype="multipart/form-data">
                @csrf
                @if($project->exists)
                    @method('PATCH')
                @endif
                <input type="hidden" name="step" :value="step">

                {{-- Шаг 1 --}}
                <div x-show="step === 1" x-cloak>
                    <h5 class="mb-3">{{ __('Основные сведения о проекте') }}</h5>
                    <p class="text-muted small mb-3">{{ __('Сначала заполните обязательные поля и загрузите изображения. Детальные классификаторы можно открыть ниже.') }}</p>
                    <div class="form-group">
                        <label for="name">{{ __('Название проекта') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="200" x-model="form.name" :readonly="readOnly" required>
                        @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="pitch">{{ __('Краткое описание (питч)') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="pitch" name="pitch" rows="3" maxlength="500" x-model="form.pitch" :readonly="readOnly" required></textarea>
                        <small class="text-muted">{{ __('2–3 предложения о сути проекта') }}</small>
                        @error('pitch')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Полное описание') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="5" maxlength="5000" x-model="form.description" :readonly="readOnly" required></textarea>
                        @error('description')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <button type="button"
                                class="btn btn-link p-0 project-advanced-toggle"
                                @click="showAdvanced = !showAdvanced"
                                :aria-expanded="showAdvanced ? 'true' : 'false'">
                            <span x-show="!showAdvanced">{{ __('Показать дополнительные параметры') }}</span>
                            <span x-show="showAdvanced">{{ __('Скрыть дополнительные параметры') }}</span>
                        </button>
                    </div>

                    <div class="project-advanced-box mb-3" x-show="showAdvanced" x-cloak>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="region">{{ __('Регион') }}</label>
                                    <select class="form-control" id="region" name="region" x-model="form.region" :disabled="readOnly">
                                        <option value="">{{ __('— Выберите —') }}</option>
                                        @foreach($regions ?? [] as $item)
                                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sector_direction">{{ __('Сектор направления') }}</label>
                                    <select class="form-control" id="sector_direction" name="sector_direction" x-model="form.sector_direction" :disabled="readOnly">
                                        <option value="">{{ __('— Выберите —') }}</option>
                                        @foreach($sector_directions ?? [] as $item)
                                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="industry">{{ __('Отрасль') }}</label>
                                    <select class="form-control" id="industry" name="industry" x-model="form.industry" :disabled="readOnly">
                                        <option value="">{{ __('— Выберите —') }}</option>
                                        @foreach($industries ?? [] as $item)
                                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="project_type">{{ __('Тип проекта') }}</label>
                                    <select class="form-control" id="project_type" name="project_type" x-model="form.project_type" :disabled="readOnly">
                                        <option value="">{{ __('— Выберите —') }}</option>
                                        @foreach($project_types ?? [] as $item)
                                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">{{ __('Категория') }}</label>
                                    <select class="form-control" id="category" name="category" x-model="form.category" :disabled="readOnly">
                                        <option value="">{{ __('— Выберите —') }}</option>
                                        @foreach($project_categories ?? [] as $item)
                                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stage">{{ __('Стадия проекта') }}</label>
                                    <select class="form-control" id="stage" name="stage" x-model="form.stage" :disabled="readOnly">
                                        <option value="">{{ __('— Выберите —') }}</option>
                                        @foreach($project_statuses ?? [] as $item)
                                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Картинки: загрузка через модальное окно с кроппером и водяным знаком --}}
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Обложка каталога (1:1)') }} <span class="text-danger">*</span></label>
                                <small class="d-block text-muted mb-2">{{ __('Квадратные изображения, не менее 300×300 px. JPG, PNG, WebP, до 5 МБ. Можно добавить несколько.') }}</small>
                                <div class="mb-2">
                                    <div id="project-cover-previews" class="d-flex flex-wrap">
                                        @foreach($project->exists ? $project->coverImages : [] as $img)
                                            <div class="project-image-item project-image-item-server mr-2 mb-2 position-relative" data-id="{{ $img->id }}" data-type="cover" data-delete-url="{{ url('/lk/projects/' . $project->id . '/images/' . $img->id) }}">
                                                <img src="{{ asset('storage/'.$img->path) }}" alt="" class="img-thumbnail d-block" style="max-width:80px;aspect-ratio:1;object-fit:cover">
                                                @if(!$isReadOnly)
                                                    <button type="button" class="project-image-delete-btn btn btn-danger btn-sm" title="{{ __('Удалить') }}" aria-label="{{ __('Удалить') }}">×</button>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if(!$isReadOnly)
                                    <input type="file" class="d-none" id="image_cover" name="image_cover[]" accept="image/jpeg,image/png,image/webp" multiple>
                                    <button type="button" class="btn btn-outline-primary btn-upload" data-toggle="modal" data-target="#projectImageCropperModal" data-aspect="1" data-input="image_cover" data-preview-container="#project-cover-previews" data-type="cover">
                                        {{ __('Добавить изображение') }}
                                    </button>
                                @endif
                                @error('image_cover')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Карточка проекта (16:9)') }} <span class="text-danger">*</span></label>
                                <small class="d-block text-muted mb-2">{{ __('Широкие изображения, не менее 550×300 px. JPG, PNG, WebP, до 5 МБ. Можно добавить несколько.') }}</small>
                                <div class="mb-2">
                                    <div id="project-card-previews" class="d-flex flex-wrap">
                                        @foreach($project->exists ? $project->cardImages : [] as $img)
                                            <div class="project-image-item project-image-item-server mr-2 mb-2 position-relative" data-id="{{ $img->id }}" data-type="card" data-delete-url="{{ url('/lk/projects/' . $project->id . '/images/' . $img->id) }}">
                                                <img src="{{ asset('storage/'.$img->path) }}" alt="" class="img-thumbnail d-block" style="max-width:120px;aspect-ratio:16/9;object-fit:cover">
                                                @if(!$isReadOnly)
                                                    <button type="button" class="project-image-delete-btn btn btn-danger btn-sm" title="{{ __('Удалить') }}" aria-label="{{ __('Удалить') }}">×</button>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if(!$isReadOnly)
                                    <input type="file" class="d-none" id="image_card" name="image_card[]" accept="image/jpeg,image/png,image/webp" multiple>
                                    <button type="button" class="btn btn-outline-primary btn-upload" data-toggle="modal" data-target="#projectImageCropperModal" data-aspect="16/9" data-input="image_card" data-preview-container="#project-card-previews" data-type="card">
                                        {{ __('Добавить изображение') }}
                                    </button>
                                @endif
                                @error('image_card')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Шаг 2: Контакты и документы --}}
                <div x-show="step === 2" x-cloak>
                    <h5 class="mb-2">{{ __('Контакты и документы') }}</h5>
                    <p class="text-muted small mb-3">{{ __('Контакты нужны для обратной связи. Документы можно добавить сразу или вернуться к ним позже.') }}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_person">{{ __('Контактное лицо') }}</label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person" maxlength="255" x-model="form.contact_person" :readonly="readOnly">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">{{ __('Телефон') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" maxlength="50" x-model="form.phone" :readonly="readOnly">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="255" x-model="form.email" :readonly="readOnly">
                                @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website">{{ __('Сайт проекта') }}</label>
                                <input type="url" class="form-control" id="website" name="website" maxlength="500" x-model="form.website" :readonly="readOnly" placeholder="https://">
                                @error('website')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h6 class="mb-3">{{ __('Документы') }}</h6>
                    @if($project->exists && $project->documents->isNotEmpty())
                        <div class="mb-3">
                            @foreach($project->documents as $doc)
                                <div class="small mb-1 d-flex align-items-center">
                                    <span>{{ \App\Models\ProjectDocument::typeLabel($doc->type) }}: {{ $doc->original_name ?? basename($doc->path) }}</span>
                                    @if(!$isReadOnly)
                                        <form method="post" action="{{ url('/lk/projects/' . $project->id . '/documents/' . $doc->id) }}" class="d-inline ml-2" data-swal-confirm="{{ __('Удалить файл?') }}" data-swal-title="{{ __('Подтверждение') }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-sm p-0 text-danger">{{ __('Удалить') }}</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if(!$isReadOnly)
                    <div class="form-group">
                        <label class="form-label d-block">{{ __('Презентация') }}</label>
                        <small class="d-block text-muted mb-1">{{ __('PDF, PPT, PPTX, до 20 МБ') }}</small>
                        <label class="btn btn-outline-primary btn-upload" for="document_presentation">
                            <input type="file" class="sr-only" id="document_presentation" name="document_presentation" accept=".pdf,.ppt,.pptx">
                            {{ __('Выбрать файл') }}
                        </label>
                        @error('document_presentation')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label d-block">{{ __('Бизнес-план') }}</label>
                        <small class="d-block text-muted mb-1">{{ __('PDF, DOC, DOCX, XLS, XLSX, до 20 МБ') }}</small>
                        <label class="btn btn-outline-primary btn-upload" for="document_business_plan">
                            <input type="file" class="sr-only" id="document_business_plan" name="document_business_plan" accept=".pdf,.doc,.docx,.xls,.xlsx">
                            {{ __('Выбрать файл') }}
                        </label>
                        @error('document_business_plan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label d-block">{{ __('Финансовая модель') }}</label>
                        <small class="d-block text-muted mb-1">{{ __('PDF, XLS, XLSX, до 20 МБ') }}</small>
                        <label class="btn btn-outline-primary btn-upload" for="document_financial_model">
                            <input type="file" class="sr-only" id="document_financial_model" name="document_financial_model" accept=".pdf,.xls,.xlsx">
                            {{ __('Выбрать файл') }}
                        </label>
                        @error('document_financial_model')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    @endif
                </div>

                {{-- Шаг 3: Финансы --}}
                <div x-show="step === 3" x-cloak>
                    <h5 class="mb-3">{{ __('Финансовые параметры') }}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="target_amount">{{ __('Требуемый объём инвестиций (руб.)') }}</label>
                                <input type="number" class="form-control" id="target_amount" name="target_amount" min="0" step="1" x-model.number="form.target_amount" :readonly="readOnly">
                                @error('target_amount')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="min_investment">{{ __('Минимальная сумма входа (руб.)') }}</label>
                                <input type="number" class="form-control" id="min_investment" name="min_investment" min="0" step="1" x-model.number="form.min_investment" :readonly="readOnly">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration_months">{{ __('Срок реализации (мес.)') }}</label>
                                <input type="number" class="form-control" id="duration_months" name="duration_months" min="1" max="600" x-model.number="form.duration_months" :readonly="readOnly">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="investment_form">{{ __('Форма участия инвестора') }}</label>
                                <select class="form-control" id="investment_form" name="investment_form" x-model="form.investment_form">
                                    <option value="">{{ __('— Выберите —') }}</option>
                                    <option value="equity">{{ __('Долевое участие') }}</option>
                                    <option value="loan">{{ __('Займ') }}</option>
                                    <option value="convertible">{{ __('Конвертируемый займ') }}</option>
                                    <option value="tokenization">{{ __('Токенизация (RWA)') }}</option>
                                    <option value="other">{{ __('Другое') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Шаг 4: Критерии оценки, анализ AI --}}
                <div x-show="step === 4" x-cloak>
                    <h5 class="mb-3">{{ __('Проверка готовности') }}</h5>
                    <p class="text-muted mb-4">{{ __('Перед отправкой на модерацию проверьте ключевые данные проекта. Система покажет ошибки, если обязательные поля не заполнены.') }}</p>
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <p class="mb-0 text-muted small">{{ __('Минимальные требования: название, краткое и полное описание, а также изображения для обложки и карточки проекта.') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Шаг 5: Заявитель --}}
                <div x-show="step === 5" x-cloak>
                    <h5 class="mb-3">{{ __('Заявитель') }}</h5>
                    <div class="form-group">
                        <label for="company_name">{{ __('Наименование организации / ИП') }}</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" maxlength="255" x-model="form.company_name" :readonly="readOnly">
                    </div>
                    <div class="form-group">
                        <label for="inn">{{ __('ИНН') }}</label>
                        <input type="text" class="form-control" id="inn" name="inn" maxlength="12" x-model="form.inn" :readonly="readOnly">
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex flex-wrap lk-form-actions" x-show="!readOnly">
                    <button type="button" class="btn btn-outline-secondary" @click="resetFields()">{{ __('Отмена') }}</button>
                    <button type="button" class="btn btn-outline-primary" @click="saveDraft()">{{ __('Сохранить') }}</button>
                    <button type="button" class="btn btn-primary" @click="nextStep()" x-show="step < 5">{{ __('Следующий шаг') }}</button>
                    @if($project->exists && $project->canSubmit())
                        <button type="button" class="btn btn-success" @click="submitForModeration()">{{ __('Отправить на модерацию') }}</button>
                    @endif
                    <a href="{{ route('lk.projects.my') }}" class="btn btn-link text-muted">{{ __('К списку проектов') }}</a>
                </div>
                @if($isReadOnly)
                <div class="d-flex flex-wrap lk-form-actions">
                    <a href="{{ route('lk.projects.my') }}" class="btn btn-outline-secondary">{{ __('К списку проектов') }}</a>
                </div>
                @endif
            </form>

            {{-- Модальное окно загрузки и обрезки изображения (компонент app) --}}
            @if(!$isReadOnly)
                <x-app.project-image-cropper-modal />
            @endif

            @if($project->exists && $project->canSubmit())
            <form method="post" action="{{ route('lk.projects.submit', $project) }}" id="submit-form" class="d-none">
                @csrf
                <input type="hidden" name="name" :value="form.name">
                <input type="hidden" name="pitch" :value="form.pitch">
                <input type="hidden" name="description" :value="form.description">
            </form>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        window.PROJECT_WATERMARK_URL = "{{ asset('assets/imgs/template/logo-head.svg') }}";
        window.PROJECT_FORM_MESSAGES = {
            fillRequired: "{{ __('Заполните обязательные поля: название, краткое и полное описание.') }}",
            fillRequiredShort: "{{ __('Заполните обязательные поля.') }}",
            addImages: "{{ __('Добавьте хотя бы одно изображение обложки (1:1) и одно изображение карточки (16:9).') }}",
            addImagesShort: "{{ __('Добавьте изображения обложки и карточки.') }}",
            deleteError: "{{ __('Не удалось удалить изображение.') }}",
            delete: "{{ __('Удалить') }}",
            draftSaved: "{{ __('Черновик сохранён.') }}",
            saveError: "{{ __('Не удалось сохранить.') }}"
        };
    </script>
    <script src="{{ asset('app/js/vendor/cropper.min.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script src="{{ asset('app/js/project-form.js') }}?v=1.0.1"></script>
    @if(!$isReadOnly)
    <script src="{{ asset('app/js/project-image-cropper.js') }}"></script>
    @endif
    <style>
    [x-cloak]{display:none!important}
    .project-image-item { display: inline-block; }
    .project-image-item .project-image-delete-btn {
        position: absolute;
        top: 4px;
        right: 4px;
        width: 22px;
        height: 22px;
        padding: 0;
        font-size: 16px;
        line-height: 1;
        border-radius: 50%;
        opacity: 0.9;
        z-index: 2;
    }
    .project-image-item .project-image-delete-btn:hover { opacity: 1; }
    #projectCropperContainer.project-cropper-container { min-height: 300px; max-height: 400px; background: #000; }
    .project-cropper-preview { width: 100%; max-width: 160px; aspect-ratio: 16/9; background: #eee; }
    </style>
    @endpush
@endsection
