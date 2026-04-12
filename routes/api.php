<?php

use App\Http\Controllers\Api\CaptchaController;
use App\Http\Controllers\Api\GanimedBlockController;
use App\Http\Controllers\Api\GanimedHealthController;
use Illuminate\Support\Facades\Route;

/*
| API-эндпоинты публичной части.
*/
Route::get('/api/ganimed/health', GanimedHealthController::class)->name('api.ganimed.health');
Route::get('/api/ganimed/block', [GanimedBlockController::class, '__invoke'])->name('api.ganimed.block');
Route::middleware('throttle:10,1')->post('/api/captcha/new', [CaptchaController::class, 'new'])->name('api.captcha.new');
