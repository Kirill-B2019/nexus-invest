<?php

namespace App\View\Components\App;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Layout личного кабинета (app.layouts.lk). Использовать как <x-app-layout>.
 */
class AppLayout extends Component
{
    public function render(): View
    {
        return view('app.layouts.lk');
    }
}
