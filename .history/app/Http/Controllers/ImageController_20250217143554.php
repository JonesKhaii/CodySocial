<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use App\Models\Image;

class ImageController extends Controller
{
    public function uploadAndConvert(Request $request)
    {
        Log::info('Nhận request upload ảnh', ['request' => $request->all()]);

        // Kiểm tra xem có file nào được tải lên không
        if (!$request->hasFile('image')) {
            Log::error('Không có ảnh nào được gửi lên.');
            return response()->json(['error' => 'No image uploaded'], 400);
        }

        $file = $request->file('image');
        Log::info('Ảnh nhận được:', [
            'name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime' => $file->getMimeType(),
            'path' => $file->getRealPath(),
        ]);

        // Tạo tên file WebP
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $webpFileName = $fileName . '.webp';
        $webpPath = "uploads/webp/{$webpFileName}";

        // Khởi tạo ImageManager
        try {
            Log::info('Bắt đầu xử lý ảnh...');
            $manager = new ImageManager(['driver' => 'gd']);

            // Đọc file ảnh từ request
            $image = $manager->read($file->getRealPath());

            // Chuyển đổi sang WebP
            $webpImage = $image->toWebp(80);
            Log::info('Chuyển đổi ảnh sang WebP thành công.');

            // Lưu lên S3
            Log::info('Bắt đầu upload ảnh lên S3...');
            $upload = Storage::disk('s3')->put($webpPath, (string) $webpImage, 'public');

            if ($upload) {
                Log::info('Upload lên S3 thành công:', ['path' => $webpPath]);
                $webpUrl = Storage::disk('s3')->url($webpPath);
                return response()->json([
                    'message' => 'Image uploaded and converted successfully!',
                    'webp_url' => $webpUrl
                ]);
            } else {
                Log::error('Upload lên S3 thất bại.');
                return response()->json(['error' => 'Upload failed'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi trong quá trình xử lý ảnh hoặc upload:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Image processing error'], 500);
        }
    }
}
