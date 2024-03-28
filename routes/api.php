<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Callback from Midtrans for update payment status
Route::post('orders/callback', [OrderController::class, 'callback'])->name('callback');
