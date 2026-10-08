# CONVENTIONS.md — Единые правила проекта MoskowNexus

## Содержание

- [1. Архитектура](#1-архитектура)
- [2. Backend (PHP/Laravel)](#2-backend-phplaravel)
- [3. Frontend (Blade/JS/CSS)](#3-frontend-bladejscss)
- [4. База данных](#4-база-данных)
- [5. Безопасность](#5-безопасность)
- [6. Производительность](#6-производительность)
- [7. Документация](#7-документация)
- [8. Чек-лист перед коммитом](#8-чек-лист-перед-коммитом)

---

## 1. Архитектура

### 1.1. Слои приложения

```
┌─────────────────────────────────┐
│         HTTP / Console          │  ← Входные точки
├─────────────────────────────────┤
│      Controllers / Commands     │  ← Оркестрация, валидация
├─────────────────────────────────┤
│         Services / Repos        │  ← Бизнес-логика
├─────────────────────────────────┤
│           Models / Eloquent     │  ← Данные, связи
├─────────────────────────────────┤
│     Support / Contracts / Rules │  ← Утилиты, контракты
└─────────────────────────────────┘
```

**Правила:**
- Контроллеры **не содержат** бизнес-логики — только оркестрация
- Бизнес-логика — **только** в `app/Services/`, `app/Domain/`, `app/Application/`
- Модели — только данные, связи, простые scope'ы
- `Support/` — чистые утилиты (статические методы, без состояния)
- `Contracts/` — интерфейсы для заменяемых компонентов

### 1.2. Контроллеры

```php
// ✅ Правильно
class ProjectController extends Controller
{
    public function store(StoreProjectRequest $request, ProjectService $service): RedirectResponse
    {
        $project = $service->create($request->validated());
        return redirect()->route('projects.show', $project);
    }
}

// ❌ Неправильно
class ProjectController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([...]);
        $project = new Project();
        $project->name = $validated['name'];
        // ... 50 строк логики
        $project->save();
        return redirect()->route('projects.show', $project);
    }
}
```

**Правила:**
- Использовать **Form Requests** для валидации
- Использовать **dependency injection** для сервисов
- Возвращать только `View`, `RedirectResponse`, `JsonResponse`, `Response`
- Максимум **3-5 строк** тела метода
- Для публичных страниц — **action-only** контроллеры (`__invoke`)

### 1.3. Сервисы

**Правила:**
- Один сервис = одна область ответственности
- Использовать **интерфейсы** (`Contracts/`) для заменяемых компонентов
- Статический фабричный метод `make()` для сервисов с зависимостями от config
- Сервисы **не знают** о HTTP, возвращают доменные объекты/массивы

### 1.4. Модели

**Правила:**
- `$fillable` — только поля формы, не все колонки
- `$casts` — все нетипизированные поля (datetime, boolean, array, json, integer)
- Связи — строго с типизацией (`BelongsTo`, `HasMany`, и т.д.)
- Scope'ы — для запросов, accessor/mutator — для атрибутов
- Методы `isXxx()`, `canXxx()` — для бизнес-правил модели

### 1.5. События и слушатели

**Правила:**
- Тяжёлые операции (mail, API-вызовы) — в **очереди** через `ShouldQueue`
- События — для слабосвязанных действий
- Слушатели — только оркестрация, логика — в командах/сервисах

---

## 2. Backend (PHP/Laravel)

### 2.1. Стиль кода

- **PSR-12** — базовый стандарт
- **PHP 8.2+** синтаксис: typed properties, named arguments, match
- **Типизация**: все параметры и возвращаемые значения — типизированы
- **DocBlock**: только для публичных API, сложных алгоритмов

### 2.2. Naming conventions

| Элемент | Convention | Пример |
|---------|------------|--------|
| Классы | PascalCase | `DzenFeedService` |
| Методы | camelCase | `fetchAndSync()` |
| Свойства | camelCase | `$apiUrl` |
| Константы | UPPER_SNAKE | `SOURCE_DZEN` |
| Таблицы | snake_case | `news_feed_items` |
| Файлы | PascalCase.php | `DzenFeedService.php` |
| Роуты | snake_case | `news.index` |
| View-компоненты | kebab-case | `x-guest.news-card` |

### 2.3. Валидация

**Правила:**
- Валидация **только** в Form Request
- `attributes()` — человеко-читаемые имена полей
- `messages()` — кастомные сообщения на русском
- Кастомные правила — в `app/Rules/` (implements `ValidationRule`)

### 2.4. Запросы к БД

```php
// ✅ Правильно
$items = NewsFeedItem::query()
    ->published()
    ->orderedForFeed()
    ->limit(12)
    ->get();

// ❌ Неправильно — N+1
foreach (RefDictionary::all() as $dict) {
    echo $dict->items->first()->name; // N+1
}
```

**Правила:**
- Использовать `query()` для построения запросов
- Eager loading через `with()` — **всегда**
- Избегать `get()` в циклах
- Использовать `firstOrNew()`, `updateOrCreate()` для upsert

### 2.5. Миграции

**Правила:**
- `foreignId()->constrained()` для FK
- `cascadeOnDelete()` / `nullOnDelete()` — всегда указывать поведение
- Индексы на часто фильтруемые колонки
- `unsignedBigInteger()` / `unsignedInteger()` — всегда unsigned

---

## 3. Frontend (Blade/JS/CSS)

### 3.1. Blade-шаблоны

**Правила:**
- Максимум **15 строк** `@php` блока в blade — больше = вынести в сервис/хелпер
- Версионирование ассетов — через `asset_version()` или `$assetVersion`
- Данные для шаблона — в контроллере, не в blade
- `{{ }}` уже экранирует — не использовать `e()` вокруг `{{ }}`
- Комментарии — `{{-- --}}`, не `<!-- -->`

### 3.2. Blade-компоненты

**Правила:**
- Компоненты — `resources/views/components/{namespace}/{name}.blade.php`
- Неймспейсы: `guest.*`, `app.*`, `lk.*`, `admin.*`
- Передача данных через `@props()`
- Слоты — для гибких вставок

### 3.3. JavaScript

**Правила:**
- IIFE или ES modules — **никаких глобальных функций**
- `'use strict'` — всегда
- DOM-ready проверка — всегда
- Атрибуты `data-*` — источник данных, не хардкод в JS

### 3.4. CSS

**Правила:**
- БЭП-подобная нотация: `.block__element--modifier`
- CSS-переменные для цветов, отступов, шрифтов
- Тёмная тема — основной стиль
- Адаптив — mobile-first

---

## 4. База данных

### 4.1. Индексы

**Правила:**
- Индекс на каждую FK-колонку
- Композитные индексы для частых комбинаций WHERE
- Unique для дедупликации (external_id + source)
- Не индексировать TEXT/BLOB колонки

### 4.2. Типы данных

| Данные | Тип | Пример |
|--------|-----|--------|
| ID | `id()` (bigint unsigned) | `$table->id()` |
| FK | `foreignId()` | `$table->foreignId('user_id')` |
| Строка короткая | `string()` | `->string('name')` |
| Строка длинная | `text()` | `->text('description')` |
| Long text | `longText()` | `->longText('body')` |
| Bool | `boolean()` | `->boolean('is_active')` |
| Integer | `unsignedInteger()` / `unsignedBigInteger()` | |
| Decimal | `decimal(8, 2)` | `->decimal('price', 8, 2)` |
| JSON | `json()` | `->json('meta')` |
| Date | `date()` | `->date('published_at')` |
| Timestamp | `timestamp()->nullable()` | `->timestamp('created_at')` |

---

## 5. Безопасность

| Правило | Описание |
|---------|----------|
| XSS | Всегда `e()` или `{{ }}` в Blade, `HtmlSanitizer` для HTML |
| SQL | Только Eloquent/Query Builder, никаких `DB::select()` с подстановкой |
| CSRF | Laravel автоматически, не отключать |
| File Upload | Проверять mime, размер, размер изображений |
| Auth | `$request->user()` или `auth()->user()`, не `Auth::user()` |

---

## 5.5. Auth и пользовательские данные

**Правила:**
- Использовать `$request->user()->id` вместо `auth()->id()`
- Использовать `$request->user()` вместо `auth()->user()`
- Использовать `$request->user()->isXxx()` вместо `auth()->check()`
- **Никогда** не использовать `auth()->id()` в blade или контроллерах

```php
// ✅ Правильно
if ($request->user()) {
    $subscription->user_id = $request->user()->id;
}

// ❌ Неправильно
if (auth()->check()) {
    $subscription->user_id = auth()->id();
}
```

**Причина:** `$request->user()` — это уже resolved и potentially cached экземпляр пользователя из текущего запроса. `auth()` — это фасад, который каждый раз обращается к аутентификатору.

## 5.6. Версионирование ассетов

**Правила:**
- Использовать `config('app.asset_version')` вместо `asset_version()`
- Передавать версию через `config()`, не через хелперы

```blade
{{-- ✅ Правильно --}}
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}?v={{ config('app.asset_version') }}">

{{-- ❌ Неправильно --}}
@php $v = asset_version(); @endphp
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}?v={{ $v }}">
```

## 5.7. Отраслевые индикаторы

**Обновление данных:**
```bash
# Обновить все индикаторы
php artisan indicators:refresh --frequency=all --force

# Обновить конкретный тип
php artisan indicators:refresh --frequency=monthly --force
php artisan indicators:refresh --frequency=quarterly --force
php artisan indicators:refresh --frequency=semiannual --force

# Обновить только просроченные
php artisan indicators:refresh --due-only --force

# Перезалить базовые данные
php artisan indicators:refresh --seed
```

**Индикаторы:**
- `cfa-temperature` — ежемесячный, состояние рынка ЦФА (НКР, цфа.рф, ЦБ)
- `rwa-vs-defi` — квартальный, сравнение RWA и DeFi
- `liquidity-light` — квартальный, ликвидность ЦФА
- `rwa-global` — ежемесячный, глобальный масштаб токенизации
- `sme-cost` — квартальный, стоимость финансирования МСБ
- `risk-map` — полугодовой, риски инвестирования

**Архитектура:**
- Парсеры: `ncr`, `procfa`, `rwa_xyz`, `coinshares`
- Данные хранятся в таблицах БД, API читает только оттуда
- Кэш очищается после каждого обновления

---

## 6. Производительность

### 6.1. Кэширование

| Что | Как | TTL |
|-----|-----|-----|
| SVG карты | `Cache::remember('map_svg', 3600, fn() => file_get_contents(...))` | 1 час |
| Справочники | `RefDictionaryCacheObserver` (model events) | до изменения |
| View-компоненты | `Cache::remember()` для тяжёлых вычислений | 5-15 мин |

### 6.2. Запросы

- **N+1**: всегда `with()`, проверять через `DB::listen()`
- **Paginate**: `paginate(12)` для списков, `cursorPaginate()` для больших
- **Select**: `get(['id', 'name'])` — только нужные колонки
- **Count**: `exists()` вместо `count() > 0`

---

## 7. Документация

### 7.1. DocBlock-шаблон

```php
/**
 * Краткое описание (1 строка).
 *
 * @param string $name Описание параметра
 * @return Project Описание возвращаемого значения
 * @throws \RuntimeException Описание исключений
 */
```

### 7.2. Комментарии в коде

```php
// ✅ Почему, а не что
// Москва первой в списке регионов фильтра карты
$regionsForMap = ['RU-MOW' => $moscow] + $regionsForMap;

// ❌ Очевидное
// Обновляем проект
$project->update($data);
```

### 7.3. Файлы документации

| Файл | Назначение |
|------|------------|
| `CONVENTIONS.md` | Единые правила кодирования проекта |
| `docs/DEPLOY.md` | Процесс деплоя |
| `docs/DZEN_FEED.md` | Интеграция с Дзен |
| `docs/TRUECONF_INTEGRATION.md` | Интеграция TrueConf |
| `CHANGELOG.md` | История изменений |

**Правила:**
- Все новые интеграции — отдельный файл в `docs/`
- Обновлять `CONVENTIONS.md` при изменении правил
- `CHANGELOG.md` вести по [Keep a Changelog](https://keepachangelog.com/)

---

## 8. Чек-лист перед коммитом

- [ ] Код проходит `phpcs` без ошибок
- [ ] Нет N+1 запросов (проверить через `DB::listen`)
- [ ] Все поля модели в `$fillable` и `$casts`
- [ ] Валидация в Form Request, не в контроллере
- [ ] Бизнес-логика в сервисах, не в контроллерах
- [ ] Тяжёлые операции в очереди (`ShouldQueue`)
- [ ] XSS: все данные в blade через `{{ }}`
- [ ] Индексы на FK и часто фильтруемые колонки
- [ ] Миграция имеет `down()`
- [ ] Нет хардкода в blade (вынести в сервис/хелпер)
- [ ] Нет дублирования кода (DRY)
- [ ] Комментарии объясняют "почему", а не "что"
- [ ] Используется `$request->user()->id`, не `auth()->id()`
- [ ] Версионирование ассетов через `config('app.asset_version')`
- [ ] Нет сложных вычислений в blade (>15 строк `@php`)

---

## 9. Быстрый справочник

### Критические паттерны

| Задача | Правильный паттерн |
|--------|-------------------|
| Валидация | `FormRequest` с `rules()`, `messages()` |
| Получение user ID | `$request->user()->id` |
| Кэширование | `Cache::remember('key', 3600, fn() => ...)` |
| Eager loading | `with(['relation'])` или `with()` в `$with` |
| Массовое создание | `create(['field' => value])` или `updateOrCreate()` |
| Отправка mail | `MailJob::dispatch()->onQueue('mail')` |
| Версия ассета | `config('app.asset_version')` |

### Команды

| Задача | Команда |
|--------|---------|
| Обновить индикаторы | `php artisan indicators:refresh --frequency=all --force` |
| Сидер индикаторов | `php artisan indicators:refresh --seed` |
| Dump autoload | `php composer.phar dump-autoload` |
| Проверить синтаксис | `php -l path/to/file.php` |
