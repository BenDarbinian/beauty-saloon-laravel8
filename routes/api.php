<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\FinalRecordGController;
use App\Http\Controllers\Api\RecordController;
use App\Http\Controllers\api\RecordGController;
use App\Http\Controllers\api\RecordStatusController;
use App\Http\Controllers\api\ServiceController;
use App\Http\Controllers\Api\ServiceHistoryController;
use App\Http\Controllers\Api\StatusController;
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

Route::get('records', [RecordController::class, 'index']);
Route::post('records', [RecordController::class, 'store']);

Route::get('recordsstatus', [RecordStatusController::class, 'index']);
Route::post('recordsstatus', [RecordStatusController::class, 'status']);

Route::get('services', [ServiceController::class, 'index']);

Route::get('categories', [CategoryController::class, 'index']);

Route::get('servicehistory', [ServiceHistoryController::class, 'index']);

Route::get('recordgs', [RecordGController::class, 'index']);
Route::post('recordgs', [RecordGController::class, 'status']);

Route::get('statuses', [StatusController::class, 'index']);

Route::post('finalrecords', [FinalRecordGController::class, 'store']);
