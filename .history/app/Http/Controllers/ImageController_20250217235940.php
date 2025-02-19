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

        // Lấy file ảnh từ request
        $image = $request->file('image');

        // Tạo tên file WebP
        $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $webpFileName = $fileName . '.webp';
        $webpPath = 'images/webp/' . $webpFileName; // Lưu vào thư mục `images/webp` trên S3

        try {
            // Khởi tạo ImageManager và đọc file ảnh
            $manager = new ImageManager();

            $image = $manager->make($image->getRealPath());

            // Chuyển đổi ảnh sang định dạng WebP với chất lượng 80
            $webpImage = $image->encode('webp', 80);

            // Lưu ảnh WebP lên S3
            $uploadSuccess = Storage::disk('s3')->put($webpPath, (string) $webpImage, 'public');

            if ($uploadSuccess) {
                // Lấy URL của ảnh đã upload lên S3
                $imageUrl = Storage::disk('s3')->url($webpPath);
                return response()->json([
                    'message' => 'Image uploaded and converted successfully!',
                    'image_url' => $imageUrl
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
