<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Уведомления ЛК: страница списка, API для колокольчика, отметка прочитанным.
 */
class NotificationsController extends Controller
{
    /** Количество уведомлений в выпадающем списке колокольчика */
    private const DROPDOWN_LIMIT = 10;

    /** Порядок важности для сортировки (сначала более важные). */
    private const IMPORTANCE_ORDER = ['urgent', 'high', 'normal', 'low'];

    /**
     * Запрос активных (не истёкших) уведомлений с сортировкой.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool $onlyUnread
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function activeQuery($query, bool $onlyUnread = false): \Illuminate\Database\Eloquent\Builder
    {
        $now = now()->toIso8601String();
        $query->where(function ($q) use ($now) {
            $q->whereNull('data->expires_at')
                ->orWhere('data->expires_at', '>', $now);
        });
        if ($onlyUnread) {
            $query->whereNull('read_at');
        }
        $order = implode("','", self::IMPORTANCE_ORDER);
        $query->orderByRaw("FIELD(JSON_UNQUOTE(JSON_EXTRACT(data, '$.importance')), '{$order}') ASC")
            ->orderByDesc('created_at');

        return $query;
    }

    /**
     * Страница «Уведомления» (/lk/notifications).
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $filter = $request->get('filter', 'active'); // active | unread | expired
        $query = $user->notifications();

        if ($filter === 'expired') {
            $query->whereNotNull('data->expires_at')
                ->where('data->expires_at', '<=', now()->toIso8601String());
        } else {
            $now = now()->toIso8601String();
            $query->where(function ($q) use ($now) {
                $q->whereNull('data->expires_at')->orWhere('data->expires_at', '>', $now);
            });
            if ($filter === 'unread') {
                $query->whereNull('read_at');
            }
        }
        $order = implode("','", self::IMPORTANCE_ORDER);
        $query->orderByRaw("FIELD(JSON_UNQUOTE(JSON_EXTRACT(data, '$.importance')), '{$order}') ASC")
            ->orderByDesc('created_at');

        $notifications = $query->paginate(20)->withQueryString();

        return view('app.pages.notifications.index', [
            'notifications' => $notifications,
            'filter' => $filter,
        ]);
    }

    /**
     * API для колокольчика: счётчик непрочитанных; список — последние N активных уведомлений (от новых к старым).
     */
    public function dropdown(Request $request): JsonResponse
    {
        $user = $request->user();
        $unreadQuery = $user->notifications();
        $this->activeQuery($unreadQuery, true);
        $count = $unreadQuery->count();

        $listQuery = $user->notifications();
        $this->activeQuery($listQuery, false);
        $items = $listQuery->limit(self::DROPDOWN_LIMIT)->get();

        $list = $items->map(function ($n) {
            $data = $n->data;
            return [
                'id' => $n->id,
                'title' => $data['title'] ?? '',
                'body' => \Illuminate\Support\Str::limit($data['body'] ?? '', 80),
                'link' => $data['link'] ?? null,
                'importance' => $data['importance'] ?? 'normal',
                'created_at' => $n->created_at->format('d.m.Y H:i'),
            ];
        });

        return response()->json([
            'count' => $count,
            'items' => $list,
        ]);
    }

    /**
     * Отметить уведомление прочитанным и опционально редирект по ссылке.
     */
    public function markRead(Request $request, string $id): RedirectResponse|JsonResponse
    {
        $notification = $request->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            $link = $notification->data['link'] ?? null;
            if ($request->wantsJson()) {
                return response()->json(['read' => true, 'link' => $link]);
            }
            if ($link) {
                return redirect()->to($link);
            }
        }

        if ($request->wantsJson()) {
            return response()->json(['read' => false], 404);
        }

        return redirect()->route('lk.notifications.index');
    }

    /**
     * Отметить все активные уведомления прочитанными.
     */
    public function markAllRead(Request $request): RedirectResponse
    {
        $now = now()->toIso8601String();
        $request->user()->notifications()
            ->whereNull('read_at')
            ->where(function ($q) use ($now) {
                $q->whereNull('data->expires_at')->orWhere('data->expires_at', '>', $now);
            })
            ->update(['read_at' => now()]);

        return redirect()->route('lk.notifications.index')->with('status', __('Все уведомления отмечены прочитанными.'));
    }
}
