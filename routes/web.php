<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StripeWebhookController;







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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


//customer

Route::get('/customer',[CustomerController::class,'index'])->name('customers.customer');
Route::get('/customer/create',[CustomerController::class,'create'])->name('customers.create');
Route::post('/customer',[CustomerController::class,'store'])->name('customers.store');
Route::get('/customer/{customer}/edit',[CustomerController::class,'edit'])->name('customers.edit');
Route::put('/customer/{customer}/update',[CustomerController::class,'update'])->name('customers.update');
//Route::delete('/customer/{customer}/destroy',[CustomerController::class,'destroy'])->name('customers.destroy');

Route::resource('customers', \App\Http\Controllers\CustomerController::class);


//proposal

// Proposal routes
Route::resource('proposals', ProposalController::class);

// Invoices routes
Route::resource('invoices', InvoiceController::class);

Route::post('/invoices/{invoice}/send', [InvoiceController::class, 'sendEmail'])->name('invoices.send');
Route::get('/invoices/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoices.pay');



Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');
Route::get('/invoices/success/{invoice}', [InvoiceController::class, 'paymentSuccess'])->name('invoices.success');
Route::get('/invoices/cancel/{invoice}', [InvoiceController::class, 'paymentCancel'])->name('invoices.cancel');

Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');

// Transaction routes
Route::resource('transactions', \App\Http\Controllers\TransactionController::class);
