@extends('layouts.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <!-- Thông tin cơ bản của bác sĩ -->
            <div class="col-lg-4">
                <div class="card mb-4 shadow">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-primary m-0">Thông Tin Cá Nhân</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Ảnh Bác Sĩ" class="img-thumbnail"
                                style="width: 150px;">
                        </div>
                        <p><strong>Họ và Tên:</strong> {{ $doctor->name }}</p>
                        <p><strong>Chuyên Khoa:</strong> {{ $doctor->specialization }}</p>
                        <p><strong>Số Điện Thoại:</strong> {{ $doctor->phone }}</p>
                        <p><strong>Email:</strong> {{ $doctor->email }}</p>
                        <p><strong>Địa Chỉ Làm Việc:</strong> {{ $doctor->workplace }}</p>
                        <p><strong>Đánh Giá:</strong> {{ $doctor->rating }} ⭐</p>
                        <p><strong>Số Người Theo Dõi:</strong> {{ $doctor->followers_count }}</p>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ thu nhập -->
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-success m-0">Biểu Đồ Thu Nhập (Điểm)</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="incomeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Số lượng người đặt khám -->
            <div class="col-lg-4">
                <div class="card mb-4 shadow">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-info m-0">Số Lượng Người Đặt Khám</h6>
                    </div>
                    <div class="card-body">
                        <h3></h3>
                    </div>
                </div>
            </div>

            <!-- Danh sách sản phẩm tiếp thị -->
            <div class="col-lg-4">
                <div class="card mb-4 shadow">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-warning m-0">Danh Sách Sản Phẩm Tiếp Thị</h6>
                    </div>
                    <div class="card-body">
                        {{-- @if ($products->isEmpty())
                            <p>Chưa có sản phẩm tiếp thị.</p>
                        @else
                            <ul>
                                @foreach ($products as $product)
                                    <li>{{ $product->name }}</li>
                                @endforeach
                            </ul>
                        @endif --}}
                        <a href="" class="btn btn-primary mt-3">+ Thêm Sản Phẩm Tiếp
                            Thị</a>
                    </div>
                </div>
            </div>

            <!-- Danh sách bài viết -->
            <div class="col-lg-4">
                <div class="card mb-4 shadow">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold text-danger m-0">Danh Sách Bài Viết</h6>
                    </div>
                    <div class="card-body">
                        @if ($posts->isEmpty())
                            <p>Chưa có bài viết nào.</p>
                        @else
                            <ul>
                                @foreach ($posts as $post)
                                    <li>{{ $post->title }} - <a
                                            href="">Xem</a></li>
                                @endforeach
                            </ul>
                        @endif
                        <a href="" class="btn btn-primary mt-3">+ Tạo Bài Viết Mới</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-header {
            background-color: #f8f9fc;
        }

        .card-body {
            padding: 20px;
        }

        .img-thumbnail {
            width: 150px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .chart-area {
            position: relative;
            height: 250px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Biểu đồ thu nhập (Dựa trên điểm tiếp thị)
        var ctx = document.getElementById("incomeChart").getContext('2d');
        var incomeChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5'],
                datasets: [{
                    label: 'Thu nhập (Điểm)',
                    data: [10, 15, 30, 40, 50],
                    borderColor: 'rgba(78, 115, 223, 1)',
                    backgroundColor: 'rgba(78, 115, 223, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
