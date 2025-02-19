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
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = $image->getClientOriginalExtension();
        $webpFileName = $fileName . '.' . $fileExtension;

        // Thay đổi dưới đây để đảm bảo lưu đúng vào thư mục images
        $path = 'images/' . $webpFileName;
        $uploaded = Storage::disk('s3')->put($path, file_get_contents($image), 'public');

        if ($uploaded) {
            // Lấy URL đầy đủ từ S3
            $imageUrl = Storage::disk('s3')->url($path);
            return $imageUrl;
        }

        return response()->json(['error' => 'Upload failed'], 500);
    }
}
