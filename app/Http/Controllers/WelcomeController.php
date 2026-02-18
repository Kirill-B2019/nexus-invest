<?php

namespace App\Http\Controllers;

/**
 * |KB 2025-02-18 Главная страница сайта (после входа). Публичная часть.
 */
class WelcomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome');
    }
}
