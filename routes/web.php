<?php

use App\Http\Controllers\Api\CaptchaController;
use App\Http\Controllers\App\BlankPageController;
use App\Http\Controllers\App\LkController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
| Сайт доступен только авторизованным пользователям.
| Логин, регистрация, восстановление пароля — в auth.php (для гостей).
*/
Route::middleware('auth')->group(function () {
    Route::get('/', WelcomeController::class)->name('welcome');

    Route::get('/features', FeaturesController::class)->name('features');
    Route::get('/compliance', ComplianceController::class)->name('compliance');
    Route::get('/documentation', DocumentationController::class)->name('documentation');

    Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::middleware('throttle:10,1')->post('/api/captcha/new', [CaptchaController::class, 'new'])->name('api.captcha.new');

    Route::get('/lk', LkController::class)->middleware('verified')->name('lk');

    Route::redirect('/dashboard', '/lk', 301);

    Route::get('/app/blank', BlankPageController::class)->name('app.blank');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
