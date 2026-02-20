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
        $hint = self::parseApiErrorBody($body);
        if ($status === 400 || $status === 422) {
            $base = __('TrueConf отклонил данные пользователя :login (HTTP :status).', ['login' => $login, 'status' => $status]);
            return $hint ? $base.' '.$hint : $base.' '.__('Подробности в логах (storage/logs).');
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
     * Извлечь из тела ответа API текст ошибки (JSON или строка).
     */
    private static function parseApiErrorBody(string $body): ?string
    {
        $body = trim($body);
        if ($body === '') {
            return null;
        }
        $data = json_decode($body, true);
        if (is_array($data)) {
            if (! empty($data['message'])) {
                return $data['message'];
            }
            if (! empty($data['error'])) {
                return is_string($data['error']) ? $data['error'] : json_encode($data['error']);
            }
            if (! empty($data['errors']) && is_array($data['errors'])) {
                return implode(' ', array_map(fn ($v) => is_array($v) ? implode(' ', $v) : (string) $v, $data['errors']));
            }
        }
        return strlen($body) <= 200 ? $body : substr($body, 0, 197).'...';
    }

    /**
     * Нормализовать логин для TrueConf: нижний регистр, только буквы, цифры, подчёркивание, точка, дефис.
     * Публичный, чтобы сохранять в БД тот же логин, что уходит в API.
     */
    public static function normalizeLogin(string $login): string
    {
        $login = trim($login);
        if ($login === '') {
            return $login;
        }
        $normalized = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $login);
        $normalized = $normalized !== '' ? $normalized : $login;
        return mb_strtolower($normalized, 'UTF-8');
    }

    /**
     * Создать или обновить пользователя в TrueConf. Возвращает true при успехе.
     * API ожидает login_name, email, при необходимости display_name и password.
     */
    public function createOrUpdateUser(string $login, string $email, string $displayName, string $password): bool
    {
        $this->lastError = null;
        $login = self::normalizeLogin($login);
        $email = trim($email);
        if ($email === '') {
            $email = $login.'@nexus.local';
        }
        $displayName = trim($displayName);
        if ($displayName === '') {
            $displayName = $login;
        }

        $token = $this->getClientToken();
        if (! $token) {
            return false;
        }

        $url = $this->baseUrl.'/api/'.$this->apiVersion.'/users';
        $body = [
            'login_name' => $login,
            'email' => $email,
            'display_name' => $displayName,
            'password' => $password,
        ];
        $response = $this->httpClient()->withToken($token)->post($url, $body);

        if ($response->successful()) {
            return true;
        }

        if ($response->status() === 409 || str_contains($response->body(), 'already exists')) {
            $updateUrl = $this->baseUrl.'/api/'.$this->apiVersion.'/users/'.urlencode($login);
            $update = $this->httpClient()->withToken($token)->put($updateUrl, [
                'email' => $email,
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
