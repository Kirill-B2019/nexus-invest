# Внутренняя часть приложения (ЛК)

Шаблоны личного кабинета. Источник вёрстки: **`resources/src/app/src/Dashboard.Default.html`** (Dore jQuery).

**Начальная точка:** маршрут **`/lk`** (имя `lk`) — главная страница личного кабинета после входа.

## Структура

```
resources/views/app/
├── README.md
├── layouts/
│   ├── lk.blade.php            # Единственный layout ЛК (Dashboard.Default.html)
│   └── partials/
│       ├── navbar.blade.php
│       ├── sidebar.blade.php
│       └── footer.blade.php
└── pages/
    ├── lk.blade.php            # Главная страница ЛК (/lk)
    └── blank.blade.php         # Пустая страница (/app/blank)
```

Компонент **`<x-app-layout>`** рендерит **`app.layouts.lk`** (полный Dashboard.Default).

## Публичная и внутренняя части

| Часть        | Точка входа      | Маршруты / представления |
|-------------|------------------|---------------------------|
| Публичная   | `/` (welcome)    | welcome, features, compliance, auth (login, register и т.д.) |
| Внутренняя (ЛК) | **`/lk`**   | lk, profile, app.blank; все используют layout `lk.blade.php` |

После входа редирект ведёт на **`route('lk')`** (`/lk`). Старый адрес `/dashboard` перенаправляется на `/lk` (301).

## Ресурсы (public/app)

Стили и скрипты для ЛК: **`public/app/`**, в layout — `asset('app/...')`. В **lk.blade.php** подключены все файлы из Dashboard.Default.html (fullcalendar, dataTables, select2, glide, Chart.js и др.). Тема задаётся в **scripts.js** и **window.DORE_BASE**.

## Маршруты ЛК

- **`/lk`** — главная ЛК (`app.pages.lk`), middleware `verified`
- **`/dashboard`** — редирект на `/lk`
- **`/app/blank`** — пустая страница
- **`/profile`** — профиль пользователя
