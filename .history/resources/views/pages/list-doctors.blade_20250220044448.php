@extends('layouts.master')

@section('title', 'Danh Sách Bác Sĩ')

@section('main-content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-800">Danh Sách Bác Sĩ</h1>
            <div class="flex space-x-4">
                <select class="form-select rounded-lg border-gray-300" name="specialty">
                    <option value="">Tất cả chuyên khoa</option>
                    <!-- Thêm options cho các chuyên khoa -->
                </select>
                <input type="text"
                    placeholder="Tìm kiếm bác sĩ..."
                    class="form-input rounded-lg border-gray-300">
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($doctors as $doctor)
                <div class="overflow-hidden rounded-lg bg-white shadow-md transition duration-300 hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-20 w-20 overflow-hidden rounded-full bg-gray-200">
                                @if ($doctor->avatar)
                                    <img src="{{ $doctor->avatar }}" alt="{{ $doctor->name }}"
                                        class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-blue-100 text-blue-500">
                                        <i class="fas fa-user-md text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $doctor->name }}</h3>
                                <p class="font-medium text-blue-600">{{ $doctor->specialty }}</p>
                                @if ($doctor->rating)
                                    <div class="mt-1 flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $doctor->rating)
                                                <i class="fas fa-star text-yellow-400"></i>
                                            @else
                                                <i class="far fa-star text-gray-300"></i>
                                            @endif
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-600">({{ $doctor->reviews_count ?? 0 }} đánh
                                            giá)</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-gray-600"><i
                                    class="fas fa-graduation-cap mr-2"></i>{{ $doctor->education ?? 'Chưa cập nhật' }}</p>
                            <p class="text-gray-600"><i
                                    class="fas fa-briefcase mr-2"></i>{{ $doctor->experience ?? 'Chưa cập nhật' }} năm kinh
                                nghiệm</p>
                        </div>

                        <div class="mt-6 flex space-x-4">
                            <a href="{{ route('appointments.create', $doctor->id) }}"
                                class="flex-1 rounded-lg bg-blue-600 px-4 py-2 text-center text-white transition duration-300 hover:bg-blue-700">
                                <i class="far fa-calendar-plus mr-2"></i>Đặt Lịch
                            </a>
                            <button
                                class="flex-1 rounded-lg bg-gray-100 px-4 py-2 text-gray-700 transition duration-300 hover:bg-gray-200">
                                <i class="far fa-heart mr-2"></i>Follow
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $doctors->links() }}
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush
