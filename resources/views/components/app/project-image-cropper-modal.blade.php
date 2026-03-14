{{-- Модальное окно загрузки и обрезки изображения проекта. Закрытая часть (ЛК). --}}
<div class="modal fade" id="projectImageCropperModal" tabindex="-1" aria-labelledby="projectImageCropperModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectImageCropperModalLabel">{{ __('Загрузка изображения') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Закрыть') }}"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small mb-2">{{ __('Выберите файл, выделите область кадрирования (1:1 для обложки — мин. 300×300 px, 16:9 для карточки — мин. 550×300 px), нажмите «Сохранить».') }}</p>
                <label class="btn btn-outline-primary btn-upload mb-3" for="projectCropperFileInput">
                    <input type="file" class="d-none" id="projectCropperFileInput" accept="image/jpeg,image/png,image/webp">
                    {{ __('Выбрать изображение') }}
                </label>
                <div id="projectCropperWrap" class="d-none">
                    <div class="row project-cropper-row">
                        <div class="col-12 col-md-8 order-2 order-md-1">
                            <div id="projectCropperContainer" class="project-cropper-container">
                                <img id="projectCropperImage" alt="" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" style="max-width: 100%; display: block;">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 order-1 order-md-2">
                            <p class="small text-muted mb-1">{{ __('Предпросмотр') }}</p>
                            <div id="projectCropperPreview" class="border overflow-hidden project-cropper-preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('Отмена') }}</button>
                <button type="button" class="btn btn-primary" id="projectCropperApplyBtn" disabled>{{ __('Сохранить') }}</button>
            </div>
        </div>
    </div>
</div>
