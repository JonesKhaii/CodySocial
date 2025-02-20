@extends('layouts.master')

@section('title', 'Trang Chủ')

@section('main-content')
    <style>
        .banner-section {
            margin-bottom: 2rem;
        }

        .small-banner {
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .small-banner:hover {
            transform: scale(1.03);
        }

        .search-container {
            position: relative;
            margin: 2rem 0;
        }

        .search-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: #0984e3;
            box-shadow: 0 0 0 0.2rem rgba(9, 132, 227, 0.1);
            outline: none;
        }

        .category-filter {
            background: white;
            border: 2px solid #e9ecef;
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-filter:hover {
            border-color: #0984e3;
        }

        .post-card {
            border: none;
            /* border-radius: 15px; */
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .post-card img {
            height: 200px;
            object-fit: cover;
        }

        .post-meta {
            color: #636e72;
            font-size: 0.9rem;
        }

        .post-meta i {
            color: #0984e3;
            margin-right: 5px;
        }

        .read-more {
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .category-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .category-card h5 {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            margin: 0;
            padding: 15px;
            font-size: 1rem;
        }

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

    <div class="container-fluid py-5">
        <div class="container">
            <!-- Banner Section -->
            <div class="row banner-section">
                @foreach (['banner1.webp', 'banner2.webp', 'banner3.webp', 'banner4.webp'] as $banner)
                    <div class="col-md-3 mb-3">
                        <img src="{{ asset('asset/images/banners/' . $banner) }}" class="small-banner" alt="Banner">
                    </div>
                @endforeach
            </div>

            <!-- Search Section -->
            <div class="search-container">
                <input type="text" class="search-input" id="searchPosts" placeholder="Tìm kiếm bài viết...">
            </div>

            <!-- Filter Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title mb-0">Thông Tin Y Tế Nổi Bật</h2>
                <select class="category-filter" id="categoryFilter">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Posts Grid -->
            <div class="row" id="postsContainer">
                @foreach ($posts as $post)
                    <div class="col-md-4 post-item mb-4" data-category="{{ $post->cat_info->slug ?? '' }}">
                        <div class="post-card shadow-sm">
                            <img src="{{ asset($post->photo) }}" class="card-img-top" alt="{{ $post->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="post-meta">
                                    <i class="fas fa-calendar-alt"></i> {{ $post->created_at->format('d M Y') }}
                                    <i class="fas fa-user ml-2"></i> {{ $post->author_info->name ?? 'N/A' }}
                                    <i class="fas fa-folder ml-2"></i> {{ $post->cat_info->title ?? 'Chưa phân loại' }}
                                </p>
                                <p class="card-text">{{ Str::limit(strip_tags($post->summary), 120) }}</p>
                                <div class="text-end">
                                    <a href="{{ route('post.detail', $post->slug) }}" class="btn btn-primary read-more">
                                        Đọc tiếp <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>

            <!-- Popular Categories -->
            <h2 class="section-title mt-5 text-center">Danh Mục Phổ Biến</h2>
            <div class="row mt-4">
                @foreach ($popularCategories as $category)
                    <div class="col-md-3 mb-4">
                        <div class="category-card shadow-sm">
                            <img src="{{ asset($category->photo) }}" alt="{{ $category->title }}">
                            <h5>{{ $category->title }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Featured Doctors -->
            <h2 class="section-title mt-5 text-center">Bác Sĩ Nổi Bật</h2>
            <div class="row mt-4">
                @foreach ($topDoctors as $doctor)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('doctor.profile', $doctor->id) }}" class="text-decoration-none">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter = document.getElementById('categoryFilter');
            const searchInput = document.getElementById('searchPosts');
            const posts = document.querySelectorAll('.post-item');

            // Hàm lọc bài viết
            function filterPosts() {
                const selectedCategory = categoryFilter.value;
                const searchTerm = searchInput.value.toLowerCase();

                posts.forEach(post => {
                    const postCategory = post.getAttribute('data-category');
                    const postContent = post.textContent.toLowerCase();

                    // Hiển thị tất cả bài viết nếu không chọn category
                    const matchesCategory = selectedCategory === '' || postCategory === selectedCategory;

                    // Tìm kiếm trong nội dung bài viết
                    const matchesSearch = searchTerm === '' || postContent.includes(searchTerm);

                    // Hiển thị/ẩn bài viết dựa trên điều kiện lọc
                    if (matchesCategory && matchesSearch) {
                        post.style.display = '';
                    } else {
                        post.style.display = 'none';
                    }
                });
            }

            // Thêm event listeners
            categoryFilter.addEventListener('change', filterPosts);
            searchInput.addEventListener('input', filterPosts);

            // Log để debug
            categoryFilter.addEventListener('change', function() {
                console.log('Selected category:', this.value);
            });
        });
    </script>
@endsection
