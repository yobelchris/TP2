<?php

use App\Http\Controllers\UserController;
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
    return redirect()->route('login');
});

Route::view('/login', 'login')->name('login');

Route::post('/login', [UserController::class, 'login']);

Route::view('/register', 'register')->name('register');

Route::post('/register', [UserController::class, 'register']);
