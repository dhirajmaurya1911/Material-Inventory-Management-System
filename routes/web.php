<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTransactionController;

Route::get('/', function () {
    return redirect()->route('materials.index');
});

/*
|--------------------------------------------------------------------------
| Category CRUD
|--------------------------------------------------------------------------
*/

Route::resource(
    'categories',
    CategoryController::class
)->except([
    'show',
]);

/*
|--------------------------------------------------------------------------
| Material CRUD
|--------------------------------------------------------------------------
*/

Route::resource(
    'materials',
    MaterialController::class
)->except([
    'show',
]);

/*
|--------------------------------------------------------------------------
| Inward / Outward Transactions
|--------------------------------------------------------------------------
*/

Route::get(
    'transactions/create',
    [MaterialTransactionController::class, 'create']
)->name('transactions.create');

Route::post(
    'transactions',
    [MaterialTransactionController::class, 'store']
)->name('transactions.store');