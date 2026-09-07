<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\NewsFeedItem;
use App\Models\User;
use App\Notifications\LkNotification;
use App\Services\AgencyFeedService;
use App\Services\DzenFeedService;
use App\Support\HtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Админка ленты новостей: Дзен sync, CRUD редакционных статей, задел под агентство.
 */
class NewsFeedAdminController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorizeNewsAccess();

        $query = NewsFeedItem::query()
            ->with('author:id,name')
            ->orderedForFeed();

        if ($source = $request->string('source')->toString()) {
            $query->where('source', $source);
        }
        if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }

        $items = $query->paginate(30)->withQueryString();

        return view('app.pages.news-feed-admin', [
            'items' => $items,
            'channelUrl' => config('dzen.channel_url', 'https://dzen.ru/digital_fintech'),
            'filters' => [
                'source' => $source,
                'status' => $status,
            ],
            'agencyEnabled' => (bool) config('news.sources.agency.enabled', false),
        ]);
    }

    public function create(): View
    {
        $this->authorizeManageNews();

        return view('app.pages.news-feed-form', [
            'item' => new NewsFeedItem([
                'source' => NewsFeedItem::SOURCE_EDITORIAL,
                'status' => NewsFeedItem::STATUS_DRAFT,
                'published_at' => now(),
            ]),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeManageNews();

        $data = $this->validateEditorial($request);
        $slug = ! empty($data['slug'])
            ? NewsFeedItem::uniqueSlug($data['slug'])
            : NewsFeedItem::uniqueSlug($data['title']);

        $imagePath = $this->storeCover($request);

        $item = NewsFeedItem::create([
            'title' => $data['title'],
            'slug' => $slug,
            'description' => $data['description'] ?: null,
            'body' => HtmlSanitizer::clean($data['body'] ?? null),
            'image_url' => $imagePath,
            'url' => null,
            'external_id' => null,
            'source' => NewsFeedItem::SOURCE_EDITORIAL,
            'status' => $data['status'],
            'published_at' => $data['published_at'] ?? now(),
            'author_id' => $request->user()->id,
        ]);

        return redirect()
            ->route('lk.admin.news-feed.edit', $item)
            ->with('status', __('Статья создана.'));
    }

    public function edit(NewsFeedItem $newsFeedItem): View
    {
        $this->authorizeManageNews();
        $this->ensureEditorial($newsFeedItem);

        return view('app.pages.news-feed-form', [
            'item' => $newsFeedItem,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, NewsFeedItem $newsFeedItem): RedirectResponse
    {
        // Sync Дзен (старый маршрут POST /update без {item}) обрабатывается syncDzen().
        $this->authorizeManageNews();
        $this->ensureEditorial($newsFeedItem);

        $data = $this->validateEditorial($request, $newsFeedItem->id);
        $slugInput = $data['slug'] ?: $newsFeedItem->slug ?: $data['title'];
        $slug = NewsFeedItem::uniqueSlug($slugInput, $newsFeedItem->id);

        $payload = [
            'title' => $data['title'],
            'slug' => $slug,
            'description' => $data['description'] ?: null,
            'body' => HtmlSanitizer::clean($data['body'] ?? null),
            'status' => $data['status'],
            'published_at' => $data['published_at'] ?? $newsFeedItem->published_at ?? now(),
        ];

        if ($request->boolean('remove_cover')) {
            $this->deleteLocalImage($newsFeedItem);
            $payload['image_url'] = null;
        } elseif ($request->hasFile('cover')) {
            $this->deleteLocalImage($newsFeedItem);
            $payload['image_url'] = $this->storeCover($request);
        }

        $newsFeedItem->update($payload);

        return redirect()
            ->route('lk.admin.news-feed.edit', $newsFeedItem)
            ->with('status', __('Статья сохранена.'));
    }

    public function syncDzen(Request $request): RedirectResponse
    {
        $this->authorizeUpdateFeed();
        $request->validate(['_token' => 'required']);

        try {
            $saved = DzenFeedService::make()->fetchAndSync();
            $notification = new LkNotification(
                title: __('Обновлена лента новостей'),
                body: __('Добавлено или обновлено записей: :count. Новости отображаются на главной и на странице «Новости».', ['count' => $saved]),
                link: route('news.index'),
                type: LkNotification::TYPE_SYSTEM,
                importance: 'normal',
                expiresAt: now()->addDays(7),
            );
            User::permission('access-lk')->get()->each(fn ($user) => $user->notify($notification));

            return redirect()
                ->route('lk.admin.news-feed.index')
                ->with('status', __('Лента Дзен обновлена. Обработано записей: :count.', ['count' => $saved]));
        } catch (\Throwable $e) {
            return redirect()
                ->route('lk.admin.news-feed.index')
                ->with('error', __('Ошибка обновления ленты: :message', ['message' => $e->getMessage()]));
        }
    }

    public function syncAgency(Request $request): RedirectResponse
    {
        $this->authorizeUpdateFeed();
        $request->validate(['_token' => 'required']);

        try {
            $saved = (new AgencyFeedService)->fetchAndSync();

            return redirect()
                ->route('lk.admin.news-feed.index')
                ->with('status', __('Лента агентства обновлена. Обработано записей: :count.', ['count' => $saved]));
        } catch (\Throwable $e) {
            return redirect()
                ->route('lk.admin.news-feed.index')
                ->with('error', $e->getMessage());
        }
    }

    public function hide(NewsFeedItem $newsFeedItem): RedirectResponse
    {
        if ($newsFeedItem->source === NewsFeedItem::SOURCE_EDITORIAL) {
            $this->authorizeManageNews();
        } else {
            $this->authorizeUpdateFeed();
        }

        $newsFeedItem->update(['status' => NewsFeedItem::STATUS_HIDDEN]);

        return redirect()
            ->route('lk.admin.news-feed.index')
            ->with('status', __('Запись скрыта с публичной ленты.'));
    }

    public function destroy(NewsFeedItem $newsFeedItem): RedirectResponse
    {
        if ($newsFeedItem->source === NewsFeedItem::SOURCE_EDITORIAL) {
            $this->authorizeManageNews();
        } else {
            $this->authorizeUpdateFeed();
        }

        $this->deleteLocalImage($newsFeedItem);
        $newsFeedItem->delete();

        return redirect()
            ->route('lk.admin.news-feed.index')
            ->with('status', __('Запись удалена.'));
    }

    private function validateEditorial(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:500'],
            'slug' => [
                'nullable',
                'string',
                'max:200',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('news_feed_items', 'slug')->ignore($ignoreId),
            ],
            'description' => ['nullable', 'string', 'max:2000'],
            'body' => ['nullable', 'string', 'max:100000'],
            'status' => ['required', Rule::in([
                NewsFeedItem::STATUS_DRAFT,
                NewsFeedItem::STATUS_PUBLISHED,
                NewsFeedItem::STATUS_HIDDEN,
            ])],
            'published_at' => ['nullable', 'date'],
            'cover' => ['nullable', 'image', 'max:4096'],
            'remove_cover' => ['nullable', 'boolean'],
        ], [
            'slug.regex' => __('Slug: только латиница, цифры и дефис.'),
        ]);
    }

    private function storeCover(Request $request): ?string
    {
        if (! $request->hasFile('cover')) {
            return null;
        }

        Storage::disk('public')->makeDirectory('news-feed');
        $file = $request->file('cover');
        $name = 'editorial-' . Str::lower(Str::random(12)) . '.' . ($file->getClientOriginalExtension() ?: 'jpg');

        return $file->storeAs('news-feed', $name, 'public');
    }

    private function deleteLocalImage(NewsFeedItem $item): void
    {
        $raw = $item->getRawOriginal('image_url');
        if (! empty($raw) && ! Str::startsWith($raw, 'http')) {
            $path = ltrim($raw, '/');
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    private function ensureEditorial(NewsFeedItem $item): void
    {
        if ($item->source !== NewsFeedItem::SOURCE_EDITORIAL) {
            abort(404);
        }
    }

    private function authorizeNewsAccess(): void
    {
        $user = request()->user();
        if (! $user->hasRole('super-admin') && ! $user->can('update-news-feed') && ! $user->can('manage-news')) {
            abort(403);
        }
    }

    private function authorizeManageNews(): void
    {
        $user = request()->user();
        if (! $user->hasRole('super-admin') && ! $user->can('manage-news')) {
            abort(403);
        }
    }

    private function authorizeUpdateFeed(): void
    {
        $user = request()->user();
        if (! $user->hasRole('super-admin') && ! $user->can('update-news-feed')) {
            abort(403);
        }
    }
}
