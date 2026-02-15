<?php

use App\Http\Controllers\Api\CaptchaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/features', FeaturesController::class)->name('features');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('throttle:10,1')->post('/api/captcha/new', [CaptchaController::class, 'new'])->name('api.captcha.new');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
