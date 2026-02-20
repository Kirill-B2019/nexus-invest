<section>
    <h5 class="card-title mb-3">{{ __('Смена пароля') }}</h5>
    <p class="text-muted mb-3">{{ __('Используйте надёжный пароль для защиты аккаунта.') }}</p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Текущий пароль') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control {{ optional($errors->updatePassword)->has('current_password') ? 'is-invalid' : '' }}" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password" class="form-label">{{ __('Новый пароль') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control {{ optional($errors->updatePassword)->has('password') ? 'is-invalid' : '' }}" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Подтверждение пароля') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control {{ optional($errors->updatePassword)->has('password_confirmation') ? 'is-invalid' : '' }}" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
    </form>
</section>
