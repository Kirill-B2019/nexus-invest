@extends('layouts.app.app')

@section('title', __('Создать уведомление'))

@section('header')
    <h1>{{ __('Создать уведомление') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lk.admin.notifications.index') }}">{{ __('Уведомления') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Создать') }}</li>
        </ol>
    </nav>
    <div class="separator mb-4"></div>

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('lk.admin.notifications.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">{{ __('Заголовок') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" maxlength="255" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="body">{{ __('Текст') }} <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="4" maxlength="5000" required>{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="link">{{ __('Ссылка') }}</label>
                    <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" maxlength="500" placeholder="https://">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="importance">{{ __('Важность') }}</label>
                    <select class="form-control @error('importance') is-invalid @enderror" id="importance" name="importance">
                        @foreach($importanceLevels as $value => $label)
                            <option value="{{ $value }}" {{ old('importance', 'normal') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('importance')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="expires_at">{{ __('Срок действия') }}</label>
                    <input type="datetime-local" class="form-control @error('expires_at') is-invalid @enderror" id="expires_at" name="expires_at" value="{{ old('expires_at') }}">
                    <small class="form-text text-muted">{{ __('Не заполнять — без срока') }}</small>
                    @error('expires_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('Аудитория') }}</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="audience" id="audience_all" value="all" {{ old('audience', 'all') === 'all' ? 'checked' : '' }}>
                        <label class="form-check-label" for="audience_all">{{ __('Всем пользователям ЛК') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="audience" id="audience_role" value="role" {{ old('audience') === 'role' ? 'checked' : '' }}>
                        <label class="form-check-label" for="audience_role">{{ __('По роли') }}</label>
                    </div>
                    <div class="pl-4 mt-1" id="role_select_wrap" style="{{ old('audience') === 'role' ? '' : 'display:none;' }}">
                        <select class="form-control form-control-sm" name="role_id" id="role_id">
                            <option value="">{{ __('Выберите роль') }}</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ (int) old('role_id') === $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="audience" id="audience_user" value="user" {{ old('audience') === 'user' ? 'checked' : '' }}>
                        <label class="form-check-label" for="audience_user">{{ __('Конкретный пользователь') }}</label>
                    </div>
                    <div class="pl-4 mt-1" id="user_select_wrap" style="{{ old('audience') === 'user' ? '' : 'display:none;' }}">
                        <input type="number" class="form-control form-control-sm" name="user_id" id="user_id" value="{{ old('user_id') }}" placeholder="{{ __('ID пользователя') }}" min="1">
                        <small class="form-text text-muted">{{ __('Введите ID пользователя') }}</small>
                    </div>
                    @error('audience')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('role_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('user_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('Отправить') }}</button>
                    <a href="{{ route('lk.admin.notifications.index') }}" class="btn btn-outline-secondary">{{ __('Отмена') }}</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('input[name="audience"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('role_select_wrap').style.display = this.value === 'role' ? 'block' : 'none';
                document.getElementById('user_select_wrap').style.display = this.value === 'user' ? 'block' : 'none';
            });
        });
    </script>
    @endpush
@endsection
