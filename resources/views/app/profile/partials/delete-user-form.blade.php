<section>
    <h5 class="card-title mb-3">{{ __('Удаление аккаунта') }}</h5>
    <p class="text-muted mb-3">{{ __('После удаления аккаунта все данные будут удалены безвозвратно. Сохраните нужные данные заранее.') }}</p>

    @if(optional($errors->userDeletion)->isNotEmpty())
        <div class="alert alert-danger mb-3">{{ __('Исправьте ошибки в форме удаления.') }}</div>
    @endif

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteAccountModal" data-bs-toggle="modal" data-bs-target="#confirmDeleteAccountModal">
        {{ __('Удалить аккаунт') }}
    </button>

    <div class="modal fade" id="confirmDeleteAccountModal" tabindex="-1" aria-labelledby="confirmDeleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteAccountModalLabel">{{ __('Удалить аккаунт?') }}</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="{{ __('Закрыть') }}"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p class="mb-3">{{ __('Все данные аккаунта будут удалены безвозвратно. Введите пароль для подтверждения.') }}</p>
                        <div class="form-group mb-0">
                            <label for="password_confirm_delete" class="form-label">{{ __('Пароль') }}</label>
                            <input id="password_confirm_delete" name="password" type="password" class="form-control {{ optional($errors->userDeletion)->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Пароль') }}" required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" data-bs-dismiss="modal">{{ __('Отмена') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Удалить аккаунт') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(optional($errors->userDeletion)->isNotEmpty())
        @push('scripts')
        <script>
            (function() {
                var el = document.getElementById('confirmDeleteAccountModal');
                if (el) {
                    var Modal = window.bootstrap && window.bootstrap.Modal ? new window.bootstrap.Modal(el) : (window.jQuery && window.jQuery(el).modal ? null : null);
                    if (Modal) Modal.show();
                    else if (window.jQuery) window.jQuery(el).modal('show');
                }
            })();
        </script>
        @endpush
    @endif
</section>
