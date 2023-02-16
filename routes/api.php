<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/contacts', [App\Http\Controllers\Api\ContactController::class, 'index']);
    Route::post('contacts', [App\Http\Controllers\Api\ContactController::class, 'store']);
    Route::put('contacts/{contact}', [App\Http\Controllers\Api\ContactController::class, 'update']);
    Route::delete('/contacts/{contact}', [App\Http\Controllers\Api\ContactController::class, 'destroy']);

    Route::post('/create-token', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    });
});