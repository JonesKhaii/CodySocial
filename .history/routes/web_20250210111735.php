<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController
Route::get('/', function () {
    return view('index');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
