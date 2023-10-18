<?php

use App\Http\Controllers\Backend\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('vendor/dashboard', [VendorController::class, 'dashboard'])
    ->name('vendor.dashboard');
