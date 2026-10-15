<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NexusAiHealthController extends Controller
{
    private const CACHE_KEY = 'nexus_ai_health';

    public function __invoke(): JsonResponse
    {
        if (request()->boolean('refresh')) {
            $data = $this->checkHealth();
            Cache::put(self::CACHE_KEY, $data, now()->addSeconds(config('services.nexus_ai.health_cache_ttl')));

            return response()->json($data);
        }

        $data = Cache::remember(
            self::CACHE_KEY,
            config('services.nexus_ai.health_cache_ttl'),
            fn () => $this->checkHealth()
        );

        return response()->json($data);
    }

    /**
     * @return array{ok: bool, status: string, checked_at: string}
     */
    private function checkHealth(): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(5)
                ->get(config('services.nexus_ai.health_url'));

            $ok = $response->successful()
                && strtolower((string) $response->json('status')) === 'ok';

            if (! $ok) {
                Log::warning('Nexus AI health check returned an unhealthy response.', [
                    'http_status' => $response->status(),
                ]);
            }
        } catch (ConnectionException $exception) {
            Log::warning('Nexus AI health check could not connect.', [
                'message' => $exception->getMessage(),
            ]);
            $ok = false;
        }

        return [
            'ok' => $ok,
            'status' => $ok ? 'Активен' : 'Недоступен',
            'checked_at' => now()->format('d.m.Y H:i:s'),
        ];
    }
}
