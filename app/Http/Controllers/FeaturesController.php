<?php

namespace App\Http\Controllers;

/**
 * |KB 2025-02-18 Страница «Особенности» (публичная часть).
 */
class FeaturesController extends Controller
{
    /**
     * Display the features page.
     */
    public function __invoke()
    {
        return view('public-sections.features', [
            'title' => __('Особенности экосистемы НЕКСУС'),
            'description' => __('Операционная модель и ключевые особенности платформы проектного финансирования: витрина проектов, карта регионов, типы инструментов и доходности.'),
        ]);
    }
}
