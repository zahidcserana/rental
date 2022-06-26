<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\InvoiceController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HouseController;

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
//
//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/reset', [DashboardController::class, 'reset'])->name('reset');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//    Route::get('/', function () {
//        return Inertia::render('Dashboard');
//    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', UserController::class);
    Route::get('user-list', [UserController::class, 'userList'])->name('users.list');
    Route::get('house-list', [HouseController::class, 'houseList'])->name('house.list');
    Route::get('customer-list', [CustomerController::class, 'dropdownList'])->name('customer.list');

    Route::resource('house', HouseController::class);
    Route::resource('flat', FlatController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('role', RoleController::class);
    Route::resource('invoice', InvoiceController::class);
//    Route::get('invoice/{direct_url}', [InvoiceController::class, 'view'])->name('invoice.direct_url');

    Route::get('customer/flat/{customer}', [CustomerController::class, 'customerFlat'])->name('customer.flat');
    Route::get('/search/customer', [SearchController::class, 'searchCustomer'])->name('search.customer');

    Route::get('change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');
});
