<?php

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

Route::get('/dashboard', function () {
    return redirect()->route('transactions.index');
})->middleware(['auth'])->name('dashboard');

Route::resource('transactions', \App\Http\Controllers\TransactionsController::class)
    ->only(['index', 'store', 'update'])
    ->middleware(['auth']);
Route::post('transactions/bulk', [\App\Http\Controllers\TransactionsController::class, 'bulk'])
    ->name('transactions.bulk')
    ->middleware('auth');
Route::get('balance', [\App\Http\Controllers\BalanceController::class, 'index'])
    ->name('balance.index')
    ->middleware(['auth']);

require __DIR__ . '/auth.php';
