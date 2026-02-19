# Выгрузка в Git, деплой на прод и запуск

## 1. Выгрузка в Git

### Первый раз (если репозиторий ещё не создан на GitHub/GitLab)

```bash
cd C:\xampp\htdocs\nexus-invest

# Инициализация уже есть — проверьте статус
git status

# Добавить все файлы (убедитесь, что в .gitignore есть .env, node_modules, vendor)
git add .
git commit -m "Готово к деплою: Laravel + Nmess мессенджер"

# Создайте репозиторий на GitHub/GitLab, затем:
git remote add origin https://github.com/ВАШ_ЛОГИН/nexus-invest.git
git branch -M master
git push -u origin master
```

### Дальнейшие обновления

```bash
git add .
git commit -m "Описание изменений"
git push origin master
```

**Важно:** в корне должен быть `.gitignore` с минимум:  
`/vendor`, `/node_modules`, `.env`, `/public/hot`, `/storage/*.key`, `Nmess/server/node_modules`, `Nmess/client/node_modules`, `Nmess/client/dist`.

---

## 2. Деплой на прод (хостинг)

Зависит от типа хостинга.

### Вариант A: Shared-хостинг (только PHP, без Node)

- Загружаете проект по FTP/Git (если хостинг умеет `git clone`).
- В корне сайта должна быть папка `public` как document root (или настройте веб-сервер так, чтобы корнем был `public`).
- База: создаёте MySQL/PostgreSQL в панели, прописываете в `.env` на проде.
- **Мессенджер Nmess:** на таком хостинге Node.js обычно нет. Варианты:
  - Отключить мессенджер (не открывать `/lk/messenger` или скрыть пункт меню).
  - Использовать отдельный сервис для Nmess (отдельный VPS/облако с Node.js) и в проде в `.env` указать `NMESS_WS_URL=wss://ваш-nmess-сервер.ru`.

### Вариант B: VPS (Ubuntu/Debian) — полноценный прод

На сервере: PHP 8.2+, Composer, Node.js 18+, Nginx (или Apache), MySQL/PostgreSQL.

#### 2.1 Клонирование и настройка Laravel

```bash
# На сервере
cd /var/www  # или ваш каталог
git clone https://github.com/ВАШ_ЛОГИН/nexus-invest.git
cd nexus-invest

cp .env.example .env
php artisan key:generate

# В .env прописать:
# APP_ENV=production, APP_DEBUG=false
# DB_*, APP_URL=https://ваш-домен.ru
# NMESS_WS_URL=wss://ваш-домен.ru  (или wss://nmess.ваш-домен.ru — см. ниже)
nano .env

composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 2.2 Nginx: корень сайта = `public`

Пример конфига сайта:

```nginx
server {
    listen 80;
    server_name ваш-домен.ru;
    root /var/www/nexus-invest/public;

    add_header X-Frame-Options "SAMEORIGIN";
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

После правок: `sudo nginx -t && sudo systemctl reload nginx`.

#### 2.3 Сервер сигналинга Nmess (Node.js)

Клиент мессенджера уже собран в `public/nmess/`. Нужно запустить только сервер сигналинга.

```bash
cd /var/www/nexus-invest/Nmess/server
cp .env.example .env
# В .env: PORT=3001 (или другой порт за прокси)
npm install --production
```

Запуск через **pm2** (чтобы работал в фоне и после перезагрузки):

```bash
sudo npm install -g pm2
pm2 start src/server.js --name nmess
pm2 save
pm2 startup
```

Проксирование WebSocket в Nginx (чтобы клиент ходил на `wss://ваш-домен.ru/nmess-ws`):

```nginx
# Внутри server { ... } для ваш-домен.ru
location /nmess-ws {
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "Upgrade";
    proxy_set_header Host $host;
    proxy_pass http://127.0.0.1:3001;
}
```

Тогда в Laravel `.env` на проде:

```env
NMESS_WS_URL=wss://ваш-домен.ru/nmess-ws
```

Если Nmess висит на поддомене (например, `nmess.ваш-домен.ru` на порту 3001), в проде можно указать:

```env
NMESS_WS_URL=wss://nmess.ваш-домен.ru
```

и на этом поддомене в nginx настроить прокси на `127.0.0.1:3001` с поддержкой WebSocket (как выше).

#### 2.4 Права и хранилище

```bash
sudo chown -R www-data:www-data /var/www/nexus-invest
sudo chmod -R 755 storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

---

## 3. Запуск и проверка

### На проде (VPS)

1. **Laravel:** после деплоя сайт уже работает через Nginx + PHP-FPM. После каждого `git pull`:
   ```bash
   cd /var/www/nexus-invest
   composer install --no-dev
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   ```

2. **Nmess:** сервер уже запущен через pm2. Перезапуск:
   ```bash
   pm2 restart nmess
   ```
   Логи: `pm2 logs nmess`.

3. **Проверка:** откройте https://ваш-домен.ru, войдите в ЛК → Мессенджер. Внизу должно быть «Сигналинг: подключено».

### Обновление клиента мессенджера после правок в Nmess/client

На своей машине:

```bash
cd C:\xampp\htdocs\nexus-invest\Nmess\client
npm run build
xcopy /E /Y dist\* ..\..\public\nmess\
```

Закоммитить изменения в `public/nmess/` и сделать `git push`. На проде — `git pull` (файлы из `public/nmess/` подтянутся).

---

## Краткий чеклист

| Шаг | Действие |
|-----|----------|
| 1 | Локально: `git add .` → `git commit` → `git push` |
| 2 | На хосте: клонировать репо или `git pull` |
| 3 | На хосте: настроить `.env`, `composer install`, `php artisan migrate`, кэши |
| 4 | Настроить веб-сервер (root = `public`) |
| 5 | Запустить Nmess: `cd Nmess/server && npm i && pm2 start src/server.js` |
| 6 | В `.env` указать `NMESS_WS_URL` (wss://...) для прода |

Если напишете, какой у вас хостинг (shared/PHP-only или VPS и ОС), можно сузить инструкцию под него.
