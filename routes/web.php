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

Route::get('/dashboard',[TransactionsController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::post('/transaction/add',[TransactionsController::class,'store'])->middleware(['auth'])->name('transaction.add');
Route::get('/transaction/delete/{id}',[TransactionsController::class,'destroy'])->middleware(['auth'])->name('transaction.destroy');
Route::post('/transaction/edit/',[TransactionsController::class,'update'])->middleware(['auth'])->name('transaction.update');
Route::post('/transaction/import/',[TransactionsController::class,'import'])->middleware(['auth'])->name('transaction.import');

require __DIR__.'/auth.php';
