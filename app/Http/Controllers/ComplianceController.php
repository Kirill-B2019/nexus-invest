<?php

namespace App\Http\Controllers;

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
