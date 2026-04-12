# UI аудит ЛК и план исправлений

Проект: `nexus-invest`  
Область: закрытая часть (`/lk`)  
Дата: 2026-04-10

## 1. Baseline: карта экранов и текущие проблемы

### Карта ключевых экранов

- Навигационный каркас:
  - `resources/views/layouts/app/app.blade.php`
  - `resources/views/layouts/app/topbar.blade.php`
  - `resources/views/layouts/app/sidebar.blade.php`
- Базовые сценарии:
  - `resources/views/app/pages/lk.blade.php`
  - `resources/views/app/pages/projects/create.blade.php`
  - `resources/views/app/pages/projects/my.blade.php`
  - `resources/views/app/pages/projects-moderation/index.blade.php`
  - `resources/views/app/pages/projects-moderation/show.blade.php`
  - `resources/views/app/pages/notifications/index.blade.php`
  - `resources/views/app/profile/edit.blade.php`

### Что уже улучшено

- Терминология навигации выровнена к `Дашборд`.
- Добавлен единый partial сообщений `layouts/app/flash`.
- Переработан `LK Home`: role-based quick actions.
- Форма проекта упрощена на уровне копирайта и структуры шагов.

### Остаточные UI-проблемы (as-is)

1. **Discoverability действий на mobile** в таблицах частично неоднородна (`Действия` vs `⋯`).
2. **Визуальная иерархия в модерации**: ключевые поля решения и контекст проекта равновесны, нет явного приоритета.
3. **Перегрузка step-1 формы проекта**: блок с медиа и много селектов на одном экране.
4. **Неполная консистентность feedback**: часть действий показывает inline-alert, часть SweetAlert.
5. **A11y-риски**: иконки с пустыми `alt`, неодинаковые `aria-label` в действиях.

## 2. Приоритизация (P0/P1/P2)

### P0 (критично, быстрый эффект)

- Унифицировать mobile-actions в таблицах (`Действия` + доступные подписи/aria).
- Довести единый feedback-паттерн до всех ключевых действий ЛК.
- Выделить primary CTA на `projects/my` и `moderation/index`.

### P1 (структурные улучшения)

- Перекомпоновать `projects/create` step-1 на две визуальные зоны:
  - обязательное ядро;
  - расширенные/опциональные поля.
- Усилить иерархию `projects-moderation/show`:
  - блок решения модератора наверх (для статуса moderation);
  - ключевые risk-поля проекта в первом экране.
- Гармонизировать тексты и метки во всех экранах role dashboards.

### P2 (качество и polish)

- Убрать оставшиеся локальные inline-стили из Blade в CSS-слой.
- Привести alt/aria/focus-visible к единому минимуму.
- Стандартизировать empty-state компоненты.

## 3. План исправлений (поэтапно, с файлами)

### Этап A — Быстрые UI-правки

- Файлы:
  - `resources/views/app/pages/projects/my.blade.php`
  - `resources/views/app/pages/projects-moderation/index.blade.php`
  - `resources/views/app/pages/notifications/index.blade.php`
- Что делаем:
  - единый паттерн кнопки мобильных действий;
  - выравнивание действий в колонке `Действия`;
  - унификация текстов CTA.
- Риск: низкий.  
- Критерий: одинаковый UX поведения таблиц на mobile.

### Этап B — Упрощение сложных экранов

- Файлы:
  - `resources/views/app/pages/projects/create.blade.php`
  - `public/app/js/project-form.js`
  - `resources/views/app/pages/projects-moderation/show.blade.php`
- Что делаем:
  - progressive disclosure в шаге 1;
  - сокращение когнитивной нагрузки на обязательных полях;
  - приоритизация блока модерации.
- Риск: средний (влияние на сценарий submit).  
- Критерий: меньше ошибок валидации и возвратов по шагам.

### Этап C — Консистентность и доступность

- Файлы:
  - `resources/views/layouts/app/topbar.blade.php`
  - `resources/views/layouts/app/sidebar.blade.php`
  - `resources/views/layouts/app/scripts.blade.php`
  - страницы таблиц и форм из ЛК.
- Что делаем:
  - доведение a11y (aria/focus/labels);
  - единые визуальные паттерны feedback.
- Риск: низкий/средний.  
- Критерий: базовый a11y checklist без критичных замечаний.

## 4. Спринтовый план

### Спринт 1 (5 рабочих дней)

- Scope:
  - P0-правки mobile-actions и feedback consistency;
  - финальная правка CTA/текстов.
- DoD:
  - таблицы ЛК единообразны на mobile;
  - во всех ключевых страницах единый паттерн сообщений.
- Smoke:
  - login -> lk -> projects/my -> project/edit -> notifications -> profile.

### Спринт 2 (5-7 рабочих дней)

- Scope:
  - P1-упрощение формы проекта;
  - reflow экрана модерации.
- DoD:
  - step-1 формы воспринимается как ядро + опции;
  - сценарий approve/reject быстрее и без прокрутки к критичным кнопкам.
- Smoke:
  - initiator create/save/submit;
  - moderator review/approve/reject.

### Спринт 3 (4-5 рабочих дней)

- Scope:
  - P2 a11y/polish/cleanup.
- DoD:
  - нет критичных a11y проблем в ключевых потоках;
  - стабильная консистентность UI.

## 5. KPI и метод измерения

1. **Time-to-action (TTA)**:
   - Метрика: время до первого целевого действия (создать проект / открыть модерацию).
   - Цель: -20% от baseline.
   - Замер: ручной сценарный прогон + телеметрия (при наличии).

2. **Терминологическая консистентность**:
   - Метрика: число конфликтующих терминов в навигации.
   - Цель: 0.
   - Замер: ревизия словаря UI по файлам.

3. **Feedback consistency**:
   - Метрика: доля ключевых экранов с единым паттерном success/error/warning.
   - Цель: 100%.
   - Замер: чеклист экранов ЛК.

4. **Mobile usability**:
   - Метрика: число критичных проблем кликабельности/скрытых действий.
   - Цель: 0 на ключевых таблицах/формах.
   - Замер: ручной прогон на mobile breakpoints.

5. **A11y baseline**:
   - Метрика: критичные блокеры keyboard/focus/aria.
   - Цель: 0.
   - Замер: чеклист доступности.

## 6. Риски и смягчение

- Риск: визуальные правки повлияют на логику submit/edit проекта.
  - Смягчение: не менять backend-контракты, только presentation-level.
- Риск: регресс в mobile-menu таблиц.
  - Смягчение: шаблонный компонент/паттерн для action-cell.
- Риск: несогласованные термины после частичных правок.
  - Смягчение: единый словарь UI в PR description.

## 7. Итог

План и приоритизация готовы к исполнению: быстрые улучшения уже частично внедрены, оставшийся объем структурирован в 3 спринта с измеримыми KPI и критериями готовности.
