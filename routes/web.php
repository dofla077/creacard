<?php

use App\Enums\QuotationState;
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
    return to_route('dashboard');
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::name('customers.')->prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('create', [CustomerController::class, 'create'])->name('create');
        Route::post('store', [CustomerController::class, 'store'])->name('store');
    });

    Route::resource('quotations', QuotationController::class)->except(['show']);

    Route::name('quotations.')->prefix('quotations')->group(function () {
        Route::post('send/{quotation}', [QuotationController::class, 'send'])->name('send');
    });
});

Route::get('/quotations/customer/choice/{quotation}/{state}', [QuotationController::class, 'customerChoice'])
    ->name('quotations.customer.choice')
    ->setBindingFields(['state' => QuotationState::class])->middleware('quotations.state');

require __DIR__ . '/auth.php';
