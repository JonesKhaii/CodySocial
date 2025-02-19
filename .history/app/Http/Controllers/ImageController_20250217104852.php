<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use App\Models\Image;

class ImageController extends Controller
{
    public function uploadAndConvert(Request $request)
    {
        // Kiểm tra xem có file nào được tải lên không
        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'No image uploaded'], 400);
        }

        $file = $request->file('image');

        // Tạo tên file WebP
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $webpFileName = $fileName . '.webp';
        $webpPath = "uploads/webp/{$webpFileName}";

        // Tạo ImageManager và chuyển đổi ảnh sang WebP
        $manager = new ImageManager();
        $image = $manager->read($file->getRealPath());
        $webpImage = $image->encode('webp', 80);

        // Lưu lên S3
        Storage::disk('s3')->put($webpPath, (string) $webpImage, 'public');

        // Lấy URL ảnh đã lưu trên S3
        $webpUrl = Storage::disk('s3')->url($webpPath);

        return response()->json([
            'message' => 'Image uploaded and converted successfully!',
            'webp_url' => $webpUrl
        ]);
    }
}
