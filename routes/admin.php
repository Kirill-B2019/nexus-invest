<?php

use App\Http\Controllers\App\AdminSettingsController;
use App\Http\Controllers\App\DictionariesAdminController;
use App\Http\Controllers\App\MessengerAdminController;
use App\Http\Controllers\App\NewsFeedAdminController;
use App\Http\Controllers\App\NotificationsAdminController;
use App\Http\Controllers\App\ProjectModerationController;
use App\Http\Controllers\App\RolesAdminController;
use Illuminate\Support\Facades\Route;

/*
| Административные разделы ЛК.
*/
Route::middleware('auth')->group(function () {
    Route::middleware('verified', 'lk.access', 'role_or_permission:super-admin|moderate-projects')->prefix('lk/admin/projects/moderation')->name('lk.admin.projects.moderation.')->group(function () {
        Route::get('/', [ProjectModerationController::class, 'index'])->name('index');
        Route::get('/{project}', [ProjectModerationController::class, 'show'])->name('show');
        Route::post('/{project}', [ProjectModerationController::class, 'moderate'])->name('moderate');
    });

    Route::get('/lk/admin/messenger', [MessengerAdminController::class, 'index'])->middleware('verified', 'lk.access', 'role:super-admin|messenger-admin')->name('lk.admin.messenger');
    Route::post('/lk/admin/messenger', [MessengerAdminController::class, 'updateAccess'])->middleware('verified', 'lk.access', 'role:super-admin|messenger-admin')->name('lk.admin.messenger.update');
    Route::post('/lk/admin/messenger/sync', [MessengerAdminController::class, 'syncWithServer'])->middleware('verified', 'lk.access', 'role:super-admin|messenger-admin')->name('lk.admin.messenger.sync');

    Route::middleware('verified', 'lk.access', 'role:super-admin|roles-admin')->prefix('lk/admin/roles')->name('lk.admin.roles.')->group(function () {
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

    Route::middleware('verified', 'lk.access', 'role_or_permission:super-admin|manage-notifications')->prefix('lk/admin/notifications')->name('lk.admin.notifications.')->group(function () {
        Route::get('/', [NotificationsAdminController::class, 'index'])->name('index');
        Route::get('/create', [NotificationsAdminController::class, 'create'])->name('create');
        Route::post('/', [NotificationsAdminController::class, 'store'])->name('store');
    });

    Route::middleware('verified', 'lk.access', 'role_or_permission:super-admin|update-news-feed')->prefix('lk/admin/news-feed')->name('lk.admin.news-feed.')->group(function () {
        Route::get('/', [NewsFeedAdminController::class, 'index'])->name('index');
        Route::post('/update', [NewsFeedAdminController::class, 'update'])->name('update');
        Route::delete('/{newsFeedItem}', [NewsFeedAdminController::class, 'destroy'])->name('destroy');
    });

    Route::get('/lk/admin/settings', AdminSettingsController::class)->middleware('verified', 'lk.access')->name('lk.admin.settings.index');

    Route::middleware('verified', 'lk.access', 'role_or_permission:super-admin|manage-dictionaries')
        ->prefix('lk/admin/settings/dictionaries')
        ->name('lk.admin.settings.dictionaries.')
        ->group(function () {
            Route::get('/', [DictionariesAdminController::class, 'index'])->name('index');
            Route::get('/search', [DictionariesAdminController::class, 'searchIndex'])->name('search.index');
            Route::get('/group/create', [DictionariesAdminController::class, 'createGroup'])->name('group.create');
            Route::post('/group', [DictionariesAdminController::class, 'storeGroup'])->name('group.store');
            Route::get('/group/{group}/edit', [DictionariesAdminController::class, 'editGroup'])->name('group.edit');
            Route::patch('/group/{group}', [DictionariesAdminController::class, 'updateGroup'])->name('group.update');
            Route::delete('/group/{group}', [DictionariesAdminController::class, 'destroyGroup'])->name('group.destroy');
            Route::get('/dictionary/create', [DictionariesAdminController::class, 'createDictionary'])->name('dictionary.create');
            Route::post('/dictionary', [DictionariesAdminController::class, 'storeDictionary'])->name('dictionary.store');
            Route::get('/dictionary/{dictionary}/edit', [DictionariesAdminController::class, 'editDictionary'])->name('dictionary.edit');
            Route::patch('/dictionary/{dictionary}', [DictionariesAdminController::class, 'updateDictionary'])->name('dictionary.update');
            Route::delete('/dictionary/{dictionary}', [DictionariesAdminController::class, 'destroyDictionary'])->name('dictionary.destroy');
            Route::get('/{dictionary}/search', [DictionariesAdminController::class, 'searchItems'])->name('search');
            Route::get('/{dictionary}', [DictionariesAdminController::class, 'show'])->name('show');
            Route::get('/{dictionary}/items/create', [DictionariesAdminController::class, 'createItem'])->name('item.create');
            Route::post('/{dictionary}/items', [DictionariesAdminController::class, 'storeItem'])->name('item.store');
            Route::get('/{dictionary}/items/{item}/edit', [DictionariesAdminController::class, 'editItem'])->name('item.edit');
            Route::patch('/{dictionary}/items/{item}', [DictionariesAdminController::class, 'updateItem'])->name('item.update');
            Route::delete('/{dictionary}/items/{item}', [DictionariesAdminController::class, 'destroyItem'])->name('item.destroy');
        });
});
