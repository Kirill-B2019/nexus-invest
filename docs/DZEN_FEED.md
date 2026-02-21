# Лента новостей из Дзен

На главной странице выводится блок новостей из канала Дзен. Данные загружаются по неофициальному API при нажатии «Обновить ленту» в админке.

## Конфигурация

Файл `config/dzen.php`, переменные окружения:

- **DZEN_CHANNEL_URL** — URL канала (по умолчанию `https://dzen.ru/digital_fintech`).
- **DZEN_CHANNEL_ID** — опционально. ID канала в формате zen.yandex (например `5a3287185f4967644f9226e4`). Если по `channel_name` API возвращает 404 или пустой `items`, укажите ID.
- **DZEN_API_URL** — основной URL API (по умолчанию `https://dzen.ru/api/v3/launcher/more`).

Сервис по очереди пробует:

1. Основной `api_url` (dzen.ru).
2. Резервные хосты: `https://zen.yandex.com/api/v3/launcher/more` и `https://zen.yandex.ru/api/v3/launcher/more`.

Для каждого хоста перебираются варианты: `channel_name` = полный URL канала, `channel_name` = slug (например `digital_fintech`), при наличии — `channel_id` = ID.

## Если API возвращает 404 и пустой items

Часто dzen.ru отдаёт HTTP 404 и `"items":[]` даже при валидном канале (ограничения/защита). Что сделать:

1. **Проверить вариант с zen.yandex**  
   Команда отладки перебирает все варианты и выводит, какой запрос вернул данные:
   ```bash
   php artisan dzen:dump-response
   ```
   Если в выводе есть «Успех» и число элементов > 0 — обновление ленты в админке будет использовать тот же вариант.

2. **Указать channel_id**  
   Откройте канал в браузере. Если URL вида `https://zen.yandex.ru/id/5a3287185f4967644f9226e4`, то ID — `5a3287185f4967644f9226e4`. Добавьте в `.env`:
   ```env
   DZEN_CHANNEL_ID=5a3287185f4967644f9226e4
   ```
   Для каналов вида `https://dzen.ru/digital_fintech` ID может быть в исходном коде страницы или в запросах во вкладке «Сеть».

3. **Сохранить ответ для отладки**  
   ```bash
   php artisan dzen:dump-response --save
   ```
   JSON сохранится в `storage/app/dzen-response.json`. Если в нём непустой `items`, парсер даты и картинок уже настроен под типичную структуру; при других полях можно доработать `DzenFeedService::extractPublishedAt` и `extractImageUrl`.

## Команды

- `php artisan dzen:dump-response` — проверить все варианты API и вывести структуру первого элемента при успехе.
- `php artisan dzen:dump-response --save` — то же и сохранить полный ответ в `storage/app/dzen-response.json`.
- `php artisan news-feed:fix` — проставить `published_at` из `created_at` у записей без даты и докачать картинки по внешним URL в storage.
