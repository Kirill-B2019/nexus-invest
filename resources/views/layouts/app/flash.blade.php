@php
    $appFlashSuccess = session('alert_success');
    $appFlashError = session('alert_error') ?: session('error');
    $appFlashWarning = session('alert_warning') ?: session('warning');
    $appFlashInfo = session('info');

    if (! $appFlashSuccess) {
        $status = session('status');
        $statusMessages = [
            'profile-updated' => __('Данные профиля сохранены.'),
            'password-updated' => __('Пароль изменён.'),
        ];
        $appFlashSuccess = $statusMessages[$status] ?? (is_string($status) ? $status : null);
    }
@endphp

@if($appFlashSuccess)
    <div class="alert alert-success">{{ $appFlashSuccess }}</div>
@endif
@if($appFlashError)
    <div class="alert alert-danger">{{ $appFlashError }}</div>
@endif
@if($appFlashWarning)
    <div class="alert alert-warning">{{ $appFlashWarning }}</div>
@endif
@if($appFlashInfo)
    <div class="alert alert-info">{{ $appFlashInfo }}</div>
@endif
