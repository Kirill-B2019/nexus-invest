<?php

namespace App\Services;

use App\Models\NewsFeedItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Загрузка ленты новостей из канала Дзен (https://dzen.ru/digital_fintech).
 * Использует неофициальный API. Обновление запускается администратором по кнопке.
 */
class DzenFeedService
{
    protected string $apiUrl;
    protected string $channelUrl;
    /** @var string[] */
    protected array $apiUrlFallbacks;
    /** @var string|null */
    protected $channelId;
    /** @var array<string, mixed> */
    protected array $apiQuery;

    public function __construct(
        ?string $apiUrl = null,
        ?string $channelUrl = null,
        ?string $channelId = null,
        ?array $apiUrlFallbacks = null,
        ?array $apiQuery = null
    ) {
        $this->channelUrl = rtrim($channelUrl ?? config('dzen.channel_url', 'https://dzen.ru/digital_fintech'), '/');
        $this->apiUrl = $apiUrl ?? config('dzen.api_url', 'https://dzen.ru/api/v3/launcher/export');
        $this->channelId = $channelId ?? config('dzen.channel_id');
        $this->apiUrlFallbacks = $apiUrlFallbacks ?? config('dzen.api_url_fallbacks', []);
        $this->apiQuery = $apiQuery ?? config('dzen.api_query', []);
    }

    public static function make(): self
    {
        return new self();
    }

    /**
     * Для записей с внешним URL картинки — скачать в storage и обновить путь в БД.
     * Возвращает количество обновлённых записей.
     */
    public function refreshImagesForExistingItems(): int
    {
        $updated = 0;
        foreach (NewsFeedItem::all() as $model) {
            $raw = $model->getRawOriginal('image_url');
            if (empty($raw) || ! Str::startsWith($raw, 'http')) {
                continue;
            }
            $path = $this->downloadImageToStorage($raw, $model->external_id);
            if ($path !== null) {
                $model->update(['image_url' => $path]);
                $updated++;
            }
        }
        return $updated;
    }

    /**
     * Извлечь slug канала из URL (например digital_fintech из https://dzen.ru/digital_fintech).
     */
    protected function getChannelSlug(): string
    {
        $path = parse_url($this->channelUrl, PHP_URL_PATH);
        return $path ? trim($path, '/') : 'digital_fintech';
    }

    /**
     * Загрузить ленту с API и сохранить/обновить записи в БД.
     * Перебираются несколько URL API (dzen.ru, zen.yandex.com, zen.yandex.ru) и варианты channel_name / channel_id.
     * Возвращает количество добавленных/обновлённых записей.
     */
    public function fetchAndSync(): int
    {
        $channelSlug = $this->getChannelSlug();
        $apiUrls = array_values(array_unique(array_merge([$this->apiUrl], $this->apiUrlFallbacks)));

        // export принимает channel_name (slug); more — URL или slug; channel_id — запасной вариант
        $paramVariants = [
            ['channel_name' => $channelSlug],
            ['channel_name' => $this->channelUrl],
        ];
        if ($this->channelId !== null && $this->channelId !== '') {
            $paramVariants[] = ['channel_id' => $this->channelId];
        }

        $lastBody = '';
        $lastStatus = 0;

        foreach ($apiUrls as $apiUrl) {
            foreach ($paramVariants as $params) {
                $response = Http::timeout(20)
                    ->withHeaders([
                        'Accept' => 'application/json',
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    ])
                    ->get($apiUrl, array_merge($this->apiQuery, $params));

                $lastStatus = $response->status();
                $lastBody = $response->body();
                $data = $response->json();

                $status = $data['status'] ?? null;
                if (is_array($status) && ($status['type'] ?? '') === 'not_found') {
                    continue;
                }

                $items = $data['items'] ?? [];
                if (is_array($items) && count($items) > 0) {
                    return $this->syncItems($items);
                }
            }
        }

        $this->throwChannelNotFound($lastStatus, $lastBody);
    }

    /**
     * Сохранить элементы в БД. Обложки скачиваются в storage сразу при обновлении ленты.
     */
    protected function syncItems(array $items): int
    {
        $baseUrl = $this->channelUrl;
        $saved = 0;

        foreach ($items as $rawItem) {
            $item = $this->normalizeFeedItem($rawItem);
            // publication_object_id — стабильный ID публикации в Дзен; id может быть отрицательным внутренним идентификатором
            $externalId = (string) ($item['publication_object_id'] ?? $item['publication_id'] ?? $item['id'] ?? $rawItem['publication_object_id'] ?? $rawItem['publication_id'] ?? $rawItem['id'] ?? '');
            if ($externalId === '') {
                continue;
            }
            $title = $this->cleanTitle((string) ($item['title'] ?? $rawItem['title'] ?? ''));
            if ($title === '') {
                continue;
            }
            $type = $item['type'] ?? $rawItem['type'] ?? '';
            if ($type !== '' && $type !== 'card' && $type !== 'native') {
                continue;
            }

            $url = $item['link'] ?? $item['share_link'] ?? $item['url'] ?? $rawItem['link'] ?? $rawItem['share_link'] ?? $rawItem['url'] ?? "{$baseUrl}/{$externalId}";
            if (! Str::startsWith($url, 'http')) {
                $url = "{$baseUrl}/{$externalId}";
            }

            $externalImageUrl = $this->extractImageUrl($item);
            if ($externalImageUrl === null) {
                $externalImageUrl = $this->extractImageUrl($rawItem);
            }
            $imageStoragePath = null;
            if ($externalImageUrl) {
                $imageStoragePath = $this->downloadImageToStorage($externalImageUrl, $externalId);
            }

            $description = $this->cleanDescription((string) ($item['text'] ?? $item['description'] ?? $rawItem['text'] ?? $rawItem['description'] ?? ''));
            $publishedAt = $this->extractPublishedAt($item);
            if ($publishedAt === null) {
                $publishedAt = $this->extractPublishedAt($rawItem);
            }

            $payload = [
                'title' => Str::limit($title, 500),
                'url' => Str::limit($url, 1000),
                'description' => $description !== '' ? Str::limit($description, 2000) : null,
            ];
            if ($imageStoragePath !== null) {
                $payload['image_url'] = $imageStoragePath;
            }

            $existing = NewsFeedItem::where('external_id', $externalId)->where('source', 'dzen')->first();
            // published_at: устанавливать только при создании или если у записи его нет.
            // API Дзен возвращает относительные даты («9 часов назад»), при каждом обновлении
            // они пересчитываются в «сейчас минус N» — это искажает реальную дату публикации.
            if ($publishedAt !== null && ($existing === null || $existing->published_at === null)) {
                $payload['published_at'] = $publishedAt instanceof \DateTimeInterface ? $publishedAt->format('Y-m-d H:i:s') : $publishedAt;
            }

            // id — автоинкремент, задаётся только БД; при update не трогать id (Query Builder)
            $payload = array_intersect_key($payload, array_flip((new NewsFeedItem)->getFillable()));
            unset($payload['id']);

            if ($existing !== null) {
                NewsFeedItem::where('external_id', $externalId)->where('source', 'dzen')->update($payload);
            } else {
                NewsFeedItem::create(array_merge(
                    ['external_id' => $externalId, 'source' => 'dzen'],
                    $payload
                ));
            }
            $saved++;
        }

        // Заполнить published_at из created_at для записей без даты публикации
        NewsFeedItem::whereNull('published_at')->update(['published_at' => DB::raw('created_at')]);

        return $saved;
    }

    /**
     * Скачать картинку по URL и сохранить в storage/app/public/news-feed/.
     * Возвращает относительный путь (news-feed/xxx.jpg) или null при ошибке.
     */
    protected function downloadImageToStorage(string $imageUrl, string $externalId): ?string
    {
        if (! Str::startsWith($imageUrl, 'http')) {
            return null;
        }
        $response = Http::timeout(15)
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'image/*',
            ])
            ->get($imageUrl);

        if (! $response->successful() || empty($response->body())) {
            return null;
        }

        try {
            Storage::disk('public')->makeDirectory('news-feed');
        } catch (\Throwable) {
        }
        $body = $response->body();
        $ext = $this->guessImageExtension($response->header('Content-Type'), $imageUrl, $body);
        $safeId = preg_replace('/[^a-zA-Z0-9_-]/', '_', Str::limit($externalId, 100));
        $filename = $safeId . '.' . $ext;
        $path = 'news-feed/' . $filename;

        $saved = Storage::disk('public')->put($path, $body);
        return $saved ? $path : null;
    }

    /**
     * Определить расширение по Content-Type, URL и при необходимости по магическим байтам.
     * PNG оставляем PNG; при неизвестном формате по умолчанию не JPG, а по детекту из содержимого.
     */
    protected function guessImageExtension(?string $contentType, string $url, ?string $body = null): string
    {
        $map = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'image/svg+xml' => 'svg',
        ];
        if ($contentType) {
            $contentType = strtolower(explode(';', trim($contentType))[0]);
            if (isset($map[$contentType])) {
                return $map[$contentType];
            }
        }
        $path = parse_url($url, PHP_URL_PATH);
        if ($path && preg_match('/\.(jpe?g|png|gif|webp|svg)$/i', $path, $m)) {
            return strtolower($m[1] === 'jpeg' ? 'jpg' : $m[1]);
        }
        if ($body !== null && $body !== '') {
            $detected = $this->detectImageFormatFromBytes($body);
            if ($detected !== null) {
                return $detected;
            }
        }
        return 'jpg';
    }

    /**
     * Определить формат изображения по магическим байтам (PNG, JPEG, GIF, WEBP).
     * PNG сохраняем как png, не конвертируем в jpg. При необходимости конвертации в JPG
     * (например через GD/Imagick) использовать белый фон для прозрачности, не чёрный.
     */
    protected function detectImageFormatFromBytes(string $body): ?string
    {
        $len = strlen($body);
        if ($len < 12) {
            return null;
        }
        $head = substr($body, 0, 12);
        if (substr($head, 0, 8) === "\x89PNG\r\n\x1A\n") {
            return 'png';
        }
        if (substr($head, 0, 3) === "\xFF\xD8\xFF") {
            return 'jpg';
        }
        if (substr($head, 0, 6) === "GIF87a" || substr($head, 0, 6) === "GIF89a") {
            return 'gif';
        }
        if ($len >= 12 && substr($head, 0, 4) === "RIFF" && substr($head, 8, 4) === "WEBP") {
            return 'webp';
        }
        return null;
    }

    protected function throwChannelNotFound(int $httpStatus, string $body): void
    {
        $data = json_decode($body, true);
        $statusText = null;
        if (is_array($data['status'] ?? null)) {
            $statusText = $data['status']['text'] ?? null;
        }
        $message = $statusText ?: 'Такого канала не существует';
        throw new \RuntimeException(
            'Канал Дзен не найден (HTTP ' . $httpStatus . '). ' . $message . ' '
            . 'Проверьте, что канал доступен: ' . $this->channelUrl . ' '
            . 'Ранее загруженные новости останутся на сайте.'
        );
    }

    /**
     * Объединить элемент с вложенным data/card/article, чтобы все поля были на одном уровне.
     */
    protected function normalizeFeedItem(array $item): array
    {
        $inner = $item['data'] ?? $item['card'] ?? $item['article'] ?? $item['content'] ?? null;
        if (is_array($inner)) {
            return array_merge($inner, $item);
        }
        return $item;
    }

    protected function cleanTitle(string $s): string
    {
        return trim(preg_replace('/\s+/', ' ', strip_tags($s)));
    }

    protected function cleanDescription(string $s): string
    {
        $s = trim(preg_replace('/\s+/', ' ', strip_tags($s)));
        return Str::limit($s, 1000);
    }

    protected function extractImageUrl(array $item): ?string
    {
        if (! empty($item['image'])) {
            if (is_array($item['image'])) {
                $first = reset($item['image']);
                if (is_array($first) && ! empty($first['url'])) {
                    return $first['url'];
                }
                if (is_string($first) && Str::startsWith($first, 'http')) {
                    return $first;
                }
            }
            if (is_string($item['image']) && Str::startsWith($item['image'], 'http')) {
                return $item['image'];
            }
            if (is_array($item['image']) && ! empty($item['image']['url'])) {
                return $item['image']['url'];
            }
        }
        if (! empty($item['cover']['url'])) {
            return $item['cover']['url'];
        }
        if (! empty($item['thumbnail']) && is_array($item['thumbnail']) && ! empty($item['thumbnail']['url'])) {
            return $item['thumbnail']['url'];
        }
        foreach (['main_image', 'preview', 'cover_image', 'image_url', 'image_src', 'og_image'] as $key) {
            $v = $item[$key] ?? null;
            if (is_string($v) && Str::startsWith($v, 'http')) {
                return $v;
            }
            if (is_array($v) && ! empty($v['url'])) {
                return $v['url'];
            }
            if (is_array($v) && ! empty($v['href'])) {
                return $v['href'];
            }
        }
        $share = $item['share'] ?? null;
        if (is_array($share)) {
            $url = $share['image'] ?? $share['image_url'] ?? $share['url'] ?? null;
            if (is_string($url) && Str::startsWith($url, 'http')) {
                return $url;
            }
        }
        return null;
    }

    /**
     * Дата публикации из ответа Дзен. Сохраняется в БД в published_at.
     * Возвращает null, если дату из ответа извлечь не удалось.
     */
    protected function extractPublishedAt(array $item): ?\DateTimeInterface
    {
        $ts = $item['creation_time'] ?? $item['published_at'] ?? $item['timestamp'] ?? $item['publication_date']
            ?? $item['created_at'] ?? $item['date'] ?? $item['created'] ?? $item['pub_date']
            ?? $item['creation_timestamp'] ?? $item['published_timestamp'] ?? $item['time'] ?? null;
        $pub = $item['publication'] ?? null;
        if (is_array($pub)) {
            $ts = $ts ?? $pub['date'] ?? $pub['time'] ?? $pub['timestamp'] ?? null;
        }
        // Вложенные структуры API (statistics, meta и т.п.)
        if ($ts === null && isset($item['statistics']) && is_array($item['statistics'])) {
            $ts = $item['statistics']['creation_time'] ?? $item['statistics']['published_at'] ?? null;
        }
        if ($ts === null && isset($item['meta']) && is_array($item['meta'])) {
            $ts = $item['meta']['creation_time'] ?? $item['meta']['published_at'] ?? null;
        }
        if (is_array($ts) && isset($ts['seconds'])) {
            $ts = $ts['seconds'];
        }
        if (is_array($ts) && isset($ts['date'])) {
            $ts = $ts['date'];
        }
        if ($ts !== null) {
            if (is_numeric($ts)) {
                $seconds = (int) $ts;
                if ($seconds > 1e12) {
                    $seconds = (int) ($seconds / 1000);
                }
                try {
                    return \Carbon\Carbon::createFromTimestamp($seconds);
                } catch (\Throwable) {
                }
            }
            if (is_string($ts)) {
                $relative = $this->parseRelativeRussianDate($ts);
                if ($relative !== null) {
                    return $relative;
                }
                try {
                    return \Carbon\Carbon::parse($ts);
                } catch (\Throwable) {
                }
            }
        }
        return null;
    }

    /**
     * Парсинг относительных дат вида «4 дня назад», «2 часа назад», «вчера».
     */
    protected function parseRelativeRussianDate(string $s): ?\DateTimeInterface
    {
        $s = trim($s);
        if ($s === '') {
            return null;
        }
        $now = now();
        if (preg_match('/^(\d+)\s+(минут[уы]?|часа?|часов|день|дня|дней|недел[ия]|недель|месяц|месяца|месяцев)\s+назад$/ui', $s, $m)) {
            $num = (int) $m[1];
            $unit = mb_strtolower($m[2]);
            if (str_contains($unit, 'минут')) {
                return $now->copy()->subMinutes($num);
            }
            if (str_contains($unit, 'час')) {
                return $now->copy()->subHours($num);
            }
            if (str_contains($unit, 'дн') || str_contains($unit, 'день')) {
                return $now->copy()->subDays($num);
            }
            if (str_contains($unit, 'недел')) {
                return $now->copy()->subWeeks($num);
            }
            if (str_contains($unit, 'месяц')) {
                return $now->copy()->subMonths($num);
            }
        }
        if (preg_match('/^вчера$/ui', $s)) {
            return $now->copy()->subDay()->startOfDay();
        }
        if (preg_match('/^сегодня$/ui', $s)) {
            return $now->copy()->startOfDay();
        }
        return null;
    }
}
