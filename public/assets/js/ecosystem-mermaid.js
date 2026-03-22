/**
 * Инициализация диаграммы архитектуры НЕКСУС/ГАНИМЕД через Mermaid.
 * Стандартная текстовая схема без кастомного позиционирования.
 */
(function () {
    'use strict';

    function initEcosystemMermaid() {
        var el = document.querySelector('.ecosystem-arch-mermaid');
        if (!el) return;
        if (typeof mermaid === 'undefined') {
            console.warn('Nexus: Mermaid not loaded');
            return;
        }
        try {
            mermaid.initialize({
                startOnLoad: false,
                securityLevel: 'loose',
                theme: 'dark',
                flowchart: { useMaxWidth: true }
            });

            if (typeof mermaid.init === 'function') {
                mermaid.init(undefined, document.querySelectorAll('.ecosystem-arch-mermaid'));
            } else if (typeof mermaid.render === 'function') {
                var txt = (el.textContent || el.innerText || '').trim();
                var id = 'mermaid-ecosystem-' + Date.now();
                mermaid.render(id, txt, function (svgCode, bindFunctions) {
                    el.innerHTML = svgCode;
                    if (bindFunctions) bindFunctions(el);
                });
            }
        } catch (e) {
            console.warn('Nexus Mermaid init:', e);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initEcosystemMermaid);
    } else {
        initEcosystemMermaid();
    }
})();
