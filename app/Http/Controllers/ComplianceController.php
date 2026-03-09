<?php

namespace App\Http\Controllers;

/**
 * |KB 2025-02-18 Страница «Соответствие» (публичная часть).
 */
class ComplianceController extends Controller
{
    /**
     * Display the compliance page.
     */
    public function __invoke()
    {
        return view('public-sections.compliance', [
            'title' => __('Соответствие законодательству РФ'),
            'description' => __('Юридическое и нормативное соответствие экосистемы НЕКСУС и блокчейна ГАНИМЕД федеральному законодательству: 259-ФЗ, 289-ФЗ, 39-ФЗ, ПОД/ФТ, персональные данные.'),
        ]);
    }
}
