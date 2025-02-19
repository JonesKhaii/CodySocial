@extends('layouts.master')

@section('title', 'Đăng Nhập')

@section('main-content')

    <head>
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>

    <div class="container-login">
        <h2>Đăng Nhập</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form đăng nhập -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="phone">Số điện thoại:</label>
                <input id="phone" type="text" name="phone" class="form-control" required autofocus>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu:</label>
                <input id="password" type="password" name="password" class="form-control" required>
            </div>

            <div class="remember-forgot">
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Ghi nhớ đăng nhập</label>
                </div>
                <a href="#">Quên mật khẩu?</a>
            </div>

            <!-- Chọn vai trò đăng nhập -->
            <div class="form-check">
                <input type="radio" name="role" id="role_user" value="user" class="form-check-input" checked>
                <label for="role_user" class="form-check-label">Đăng Nhập Người Dùng</label>
            </div>
            <div class="form-check">
                <input type="radio" name="role" id="role_doctor" value="doctor" class="form-check-input">
                <label for="role_doctor" class="form-check-label">Đăng Nhập Bác Sĩ</label>
            </div>

            <!-- Nút đăng nhập -->
            <button type="submit" class="btn-login">Đăng Nhập</button>
        </form>

        <div class="footer-text">
            Chưa có tài khoản? <a href="#">Đăng ký ngay</a>
        </div>
    </div>

@endsection
