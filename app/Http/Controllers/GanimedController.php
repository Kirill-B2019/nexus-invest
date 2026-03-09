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
            'description' => __('Двухтокеновая модель блокчейна ГАНИМЕД: утилитарный токен GND для комиссий и стейкинга, governance-токен GANI для управления протоколом и vote-escrow.'),
        ]);
    }
}
