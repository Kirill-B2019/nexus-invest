<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TrueConfApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Выдача токена TrueConf для открытия веб-клиента мессенджера.
 * Доступ только у пользователей с правом use-messenger и messenger_access.
 */
class TrueConfTokenController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Необходима авторизация.'], 401);
        }

        $hasAccess = (bool) ($user->messenger_access ?? false);
        if (! $user->hasRole('super-admin') && ! $user->hasRole('messenger-admin') && (! $user->can('use-messenger') || ! $hasAccess)) {
            return response()->json(['message' => 'Нет доступа к мессенджеру.'], 403);
        }

        $login = $user->trueconf_login;
        $password = $user->trueconf_password_encrypted;

        if (! $login || ! $password) {
            return response()->json(['message' => 'Учётная запись мессенджера не настроена. Обратитесь к администратору.'], 403);
        }

        $service = TrueConfApiService::fromConfig();
        $tokenData = $service->getUserToken($login, $password);

        if (! $tokenData || empty($tokenData['access_token'])) {
            return response()->json(['message' => 'Не удалось получить сессию мессенджера. Попробуйте позже.'], 502);
        }

        return response()->json([
            'access_token' => $tokenData['access_token'],
            'expires_in' => $tokenData['expires_in'] ?? 3600,
            'web_client_url' => $service->getWebClientUrl(),
        ]);
    }
}
