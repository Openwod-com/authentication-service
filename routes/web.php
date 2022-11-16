<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BasicLoginController;
use App\Http\Controllers\PublicKeyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/public_key', [PublicKeyController::class, 'index']);

Route::post('/login', [BasicLoginController::class, 'index']);

Route::post('/accounts', [AccountController::class, 'store']);
