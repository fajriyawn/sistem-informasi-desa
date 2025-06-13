<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);


Route::get('/layanan', [ServiceController::class, 'create'])->name('service.form');
Route::post('/layanan', [ServiceController::class, 'store'])->name('service.store');