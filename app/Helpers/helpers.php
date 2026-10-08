<?php

/**
 * Общие хелперы проекта MoskowNexus.
 */

if (! function_exists('asset_version')) {
    /**
     * Получить версию ассетов для кэширования браузером.
     *
     * @param  string  $base  Базовая версия (по умолчанию '1.0').
     * @return string Версия в формате X.Y.Z
     */
    function asset_version(string $base = '1.0'): string
    {
        $v = config('app.asset_version');
        if ($v === null || $v === '') {
            $v = $base . '.' . (config('app.env') === 'production' ? '0' : time());
        }

        return (string) $v;
    }
}
