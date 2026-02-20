<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Интеграция с TrueConf Server API: OAuth 2.0 и управление пользователями.
 */
class TrueConfApiService
{
    /** Сообщение об ошибке для показа пользователю (без секретов). */
    public ?string $lastError = null;

    public function __construct(
        protected string $baseUrl,
        protected string $clientId,
        protected string $clientSecret,
        protected string $apiVersion
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public static function fromConfig(): self
    {
        return new self(
            config('trueconf.base_url'),
            config('trueconf.client_id'),
            config('trueconf.client_secret'),
            config('trueconf.api_version', 'v3.8')
        );
    }

    protected function httpClient(): \Illuminate\Http\Client\PendingRequest
    {
        $verify = config('trueconf.verify_ssl', true);

        return Http::withOptions(['verify' => $verify]);
    }

    /**
     * Токен по Client Credentials (для вызовов API от имени приложения).
     */
    public function getClientToken(): ?string
    {
        $url = $this->baseUrl.'/oauth2/v1/token';
        $response = $this->httpClient()->asForm()->post($url, [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        if (! $response->successful()) {
            Log::warning('TrueConf getClientToken failed', ['status' => $response->status(), 'body' => $response->body()]);
            $this->lastError = self::tokenErrorMessage($response);

            return null;
        }
        $this->lastError = null;

        $data = $response->json();

        return $data['access_token'] ?? null;
    }

    /**
     * Токен по User Credentials (для выдачи пользователю и открытия веб-клиента).
     */
    public function getUserToken(string $login, string $password): ?array
    {
        $url = $this->baseUrl.'/oauth2/v1/token';
        $response = $this->httpClient()->asForm()->post($url, [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $login,
            'password' => $password,
        ]);

        if (! $response->successful()) {
            Log::warning('TrueConf getUserToken failed', ['login' => $login, 'status' => $response->status()]);

            return null;
        }

        return $response->json();
    }

    private static function tokenErrorMessage(\Illuminate\Http\Client\Response $response): string
    {
        $status = $response->status();
        if ($status === 401) {
            return __('Не удалось получить токен TrueConf (401). Проверьте TRUECONF_CLIENT_ID и TRUECONF_CLIENT_SECRET в .env.');
        }
        if ($status === 0 || $status >= 500) {
            return __('Сервер TrueConf недоступен или вернул ошибку :status. Проверьте TRUECONF_BASE_URL и доступность сервера.', ['status' => $status ?: 'timeout']);
        }
        if ($status >= 400) {
            return __('Ошибка TrueConf при получении токена: HTTP :status.', ['status' => $status]);
        }
        return __('Неизвестная ошибка при обращении к TrueConf.');
    }

    private static function userErrorMessage(\Illuminate\Http\Client\Response $response, string $login): string
    {
        $status = $response->status();
        $body = (string) $response->body();
        if ($status === 400 || $status === 422) {
            return __('TrueConf отклонил данные пользователя :login (HTTP :status). Проверьте логи.', ['login' => $login, 'status' => $status]);
        }
        if ($status === 403 || $status === 401) {
            return __('Нет прав на создание пользователей в TrueConf (HTTP :status).', ['status' => $status]);
        }
        if ($status === 0 || $status >= 500) {
            return __('Сервер TrueConf недоступен (HTTP :status). Проверьте TRUECONF_BASE_URL.', ['status' => $status ?: 'timeout']);
        }
        return __('Ошибка TrueConf при создании/обновлении пользователя :login: HTTP :status.', ['login' => $login, 'status' => $status]);
    }

    /**
     * Создать или обновить пользователя в TrueConf. Возвращает true при успехе.
     * При неудаче в lastError записывается сообщение для пользователя.
     */
    public function createOrUpdateUser(string $login, string $displayName, string $password): bool
    {
        $this->lastError = null;
        $token = $this->getClientToken();
        if (! $token) {
            return false;
        }

        $url = $this->baseUrl.'/api/'.$this->apiVersion.'/users';
        $response = $this->httpClient()->withToken($token)->post($url, [
            'login' => $login,
            'display_name' => $displayName,
            'password' => $password,
        ]);

        if ($response->successful()) {
            return true;
        }

        if ($response->status() === 409 || str_contains($response->body(), 'already exists')) {
            $updateUrl = $this->baseUrl.'/api/'.$this->apiVersion.'/users/'.urlencode($login);
            $update = $this->httpClient()->withToken($token)->put($updateUrl, [
                'display_name' => $displayName,
                'password' => $password,
            ]);

            if ($update->successful()) {
                return true;
            }
            $this->lastError = self::userErrorMessage($update, $login);
            Log::warning('TrueConf createOrUpdateUser (update) failed', [
                'login' => $login,
                'status' => $update->status(),
                'body' => $update->body(),
            ]);
            return false;
        }

        $this->lastError = self::userErrorMessage($response, $login);
        Log::warning('TrueConf createOrUpdateUser failed', [
            'login' => $login,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return false;
    }

    /**
     * URL веб-клиента TrueConf (для редиректа или iframe).
     */
    public function getWebClientUrl(): string
    {
        return $this->baseUrl.'/';
    }
}
