<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomingProductController;
use App\Http\Controllers\ItemRequestsController;
use App\Http\Controllers\OutgoingProductController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\PurchaseTransactionsController;
use App\Http\Controllers\SalesTransactionsController;
use App\Http\Controllers\ScheduleProductController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Customers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function () {
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'authenticate']);

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

// Auth::routes();

// Route::get('/', [LoginController::class, 'index']);
// Route::post('/', [LoginController::class, 'login']);
// Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout']);

    // Route::middleware(['role:admin', 'role:manager'])->group(function () {
        Route::get('/customer', [CustomersController::class, 'index'])->name('customers.index');
        Route::post('/customer', [CustomersController::class, 'store'])->name('customers.store');

        Route::delete('/customers/{customer}', [CustomersController::class, 'destroy'])->name('customers.destroy');

        Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('customers.update');

        Route::get('/product', [ItemsController::class, 'index'])->name('items.index');

        Route::post('/product', [ItemsController::class, 'store'])->name('items.store');

        Route::put('/products/{id}', [ItemsController::class, 'update'])->name('items.update');

        Route::delete('/products/{id}', [ItemsController::class, 'destroy'])->name('items.destroy');

        Route::get('/purchase-transaction', [PurchaseTransactionsController::class, 'index']);
        Route::post('/purchase-transaction', [PurchaseTransactionsController::class, 'store'])->name('purchase.store');
        Route::put('/purchase-transaction/{id}', [PurchaseTransactionsController::class, 'update'])->name('purchase.update');
        Route::delete('/purchase-transaction/{id}', [PurchaseTransactionsController::class, 'destroy'])->name('purchase.destroy');

        Route::get('/sales-transaction', [SalesTransactionsController::class, 'index']);
        Route::post('/sales-transaction', [SalesTransactionsController::class, 'store'])->name('sales.store');
        Route::put('/sales-transaction/{id}', [SalesTransactionsController::class, 'update'])->name('sales.update');
        Route::delete('/sales-transaction/{id}', [SalesTransactionsController::class, 'destroy'])->name('sales.destroy');

        Route::get('/supplier', [SuppliersController::class, 'index'])->name('suppliers.index');

        Route::post('/supplier', [SuppliersController::class, 'store'])->name('suppliers.store');

        Route::delete('/suppliers/{supplier}', [SuppliersController::class, 'destroy'])->name('suppliers.destroy');

        Route::put('/suppliers/{id}', [SuppliersController::class, 'update'])->name('suppliers.update');

        Route::get("/incoming", [IncomingProductController::class, 'index'])->name('incoming.index');
        Route::post("/incoming/insert", [IncomingProductController::class, 'store'])->name('incoming.store');
        Route::put('/incoming/{id}/update', [IncomingProductController::class, 'update'])->name('incoming.update');
        Route::delete('/incoming/{id}/delete', [IncomingProductController::class, 'destroy'])->name('incoming.destroy');

        Route::get("/outgoing", [OutgoingProductController::class, 'index'])->name('outgoing.index');
        Route::post("/outgoing/insert", [OutgoingProductController::class, 'store'])->name('outgoing.store');
        Route::put('/outgoing/{id}/update', [OutgoingProductController::class, 'update'])->name('outgoing.update');
        Route::delete('/outgoing/{id}/delete', [OutgoingProductController::class, 'destroy'])->name('outgoing.destroy');

        Route::get("/outgoing", [OutgoingProductController::class, 'index'])->name('outgoing.index');
        Route::delete('/outgoing/{incomming}', [OutgoingProductController::class, 'destroy'])->name('outgoing.destroy');

        Route::get('/product-request', [ItemRequestsController::class, 'index']);
        Route::post('/product-request', [ItemRequestsController::class, 'store'])->name('requests.store');
        Route::put('/product-request/{id}', [ItemRequestsController::class, 'update'])->name('requests.update');
        Route::delete('/product-request/{id}', [ItemRequestsController::class, 'destroy'])->name('requests.destroy');
        Route::post('/product-request/accept/{id}', [ItemRequestsController::class, 'accept'])->name('requests.accept');
    // });

    // Route::middleware('role:staff')->group(function () {
    //     Route::get('/customer', [CustomersController::class, 'index'])->name('customers.index');
    //     Route::post('/customer', [CustomersController::class, 'store'])->name('customers.store');

    //     Route::delete('/customers/{customer}', [CustomersController::class, 'destroy'])->name('customers.destroy');

    //     Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('customers.update');

    //     Route::get('/product', [ItemsController::class, 'index'])->name('items.index');

    //     Route::post('/product', [ItemsController::class, 'store'])->name('items.store');

    //     Route::put('/products/{id}', [ItemsController::class, 'update'])->name('items.update');

    //     Route::delete('/products/{id}', [ItemsController::class, 'destroy'])->name('items.destroy');
    //     Route::get('/supplier', [SuppliersController::class, 'index'])->name('suppliers.index');

    //     Route::post('/supplier', [SuppliersController::class, 'store'])->name('suppliers.store');

    //     Route::delete('/suppliers/{supplier}', [SuppliersController::class, 'destroy'])->name('suppliers.destroy');

    //     Route::put('/suppliers/{id}', [SuppliersController::class, 'update'])->name('suppliers.update');
    // });

    // Route::middleware('role:user')->group(function () {
    //     Route::get('/product-request', [ItemRequestsController::class, 'index']);
    //     Route::post('/product-request', [ItemRequestsController::class, 'store'])->name('requests.store');
    //     Route::put('/product-request/{id}', [ItemRequestsController::class, 'update'])->name('requests.update');
    //     Route::delete('/product-request/{id}', [ItemRequestsController::class, 'destroy'])->name('requests.destroy');
    //     Route::post('/product-request/accept/{id}', [ItemRequestsController::class, 'accept'])->name('requests.accept');
    // });

    // Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    // });

    Route::resource('users', UserController::class);
});
