<?php

namespace App\Http\Controllers;

class ComplianceController extends Controller
{
    /**
     * Страница «Соответствие» — юридическое и нормативное соответствие платформы.
     */
    public function __invoke()
    {
        return view('compliance', [
            'title' => __('Соответствие'),
        ]);
    }
}
