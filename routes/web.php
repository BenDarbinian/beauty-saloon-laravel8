<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\RecordController as ApiRecordController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RecordGController;
use App\Http\Controllers\ServiceController;
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

Route::get('/', [ServiceController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('account', [AccountController::class, 'account'])->middleware('auth');

Route::get('record', [RecordController::class, 'create'])->middleware('auth');
#Route::post('record', [RecordController::class, 'store'])->middleware('auth');

Route::get('record_guest', [RecordGController::class, 'create'])->middleware('guest');
Route::post('record_guest', [RecordGController::class, 'store'])->middleware('guest')->name('recordg');
 
Route::get('admin', [AdminController::class, 'create'])->middleware('admin');

require __DIR__ . '/auth.php';
