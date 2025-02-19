<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Auth\AuthController;


// AUTH--------------------------------------------------------------------------------
// Trang đăng nhập & xử lý đăng nhập
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);

// Trang đăng ký & xử lý đăng ký
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister']);

// Đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');






// Route::get('/', function () {
//     return view('index');
// });
Route::get('/about', function () {
    return view('pages.about-us');
});
Route::get('/doctors', function () {
    return view('pages.list-doctor');
});
Route::get('/appointment', function () {
    return view('pages.booking-appointment');
});
// Route::get('/appointment', function () {
//     return view('pages.booking-appointment');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{slug}', [PostController::class, 'detail'])->name('post.detail');
Route::get('/doctor/{id}', [DoctorController::class, 'profile'])->name('doctor.profile');
