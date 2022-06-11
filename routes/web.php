<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QuotationController;
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

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('store', [CustomerController::class, 'store'])->name('customers.store');
    });

    Route::resource('quotations', QuotationController::class)->except(['show']);
    Route::post('/quotations/send/{quotation}', [QuotationController::class, 'send'])->name('quotations.send');
    Route::get('/quotations/return/{quotation}/{state}', [QuotationController::class, 'return'])->name('quotations.return');

});

require __DIR__ . '/auth.php';
