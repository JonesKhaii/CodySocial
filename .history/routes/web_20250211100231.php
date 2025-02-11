<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DoctorController;

Route::get('/', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('pages.about-us');
});
Route::get('/doctors', function () {
    return view('pages.list-doctor');
});
Route::get('/appointment', function () {
    return view('pages.booking-appointment');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{slug}', [PostController::class, 'detail'])->name('post.detail');
Route::get('/doctor/{id}', [DoctorController::class, 'profile'])->name('doctor.profile');
