<?php

use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\GanimedController;
use App\Http\Controllers\IgndController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NexusAiController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
| Публичная часть — без авторизации.
*/
Route::get('/robots.txt', RobotsController::class)->name('robots');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/features', FeaturesController::class)->name('features');
Route::get('/compliance', ComplianceController::class)->name('compliance');
Route::get('/documentation', DocumentationController::class)->name('documentation');
Route::get('/ganimed', GanimedController::class)->name('ganimed');
Route::get('/ignd', IgndController::class)->name('ignd');
Route::get('/nexus-ai', NexusAiController::class)->name('nexus-ai');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show')->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
