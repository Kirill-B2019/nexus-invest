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
        return view('features', [
            'title' => __('Особенности'),
        ]);
    }
}
