@extends('layouts.app.app')

@section('title', __('Модерация проекта'))

@section('header')
    <h1>{{ __('Модерация проекта') }}</h1>
@endsection

@section('content')
    <x-lk-breadcrumb :items="[
        ['label' => __('Личный кабинет'), 'url' => route('lk')],
        ['label' => __('Настройки'), 'url' => route('lk.admin.settings.index')],
        ['label' => __('Модерация проектов'), 'url' => route('lk.admin.projects.moderation.index')],
        ['label' => $project->name ?: __('Проект')],
    ]" separator-margin="mb-5" />
    @include('layouts.app.flash')

    @if($project->status === 'moderation')
    <div class="card mb-4 border-warning">
        <div class="card-body">
            <h6 class="mb-2">{{ __('Решение модератора') }}</h6>
            <p class="text-muted small mb-3">{{ __('Сначала примите решение по проекту, затем при необходимости изучите подробные разделы ниже.') }}</p>
            <form method="post" action="{{ route('lk.admin.projects.moderation.moderate', $project) }}">
                @csrf
                <div class="form-group">
                    <label for="moderation_comment">{{ __('Комментарий (обязателен при отклонении)') }}</label>
                    <textarea class="form-control" id="moderation_comment" name="moderation_comment" rows="3" maxlength="1000" placeholder="{{ __('Укажите причину отклонения для инициатора...') }}">{{ old('moderation_comment') }}</textarea>
                    @error('moderation_comment')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex flex-wrap lk-form-actions">
                    <button type="submit" name="action" value="approve" class="btn btn-success">{{ __('Одобрить') }}</button>
                    <button type="submit" name="action" value="reject" class="btn btn-danger">{{ __('Отклонить') }}</button>
                    <a href="{{ route('lk.admin.projects.moderation.index') }}" class="btn btn-outline-secondary">{{ __('Назад') }}</a>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $project->name ?: __('Без названия') }}</h5>
            <p class="text-muted mb-2">{{ __('Инициатор:') }} {{ $project->user?->name ?? '—' }} ({{ $project->user?->email ?? '—' }})</p>
            <p class="text-muted mb-0">{{ __('Отправлен:') }} {{ $project->submitted_at?->format('d.m.Y H:i') ?? '—' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h6 class="text-uppercase text-muted mb-3">{{ __('Основные сведения') }}</h6>
            @if($project->images->isNotEmpty())
                <div class="row mb-3">
                    @if($project->coverImages->isNotEmpty())
                        <div class="col-md-6">
                            <p class="small text-muted mb-1">{{ __('Обложка 1:1') }}</p>
                            <div class="d-flex flex-wrap">
                                @foreach($project->coverImages as $img)
                                    <img src="{{ asset('storage/'.$img->path) }}" alt="" class="img-thumbnail mr-2 mb-2" style="max-width:120px;aspect-ratio:1;object-fit:cover">
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($project->cardImages->isNotEmpty())
                        <div class="col-md-6">
                            <p class="small text-muted mb-1">{{ __('Карточка 16:9') }}</p>
                            <div class="d-flex flex-wrap">
                                @foreach($project->cardImages as $img)
                                    <img src="{{ asset('storage/'.$img->path) }}" alt="" class="img-thumbnail mr-2 mb-2" style="max-width:200px;aspect-ratio:16/9;object-fit:cover">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            <p><strong>{{ __('Краткое описание:') }}</strong><br>{{ $project->pitch ?: '—' }}</p>
            <p><strong>{{ __('Полное описание:') }}</strong><br>{{ $project->description ?: '—' }}</p>
            <p class="mb-0"><strong>{{ __('Регион / Сектор / Отрасль / Тип / Категория / Стадия:') }}</strong><br>
                {{ \App\Models\RefDictionaryItem::labelByCode('regions', $project->region) ?: $project->region ?: '—' }} /
                {{ \App\Models\RefDictionaryItem::labelByCode('sector_directions', $project->sector_direction) ?: $project->sector_direction ?: '—' }} /
                {{ \App\Models\RefDictionaryItem::labelByCode('industries', $project->industry) ?: $project->industry ?: '—' }} /
                {{ \App\Models\RefDictionaryItem::labelByCode('project_types', $project->project_type) ?: $project->project_type ?: '—' }} /
                {{ \App\Models\RefDictionaryItem::labelByCode('project_categories', $project->category) ?: $project->category ?: '—' }} /
                {{ \App\Models\RefDictionaryItem::labelByCode('project_statuses', $project->stage) ?: $project->stage ?: '—' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h6 class="text-uppercase text-muted mb-3">{{ __('Финансы') }}</h6>
            <p class="mb-0">{{ __('Требуемый объём:') }} {{ $project->target_amount ? number_format($project->target_amount, 0, ',', ' ') . ' ₽' : '—' }} |
                {{ __('Мин. вход:') }} {{ $project->min_investment ? number_format($project->min_investment, 0, ',', ' ') . ' ₽' : '—' }} |
                {{ __('Срок:') }} {{ $project->duration_months ? $project->duration_months . ' мес.' : '—' }} |
                {{ __('Форма:') }} {{ $project->investment_form ?: '—' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h6 class="text-uppercase text-muted mb-3">{{ __('Контакты') }}</h6>
            <p class="mb-0">{{ $project->contact_person ?: '—' }} | {{ $project->phone ?: '—' }} | {{ $project->email ?: '—' }} | {{ $project->website ?: '—' }}</p>
        </div>
    </div>
    @if($project->documents->isNotEmpty())
    <div class="card mb-4">
        <div class="card-body">
            <h6 class="text-uppercase text-muted mb-3">{{ __('Документы') }}</h6>
            <ul class="list-unstyled mb-0">
                @foreach($project->documents as $doc)
                    <li><a href="{{ asset('storage/'.$doc->path) }}" target="_blank">{{ \App\Models\ProjectDocument::typeLabel($doc->type) }}: {{ $doc->original_name ?? basename($doc->path) }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <h6 class="text-uppercase text-muted mb-3">{{ __('Заявитель') }}</h6>
            <p class="mb-0">{{ $project->company_name ?: '—' }} | ИНН: {{ $project->inn ?: '—' }}</p>
        </div>
    </div>

    @if($project->status !== 'moderation')
    <div class="card">
        <div class="card-body">
            <p class="text-muted mb-0">{{ __('Проект уже рассмотрен.') }} <a href="{{ route('lk.admin.projects.moderation.index') }}">{{ __('К списку') }}</a></p>
        </div>
    </div>
    @endif
@endsection
