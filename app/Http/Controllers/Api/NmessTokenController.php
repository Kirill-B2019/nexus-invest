<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * |KB Выдача токена для мессенджера Nmess (сигналинг).
 * Доступ только у авторизованных пользователей; права мессенджера — из админки (позже).
 */
class NmessTokenController extends Controller
{
    /**
     * Вернуть токен и user_id для подключения к серверу сигналинга.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Необходима авторизация.'], 401);
        }

        // TODO: проверка права «доступ к мессенджеру» из админки (роль/флаг в БД)
        // if (! $user->canUseMessenger()) { return response()->json([...], 403); }

        $token = Str::random(64);
        cache()->put('nmess_token:'.$token, [
            'user_id' => (string) $user->id,
            'email'   => $user->email,
        ], now()->addMinutes(60));

        return response()->json([
            'token'    => $token,
            'user_id'  => (string) $user->id,
            'name'     => $user->name,
            'ws_url'   => config('nmess.ws_url', 'ws://127.0.0.1:3001'),
        ]);
    }
}
