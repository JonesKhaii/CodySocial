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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate ảnh
        ]);

        // Lấy file ảnh từ request
        $image = $request->file('image');

        // Tạo tên file WebP (hoặc có thể dùng tên gốc của file)
        $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = $image->getClientOriginalExtension();
        $webpFileName = $fileName . '.' . $fileExtension; // Hoặc đổi sang .webp nếu cần

        // Đặt đường dẫn nơi lưu ảnh trong S3 (bao gồm cả thư mục và tên file)
        $path = 'images/' . $webpFileName;

        // Lưu ảnh lên S3 với tên rõ ràng vào thư mục 'images'
        try {
            $result = Storage::disk('s3')->put($path, file_get_contents($image), 'public');  // 'public' để có thể truy cập từ bên ngoài

            // Kiểm tra nếu việc lưu thành công
            if ($result) {
                // Lấy URL của ảnh đã upload
                $imageUrl = Storage::disk('s3')->url($path);

                // Trả về chỉ URL ảnh (không phải thông tin JSON hay metadata)
                return response()->json([
                    'image_url' => $imageUrl,  // Chỉ trả về URL ảnh
                ]);
            } else {
                return response()->json(['error' => 'Failed to upload image'], 500);
            }
        } catch (\Exception $e) {
            // Log lỗi nếu có
            Log::error('Image upload error: ' . $e->getMessage());
            return response()->json(['error' => 'Image processing error'], 500);
        }
    }
}
