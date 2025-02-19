<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Kiểm tra nếu file có được chọn và validate
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');

        // Lưu ảnh lên S3
        $path = $image->storeAs('images', $webpFileName, 's3'); // Lưu vào thư mục 'images'

        // Lấy URL của ảnh đã upload
        $imageUrl = Storage::disk('s3')->url($path);

        // Trả về URL ảnh dưới dạng chuỗi
        return $imageUrl;
    }
}
