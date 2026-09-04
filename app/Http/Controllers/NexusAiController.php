<?php

namespace App\Http\Controllers;

/**
 * Публичная страница «НЕКСУС ИИ» — собственная обучаемая модель экосистемы.
 */
class NexusAiController extends Controller
{
    public function __invoke()
    {
        return view('public-sections.nexus-ai', [
            'title' => __('НЕКСУС ИИ'),
            'description' => __('Собственная обучаемая модель — единый сервис скоринга, комплаенса, рисков, стратегий и поддержки для модулей экосистемы НЕКСУС.'),
        ]);
    }
}
