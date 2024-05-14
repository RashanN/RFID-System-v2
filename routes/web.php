<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PlaytimespriceController;
use App\Http\Controllers\ProductCategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/invoice/bill', function () {
//     return view('invoice.bill');
// })->name('invoice.bill');

// Route::get('/invoice/show', function () {
//     return view('invoice.show');
// })->name('invoice.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
Route::get('admin/dashboard1', [HomeController::class, 'index1'])->name('admin.dashboard1');
Route::get('/dashboard', [HomeController::class, 'paneldata'])->name('dashboard');

//Product Routes
Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::delete('/product', [ProductController::class, 'destroy'])->name('product.destroy');

//Customer Routes
Route::resource('customer', CustomerController::class);

//Supplier Route
Route::resource('supplier',SupplierController::class);

//Product Category
Route::resource('product_category',ProductCategoryController::class);

Route::resource('invoice',InvoiceController::class);
Route::get('/invoice', [InvoiceController::class, 'index1'])->name('invoice.index');
Route::resource('playtimeprices', PlaytimespriceController::class);
Route::resource('child', ChildController::class);
Route::get('/invoice/generate/{playedTime}/{customerId}/{inTime}', [InvoiceController::class,'generate'])->name('invoice.generate');
Route::get('get-product-details', [InvoiceController::class, 'getProductDetails'])->name('get-product-details');

Route::resource('child', ChildController::class);
Route::get('/fetch-children', [ChildController::class, 'fetchChildren'])->name('fetch.children');
Route::get('get-time', [InvoiceController::class, 'getTime'])->name('get-time');
Route::post('playTimeOrder', [InvoiceController::class, 'playTimeOrder'])->name('playTimeOrder');
Route::post('invoiceGenerator', [InvoiceController::class, 'invoiceGenerator'])->name('invoiceGenerator');
Route::post('invoiceDraft', [InvoiceController::class, 'invoiceDraft'])->name('invoiceDraft');
Route::get('invoice.show', [InvoiceController::class, 'invoiceShow'])->name('invoice.show');
Route::get('invoice.bill', [InvoiceController::class, 'invoiceBill'])->name('invoice.bill');
Route::get('invoice/preview', [InvoiceController::class, 'invoicePreview'])->name('invoice.preview');
Route::get('get-status', [ChildController::class, 'getStatus'])->name('get-status');

Route::post('/search/customers', [CustomerController::class, 'search'])->name('search.customers');
Route::get('invoice.draft', [InvoiceController::class, 'draft'])->name('invoice.draft');
//Route::get('/get-product-draft-data', [InvoiceController::class, 'getProductDraftData'])->name('getProductDraftData');
Route::get('/fetchProductDraftData', [InvoiceController::class, 'fetchProductDraftData'])->name('getProductDraftData');