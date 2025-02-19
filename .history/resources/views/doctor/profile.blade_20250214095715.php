@extends('layouts.master')

@section('title', 'Dashboard Bác Sĩ')

@section('main-content')

    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Tubagora
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('doctor.profile') }}">
                            <i class="material-icons">person</i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="material-icons">store</i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="material-icons">content_paste</i>
                            <p>Appointments</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="material-icons">notifications</i>
                            <p>Notifications</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Bảng Điều Khiển Bác Sĩ</a>
                </div>
            </nav>
            <!-- End Navbar -->

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Thẻ Thống Kê -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">content_copy</i>
                                    </div>
                                    <p class="card-category">Số Lượng Khám</p>
                                    <h3 class="card-title">120</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons text-danger">warning</i>
                                        <a href="#">Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Biểu Đồ Thu Nhập -->
                        <div class="col-lg-9 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">Biểu Đồ Thu Nhập</h4>
                                    <div class="ct-chart" id="incomeChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sản Phẩm và Bài Viết -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-success">
                                    <h4 class="card-title">Sản Phẩm Tiếp Thị</h4>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>Sản phẩm 1</li>
                                        <li>Sản phẩm 2</li>
                                        <li>Sản phẩm 3</li>
                                    </ul>
                                    <button class="btn btn-primary">Thêm Sản Phẩm</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-info">
                                    <h4 class="card-title">Danh Sách Bài Viết</h4>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>Bài viết 1</li>
                                        <li>Bài viết 2</li>
                                        <li>Bài viết 3</li>
                                    </ul>
                                    <button class="btn btn-primary">Thêm Bài Viết</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="copyright pull-right">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>, made with love by <a href="https://www.creative-tim.com" target="_blank">Creative
                    Tim</a> for a better web.
            </div>
        </div>
    </footer>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('incomeChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April'],
                datasets: [{
                    label: 'Thu Nhập',
                    data: [1200, 1900, 1300, 2500],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            }
        });
    </script>
@endpush
