<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Chỉnh sửa thông tin cá nhân</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <!-- Ảnh đại diện -->
                        <div class="col-12 mb-4 text-center">
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <img id="avatarPreview"
                                        src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://via.placeholder.com/150' }}"
                                        alt="Avatar Preview">
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" id="avatarInput" name="photo" accept="image/*">
                                    <label for="avatarInput">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin cá nhân -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                value="{{ $user->phone }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="province" class="form-label">Tỉnh/Thành phố</label>
                            <select class="form-select" id="province" name="province">
                                <option value="">Chọn tỉnh/thành phố</option>
                                <!-- Các option sẽ được load bằng API -->
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="address" name="address" rows="2">{{ $user->address }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* CSS cho form chỉnh sửa profile */
    .avatar-upload {
        position: relative;
        max-width: 180px;
        margin: 0 auto;
    }

    .avatar-preview {
        width: 180px;
        height: 180px;
        position: relative;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #f8f9fc;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-edit {
        position: absolute;
        right: 10px;
        bottom: 10px;
        z-index: 1;
    }

    .avatar-edit input {
        display: none;
    }

    .avatar-edit label {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #4e73df;
        border: 1px solid transparent;
        color: white;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .avatar-edit label:hover {
        background: #2e59d9;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #bac8f3;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .modal-header {
        background-color: #4e73df;
        color: white;
    }

    .modal-header .btn-close {
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý nút chỉnh sửa
        const editBtn = document.getElementById('edit-info-btn');
        const editModal = new bootstrap.Modal(document.getElementById('editProfileModal'));

        editBtn.addEventListener('click', function() {
            editModal.show();
        });

        // Xử lý preview ảnh đại diện
        const avatarInput = document.getElementById('avatarInput');
        const avatarPreview = document.getElementById('avatarPreview');

        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Xử lý form submit
        const editProfileForm = document.getElementById('editProfileForm');

        editProfileForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Gửi request cập nhật thông tin
            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật UI
                        document.querySelector('.profile-name').textContent = data.user.name;
                        document.querySelector('[data-info="phone"]').textContent = data.user
                            .phone || 'Chưa cập nhật';
                        document.querySelector('[data-info="address"]').textContent = data.user
                            .address || 'Chưa cập nhật';
                        document.querySelector('[data-info="province"]').textContent = data.user
                            .province || 'Chưa cập nhật';

                        if (data.user.photo) {
                            document.querySelector('.profile-photo').src =
                                `/storage/${data.user.photo}`;
                        }

                        // Hiển thị thông báo thành công
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: 'Thông tin cá nhân đã được cập nhật',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // Đóng modal
                        editModal.hide();
                    } else {
                        // Hiển thị lỗi
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: data.message || 'Đã có lỗi xảy ra',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Đã có lỗi xảy ra khi cập nhật thông tin',
                    });
                });
        });

        // Load danh sách tỉnh/thành phố
        fetch('https://provinces.open-api.vn/api/p/')
            .then(response => response.json())
            .then(data => {
                const provinceSelect = document.getElementById('province');
                const currentProvince = "{{ $user->province }}";

                data.forEach(province => {
                    const option = new Option(province.name, province.name);
                    if (province.name === currentProvince) {
                        option.selected = true;
                    }
                    provinceSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading provinces:', error));
    });
</script>
