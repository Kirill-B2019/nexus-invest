/**
 * AUDIENCES — Alpine-компонент вкладок секции «Аудитории платформы».
 *
 * Подключение в разметке:
 *   <section class="aud" x-data="audiences"> …
 *
 * Гарантируется несколько независимых экземпляров на странице
 * (фабрика состояния + uniqid в Blade).
 */
import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('audiences', () => ({
        active: 0,

        /**
         * Переключить вкладку.
         * @param {number} index  индекс вкладки
         * @param {boolean} focus передать фокус вкладке (при навигации с клавиатуры)
         */
        select(index, focus = false) {
            this.active = index;

            const tabs  = this.$root.querySelectorAll('[role="tab"]');
            const panes = this.$root.querySelectorAll('[role="tabpanel"]');

            tabs.forEach((tab, i) => {
                const on = i === index;
                tab.classList.toggle('is-active', on);
                tab.setAttribute('aria-selected', String(on));
                tab.setAttribute('tabindex', on ? '0' : '-1');
            });

            panes.forEach((pane, i) => {
                pane.classList.toggle('is-active', i === index);
            });

            if (focus) tabs[index]?.focus();
        },

        /**
         * Клавиатурная навигация по tablist: стрелки / Home / End.
         * Вешается на контейнер вкладок: x-on:keydown="onTablistKeydown($event)"
         */
        onTablistKeydown(event) {
            const tabs = [...this.$root.querySelectorAll('[role="tab"]')];
            const current = tabs.indexOf(document.activeElement);
            if (current === -1) return;

            let next = null;
            switch (event.key) {
                case 'ArrowDown':
                case 'ArrowRight': next = (current + 1) % tabs.length; break;
                case 'ArrowUp':
                case 'ArrowLeft':  next = (current - 1 + tabs.length) % tabs.length; break;
                case 'Home':       next = 0; break;
                case 'End':        next = tabs.length - 1; break;
            }

            if (next !== null) {
                event.preventDefault();
                this.select(next, true);
            }
        },
    }));
});
