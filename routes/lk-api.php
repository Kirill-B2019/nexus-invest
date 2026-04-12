<?php

use App\Http\Controllers\Api\NmessContactsController;
use App\Http\Controllers\Api\NmessTokenController;
use App\Http\Controllers\Api\TrueConfTokenController;
use Illuminate\Support\Facades\Route;

/*
| JSON/API эндпоинты для виджетов ЛК (мессенджер, iframe). Те же URI и middleware, что ранее в lk.php.
| Подключается из routes/lk.php внутри группы middleware('auth').
*/
Route::get('/api/nmess/token', NmessTokenController::class)->middleware('lk.access')->name('api.nmess.token');
Route::get('/api/nmess/contacts', NmessContactsController::class)->middleware('lk.access')->name('api.nmess.contacts');
Route::get('/api/messenger/trueconf-token', TrueConfTokenController::class)->middleware('lk.access')->name('api.messenger.trueconf-token');
