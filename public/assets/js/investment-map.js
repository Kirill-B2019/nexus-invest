/**
 * Интерактивная карта регионов РФ: тултипы, модалка, выпадающие фильтры, кнопки Применить/Сброс.
 * Данные регионов читаются из #regions-for-map-data (JSON).
 */
(function() {
    var container = document.getElementById('rf-map-container');
    var tooltip = document.getElementById('rf-map-tooltip');
    var modal = document.getElementById('region-details-modal');
    var modalTitle = document.getElementById('region-details-title');
    var modalBody = document.getElementById('region-details-body');
    var dataEl = document.getElementById('regions-for-map-data');
    var districtLinksEl = container && container.querySelector('.district-links');
    var regions = {};
    if (dataEl && dataEl.textContent) {
        try { regions = JSON.parse(dataEl.textContent); } catch (e) {}
    }

    function openRegionModal(code, title) {
        if (!modal || !modalTitle || !modalBody) return;
        var r = regions[code];
        var regionName = title || (r && r.name) || code || '';
        modalTitle.textContent = regionName;
        var today = new Date();
        var dateStr = today.toLocaleDateString('ru-RU', { day: 'numeric', month: 'long', year: 'numeric' });
        var html = '<p class="rf-map-modal-date mb-2">на ' + dateStr + '</p>';
        html += '<p class="rf-map-modal-projects">Проектов: <strong>0</strong></p>';
        if (r && r.description) html += '<p class="small mt-2">' + (r.description || '') + '</p>';
        modalBody.innerHTML = html;
        modal.showModal();
    }

    function showTooltip(title, code, x, y) {
        if (!tooltip) return;
        var name = title || (regions[code] && regions[code].name) || code || '';
        tooltip.querySelector('b').textContent = name;
        tooltip.querySelector('span').textContent = '';
        tooltip.setAttribute('aria-hidden', 'false');
        tooltip.classList.add('visible');
        tooltip.style.left = (x + 10) + 'px';
        tooltip.style.top = (y + 10) + 'px';
    }
    function hideTooltip() {
        if (tooltip) {
            tooltip.classList.remove('visible');
            tooltip.setAttribute('aria-hidden', 'true');
        }
    }
    if (container) {
        container.addEventListener('mouseleave', hideTooltip);
        container.addEventListener('mousemove', function(e) {
            var path = e.target.closest('path[data-code]');
            if (path) {
                var title = path.getAttribute('data-title') || '';
                var code = path.getAttribute('data-code') || '';
                var rect = container.getBoundingClientRect();
                showTooltip(title, code, e.clientX - rect.left, e.clientY - rect.top);
            } else {
                hideTooltip();
            }
        });
        container.addEventListener('click', function(e) {
            var path = e.target.closest('path[data-code]');
            if (!path || !modal) return;
            e.preventDefault();
            var code = path.getAttribute('data-code') || '';
            var title = path.getAttribute('data-title') || '';
            openRegionModal(code, title);
        });
    }

    if (districtLinksEl && typeof Object.keys === 'function') {
        Object.keys(regions).sort().forEach(function(code) {
            var r = regions[code];
            var name = (r && r.name) || code;
            var div = document.createElement('div');
            var a = document.createElement('a');
            a.href = '#';
            a.setAttribute('data-code', code);
            a.setAttribute('data-title', name);
            a.textContent = name;
            a.addEventListener('click', function(ev) {
                ev.preventDefault();
                openRegionModal(code, name);
            });
            div.appendChild(a);
            districtLinksEl.appendChild(div);
        });
    }

    document.querySelectorAll('.rf-map-filter-option').forEach(function(label) {
        var cb = label.querySelector('input[data-code]');
        if (!cb) return;
        label.addEventListener('click', function(ev) {
            if (ev.target.tagName === 'INPUT') return;
            var code = cb.getAttribute('data-code');
            var title = cb.getAttribute('data-title') || '';
            var path = container && container.querySelector('path[data-code="' + code + '"]');
            if (path) { path.focus(); path.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }
        });
    });

    function updateDropdownTriggerText(trigger, panel) {
        var placeholder = trigger.getAttribute('data-placeholder') || '';
        var checkboxes = panel.querySelectorAll('input[type="checkbox"]:checked');
        var textEl = trigger.querySelector('.rf-map-dropdown-text');
        if (!textEl) return;
        if (checkboxes.length === 0) {
            textEl.textContent = placeholder;
        } else if (checkboxes.length === 1) {
            textEl.textContent = checkboxes[0].closest('label').querySelector('span').textContent.trim();
        } else {
            textEl.textContent = 'Выбрано: ' + checkboxes.length;
        }
    }
    function positionDropdownPanel(trigger, panel) {
        var r = trigger.getBoundingClientRect();
        panel.style.top = (r.bottom + 4) + 'px';
        panel.style.left = r.left + 'px';
        panel.style.width = r.width + 'px';
    }
    function closeAllDropdowns() {
        document.querySelectorAll('.rf-map-dropdown-trigger').forEach(function(t) {
            t.setAttribute('aria-expanded', 'false');
            var p = t._rfMapPanel;
            if (p && p._rfMapDropdown) {
                p._rfMapDropdown.appendChild(p);
                p.hidden = true;
                t._rfMapPanel = null;
            } else {
                var dd = t.closest('.rf-map-dropdown');
                if (dd) { p = dd.querySelector('.rf-map-dropdown-panel'); if (p) p.hidden = true; }
            }
        });
    }
    var cardInner = document.querySelector('.rf-map-filters-card-inner');
    document.querySelectorAll('.rf-map-dropdown').forEach(function(dropdown) {
        var trigger = dropdown.querySelector('.rf-map-dropdown-trigger');
        var panel = dropdown.querySelector('.rf-map-dropdown-panel');
        if (!trigger || !panel) return;
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            var isOpen = trigger.getAttribute('aria-expanded') === 'true';
            closeAllDropdowns();
            if (!isOpen) {
                trigger.setAttribute('aria-expanded', 'true');
                panel._rfMapDropdown = dropdown;
                trigger._rfMapPanel = panel;
                document.body.appendChild(panel);
                panel.hidden = false;
                positionDropdownPanel(trigger, panel);
            }
        });
        panel.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        panel.querySelectorAll('input[type="checkbox"]').forEach(function(cb) {
            cb.addEventListener('change', function() {
                updateDropdownTriggerText(trigger, panel);
            });
        });
        updateDropdownTriggerText(trigger, panel);
    });
    if (cardInner) {
        cardInner.addEventListener('scroll', function() {
            document.querySelectorAll('.rf-map-dropdown-trigger[aria-expanded="true"]').forEach(function(t) {
                var p = t._rfMapPanel;
                if (p && !p.hidden) positionDropdownPanel(t, p);
            });
        });
    }
    window.addEventListener('resize', function() {
        document.querySelectorAll('.rf-map-dropdown-trigger[aria-expanded="true"]').forEach(function(t) {
            var p = t._rfMapPanel;
            if (p && !p.hidden) positionDropdownPanel(t, p);
        });
    });
    document.addEventListener('click', function() {
        closeAllDropdowns();
    });

    function resetMapFilters() {
        closeAllDropdowns();
        var card = document.querySelector('.rf-map-filters-card');
        if (!card) return;
        card.querySelectorAll('input[type="checkbox"]').forEach(function(cb) { cb.checked = false; });
        card.querySelectorAll('.rf-map-dropdown').forEach(function(dd) {
            var trigger = dd.querySelector('.rf-map-dropdown-trigger');
            var panel = dd.querySelector('.rf-map-dropdown-panel');
            if (trigger && panel) updateDropdownTriggerText(trigger, panel);
        });
        if (container) {
            container.querySelectorAll('path[data-code]').forEach(function(path) {
                path.style.fill = '';
                path.style.stroke = '';
                path.classList.remove('rf-map-path-dimmed');
            });
        }
    }
    var btnApply = document.getElementById('rf-map-btn-apply');
    var btnReset = document.getElementById('rf-map-btn-reset');
    if (btnApply) {
        btnApply.addEventListener('click', function() {
            closeAllDropdowns();
            if (typeof window.swalPublic !== 'undefined' && typeof window.swalPublic.info === 'function') {
                window.swalPublic.info('Проекты доступны после размещения на платформе');
            } else if (typeof Swal !== 'undefined') {
                Swal.fire({
                    customClass: { popup: 'swal-public-theme', confirmButton: 'swal-btn-confirm' },
                    background: '#191919',
                    color: '#ECEEF2',
                    confirmButtonColor: '#C5FF41',
                    confirmButtonText: 'OK',
                    backdrop: 'rgba(0,0,0,0.75)',
                    heightAuto: false,
                    scrollbarPadding: false,
                    icon: 'info',
                    title: 'Информация',
                    text: 'Проекты доступны после размещения на платформе',
                    iconColor: '#3498db'
                });
            }
        });
    }
    if (btnReset) btnReset.addEventListener('click', resetMapFilters);

    if (modal) {
        var closeBtnModal = modal.querySelector('[data-close-modal]');
        if (closeBtnModal) closeBtnModal.addEventListener('click', function() { modal.close(); });
        modal.addEventListener('cancel', function() { modal.close(); });
        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.close();
        });
    }
})();
