@extends('layouts.master')

@section('title', 'Trang Chủ')

@push('styles')
    <style>
        /* Banner styles */
        .small-banner {
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .small-banner:hover {
            transform: translateY(-5px);
        }

        /* Search styles */
        .search-container {
            position: relative;
            margin: 30px 0;
        }

        .search-input {
            width: 100%;
            padding: 15px 20px 15px 45px;
            border-radius: 30px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .search-input:focus {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #007bff;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        /* Category styles */
        .category-card {
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            height: 200px;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 20px 15px;
        }

        .category-card h5 {
            color: #fff;
            margin: 0;
            font-weight: 600;
        }

        /* Post card styles */
        .post-card {
            height: 100%;
            transition: transform 0.3s;
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .post-card:hover {
            transform: translateY(-5px);
        }

        .post-img-container {
            height: 200px;
            overflow: hidden;
        }

        .post-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .post-card:hover .post-img {
            transform: scale(1.05);
        }

        .post-category {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 1;
        }

        .post-meta {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .post-title {
            font-weight: 600;
            margin: 10px 0;
            height: 48px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .post-summary {
            color: #6c757d;
            font-size: 0.9rem;
            height: 72px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .read-more {
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.375rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .read-more:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        /* Doctor card styles */
        .doctor-card {
            transition: transform 0.3s;
            border: none;
            border-radius: 10px;
        }

        .doctor-card:hover {
            transform: translateY(-5px);
        }

        .doctor-avatar {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .doctor-name {
            font-weight: 600;
            margin: 15px 0 5px;
        }

        .doctor-field {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Section styles */
        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background-color: #007bff;
            bottom: 0;
            left: 25%;
            border-radius: 2px;
        }

        .btn-load-more {
            padding: 8px 25px;
            font-weight: 500;
            border-radius: 30px;
            transition: all 0.3s;
        }

        .btn-load-more:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Pagination styles */
        .pagination {
            margin-top: 2rem;
        }

        .page-link {
            color: #007bff;
            border-radius: 50%;
            margin: 0 3px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
@endpush

@section('main-content')
    <!-- Banner Section -->
    <div class="container mt-4">
        <div class="row g-3" id="bannerRow">
            <div class="col-md-3 col-6">
                <a href="#" class="d-block">
                    <img src="{{ asset('asset/images/banners/banner1.webp') }}" class="small-banner"
                        alt="Khuyến mãi dịch vụ y tế" />
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#" class="d-block">
                    <img src="{{ asset('asset/images/banners/banner2.webp') }}" class="small-banner"
                        alt="Tư vấn sức khỏe miễn phí" />
                </a>
            </div>
            <div class="col-md-3 col-6 mt-md-0 mt-3">
                <a href="#" class="d-block">
                    <img src="{{ asset('asset/images/banners/banner3.webp') }}" class="small-banner"
                        alt="Lịch khám ưu đãi tháng này" />
                </a>
            </div>
            <div class="col-md-3 col-6 mt-md-0 mt-3">
                <a href="#" class="d-block">
                    <img src="{{ asset('asset/images/banners/banner4.webp') }}" class="small-banner"
                        alt="Tầm soát bệnh lý sớm" />
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <form action="" method="GET">
                <div class="position-relative">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" class="form-control search-input"
                        placeholder="Tìm kiếm bài viết, tin tức y tế..." autocomplete="off">
                </div>
            </form>
        </div>

        <!-- Filter and Categories -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="section-title h3 mb-md-0 mb-3">Thông Tin Y Tế Nổi Bật</h2>
            <div class="category-filter">
                <select class="form-select" id="categoryFilter" aria-label="Lọc theo danh mục">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Featured Posts -->
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card post-card h-100 shadow-sm">
                        <div class="position-relative">
                            <span class="badge bg-primary post-category">
                                {{ $post->cat_info->title ?? 'Chưa phân loại' }}
                            </span>
                            <div class="post-img-container">
                                <a href="{{ route('post.detail', ['slug' => $post->slug]) }}">
                                    <img src="{{ asset($post->photo) }}" class="post-img" alt="{{ $post->title }}">
                                </a>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="post-title">
                                <a href="{{ route('post.detail', ['slug' => $post->slug]) }}"
                                    class="text-decoration-none text-dark">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <div class="post-meta mb-2">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $post->created_at->format('d M Y') }}
                                <span class="mx-1">|</span>
                                <i class="fas fa-user me-1"></i>
                                {{ $post->author_info->name ?? 'N/A' }}
                            </div>
                            <p class="post-summary mb-3">
                                {{ Str::limit(strip_tags($post->summary), 120) }}
                            </p>
                            <div class="mt-auto text-end">
                                <a href="{{ route('post.detail', ['slug' => $post->slug]) }}"
                                    class="btn btn-primary read-more">
                                    Đọc tiếp <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>

        <!-- Load More Button -->
        <div class="mb-5 text-center">
            <button type="button" class="btn btn-dark btn-load-more" id="PlusArticles">
                <i class="fas fa-plus-circle me-2"></i>Tải thêm bài viết
            </button>
            <button type="button" class="btn btn-secondary btn-load-more" id="CollapseArticles" style="display: none">
                <i class="fas fa-minus-circle me-2"></i>Thu gọn bài viết
            </button>
        </div>

        <!-- Popular Categories -->
        <div class="mb-5">
            <h2 class="section-title text-center">Danh Mục Phổ Biến</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4" id="PopularCategories">
                @foreach ($popularCategories as $category)
                    <div class="col">
                        <a href="{{ route('category.posts', $category->slug) }}" class="text-decoration-none">
                            <div class="category-card">
                                <img src="{{ asset($category->photo) }}" alt="{{ $category->title }}">
                                <div class="category-overlay">
                                    <h5>{{ $category->title }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Featured Doctors -->
        <div class="mb-5">
            <h2 class="section-title text-center">Bác Sĩ Nổi Bật</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach ($topDoctors as $doctor)
                    <div class="col">
                        <a href="{{ route('doctor.profile', ['id' => $doctor->id]) }}" class="text-decoration-none">
                            <div class="card doctor-card h-100 p-3 text-center shadow-sm">
                                <div class="mx-auto">
                                    <img src="{{ asset($doctor->photo) }}" alt="{{ $doctor->name }}"
                                        class="rounded-circle doctor-avatar">
                                </div>
                                <h5 class="doctor-name">{{ $doctor->name }}</h5>
                                <p class="doctor-field mb-0">{{ $doctor->field }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Animate on scroll initialization
            AOS.init({
                duration: 800,
                easing: 'ease-in-out'
            });

            // Handle category filter changes
            $('#categoryFilter').on('change', function() {
                var category = $(this).val();
                if (category) {
                    window.location.href = '/category/' + category;
                } else {
                    window.location.href = '/';
                }
            });

            // Load more articles functionality
            $('#PlusArticles').on('click', function() {
                // Add your load more logic here
                $(this).hide();
                $('#CollapseArticles').show();
            });

            $('#CollapseArticles').on('click', function() {
                // Add your collapse logic here
                $(this).hide();
                $('#PlusArticles').show();
            });
        });
    </script>
@endpush
