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
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Trang Chủ</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('about') }}">Về chúng tôi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Bác Sĩ</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Hỏi Đáp</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/appointment') }}">Lịch Khám</a></li>

                {{-- Kiểm tra vai trò từ session để hiển thị đúng menu --}}
                @if (session('role') === 'doctor')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('doctor.profile') }}">
                            Trang Tổng Quan Bác Sĩ
                        </a>
                    </li>
                @elseif (session('role') === 'user')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('user.profile') }}">
                            Hồ Sơ Người Dùng
                        </a>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Đăng Nhập</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Đăng Ký</a></li>
                @endif

                {{-- Đăng xuất --}}
                @auth
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('logout') }}">Đăng Xuất</a></li>
                @endauth
            </ul>
        </div>
    </div>

    <!-- Debugging -->
    <script>
        console.log("Session role: {{ session('role') }}");
        console.log("Auth guard web: {{ Auth::guard('web')->check() ? 'Đang đăng nhập' : 'Chưa đăng nhập' }}");
        console.log("Auth guard doctor: {{ Auth::guard('doctor')->check() ? 'Đang đăng nhập' : 'Chưa đăng nhập' }}");
    </script>
</header>
