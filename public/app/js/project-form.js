/**
 * Форма проекта: Alpine.js projectForm и обработчик удаления изображений.
 * Подключается на странице создания/редактирования проекта.
 */
(function() {
    var msgs = window.PROJECT_FORM_MESSAGES || {};

    function swalFireFallback(type, text) {
        if (typeof Swal === 'undefined') return;
        var palette = typeof window.getLkSwalThemePalette === 'function' ? window.getLkSwalThemePalette() : null;
        var isDark = typeof window.isLkDarkTheme === 'function' ? window.isLkDarkTheme() : !!(document.getElementById('app-container') && document.getElementById('app-container').classList.contains('theme-dark'));
        var cfg = isDark
            ? { background: '#191919', color: '#ECEEF2', confirmButtonColor: palette ? palette.accent : '#C5FF41', customClass: { popup: 'swal-lk-theme' } }
            : { background: '#FFFFFF', color: '#1F2937', confirmButtonColor: palette ? palette.accent : '#4B7B5B', customClass: { popup: 'swal-lk-theme swal-lk-theme-light' } };
        var iconColor = palette
            ? (type === 'error' ? palette.error : palette.warning)
            : (isDark ? '#FBBF24' : '#B45309');
        Swal.fire({
            background: cfg.background,
            color: cfg.color,
            confirmButtonColor: cfg.confirmButtonColor,
            customClass: cfg.customClass,
            heightAuto: false,
            scrollbarPadding: false,
            icon: type,
            iconColor: iconColor,
            title: type === 'error' ? 'Ошибка' : 'Внимание',
            text: text,
            didOpen: function () {
                if (typeof window.scheduleSyncLkSwalPopupTheme === 'function') {
                    window.scheduleSyncLkSwalPopupTheme();
                } else if (typeof window.syncLkSwalPopupTheme === 'function') {
                    window.syncLkSwalPopupTheme();
                }
            },
        });
    }

    /**
     * После сохранения черновика: очистить file inputs и заменить клиентские превью
     * на серверные, чтобы при повторном сохранении изображения не дублировались.
     */
    function applyDraftSaveImageFix(form, createdImages) {
        var coverInput = document.getElementById('image_cover') || form.querySelector('[name="image_cover[]"]');
        var cardInput = document.getElementById('image_card') || form.querySelector('[name="image_card[]"]');
        if (coverInput) { coverInput.value = ''; }
        if (cardInput) { cardInput.value = ''; }

        var coverContainer = document.getElementById('project-cover-previews');
        var cardContainer = document.getElementById('project-card-previews');
        if (coverContainer) {
            [].slice.call(coverContainer.querySelectorAll('.project-image-item:not(.project-image-item-server)')).forEach(function(el) { el.remove(); });
        }
        if (cardContainer) {
            [].slice.call(cardContainer.querySelectorAll('.project-image-item:not(.project-image-item-server)')).forEach(function(el) { el.remove(); });
        }

        var deleteTitle = msgs.delete || 'Удалить';
        (createdImages || []).forEach(function(img) {
            var container = img.type === 'cover' ? coverContainer : cardContainer;
            if (!container) return;
            var div = document.createElement('div');
            div.className = 'project-image-item project-image-item-server mr-2 mb-2 position-relative';
            div.dataset.id = String(img.id);
            div.dataset.type = img.type;
            div.dataset.deleteUrl = img.delete_url || '';
            var thumb = document.createElement('img');
            thumb.src = img.url || '';
            thumb.className = 'img-thumbnail d-block';
            thumb.style.cssText = img.type === 'card' ? 'max-width:120px;aspect-ratio:16/9;object-fit:cover' : 'max-width:80px;aspect-ratio:1;object-fit:cover';
            div.appendChild(thumb);
            var delBtn = document.createElement('button');
            delBtn.type = 'button';
            delBtn.className = 'project-image-delete-btn btn btn-danger btn-sm';
            delBtn.title = deleteTitle;
            delBtn.setAttribute('aria-label', deleteTitle);
            delBtn.textContent = '×';
            div.appendChild(delBtn);
            container.appendChild(div);
        });
    }

    function projectForm(isEdit, initial, readOnlyMode, initialStep) {
        var initialData = {
            name: initial.name || '',
            pitch: initial.pitch || '',
            description: initial.description || '',
            industry: initial.industry || '',
            region: initial.region || '',
            sector_direction: initial.sector_direction || '',
            stage: initial.stage || '',
            project_type: initial.project_type || '',
            category: initial.category || '',
            target_amount: initial.target_amount || '',
            min_investment: initial.min_investment || '',
            duration_months: initial.duration_months || '',
            investment_form: initial.investment_form || '',
            company_name: initial.company_name || '',
            inn: initial.inn || '',
            contact_person: initial.contact_person || '',
            phone: initial.phone || '',
            email: initial.email || '',
            website: initial.website || '',
        };
        return {
            step: initialStep || 1,
            showAdvanced: false,
            readOnly: !!readOnlyMode,
            initial: JSON.parse(JSON.stringify(initialData)),
            form: initialData,
            submitDraft: function(targetStep, showSuccessMsg) {
                var form = document.getElementById('project-form');
                if (!form) return;
                var fd = new FormData(form);
                fd.set('step', String(targetStep));
                var url = form.action;
                var methodInput = form.querySelector('[name="_method"]');
                var isPatch = methodInput && methodInput.value === 'PATCH';
                if (isPatch) {
                    fd.set('_method', 'PATCH');
                }
                var csrfToken = (document.querySelector('meta[name="csrf-token"]') || {}).content || '';
                fetch(url, {
                    method: 'POST',
                    body: fd,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json', 
                        'X-CSRF-TOKEN': csrfToken
                    }
                }).then(function(r) {
                    if (r.status === 422) return r.json().then(function(json) { throw json; });
                    return r.json();
                }).then(function(data) {
                    if (data.success) {
                        if (data.form_action) {
                            form.action = data.form_action;
                            if (!methodInput) {
                                var m = document.createElement('input');
                                m.type = 'hidden';
                                m.name = '_method';
                                m.value = 'PATCH';
                                form.appendChild(m);
                            } else {
                                methodInput.value = 'PATCH';
                            }
                        }
                        applyDraftSaveImageFix(form, data.created_images || []);
                        if (showSuccessMsg && window.swalLk) {
                            window.swalLk.success(msgs.draftSaved || 'Черновик сохранён.');
                        }
                    }
                }).catch(function(err) {
                    var txt = msgs.saveError || 'Не удалось сохранить.';
                    if (err && err.errors && typeof err.errors === 'object') {
                        var first = Object.values(err.errors)[0];
                        if (first) txt = Array.isArray(first) ? first[0] : String(first);
                    }
                    (window.swalLk || {}).error ? window.swalLk.error(txt) : (typeof Swal !== 'undefined' && swalFireFallback('error', txt));
                });
            },
            validateStep: function(stepNum) {
                if (stepNum === 1) {
                    var name = this.form.name && String(this.form.name).trim();
                    var pitch = this.form.pitch && String(this.form.pitch).trim();
                    var desc = this.form.description && String(this.form.description).trim();
                    var coverCount = document.querySelectorAll('#project-cover-previews .project-image-item').length;
                    var cardCount = document.querySelectorAll('#project-card-previews .project-image-item').length;
                    return !!(name && pitch && desc && coverCount >= 1 && cardCount >= 1);
                }
                return true;
            },
            validateStepsUpTo: function(targetStep) {
                for (var s = 1; s < targetStep; s++) {
                    if (!this.validateStep(s)) return false;
                }
                return true;
            },
            goToStep: function(n) {
                if (this.readOnly) {
                    this.step = n;
                    return;
                }
                if (n > this.step && !this.validateStepsUpTo(n)) {
                    var txt = msgs.fillRequired || 'Заполните обязательные поля: название, краткое и полное описание.';
                    var coverCount = document.querySelectorAll('#project-cover-previews .project-image-item').length;
                    var cardCount = document.querySelectorAll('#project-card-previews .project-image-item').length;
                    if (coverCount < 1 || cardCount < 1) {
                        txt = msgs.addImages || 'Добавьте хотя бы одно изображение обложки (1:1) и одно изображение карточки (16:9).';
                    } else if (!(this.form.name && String(this.form.name).trim()) || !(this.form.pitch && String(this.form.pitch).trim()) || !(this.form.description && String(this.form.description).trim())) {
                        txt = msgs.fillRequired || 'Заполните обязательные поля: название, краткое и полное описание.';
                    }
                    (window.swalLk || {}).warning ? window.swalLk.warning(txt) : (typeof Swal !== 'undefined' && swalFireFallback('warning', txt));
                    return;
                }
                this.step = n;
                this.submitDraft(n, false);
            },
            resetFields: function() {
                var f = this.form;
                var i = this.initial || {};
                Object.keys(f).forEach(function(k) {
                    f[k] = i[k] || (typeof f[k] === 'number' ? '' : '');
                });
            },
            saveDraft: function() {
                if (this.readOnly) return;
                this.submitDraft(this.step, true);
            },
            nextStep: function() {
                if (this.readOnly) return;
                if (this.step >= 5) return;
                if (!this.validateStepsUpTo(this.step + 1)) {
                    var txt = msgs.fillRequired || 'Заполните обязательные поля: название, краткое и полное описание.';
                    var coverCount = document.querySelectorAll('#project-cover-previews .project-image-item').length;
                    var cardCount = document.querySelectorAll('#project-card-previews .project-image-item').length;
                    if (coverCount < 1 || cardCount < 1) {
                        txt = msgs.addImages || 'Добавьте хотя бы одно изображение обложки (1:1) и одно изображение карточки (16:9).';
                    } else if (!(this.form.name && String(this.form.name).trim()) || !(this.form.pitch && String(this.form.pitch).trim()) || !(this.form.description && String(this.form.description).trim())) {
                        txt = msgs.fillRequired || 'Заполните обязательные поля: название, краткое и полное описание.';
                    }
                    (window.swalLk || {}).warning ? window.swalLk.warning(txt) : (typeof Swal !== 'undefined' && swalFireFallback('warning', txt));
                    return;
                }
                this.step = this.step + 1;
                this.submitDraft(this.step, false);
            },
            submitForModeration: function() {
                var name = this.form.name && this.form.name.trim();
                var pitch = this.form.pitch && this.form.pitch.trim();
                var desc = this.form.description && this.form.description.trim();
                if (!name || !pitch || !desc) {
                    var txt = msgs.fillRequired || 'Заполните обязательные поля: название, краткое и полное описание.';
                    (window.swalLk || {}).warning ? window.swalLk.warning(txt) : (typeof Swal !== 'undefined' && swalFireFallback('warning', txt));
                    return;
                }
                var coverCount = document.querySelectorAll('#project-cover-previews .project-image-item').length;
                var cardCount = document.querySelectorAll('#project-card-previews .project-image-item').length;
                if (coverCount < 1 || cardCount < 1) {
                    var txt2 = msgs.addImages || 'Добавьте хотя бы одно изображение обложки (1:1) и одно изображение карточки (16:9).';
                    (window.swalLk || {}).warning ? window.swalLk.warning(txt2) : (typeof Swal !== 'undefined' && swalFireFallback('warning', txt2));
                    return;
                }
                var f = document.getElementById('submit-form');
                if (f) {
                    f.querySelector('[name=name]').value = name;
                    f.querySelector('[name=pitch]').value = pitch;
                    f.querySelector('[name=description]').value = desc;
                    f.submit();
                }
            }
        };
    }

    window.projectForm = projectForm;

    // Обработчик удаления изображений
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var token = csrf ? csrf.content : '';
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.project-image-delete-btn');
        if (!btn) return;
        e.preventDefault();
        var item = btn.closest('.project-image-item');
        if (!item) return;
        if (item.classList.contains('project-image-item-server')) {
            var url = item.dataset.deleteUrl;
            if (!url) return;
            btn.disabled = true;
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(function(r) {
                if (r.ok) {
                    item.remove();
                } else {
                    btn.disabled = false;
                    var err = msgs.deleteError || 'Не удалось удалить изображение.';
                    (window.swalLk || {}).error ? window.swalLk.error(err) : (typeof Swal !== 'undefined' && swalFireFallback('error', err));
                }
            }).catch(function() {
                btn.disabled = false;
                var err = msgs.deleteError || 'Не удалось удалить изображение.';
                (window.swalLk || {}).error ? window.swalLk.error(err) : (typeof Swal !== 'undefined' && swalFireFallback('error', err));
            });
        } else {
            var fileIndex = parseInt(item.dataset.fileIndex, 10);
            var container = item.closest('[id$="-previews"]');
            var inputId = container && container.id === 'project-cover-previews' ? 'image_cover' : 'image_card';
            var fileInput = document.getElementById(inputId) || document.querySelector('[name="' + inputId + '[]"]');
            if (fileInput && fileInput.files && !isNaN(fileIndex)) {
                var dt = new DataTransfer();
                for (var i = 0; i < fileInput.files.length; i++) {
                    if (i !== fileIndex) dt.items.add(fileInput.files[i]);
                }
                fileInput.files = dt.files;
                var siblings = container ? container.querySelectorAll('.project-image-item:not(.project-image-item-server)') : [];
                siblings.forEach(function(s) {
                    var idx = parseInt(s.dataset.fileIndex, 10);
                    if (!isNaN(idx) && idx > fileIndex) s.dataset.fileIndex = String(idx - 1);
                });
            }
            item.remove();
        }
    });
})();
