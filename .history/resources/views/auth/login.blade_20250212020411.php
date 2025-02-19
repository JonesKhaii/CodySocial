@extends('layouts.master')

@section('title', 'Đăng Nhập')

@section('main-content')
    <div class="login-container">
        <div class="login-card">
            <h4>Đăng Nhập</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                </div>
            </form>
            <div class="login-footer">
                <a href="#">Quên mật khẩu?</a> |
                <a href="#">Đăng ký tài khoản mới</a>
            </div>
        </div>
    </div>
@endsection
