<?php

use App\Http\Controllers\Api\CaptchaController;
use App\Http\Controllers\Api\GanimedBlockController;
use App\Http\Controllers\Api\GanimedHealthController;
use App\Http\Controllers\Api\IndustryIndicatorsController;
use Illuminate\Support\Facades\Route;

/*
| API-эндпоинты публичной части.
*/
Route::get('/api/ganimed/health', GanimedHealthController::class)->name('api.ganimed.health');
Route::get('/api/ganimed/block', [GanimedBlockController::class, '__invoke'])->name('api.ganimed.block');
Route::middleware('throttle:10,1')->post('/api/captcha/new', [CaptchaController::class, 'new'])->name('api.captcha.new');
Route::middleware('throttle:60,1')->get('/api/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
})->name('api.csrf-token');

/*
| Отраслевые индикаторы ЦФА/RWA (публичные JSON-виджеты).
*/
Route::prefix('/api/indicators')->name('api.indicators.')->group(function () {
    Route::get('/board', [IndustryIndicatorsController::class, 'board'])->name('board');
    Route::get('/cfa-temperature', [IndustryIndicatorsController::class, 'cfaTemperature'])->name('cfa-temperature');
    Route::get('/rwa-vs-defi', [IndustryIndicatorsController::class, 'rwaVsDefi'])->name('rwa-vs-defi');
    Route::get('/liquidity-light', [IndustryIndicatorsController::class, 'liquidityLight'])->name('liquidity-light');
    Route::get('/rwa-global', [IndustryIndicatorsController::class, 'rwaGlobal'])->name('rwa-global');
    Route::get('/sme-cost', [IndustryIndicatorsController::class, 'smeCost'])->name('sme-cost');
    Route::get('/risk-map', [IndustryIndicatorsController::class, 'riskMap'])->name('risk-map');
});
