<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * |KB 2026-02-27 API статуса кросс-узла нод блокчейна ГАНИМЕД (health main-node).
 * Кеширует ответ; при refresh=1 обновляет кеш.
 */
class GanimedHealthController extends Controller
{
    private const CACHE_KEY = 'ganimed_node_health';

    public function __invoke(): JsonResponse
    {
        $refresh = request()->boolean('refresh');

        if ($refresh) {
            $data = $this->fetchHealth();
            Cache::put(self::CACHE_KEY, $data, now()->addSeconds(config('ganimed.health_cache_ttl', 60)));
            return response()->json($data);
        }

        $data = Cache::remember(
            self::CACHE_KEY,
            config('ganimed.health_cache_ttl', 60),
            fn () => $this->fetchHealth()
        );

        return response()->json($data);
    }

    /**
     * Запрос к main-node health.
     *
     * @return array{ok: bool, status: string, raw: array|null}
     */
    private function fetchHealth(): array
    {
        $url = config('ganimed.main_node_health_url');

        try {
            $response = Http::timeout(5)->get($url);

            if ($response->successful()) {
                $body = $response->json();
                $status = $body['data']['status'] ?? null;
                $ok = $status === 'ok';

                return [
                    'ok' => $ok,
                    'status' => $ok ? 'ok' : (string) $status,
                    'raw' => $body,
                ];
            }

            return [
                'ok' => false,
                'status' => 'error',
                'raw' => ['http_status' => $response->status()],
            ];
        } catch (\Throwable $e) {
            return [
                'ok' => false,
                'status' => 'error',
                'raw' => ['message' => $e->getMessage()],
            ];
        }
    }
}
