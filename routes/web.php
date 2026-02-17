<?php

use App\Http\Controllers\Api\CaptchaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
| Сайт доступен только авторизованным пользователям.
| Логин, регистрация, восстановление пароля — в auth.php (для гостей).
*/
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/features', FeaturesController::class)->name('features');
    Route::get('/compliance', ComplianceController::class)->name('compliance');

    Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::middleware('throttle:10,1')->post('/api/captcha/new', [CaptchaController::class, 'new'])->name('api.captcha.new');

    Route::get('/lk', function () {
        return view('app.pages.lk');
    })->middleware('verified')->name('lk');

    Route::redirect('/dashboard', '/lk', 301);

    Route::get('/app/blank', function () {
        return view('app.pages.blank', ['title' => __('Страница')]);
    })->name('app.blank');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
