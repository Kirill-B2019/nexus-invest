<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * |KB 2026-03-03 API последнего блока ГАНИМЕД (block/latest). Статус по success, данные блока для футера.
 */
class GanimedBlockController extends Controller
{
    private const CACHE_KEY = 'ganimed_block_latest';

    public function __invoke(): JsonResponse
    {
        $refresh = request()->boolean('refresh');

        if ($refresh) {
            $data = $this->fetchBlock();
            Cache::put(self::CACHE_KEY, $data, now()->addSeconds(config('ganimed.block_cache_ttl', 60)));
            return response()->json($data);
        }

        $data = Cache::remember(
            self::CACHE_KEY,
            config('ganimed.block_cache_ttl', 60),
            fn () => $this->fetchBlock()
        );

        return response()->json($data);
    }

    /**
     * Запрос block/latest, нормализация для футера.
     *
     * @return array{ok: bool, block: array{height: int, merkleRoot: string, miner: string, updatedAt: string, isFinalized: bool}|null}
     */
    private function fetchBlock(): array
    {
        $url = config('ganimed.main_node_block_latest_url');

        try {
            $response = Http::timeout(5)->get($url);

            if (! $response->successful()) {
                return ['ok' => false, 'block' => null];
            }

            $body = $response->json();
            $success = $body['success'] ?? false;
            $data = $body['data'] ?? [];

            if (! $success || empty($data)) {
                return ['ok' => false, 'block' => null];
            }

            $updatedAt = $data['UpdatedAt'] ?? $data['Timestamp'] ?? null;
            $updatedAtFormatted = $updatedAt
                ? Carbon::parse($updatedAt)->locale('ru')->format('d.m.Y H:i')
                : '';

            return [
                'ok' => true,
                'block' => [
                    'height' => (int) ($data['Height'] ?? $data['Index'] ?? 0),
                    'hash' => (string) ($data['Hash'] ?? ''),
                    'merkleRoot' => (string) ($data['MerkleRoot'] ?? ''),
                    'miner' => (string) ($data['Miner'] ?? ''),
                    'updatedAt' => $updatedAtFormatted,
                    'isFinalized' => (bool) ($data['IsFinalized'] ?? false),
                ],
            ];
        } catch (\Throwable $e) {
            return ['ok' => false, 'block' => null];
        }
    }
}
