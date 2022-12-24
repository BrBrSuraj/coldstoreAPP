<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SaleController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurcheseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SalePaymentController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\PurcheseReportController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\PurchesePaymentController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'verified'], function () {
    // dashboard route
        Route::get('dashboard',DashboardController::class)->name('dashboard');
    });

    // user controller route
    Route::group(['middleware'=>'admin' ,'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
        Route::get('users/{user_id}/supplierPurcheses/{supplier_id}',[UserController::class,'supplierPurchese'])->name('users/supplierPurcheses');
        Route::get('users/{user_id}/supplierPurchesesPayments/{purchese_id}', [UserController::class, 'purchesePayment'])->name('users/supplierPurchesesPayments');

        Route::get('users/{user_id}/customerSale/{customer_id}', [UserController::class, 'customerSale'])->name('users/customerSale');
        Route::get('users/{user_id}/customerSalePayment/{sale_id}', [UserController::class, 'salePayment'])->name('users/customerSalePayment');
        Route::resource('users', UserController::class);
    });

    
    // profile Route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    
// purcheses and payment process
    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth'], function () {
        Route::get('customers/billprint/{customer_id}',[SupplierController::class,'printBilll'])->name('customers/billprint');
        // supplier
        Route::resource('suppliers', SupplierController::class);
        Route::resource('suppliers.purcheses', PurcheseController::class);
        Route::resource('suppliers.payments', PaymentController::class);
        Route::resource('suppliers.purcheses.payments', PurchesePaymentController::class);

        // customer 
        Route::resource('customers', CustomerController::class);
        Route::resource('customers.sales', SaleController::class);
        Route::resource('customers.sale_payments', CustomerPaymentController::class);
         Route::resource('customers.sales.sale_payments', SalePaymentController::class);
        Route::resource('locals', LocalController::class);
    });


    Route::group(['prefix'=>'system','as'=>'system.'],function(){
      

        Route::resource('purcheseReports',PurcheseReportController::class);
        Route::resource('salesReports', SalesReportController::class);
    });
});

require __DIR__ . '/auth.php';









