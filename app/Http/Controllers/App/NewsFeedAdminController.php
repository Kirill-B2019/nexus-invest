<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\NewsFeedItem;
use App\Models\User;
use App\Notifications\LkNotification;
use App\Services\DzenFeedService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Админка ленты новостей: обновление с канала Дзен.
 * Доступ по разрешению update-news-feed.
 */
class NewsFeedAdminController extends Controller
{
    public function index(): View
    {
        $items = NewsFeedItem::query()
            ->select(['id', 'external_id', 'title', 'url', 'image_url', 'description', 'published_at', 'source', 'created_at', 'updated_at'])
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(50)
            ->get();

        return view('app.pages.news-feed-admin', [
            'items' => $items,
            'channelUrl' => config('dzen.channel_url', 'https://dzen.ru/digital_fintech'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate(['_token' => 'required']);

        try {
            $saved = DzenFeedService::make()->fetchAndSync();
            $notification = new LkNotification(
                title: __('Обновлена лента новостей'),
                body: __('Добавлено или обновлено записей: :count. Новости отображаются на главной странице.', ['count' => $saved]),
                link: route('welcome'),
                type: LkNotification::TYPE_SYSTEM,
                importance: 'normal',
                expiresAt: now()->addDays(7),
            );
            User::permission('access-lk')->get()->each(fn ($user) => $user->notify($notification));
            return redirect()
                ->route('lk.admin.news-feed.index')
                ->with('status', __('Лента обновлена. Обработано записей: :count.', ['count' => $saved]));
        } catch (\Throwable $e) {
            return redirect()
                ->route('lk.admin.news-feed.index')
                ->with('error', __('Ошибка обновления ленты: :message', ['message' => $e->getMessage()]));
        }
    }

    /**
     * Удалить статью с сайта (запись в БД и картинка в storage). С канала Дзен не удаляется.
     */
    public function destroy(NewsFeedItem $newsFeedItem): RedirectResponse
    {
        $rawImageUrl = $newsFeedItem->getRawOriginal('image_url');
        if (! empty($rawImageUrl) && ! Str::startsWith($rawImageUrl, 'http')) {
            $path = ltrim($rawImageUrl, '/');
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $newsFeedItem->delete();

        return redirect()
            ->route('lk.admin.news-feed.index')
            ->with('status', __('Статья удалена с сайта.'));
    }
}
