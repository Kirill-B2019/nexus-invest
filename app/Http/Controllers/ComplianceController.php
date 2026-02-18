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
        return view('compliance', [
            'title' => __('Соответствие'),
        ]);
    }
}
