<?php

namespace App\Http\Controllers;

/**
 * Публичная страница «ГАНИМЕД» — описание блокчейна и стандарта.
 * |KB 2026-02-27 Добавлена страница «Токены GND и GANI».
 */
class GanimedController extends Controller
{
    public function __invoke()
    {
        return view('public-sections.ganimed', [
            'title' => __('ГАНИМЕД'),
        ]);
    }

    /**
     * Внутренняя страница «Токены GND и GANI» — концепция двухтокеновой модели.
     */
    public function tokens()
    {
        return view('public-sections.ganimed-tokens', [
            'title' => __('Токены GND и GANI'),
        ]);
    }
}
