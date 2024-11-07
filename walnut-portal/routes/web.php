<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\IncomingLogController;
use App\Http\Controllers\IncomingLogDataController;
use App\Http\Controllers\CallbackLogController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/test-config', function () {
    dd([
        'connection' => config('database.default'),
        'env_path' => app()->environmentFilePath(),
        'database' => config('database.connections.'.config('database.default'))
    ]);
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin-users.index');
    });

    Route::resource('admin-users', AdminUserController::class);
    Route::resource('incoming-logs', IncomingLogController::class)->only(['index', 'show']);
    Route::resource('callback-logs', CallbackLogController::class)->only(['index', 'show']);
    Route::resource('incoming-log-data', IncomingLogDataController::class);
});

// Logout route
Route::post('logout', [LoginController::class, 'logout'])->name('logout'); 