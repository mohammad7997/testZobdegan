<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TicketController;
use \App\Http\Controllers\Client\HomeController;

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

Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/orderInfo/{ticket}',[HomeController::class,'orderInfo'])->name('orderInfo');


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
