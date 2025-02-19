<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TestController;

// AUTH--------------------------------------------------------------------------------
// Trang đăng nhập & xử lý đăng nhập
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login/doctor', [AuthController::class, 'loginAsDoctor'])->name('login.doctor');
Route::post('/login', [AuthController::class, 'processLogin']);

// Trang đăng ký & xử lý đăng ký
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister']);

// Đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Xử lý ảnh
Route::post('/upload-image', [ImageController::class, 'uploadImage'])->name('upload.image');


// Test
Route::post('/upload-image-test', [TestController::class, 'upload'])->name('upload-image-test');


// Route::get('/', function () {
//     return view('index');
// });
Route::get('/about', function () {
    return view('pages.about-us');
})->name('about');

Route::get('/doctors', function () {
    return view('pages.list-doctor');
})->name('doctors');
Route::get('/appointment', function () {
    return view('pages.booking-appointment');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{slug}', [PostController::class, 'detail'])->name('post.detail');


// Doctor
Route::get('/doctor/{id}', [DoctorController::class, 'profile'])->name('doctor.profile');
Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');
Route::get('/doctor/profile', [DoctorController::class, 'profile'])->name('doctor.profile');
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/doctor/{doctor_id}/products', [DoctorController::class, 'getAffilateProduct'])->name('doctor.products');



// Post detail---------------
Route::get('/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::post('/post/{slug}/comment', [CommentController::class, 'store'])->name('post-comment.store');


// Appointment
