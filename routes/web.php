<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('home');
Route::get('/contacts',ContactsController::class)->name('contacts');
