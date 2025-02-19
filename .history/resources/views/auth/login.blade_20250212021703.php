@extends('layouts.master')

@section('title', 'Đăng Nhập')

@section('main-content')
    <section class="h-100">
        <div class="h-100 container">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 col-sm-10">
                    <div class="my-4 text-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4 text-center">Đăng Nhập</h1>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label class="text-muted mb-2" for="email">Địa chỉ Email</label>
                                    <input id="email" type="email" class="form-control" name="email" required
                                        autofocus>
                                    <div class="invalid-feedback">Email không hợp lệ</div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label class="text-muted" for="password">Mật khẩu</label>
                                        <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">Mật khẩu là bắt buộc</div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Ghi nhớ đăng nhập</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        Đăng Nhập
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer border-0 py-3">
                            <div class="text-center">
                                Chưa có tài khoản? <a href="#" class="text-dark fw-bold">Tạo tài khoản mới</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-muted mt-5 text-center">
                        Copyright &copy; 2024 &mdash; CodyHealth
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
