<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RecordGController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionsController;
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

Route::get('/', [ServiceController::class, 'index']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');


Route::get('login', [LoginController::class, 'showLoginForm'])
->name('login');

Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('account', [AccountController::class, 'account'])->middleware('auth');

Route::get('record', [RecordController::class, 'create'])->middleware('auth');
#Route::post('record', [RecordController::class, 'store'])->middleware('auth');

Route::get('record_guest', [RecordGController::class, 'create'])->middleware('guest');
Route::post('record_guest', [RecordGController::class, 'store'])->middleware('guest');

Route::get('admin', [AdminController::class, 'create'])->middleware('admin');