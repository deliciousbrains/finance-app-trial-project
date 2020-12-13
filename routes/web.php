<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionsController;

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

Route::get('/dashboard', [TransactionsController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/dashboard', [TransactionsController::class, 'store'])->middleware(['auth'])->name('dashboard');
Route::put('/dashboard', [TransactionsController::class, 'update'])->middleware(['auth'])->name('dashboard');
Route::delete('/dashboard', [TransactionsController::class, 'destroy'])->middleware(['auth'])->name('dashboard');

//Route::get('/dashboard', function () {    
//    return view('transactions.edit');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

