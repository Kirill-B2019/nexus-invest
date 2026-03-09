<?php

namespace App\Http\Controllers;

/**
 * |KB 2025-02-18 Страница «Документация» (публичная часть).
 */
class DocumentationController extends Controller
{
    /**
     * Display the documentation page.
     */
    public function __invoke()
    {
        return view('public-sections.documentation', [
            'title' => __('Документация и правила платформы'),
            'description' => __('Условия использования платформы НЕКСУС, политики, соглашения и регламентирующие документы.'),
        ]);
    }
}
