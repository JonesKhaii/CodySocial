@extends('layouts.master')
@section('title', 'Lịch khám')
@section('main-content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Lịch Khám Của Tôi</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookAppointmentModal">
                <i class="fas fa-plus-circle me-2"></i>Đặt lịch khám
            </button>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-pills mb-4">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="pill" href="#pending">
                    <i class="fas fa-clock me-2"></i>Chờ xác nhận
                    @if ($appointments->where('status', 'pending')->count() > 0)
                        <span class="badge bg-warning ms-2">{{ $appointments->where('status', 'pending')->count() }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#confirmed">
                    <i class="fas fa-check-circle me-2"></i>Đã xác nhận
                    @if ($appointments->where('status', 'confirmed')->count() > 0)
                        <span
                            class="badge bg-primary ms-2">{{ $appointments->where('status', 'confirmed')->count() }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#completed">
                    <i class="fas fa-check-double me-2"></i>Hoàn thành
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#canceled">
                    <i class="fas fa-times-circle me-2"></i>Đã hủy
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            @foreach (['pending' => 'Chờ xác nhận', 'confirmed' => 'Đã xác nhận', 'completed' => 'Hoàn thành', 'canceled' => 'Đã hủy'] as $status => $label)
                <div id="{{ $status }}" class="tab-pane fade {{ $loop->first ? 'show active' : '' }}">
                    @if ($appointments->where('status', $status)->count() > 0)
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @foreach ($appointments->where('status', $status) as $appointment)
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $appointment->doctor->avatar ?? '/images/default-avatar.png' }}"
                                                    class="rounded-circle me-3"
                                                    width="50" height="50"
                                                    alt="Doctor avatar">
                                                <div>
                                                    <h5 class="card-title mb-1">Bs. {{ $appointment->doctor->name }}</h5>
                                                    <p class="text-muted small mb-0">{{ $appointment->doctor->specialty }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                                    <span>{{ $appointment->date->format('d/m/Y') }}</span>
                                                    <i class="fas fa-clock text-primary me-2 ms-3"></i>
                                                    <span>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</span>
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-stethoscope text-primary me-2"></i>
                                                    <span>{{ $appointment->consultation_type === 'online' ? 'Tư vấn trực tuyến' : 'Khám tại phòng khám' }}</span>
                                                </div>

                                                @if ($appointment->notes)
                                                    <div class="d-flex align-items-start">
                                                        <i class="fas fa-sticky-note text-primary me-2 mt-1"></i>
                                                        <p class="small mb-0">{{ $appointment->notes }}</p>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center">
                                                @if ($status === 'pending')
                                                    <form action="{{ route('appointments.cancel', $appointment->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            <i class="fas fa-times me-2"></i>Hủy lịch
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($status === 'confirmed' && $appointment->consultation_type === 'online')
                                                    <a href="{{ route('video-call', $appointment->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-video me-2"></i>Vào phòng khám
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-5 text-center">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Không có lịch khám {{ strtolower($label) }}</h4>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Đặt lịch khám -->
    <div class="modal fade" id="bookAppointmentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đặt lịch khám</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- <form action="" method="POST" id="appointmentForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Chọn bác sĩ</label>
                                <select name="doctor_id" class="form-select" required>
                                    <option value="">-- Chọn bác sĩ --</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">Bs. {{ $doctor->name }} -
                                            {{ $doctor->specialty }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Hình thức khám</label>
                                <select name="consultation_type" class="form-select" required>
                                    <option value="clinic">Khám tại phòng khám</option>
                                    <option value="online">Tư vấn trực tuyến</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Ngày khám</label>
                                <input type="date" name="date" class="form-control" required
                                    min="{{ date('Y-m-d') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Giờ khám</label>
                                <select name="time" class="form-select" required>
                                    <option value="">-- Chọn giờ --</option>
                                    @foreach (['08:00', '09:00', '10:00', '14:00', '15:00', '16:00'] as $time)
                                        <option value="{{ $time }}">{{ $time }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Lý do khám</label>
                                <textarea name="notes" class="form-control" rows="3" placeholder="Mô tả triệu chứng, lý do khám..."></textarea>
                            </div>
                        </div>
                    </form> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" form="appointmentForm" class="btn btn-primary">Đặt lịch</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Validation và xử lý form
            document.getElementById('appointmentForm').addEventListener('submit', function(e) {
                e.preventDefault();
                // Thêm validation logic ở đây
                this.submit();
            });

            // Cập nhật slot giờ khám dựa theo ngày và bác sĩ
            document.querySelector('select[name="doctor_id"], input[name="date"]').addEventListener('change', function() {
                const doctorId = document.querySelector('select[name="doctor_id"]').value;
                const date = document.querySelector('input[name="date"]').value;

                if (doctorId && date) {
                    // Gọi API để lấy các slot còn trống
                    fetch(`/api/available-slots/${doctorId}/${date}`)
                        .then(response => response.json())
                        .then(data => {
                            const timeSelect = document.querySelector('select[name="time"]');
                            timeSelect.innerHTML = '<option value="">-- Chọn giờ --</option>';
                            data.forEach(slot => {
                                timeSelect.innerHTML += `<option value="${slot}">${slot}</option>`;
                            });
                        });
                }
            });
        </script>
    @endpush
@endsection
