@extends('layouts.master')

@section('title', 'Đăng Nhập')

@push('style')
    <style>
        /* Định dạng cho checkbox và radio buttons */
        .form-check-input {
            width: 20px !important;
            height: 20px !important;
            border: 2px solid #007bff !important;
            border-radius: 50% !important;
            transition: all 0.3s ease !important;
        }

        /* Thêm màu nền khi người dùng chọn */
        .form-check-input:checked {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        /* Thay đổi màu viền và làm nổi bật checkbox khi hover */
        .form-check-input:hover {
            border-color: #0056b3 !important;
            cursor: pointer !important;
        }

        /* Định dạng label của checkbox và radio buttons */
        .form-check-label {
            font-size: 16px !important;
            color: #333 !important;
            margin-left: 10px !important;
        }

        /* Thêm hiệu ứng cho radio buttons */
        .form-check-input:checked[type="radio"] {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
    </style>
@endpush

@section('main-content')

    <div class="container-login">
        <h2>Đăng Nhập</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

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
            <div class="form-check">
                <input type="radio" name="role" id="role_user" value="user" class="form-check-input" checked>
                <label for="role_user" class="form-check-label">Đăng Nhập Người Dùng</label>
            </div>
            <div class="form-check">
                <input type="radio" name="role" id="role_doctor" value="doctor" class="form-check-input">
                <label for="role_doctor" class="form-check-label">Đăng Nhập Bác Sĩ</label>
            </div>

            <button type="submit" class="btn-login">Đăng Nhập</button>
        </form>

        <div class="footer-text">
            Chưa có tài khoản? <a href="#">Đăng ký ngay</a>
        </div>
    </div>

@endsection
