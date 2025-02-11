<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DoctorController;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{slug}', [PostController::class, 'detail'])->name('post.detail');
Route::get('/doctor/{id}', [DoctorController::class, 'profile'])->name('doctor.profile');
