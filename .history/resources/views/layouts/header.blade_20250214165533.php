<header class="navbar navbar-expand-lg navbar-light bg-primary shadow-sm">
    <div class="container">
        <div class="logo-container d-flex align-items-center">
            <img src="{{ asset('asset/images/logo.png') }}" alt="Logo" class="logo me-2"
                style="height: 50px; border-radius: 50px" />
            <a class="navbar-brand fs-2 text-white" href="{{ url('/') }}">CodyHealth</a>
        </div>

        <!-- Nút Toggle cho Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu chính -->
        <div class="navbar-collapse collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/') }}">Trang Chủ</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/about') }}">Về chúng tôi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/doctors') }}">Bác Sĩ</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Hỏi Đáp</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/appointment') }}">Lịch Khám</a></li>

                {{-- Kiểm tra vai trò và thay đổi đường dẫn cho trang profile --}}
                @auth
                    @if (Auth::guard('doctor')->check())
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('doctor.profile') }}">
                                Trang Tổng Quan Bác Sĩ
                            </a>
                        </li>
                    @elseif (Auth::guard('web')->check())
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('user.profile') }}">
                                Hồ Sơ Người Dùng
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">Đăng Nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">Đăng Ký</a>
                        </li>
                    @endif

                    {{-- Đăng xuất --}}
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('logout') }}">Đăng Xuất</a></li>
                @else
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Đăng Nhập</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Đăng Ký</a></li>
                @endauth
            </ul>
        </div>
    </div>
    <script>
        @if (session('role'))
            console.log("Role from session: {{ session('role') }}");
        @endif

        @if (Auth::guard('doctor')->check())
            console.log("Doctor logged in");
        @endif
    </script>
</header>
