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

        $path = $image->storeAs('images', $webpFileName, 's3');
        $imageUrl = Storage::disk('s3')->url($path);


        // Trả về URL của ảnh đã upload
        return response()->json([
            'image_url' => Storage::disk('s3')->url($path),
        ]);
    }
}
