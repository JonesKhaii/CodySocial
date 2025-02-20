@extends('layouts.master')

@section('title', 'Trang Chủ')

@section('main-content')
    <div class="container-fluid mt-4">
        <div class="container">
            <!-- Banner -->
            <div class="row mb-3 text-center" id="bannerRow">
                <div class="col-md-3"><img src="{{ asset('asset/images/banners/banner1.webp') }}" class="small-banner"
                        alt="Khuyến mãi dịch vụ y tế" /></div>
                <div class="col-md-3"><img src="{{ asset('asset/images/banners/banner2.webp') }}" class="small-banner"
                        alt="Tư vấn sức khỏe miễn phí" /></div>
                <div class="col-md-3"><img src="{{ asset('asset/images/banners/banner3.webp') }}" class="small-banner"
                        alt="Lịch khám ưu đãi tháng này" /></div>
                <div class="col-md-3"><img src="{{ asset('asset/images/banners/banner4.webp') }}" class="small-banner"
                        alt="Tầm soát bệnh lý sớm" /></div>
            </div>

            <!-- Thanh tìm kiếm -->
            <form class="nosubmit">
                <div class="row">
                    <input
                        class="nosubmit form-control"
                        type="text"
                        id="Pesquisar"
                        placeholder="Tìm kiếm bài viết..."
                        autocomplete="off" />
                </div>
            </form>

            <!-- Tiêu đề và bộ lọc -->
            <div class="row mt-3">
                <div class="col-6">
                    <h1>Thông Tin Y Tế Nổi Bật</h1>
                </div>
                <div class="col-6 text-end">
                    <select class="btn btn-light" id="Genero">
                        <option value="">Tất cả</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Danh sách bài viết -->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>Bài Viết Y Tế Nổi Bật</h2>
                    </div>
                </div>

                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" src="{{ asset($post->photo) }}" alt="{{ $post->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="text-muted">
                                        <small>
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $post->created_at->format('d M Y') }}
                                            |
                                            <i class="fas fa-user"></i> {{ $post->author_info->name ?? 'N/A' }} |
                                            <i class="fas fa-folder"></i>
                                            {{ $post->cat_info->title ?? 'Chưa phân loại' }}
                                        </small>
                                    </p>
                                    <p class="card-text">
                                        {{ Str::limit(strip_tags($post->summary), 120) }}
                                    </p>
                                    <div class="text-end">
                                        <a href="{{ route('post.detail', ['slug' => $post->slug]) }}"
                                            class="btn btn-primary read-more">
                                            Đọc tiếp <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Nút tải thêm bài viết -->
            {{-- <div class="mt-3 text-center">
                <button type="button" class="btn btn-dark" id="PlusArticles">+ Tải thêm bài viết</button>
                <button type="button" class="btn btn-secondary" id="CollapseArticles" style="display: none">- Thu gọn
                    bài viết</button>
            </div> --}}

            <!-- Danh mục phổ biến -->
            <div class="container-fluid mt-5">
                <div class="container">
                    <h1 class="mb-4 text-center">Danh Mục Phổ Biến</h1>
                    <div class="row" id="PopularCategories">
                        @foreach ($popularCategories as $category)
                            <div class="col-md-3 category-item mt-3">
                                <div class="category-card" data-category="{{ $category->title }}">
                                    <img src="{{ asset($category->photo) }}" alt="{{ $category->title }}" />
                                    <h5>{{ $category->title }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <h2 class="section-title mt-5 text-center">Bác Sĩ Nổi Bật</h2>
                <div class="row mt-4">
                    @foreach ($topDoctors as $doctor)
                        <div class="col-md-3 mb-4">
                            <a href="{{ route('doctor.detail', $doctor->id) }}" class="text-decoration-none">
                                <div class="doctor-card p-4 text-center">
                                    <img src="{{ asset($doctor->photo) }}" class="doctor-photo mb-3"
                                        alt="{{ $doctor->name }}">
                                    <h5 class="mb-2">{{ $doctor->name }}</h5>
                                    <p class="text-muted mb-0">{{ $doctor->field }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('asset/js/main.js') }}"></script>
@endsection

<style>
    .doctor-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    .doctor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .doctor-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #f8f9fa;
        margin: 0 auto;
    }

    .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 2rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 50px;
        height: 3px;
        background: #0984e3;
    }
</style>
