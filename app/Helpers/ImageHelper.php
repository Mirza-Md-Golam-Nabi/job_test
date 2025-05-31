<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class ImageHelper
{
    /**
     * Uploads an image and creates a thumbnail.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @param int $thumbWidth
     * @param int $thumbHeight
     * @return array
     */
    public static function uploadWithThumbnail($file, $folder = 'images', $thumbWidth = 300, $thumbHeight = 200)
    {
        // Generate unique file name
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Store original image
        $originalPath = $file->storeAs($folder, $filename, 'public');

        // Create thumbnail using Intervention Image
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $thumbnailImage = $image->resize($thumbWidth, $thumbHeight);

        // Define thumbnail path
        $thumbFilename = 'thumb_' . $filename;
        $thumbPath = $folder . '/' . $thumbFilename;

        // Save thumbnail to storage
        Storage::disk('public')->put($thumbPath, (string) $thumbnailImage->encode());

        return [
            'original' => 'storage/' . $originalPath,
            'thumbnail' => 'storage/' . $thumbPath,
        ];
    }
}
