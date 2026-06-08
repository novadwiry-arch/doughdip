<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
});

Route::get(
    '/admin/export-pdf',
    [OrderController::class, 'exportPdf']
);

Route::post('/pesan', [OrderController::class, 'store']);
Route::get('/admin/orders', [OrderController::class, 'orders']);
Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy']);
Route::get('/admin/orders/{id}/edit', [OrderController::class, 'edit']);
Route::put('/admin/orders/{id}', [OrderController::class, 'update']);
Route::get('/admin/login', [AdminController::class, 'loginForm']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/logout', [AdminController::class, 'logout']);
Route::post('/admin/orders/status/{id}', [OrderController::class, 'updateStatus']);
Route::post('/checkout-cart', [OrderController::class, 'checkoutCart']);
Route::get(
    '/admin/invoice/{invoice}',
    [OrderController::class, 'invoiceDetail']
);

Route::post(
    '/admin/invoice/status/{invoice}',
    [OrderController::class, 'updateInvoiceStatus']
);

Route::delete(
    '/admin/invoice/{invoice}',
    [OrderController::class, 'deleteInvoice']
);

Route::get(
    '/admin/invoice/{invoice_id}/edit',
    [OrderController::class, 'editInvoice']
);

Route::put(
    '/admin/invoice/{invoice_id}',
    [OrderController::class, 'updateInvoice']
);