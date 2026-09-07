<?php

namespace App\Http\Controllers;

/**
 * Публичная страница «ГАНИМЕД» — описание блокчейна и стандарта.
 */
class GanimedController extends Controller
{
    public function __invoke()
    {
        return view('public-sections.ganimed', [
            'title' => __('ГАНИМЕД'),
        ]);
    }
}
