<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/contact/{contact}/edit', [App\Http\Controllers\ContactController::class, 'edit'])->name('contact.edit');

    Route::post('/create-token', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    });
});
