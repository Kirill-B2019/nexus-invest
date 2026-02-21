@push('styles')
    <link rel="stylesheet" href="{{ asset('app/css/vendor/cropper.min.css') }}">
@endpush

<section>
    <p class="text-muted mb-3">{{ __('Измените имя, email и фото профиля. После смены email потребуется повторная верификация.') }}</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="profile-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group mb-3">
            <label class="form-label d-block">{{ __('Фото профиля') }}</label>
            <label class="btn btn-outline-primary btn-upload" for="profilePhotoInput" title="{{ __('Выбрать изображение') }}">
                <input type="file" class="sr-only" id="profilePhotoInput" name="photo" accept=".jpg,.jpeg,.png,.gif,.webp">
                {{ __('Выбрать файл') }}
            </label>
            <small class="form-text text-muted d-block mt-1">{{ __('JPEG, PNG, GIF или WebP, не более 2 МБ. Выделите область для аватара.') }}</small>
            @error('photo')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            @if($user->profile_photo_path)
                <div class="custom-control custom-checkbox mt-2">
                    <input type="checkbox" class="custom-control-input" id="remove_photo" name="remove_photo" value="1">
                    <label class="custom-control-label" for="remove_photo">{{ __('Удалить текущее фото') }}</label>
                </div>
            @endif
            <div class="row mt-3" id="profileCropperRow" style="display: none;">
                <div class="col-12 col-md-5">
                    <div id="profileCropperContainer" style="max-height: 320px; background: #000;">
                        <img id="profileCropperImage" alt="" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" style="max-width: 100%;">
                    </div>
                </div>
                <div class="col-12 col-md-3 mt-2 mt-md-0">
                    <p class="text-muted small mb-1">{{ __('Предпросмотр') }}</p>
                    <div class="profile-cropper-preview rounded-circle overflow-hidden" style="width: 120px; height: 120px; background: var(--app-color-surface, #eee);"></div>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ __('Имя') }}</label>
            <input id="name" name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-muted small mt-2 mb-0">
                    {{ __('Email не подтверждён.') }}
                    <button form="send-verification" type="submit" class="btn btn-link p-0 align-baseline">{{ __('Отправить письмо повторно') }}</button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="text-success small mt-1 mb-0">{{ __('Ссылка для подтверждения отправлена на вашу почту.') }}</p>
                @endif
            @endif
        </div>

        <div class="lk-form-actions">
            <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
        </div>
    </form>
</section>

@push('scripts')
<script src="{{ asset('app/js/vendor/cropper.min.js') }}"></script>
<script>
(function() {
    var profilePhotoInput = document.getElementById('profilePhotoInput');
    var profileCropperRow = document.getElementById('profileCropperRow');
    var profileCropperImage = document.getElementById('profileCropperImage');
    var profileCropperContainer = document.getElementById('profileCropperContainer');
    var profileForm = document.getElementById('profile-form');
    var profileCropper = null;
    var profileCropperFile = null;

    if (!profilePhotoInput || !profileForm) return;

    profilePhotoInput.addEventListener('change', function(e) {
        var file = (e.target.files || [])[0];
        if (!file || !file.type.match(/^image\/(jpeg|png|gif|webp)$/i)) {
            if (profileCropper) { profileCropper.destroy(); profileCropper = null; }
            profileCropperRow.style.display = 'none';
            profileCropperFile = null;
            return;
        }
        profileCropperFile = file;
        if (profileCropper) { profileCropper.destroy(); profileCropper = null; }
        var url = URL.createObjectURL(file);
        profileCropperImage.src = url;
        profileCropperRow.style.display = 'flex';
        profileCropperRow.style.flexWrap = 'wrap';

        setTimeout(function() {
            profileCropper = new Cropper(profileCropperImage, {
                aspectRatio: 1,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 0.8,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
                preview: '.profile-cropper-preview'
            });
        }, 100);
    });

    profileForm.addEventListener('submit', function(e) {
        if (!profileCropper) return;
        e.preventDefault();
        var maxSize = 512;
        profileCropper.getCroppedCanvas({ width: maxSize, height: maxSize, imageSmoothingEnabled: true, imageSmoothingQuality: 'high' })
            .toBlob(function(blob) {
                if (!blob) { profileForm.submit(); return; }
                var dt = new DataTransfer();
                var ext = (profileCropperFile && profileCropperFile.name) ? profileCropperFile.name.split('.').pop() : 'jpg';
                var name = 'photo.' + (ext.toLowerCase() === 'png' ? 'png' : ext.toLowerCase() === 'webp' ? 'webp' : 'jpg');
                dt.items.add(new File([blob], name, { type: blob.type }));
                profilePhotoInput.files = dt.files;
                profileCropper.destroy();
                profileCropper = null;
                profileCropperRow.style.display = 'none';
                profileForm.submit();
            }, 'image/jpeg', 0.92);
    });
})();
</script>
@endpush
