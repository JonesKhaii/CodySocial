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
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $image = $request->file('image');
            Log::info('Image details', [
                'original_name' => $image->getClientOriginalName(),
                'mime_type' => $image->getMimeType(),
                'size' => $image->getSize(),
                'temp_path' => $image->getRealPath()
            ]);

            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileExtension = $image->getClientOriginalExtension();
            $webpFileName = $fileName . '.' . $fileExtension;
            $path = 'images/' . $webpFileName;

            Log::info('Attempting to upload to S3', [
                'disk' => 's3',
                'path' => $path,
                'bucket' => config('filesystems.disks.s3.bucket'),
                'region' => config('filesystems.disks.s3.region')
            ]);

            $uploaded = Storage::disk('s3')->put($path, file_get_contents($image), 'public');

            if ($uploaded) {
                $imageUrl = Storage::disk('s3')->url($path);
                Log::info('Upload successful', ['url' => $imageUrl]);
                return $imageUrl;
            }

            Log::error('Upload failed - Storage::put returned false');
            return response()->json(['error' => 'Failed to upload image'], 500);
        } catch (\Exception $e) {
            Log::error('Exception during upload: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to upload image: ' . $e->getMessage()], 500);
        }
    }
}
