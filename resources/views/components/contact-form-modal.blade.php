<div class="modal fade" id="contactFormModal" tabindex="-1" aria-labelledby="contactFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content contact-form-modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-18-semibold neutral-0" id="contactFormModalLabel">{{ __('Обратная связь') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('Закрыть') }}"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="{{ route('contact.store') }}" method="post" id="contact-form">
                    @csrf
                    <input type="hidden" name="_form" value="contact">
                    <div class="mb-3">
                        <label for="contact-name" class="form-label">{{ __('Имя') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact-name" name="name" value="{{ old('name') }}" required maxlength="255">
                        @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact-email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="contact-email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact-subject" class="form-label">{{ __('Тема') }}</label>
                        <input type="text" class="form-control" id="contact-subject" name="subject" value="{{ old('subject') }}" maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label for="contact-message" class="form-label">{{ __('Сообщение') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="contact-message" name="message" rows="4" required maxlength="5000">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <x-math-captcha />
                        @error('captcha_answer')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-brand-4-medium">{{ __('Отправить') }}</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Отмена') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
