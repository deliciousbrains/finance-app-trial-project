<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CsvImportController;
use App\Services\TransactionService;

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

Route::middleware('auth:api')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/account', [AccountController::class, 'index']);
    Route::apiResource('/transactions', TransactionController::class);
    Route::post('/import', [CsvImportController::class, 'store']);
});
