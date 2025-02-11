<header class="navbar navbar-expand-lg navbar-light bg-primary shadow-sm">
    <div class="container">
        <div class="logo-container d-flex align-items-center">
            <img src="{{ asset('asset/images/logo.png') }}" alt="Logo" class="logo me-2" style="height: 50px; border-radius: 50px" />
            <a class="navbar-brand fs-2 text-white" href="{{ url('/') }}">CodyHealth</a>
        </div>

        <!-- Nút Toggle cho Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu chính -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/') }}">Trang Chủ</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/about') }}">Về chúng tôi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/doctors') }}">Bác Sĩ</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Hỏi Đáp</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/appointment') }}">Lịch Khám</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/blog') }}">Bài Viết</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/account') }}">Hồ Sơ</a></li>
            </ul>
        </div>
    </div>
</header>
