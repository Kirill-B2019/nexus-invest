# Интеграция мессенджера с TrueConf Server

## Настройка .env

```env
TRUECONF_BASE_URL=https://mess.nexus-invest.fund
TRUECONF_CLIENT_ID=<Application ID из панели API → OAuth2>
TRUECONF_CLIENT_SECRET=<Secret из панели API → OAuth2>
```

Опционально для Authorization Code: `TRUECONF_REDIRECT_URI=https://nexus-invest.fund/lk/messenger/callback`.

## Первый запуск

1. Выполнить миграции: `php artisan migrate`
2. Создать разрешение «Доступ к мессенджеру»:  
   `php artisan db:seed --class=PermissionUseMessengerSeeder`
3. В панели TrueConf Server (API → OAuth2) создать приложение и выдать разрешения: users, conferences, conferences.participants и др. (см. ТЗ).
4. Указать в .env `TRUECONF_CLIENT_ID` и `TRUECONF_CLIENT_SECRET`, затем `php artisan config:cache`.

## Назначение доступа

- Войти под пользователем с ролью **Админ мессенджера** (`messenger-admin`).
- Открыть **Управление мессенджером** в меню ЛК.
- Отметить пользователей, которым нужен доступ к чату и звонкам, нажать **Сохранить**.
- При первом включении для пользователя создаётся учётная запись в TrueConf (логин `nexus_{id}` или текущий trueconf_login).

## Страница мессенджера

- Пункт меню «Мессенджер» виден только пользователям с разрешением **use-messenger** и включённым **Доступ к мессенджеру**.
- При настроенном TrueConf открывается веб-клиент TrueConf (iframe или ссылка «Открыть в новом окне»).
- Токен выдаётся через `GET /api/messenger/trueconf-token`.

## Отключение старого Nmess

Если используется только TrueConf, сервер Nmess (Node.js) можно не запускать. Если в .env не задан `TRUECONF_CLIENT_ID`, страница мессенджера показывает прежний iframe Nmess.
