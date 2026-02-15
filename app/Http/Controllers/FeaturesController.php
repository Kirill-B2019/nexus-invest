<?php

namespace App\Http\Controllers;

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
