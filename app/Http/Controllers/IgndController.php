<?php

namespace App\Http\Controllers;

/**
 * Публичная страница «Система iGND» — система смягчения инвестиционных рисков NEXUS.
 */
class IgndController extends Controller
{
    public function __invoke()
    {
        return view('public-sections.ignd', [
            'title' => __('Система смягчения инвестиционных рисков (iGND)'),
            'description' => __('Внутренний сервисный токен экосистемы НЕКСУС для управления рисками, персонального риск-профиля инвестора и доступа к специализированным сервисам платформы.'),
        ]);
    }
}
