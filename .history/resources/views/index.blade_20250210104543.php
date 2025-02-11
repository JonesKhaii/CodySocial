<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Bài Viết Y Tế - Trang Chủ</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Felipe E. Cassimiro" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/css/mystyle.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link rel="icon" href="{{ asset('Images/logo.png') }}" />
</head>

<body>
    @include('layouts.header')

    <div class="container-fluid mt-4">
        <div class="container">
            <!-- Banner -->
            <div class="row mb-3 text-center" id="bannerRow">
                <div class="col-md-3"><img src="{{ asset('images/banners/banner1.webp') }}" class="small-banner"
                        alt="Khuyến mãi dịch vụ y tế" /></div>
                <div class="col-md-3"><img src="{{ asset('images/banners/banner2.webp') }}" class="small-banner"
                        alt="Tư vấn sức khỏe miễn phí" /></div>
                <div class="col-md-3"><img src="{{ asset('images/banners/banner3.webp') }}" class="small-banner"
                        alt="Lịch khám ưu đãi tháng này" /></div>
                <div class="col-md-3"><img src="{{ asset('images/banners/banner4.webp') }}" class="small-banner"
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
                    <h1>Bài Viết Y Tế Nổi Bật</h1>
                </div>
                <div class="col-6 text-end">
                    <select class="btn btn-light" id="Genero">
                        <option>Tất cả</option>
                        <option>Sức khỏe tổng quát</option>
                        <option>Tim mạch</option>
                        <option>Dinh dưỡng</option>
                        <option>Bệnh lý & Điều trị</option>
                        <option>Sức khỏe tinh thần</option>
                        <option>Chăm sóc người cao tuổi</option>
                        <option>Sức khỏe phụ nữ</option>
                        <option>Sức khỏe nam giới</option>
                    </select>
                </div>
            </div>

            <!-- Danh sách bài viết -->
            <div class="row mt-3" id="Articles"></div>

            <!-- Nút tải thêm bài viết -->
            <div class="mt-3 text-center">
                <button type="button" class="btn btn-dark" id="PlusArticles">+ Tải thêm bài viết</button>
                <button type="button" class="btn btn-secondary" id="CollapseArticles" style="display: none">- Thu gọn
                    bài viết</button>
            </div>

            <!-- Danh mục phổ biến -->
            <div class="container-fluid mt-5">
                <div class="container">
                    <h1 class="mb-4 text-center">Danh Mục Phổ Biến</h1>
                    <div class="row" id="PopularCategories">
                        <div class="col-md-3 category-item">
                            <div
                                class="category-card"
                                data-category="Sức khỏe tổng quát">
                                <img
                                    src="asset/images/categories/health.jpg"
                                    alt="Sức khỏe tổng quát" />
                                <h5>Sức khỏe tổng quát</h5>
                            </div>
                        </div>
                        <div class="col-md-3 category-item">
                            <div
                                class="category-card"
                                data-category="Tim mạch">
                                <img
                                    src="asset/images/categories/heart.jpg"
                                    alt="Tim mạch" />
                                <h5>Tim mạch</h5>
                            </div>
                        </div>
                        <div class="col-md-3 category-item">
                            <div
                                class="category-card"
                                data-category="Dinh dưỡng">
                                <img
                                    src="asset/images/categories/nutrition.jpg"
                                    alt="Dinh dưỡng" />
                                <h5>Dinh dưỡng</h5>
                            </div>
                        </div>
                        <div class="col-md-3 category-item">
                            <div
                                class="category-card"
                                data-category="Sức khỏe tinh thần">
                                <img
                                    src="asset/images/categories/mental.jpg"
                                    alt="Sức khỏe tinh thần" />
                                <h5>Sức khỏe tinh thần</h5>
                            </div>
                        </div>

                        <!-- Danh mục ẩn ban đầu -->
                        <div class="col-md-3 category-item hidden">
                            <div
                                class="category-card"
                                data-category="Bệnh lý & Điều trị">
                                <img
                                    src="asset/images/categories/disease.jpg"
                                    alt="Bệnh lý & Điều trị" />
                                <h5>Bệnh lý & Điều trị</h5>
                            </div>
                        </div>
                        <div class="col-md-3 category-item hidden">
                            <div
                                class="category-card"
                                data-category="Chăm sóc người cao tuổi">
                                <img
                                    src="asset/images/categories/elderly.jpg"
                                    alt="Chăm sóc người cao tuổi" />
                                <h5>Chăm sóc người cao tuổi</h5>
                            </div>
                        </div>
                        <div class="col-md-3 category-item hidden">
                            <div
                                class="category-card"
                                data-category="Sức khỏe phụ nữ">
                                <img
                                    src="asset/images/categories/women.jpg"
                                    alt="Sức khỏe phụ nữ" />
                                <h5>Sức khỏe phụ nữ</h5>
                            </div>
                        </div>
                        <div class="col-md-3 category-item hidden">
                            <div
                                class="category-card"
                                data-category="Sức khỏe nam giới">
                                <img
                                    src="asset/images/categories/men.jpg"
                                    alt="Sức khỏe nam giới" />
                                <h5>Sức khỏe nam giới</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Nút điều khiển -->
                    <div class="mt-3 text-center">
                        <button id="showAllCategories" class="btn btn-dark">
                            Xem toàn bộ
                        </button>
                        <button
                            id="hideCategories"
                            class="btn btn-secondary"
                            style="display: none">
                            Thu gọn
                        </button>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-5">
                <div class="container">
                    <!-- Tiêu đề -->
                    <h1 class="mb-4 text-center">Tác Giả Nổi Bật</h1>

                    <!-- Danh sách tác giả -->
                    <div class="row" id="PopularAuthors">
                        <!-- Tác giả sẽ được tải động vào đây -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="{{ asset('asset/js/main.js') }}"></script>
</body>

</html>
