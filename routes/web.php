<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TicketController;
use \App\Http\Controllers\Client\HomeController;
use \App\Http\Controllers\Client\OrderController;
use \App\Http\Controllers\Client\panelController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::prefix('order/')->name('Order.')->group(function () {
    Route::get('/info/{ticket}', [OrderController::class, 'create'])->name('create');
    Route::post('/store/{ticket}', [OrderController::class, 'store'])->name('store');
    Route::get('verify', [OrderController::class, 'verify'])->name('verify');
    Route::get('factor/{order}', [OrderController::class, 'factor'])->name('factor');
});

Route::prefix('panel/')->name('Panel.')->group(function () {
    Route::get('/index', [panelController::class, 'index'])->name('index');
    Route::get('/pay/{installmentPay} ', [panelController::class, 'payInstallment'])->name('installmentPay');
    Route::get('/verifyPay ', [panelController::class, 'verifyPay'])->name('verifyPay');
});

Route::prefix('admin/')->name('Admin.')->group(function () {

    // route of own and group ticket
    Route::get('/', [TicketController::class, 'index'])->name('index');

    Route::get('create', [TicketController::class, 'create'])->name('create');
    Route::post('store', [TicketController::class, 'store'])->name('store');

    Route::get('edit/{ticket}', [TicketController::class, 'edit'])->name('edit');
    Route::post('update/{ticket}', [TicketController::class, 'update'])->name('update');

    Route::delete('delete/{ticket}', [TicketController::class, 'destroy'])->name('delete');

    //route of child ticket for group ticket
    Route::get('/childTicket/{ticket}', [TicketController::class, 'childTicket'])->name('childTicket');
    Route::get('childTicket/create/{ticket}', [TicketController::class, 'createChildTicket'])->name('createChildTicket');
    Route::get('childTicket/edit/{ticket}', [TicketController::class, 'editChildTicket'])->name('editChildTicket');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
