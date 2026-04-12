<?php

use App\Http\Controllers\App\DashboardController;
use App\Http\Controllers\App\LkController;
use App\Http\Controllers\App\LkRoleSwitchController;
use App\Http\Controllers\App\NmessPageController;
use App\Http\Controllers\App\NotificationsController;
use App\Http\Controllers\App\ProjectsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
| Личный кабинет и профиль — требуют авторизации. Вход в /lk — по разрешению access-lk.
*/
Route::middleware('auth')->group(function () {
    Route::get('/lk', LkController::class)->middleware('verified', 'lk.access')->name('lk');
    Route::post('/lk/switch-role', LkRoleSwitchController::class)->middleware('verified', 'lk.access', 'role:super-admin')->name('lk.switch-role');
    Route::get('/lk/investor', [DashboardController::class, 'investor'])->middleware('verified', 'lk.access', 'role:super-admin|investor')->name('lk.dashboard.investor');
    Route::get('/lk/initiator', [DashboardController::class, 'initiator'])->middleware('verified', 'lk.access', 'role:super-admin|initiator')->name('lk.dashboard.initiator');
    Route::get('/lk/expert', [DashboardController::class, 'expert'])->middleware('verified', 'lk.access', 'role:super-admin|expert')->name('lk.dashboard.expert');
    Route::get('/lk/messenger', NmessPageController::class)->middleware('verified', 'lk.access')->name('lk.messenger');

    Route::middleware('verified', 'lk.access', 'role:super-admin|investor')->group(function () {
        Route::get('/lk/portfolio', [ProjectsController::class, 'portfolio'])->name('lk.portfolio');
        Route::get('/lk/projects', [ProjectsController::class, 'all'])->name('lk.projects.all');
    });

    Route::middleware('verified', 'lk.access', 'role:super-admin|initiator')->group(function () {
        Route::get('/lk/projects/my', [ProjectsController::class, 'my'])->name('lk.projects.my');
        Route::get('/lk/projects/create', [ProjectsController::class, 'create'])->name('lk.projects.create');
        Route::post('/lk/projects', [ProjectsController::class, 'store'])->name('lk.projects.store');
        Route::get('/lk/projects/{project}/edit', [ProjectsController::class, 'edit'])->name('lk.projects.edit');
        Route::patch('/lk/projects/{project}', [ProjectsController::class, 'update'])->name('lk.projects.update');
        Route::post('/lk/projects/{project}/submit', [ProjectsController::class, 'submit'])->name('lk.projects.submit');
        Route::delete('/lk/projects/{project}/documents/{document}', [ProjectsController::class, 'deleteDocument'])->name('lk.projects.document.delete');
        Route::delete('/lk/projects/{project}/images/{image}', [ProjectsController::class, 'deleteImage'])->name('lk.projects.image.delete');
    });

    Route::middleware('verified', 'lk.access')->prefix('lk/notifications')->name('lk.notifications.')->group(function () {
        Route::get('/', [NotificationsController::class, 'index'])->name('index');
        Route::get('/dropdown', [NotificationsController::class, 'dropdown'])->name('dropdown');
        Route::post('/read-all', [NotificationsController::class, 'markAllRead'])->name('mark-all-read');
        Route::post('/{id}/read', [NotificationsController::class, 'markRead'])->name('mark-read');
    });

    require __DIR__.'/lk-api.php';

    Route::redirect('/dashboard', '/lk', 301)->middleware('lk.access');

    Route::get('/profile', [ProfileController::class, 'edit'])->middleware('lk.access')->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->middleware('lk.access')->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('lk.access')->name('profile.destroy');
});
