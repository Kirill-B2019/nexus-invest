/**
 * Модальное окно загрузки и обрезки изображения проекта (Cropper.js).
 * Подключается на странице создания/редактирования проекта.
 */
(function() {
    var modal = document.getElementById('projectImageCropperModal');
    var fileInput = document.getElementById('projectCropperFileInput');
    var wrap = document.getElementById('projectCropperWrap');
    var imgEl = document.getElementById('projectCropperImage');
    var applyBtn = document.getElementById('projectCropperApplyBtn');
    if (!modal || !fileInput || !wrap || !imgEl) return;

    var cropper = null;
    var currentTarget = null;
    var currentAspectRatio = 1;
    var currentPreviewContainer = null;
    var currentFile = null;

    function getInputByName(name) {
        var byId = document.getElementById(name);
        if (byId) return byId;
        var byName = document.querySelector('[name="' + name + '"]') || document.querySelector('[name="' + name + '[]"]');
        return byName;
    }

    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-target="#projectImageCropperModal"]');
        if (!btn || !btn.dataset.input || !btn.dataset.aspect) return;
        currentTarget = getInputByName(btn.dataset.input);
        var asp = String(btn.dataset.aspect);
        currentAspectRatio = (asp === '16/9') ? (16/9) : parseFloat(asp) || 1;
        currentPreviewContainer = document.querySelector(btn.dataset.previewContainer || '#project-cover-previews');
    });

    var emptyImgSrc = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

    modal.addEventListener('show.bs.modal', function(e) {
        var btn = e.relatedTarget || document.querySelector('[data-target="#projectImageCropperModal"][data-input]');
        if (btn && btn.dataset.input && btn.dataset.aspect && !currentTarget) {
            currentTarget = getInputByName(btn.dataset.input);
            var asp = String(btn.dataset.aspect);
            currentAspectRatio = (asp === '16/9') ? (16/9) : parseFloat(asp) || 1;
            currentPreviewContainer = document.querySelector(btn.dataset.previewContainer || '#project-cover-previews');
        }
        wrap.classList.add('d-none');
        applyBtn.disabled = true;
        fileInput.value = '';
        if (cropper) { cropper.destroy(); cropper = null; }
        // Сброс изображения — модальное окно всегда открывается пустым
        if (imgEl.src && imgEl.src.startsWith('blob:')) {
            try { URL.revokeObjectURL(imgEl.src); } catch (err) {}
        }
        imgEl.src = emptyImgSrc;
        currentFile = null;
    });

    modal.addEventListener('hidden.bs.modal', function() {
        currentTarget = null;
        currentPreviewContainer = null;
    });

    fileInput.addEventListener('change', function(e) {
        var file = (e.target.files || [])[0];
        if (!file || !file.type.match(/^image\/(jpeg|png|webp)$/i)) {
            wrap.classList.add('d-none');
            applyBtn.disabled = true;
            return;
        }
        currentFile = file;
        if (cropper) { cropper.destroy(); cropper = null; }
        var url = URL.createObjectURL(file);
        imgEl.onload = function() {
            imgEl.onload = null;
            wrap.classList.remove('d-none');
            applyBtn.disabled = false;
            var previewEl = document.getElementById('projectCropperPreview');
            if (previewEl) previewEl.style.aspectRatio = currentAspectRatio > 1.5 ? '16/9' : '1';
            var minW = currentAspectRatio >= 1.5 ? 550 : 300;
            var minH = currentAspectRatio >= 1.5 ? 300 : 300;
            cropper = new Cropper(imgEl, {
                aspectRatio: currentAspectRatio,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 0.8,
                guides: true,
                center: true,
                cropBoxMovable: true,
                cropBoxResizable: true,
                minCropBoxWidth: minW,
                minCropBoxHeight: minH,
                preview: previewEl || undefined
            });
        };
        imgEl.onerror = function() {
            imgEl.onload = null;
            wrap.classList.add('d-none');
            applyBtn.disabled = true;
        };
        imgEl.src = url;
    });

    applyBtn.addEventListener('click', function() {
        if (!cropper || !currentTarget) return;
        var size = currentAspectRatio >= 1 ? { width: 800, height: Math.round(800 / currentAspectRatio) } : { width: Math.round(800 * currentAspectRatio), height: 800 };
        var canvas = cropper.getCroppedCanvas({ width: size.width, height: size.height, imageSmoothingEnabled: true, imageSmoothingQuality: 'high' });
        if (!canvas) return;
        var ctx = canvas.getContext('2d');
        var watermarkUrl = window.PROJECT_WATERMARK_URL || '';
        if (watermarkUrl) {
            var logoImg = new Image();
            logoImg.onload = function() {
                var logoW = 30;
                var logoH = (logoImg.height / logoImg.width) * logoW;
                var x = canvas.width - logoW - 10;
                var y = canvas.height - logoH - 10;
                ctx.globalAlpha = 0.15;
                ctx.drawImage(logoImg, x, y, logoW, logoH);
                ctx.globalAlpha = 1;
                finishCanvas();
            };
            logoImg.onerror = finishCanvas;
            logoImg.src = watermarkUrl;
        } else {
            finishCanvas();
        }
        function finishCanvas() {
            canvas.toBlob(function(blob) {
                if (!blob) return;
                var ext = (currentFile && currentFile.name) ? currentFile.name.split('.').pop() : 'jpg';
                var name = 'image_' + Date.now() + '.' + (ext.toLowerCase() === 'png' ? 'png' : ext.toLowerCase() === 'webp' ? 'webp' : 'jpg');
                var newFile = new File([blob], name, { type: blob.type });
                var dt = new DataTransfer();
                if (currentTarget.files && currentTarget.files.length) {
                    for (var i = 0; i < currentTarget.files.length; i++) dt.items.add(currentTarget.files[i]);
                }
                dt.items.add(newFile);
                currentTarget.files = dt.files;
                if (currentPreviewContainer) {
                    var msgs = window.PROJECT_FORM_MESSAGES || {};
                    var fileIndex = currentTarget.files.length - 1;
                    var div = document.createElement('div');
                    div.className = 'project-image-item mr-2 mb-2 position-relative';
                    div.dataset.fileIndex = String(fileIndex);
                    var thumb = document.createElement('img');
                    thumb.src = URL.createObjectURL(blob);
                    thumb.className = 'img-thumbnail d-block';
                    thumb.style.cssText = currentAspectRatio >= 1.5 ? 'max-width:120px;aspect-ratio:16/9;object-fit:cover' : 'max-width:80px;aspect-ratio:1;object-fit:cover';
                    div.appendChild(thumb);
                    var delBtn = document.createElement('button');
                    delBtn.type = 'button';
                    delBtn.className = 'project-image-delete-btn btn btn-danger btn-sm';
                    delBtn.title = msgs.delete || 'Удалить';
                    delBtn.setAttribute('aria-label', msgs.delete || 'Удалить');
                    delBtn.textContent = '×';
                    div.appendChild(delBtn);
                    currentPreviewContainer.appendChild(div);
                }
                cropper.destroy();
                cropper = null;
                if (typeof jQuery !== 'undefined') {
                    jQuery(modal).modal('hide');
                } else if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    var m = bootstrap.Modal.getInstance(modal);
                    if (m) m.hide();
                }
            }, 'image/jpeg', 0.92);
        }
    });
})();
