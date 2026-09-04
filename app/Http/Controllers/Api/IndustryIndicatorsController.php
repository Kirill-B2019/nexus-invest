<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Indicators\IndustryIndicatorsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * Публичное API отраслевых индикаторов ЦФА/RWA.
 */
class IndustryIndicatorsController extends Controller
{
    public function __construct(
        private readonly IndustryIndicatorsService $service
    ) {}

    public function cfaTemperature(): JsonResponse
    {
        return $this->cached('cfa-temperature', fn () => $this->service->cfaTemperature());
    }

    public function rwaVsDefi(): JsonResponse
    {
        return $this->cached('rwa-vs-defi', fn () => $this->service->rwaVsDefi());
    }

    public function liquidityLight(): JsonResponse
    {
        return $this->cached('liquidity-light', fn () => $this->service->liquidityLight());
    }

    public function rwaGlobal(): JsonResponse
    {
        return $this->cached('rwa-global', fn () => $this->service->rwaGlobal());
    }

    public function smeCost(): JsonResponse
    {
        return $this->cached('sme-cost', fn () => $this->service->smeCost());
    }

    public function riskMap(): JsonResponse
    {
        return $this->cached('risk-map', fn () => $this->service->riskMap());
    }

    /**
     * Пакетный ответ для главной (один запрос вместо пяти).
     */
    public function board(): JsonResponse
    {
        return $this->cached('board', function () {
            return [
                'ok' => true,
                'cfa-temperature' => $this->service->cfaTemperature(),
                'liquidity-light' => $this->service->liquidityLight(),
                'rwa-vs-defi' => $this->service->rwaVsDefi(),
                'risk-map' => $this->service->riskMap(),
                'rwa-global' => $this->service->rwaGlobal(),
            ];
        });
    }

    /**
     * @param  callable(): array<string, mixed>  $resolver
     */
    private function cached(string $key, callable $resolver): JsonResponse
    {
        $cacheKey = 'indicators.v2.'.$key;
        $ttl = config('indicators.cache_ttl', 300);

        if (request()->boolean('refresh')) {
            $data = $resolver();
            Cache::put($cacheKey, $data, now()->addSeconds($ttl));

            return response()->json($data)
                ->header('Cache-Control', 'no-store');
        }

        $data = Cache::remember($cacheKey, $ttl, $resolver);

        return response()->json($data)
            ->header('Cache-Control', 'public, max-age=60, stale-while-revalidate=300');
    }
}
