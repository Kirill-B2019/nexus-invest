<?php

use App\Http\Controllers\Api\CaptchaController;
use App\Http\Controllers\Api\NmessContactsController;
use App\Http\Controllers\Api\NmessTokenController;
use App\Http\Controllers\Api\TrueConfTokenController;
use App\Http\Controllers\App\BlankPageController;
use App\Http\Controllers\App\LkController;
use App\Http\Controllers\App\MessengerAdminController;
use App\Http\Controllers\App\NmessPageController;
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
    Route::get('/lk/messenger', NmessPageController::class)->middleware('verified')->name('lk.messenger');
    Route::get('/lk/admin/messenger', [MessengerAdminController::class, 'index'])->middleware('verified', 'role:messenger-admin')->name('lk.admin.messenger');
    Route::post('/lk/admin/messenger', [MessengerAdminController::class, 'updateAccess'])->middleware('verified', 'role:messenger-admin')->name('lk.admin.messenger.update');
    Route::post('/lk/admin/messenger/sync', [MessengerAdminController::class, 'syncWithServer'])->middleware('verified', 'role:messenger-admin')->name('lk.admin.messenger.sync');
    Route::get('/api/nmess/token', NmessTokenController::class)->name('api.nmess.token');
    Route::get('/api/nmess/contacts', NmessContactsController::class)->name('api.nmess.contacts');
    Route::get('/api/messenger/trueconf-token', TrueConfTokenController::class)->name('api.messenger.trueconf-token');

    Route::redirect('/dashboard', '/lk', 301);

    Route::get('/app/blank', BlankPageController::class)->name('app.blank');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
