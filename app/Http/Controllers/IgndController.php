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
            'title' => __('Система iGND'),
        ]);
    }
}
