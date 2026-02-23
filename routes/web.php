<?php

use App\Http\Controllers\Api\CaptchaController;
use App\Http\Controllers\Api\NmessContactsController;
use App\Http\Controllers\Api\NmessTokenController;
use App\Http\Controllers\Api\TrueConfTokenController;
use App\Http\Controllers\App\BlankPageController;
use App\Http\Controllers\App\LkController;
use App\Http\Controllers\App\MessengerAdminController;
use App\Http\Controllers\App\RolesAdminController;
use App\Http\Controllers\App\NewsFeedAdminController;
use App\Http\Controllers\App\NmessPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\GanimedController;
use App\Http\Controllers\IgndController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
| Публичная часть — без авторизации.
*/
Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/features', FeaturesController::class)->name('features');
Route::get('/compliance', ComplianceController::class)->name('compliance');
Route::get('/documentation', DocumentationController::class)->name('documentation');
Route::get('/ganimed', GanimedController::class)->name('ganimed');
Route::get('/ignd', IgndController::class)->name('ignd');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::middleware('throttle:10,1')->post('/api/captcha/new', [CaptchaController::class, 'new'])->name('api.captcha.new');

/*
| Личный кабинет и профиль — требуют авторизации. Вход в /lk — по разрешению access-lk.
*/
Route::middleware('auth')->group(function () {
    Route::get('/lk', LkController::class)->middleware('verified', 'lk.access')->name('lk');
    Route::get('/lk/messenger', NmessPageController::class)->middleware('verified', 'lk.access')->name('lk.messenger');
    Route::get('/lk/admin/messenger', [MessengerAdminController::class, 'index'])->middleware('verified', 'lk.access', 'role:messenger-admin')->name('lk.admin.messenger');
    Route::post('/lk/admin/messenger', [MessengerAdminController::class, 'updateAccess'])->middleware('verified', 'lk.access', 'role:messenger-admin')->name('lk.admin.messenger.update');
    Route::post('/lk/admin/messenger/sync', [MessengerAdminController::class, 'syncWithServer'])->middleware('verified', 'lk.access', 'role:messenger-admin')->name('lk.admin.messenger.sync');

    Route::middleware('verified', 'lk.access', 'role:roles-admin')->prefix('lk/admin/roles')->name('lk.admin.roles.')->group(function () {
        Route::get('/', [RolesAdminController::class, 'index'])->name('index');
        Route::get('/users', [RolesAdminController::class, 'users'])->name('users');
        Route::get('/users/{user}/edit', [RolesAdminController::class, 'userEdit'])->name('user.edit');
        Route::patch('/users/{user}', [RolesAdminController::class, 'userUpdate'])->name('user.update');
        Route::get('/roles', [RolesAdminController::class, 'roles'])->name('roles');
        Route::get('/roles/create', [RolesAdminController::class, 'roleCreate'])->name('role.create');
        Route::post('/roles', [RolesAdminController::class, 'roleStore'])->name('role.store');
        Route::get('/roles/{role}/edit', [RolesAdminController::class, 'roleEdit'])->name('role.edit');
        Route::patch('/roles/{role}', [RolesAdminController::class, 'roleUpdate'])->name('role.update');
        Route::delete('/roles/{role}', [RolesAdminController::class, 'roleDestroy'])->name('role.destroy');
        Route::get('/permissions', [RolesAdminController::class, 'permissions'])->name('permissions');
        Route::get('/permissions/create', [RolesAdminController::class, 'permissionCreate'])->name('permission.create');
        Route::post('/permissions', [RolesAdminController::class, 'permissionStore'])->name('permission.store');
        Route::get('/permissions/{permission}/edit', [RolesAdminController::class, 'permissionEdit'])->name('permission.edit');
        Route::patch('/permissions/{permission}', [RolesAdminController::class, 'permissionUpdate'])->name('permission.update');
        Route::delete('/permissions/{permission}', [RolesAdminController::class, 'permissionDestroy'])->name('permission.destroy');
    });

    Route::middleware('verified', 'lk.access', 'permission:update-news-feed')->prefix('lk/admin/news-feed')->name('lk.admin.news-feed.')->group(function () {
        Route::get('/', [NewsFeedAdminController::class, 'index'])->name('index');
        Route::post('/update', [NewsFeedAdminController::class, 'update'])->name('update');
        Route::delete('/{newsFeedItem}', [NewsFeedAdminController::class, 'destroy'])->name('destroy');
    });

    Route::get('/api/nmess/token', NmessTokenController::class)->middleware('lk.access')->name('api.nmess.token');
    Route::get('/api/nmess/contacts', NmessContactsController::class)->middleware('lk.access')->name('api.nmess.contacts');
    Route::get('/api/messenger/trueconf-token', TrueConfTokenController::class)->middleware('lk.access')->name('api.messenger.trueconf-token');

    Route::redirect('/dashboard', '/lk', 301)->middleware('lk.access');

    Route::get('/app/blank', BlankPageController::class)->middleware('lk.access')->name('app.blank');

    Route::get('/profile', [ProfileController::class, 'edit'])->middleware('lk.access')->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->middleware('lk.access')->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('lk.access')->name('profile.destroy');
});

require __DIR__.'/auth.php';
