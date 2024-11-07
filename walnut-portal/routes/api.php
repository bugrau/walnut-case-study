<?php

use Illuminate\Support\Facades\Route;

// Remove middleware group and make routes direct
Route::get('/test', function() {
    return response()->json(['message' => 'API is working']);
});

Route::post('/callback', [\App\Http\Controllers\Api\CallbackController::class, 'store']);
Route::post('/test-receiver', [\App\Http\Controllers\Api\CallbackController::class, 'testReceiver']);