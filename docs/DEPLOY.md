# Пересборка и деплой на production

Выполнять на сервере в каталоге проекта (например `/var/www/nexus-invest` или как у вас настроен document root).

## 1. Обновить код

```bash
git pull origin main
# или: git pull origin master
```

Если код заливаете вручную — скопируйте файлы в каталог приложения (кроме `.env`, `node_modules`, `vendor` при необходимости).

## 2. Зависимости PHP

```bash
composer install --no-dev --optimize-autoloader
```

- `--no-dev` — не ставить dev-зависимости на prod  
- `--optimize-autoloader` — быстрее автозагрузка

## 3. Миграции БД (при необходимости)

```bash
php artisan migrate --force
```

`--force` нужен, чтобы Laravel не спрашивал подтверждение в production.

## 4. Очистить и заново собрать кэш

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

Затем закэшировать для ускорения (рекомендуется на prod):

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

После изменения маршрутов или конфига снова делайте `route:clear` / `config:clear`, затем при необходимости снова `route:cache` / `config:cache`.

## 5. Права и ссылка на storage

Если первый деплой или сбросили права:

```bash
chmod -R 775 storage bootstrap/cache
# веб-сервер должен быть владельцем или в той же группе, иначе:
# chown -R www-data:www-data storage bootstrap/cache

php artisan storage:link
```

## 6. Перезапуск сервисов (по необходимости)

- **PHP-FPM**: `sudo systemctl reload php8.2-fpm` (или ваша версия).
- **Очереди**: если используете `php artisan queue:work`, перезапустите воркеры после деплоя (supervisor или аналог).

---

## Краткая последовательность (одним блоком)

```bash
cd /path/to/nexus-invest
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:clear && php artisan route:clear && php artisan view:clear && php artisan cache:clear
php artisan config:cache && php artisan route:cache && php artisan view:cache
# при необходимости:
# php artisan storage:link
# sudo systemctl reload php8.2-fpm
```

---

## Если появляется ошибка «Route ... not defined»

На prod после деплоя выполните:

```bash
php artisan route:clear
php artisan route:cache
```

Если ошибка остаётся — временно не кэшируйте маршруты: оставьте только `route:clear` и не вызывайте `route:cache`.

---

## В мессенджере пишет «Нет доступа»

Доступ к мессенджеру проверяется так: у пользователя должно быть **разрешение** `use-messenger` и в БД включён **доступ** `messenger_access`.

1. **Обязательно выполните миграции** (должна быть колонка `messenger_access` в таблице `users`):

   ```bash
   php artisan migrate --force
   ```

2. **Очистите кэш** (Spatie Permission и приложение кэшируют права):

   ```bash
   php artisan cache:clear
   ```

3. **Создайте разрешение**, если его ещё нет в БД:

   ```bash
   php artisan db:seed --class=PermissionUseMessengerSeeder
   ```

4. **Выдайте доступ пользователям** — через раздел «Управление мессенджером» в ЛК (пользователь с ролью `messenger-admin`) или вручную в БД:
   - в таблице `users`: `messenger_access = 1` для нужных пользователей;
   - пользователь должен иметь разрешение `use-messenger` (напрямую или через роль).

5. Если на prod включён **кэш конфига** (`config:cache`), после смены `.env` выполните:

   ```bash
   php artisan config:clear
   php artisan config:cache
   ```
