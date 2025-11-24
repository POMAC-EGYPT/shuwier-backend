<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ImageHelpers
{
    public static function addImage(UploadedFile $image, string $path): string
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        $path = $image->storeAs($path, $filename, 'public');

        return 'storage/' . $path;
    }

    public static function updateImage(UploadedFile $image, string $oldImagePath, string $path): string
    {
        if (File::exists($oldImagePath))
            File::delete($oldImagePath);

        return self::addImage($image, $path);
    }

    public static function deleteImage(?string $path): void
    {
        if ($path && File::exists($path))
            File::delete($path);
    }

    public static function createUploadedFileFromUrl(string $url): UploadedFile
    {
        $contents = file_get_contents($url);
        $tmpPath = storage_path('app/tmp_social_photo.jpg');
        file_put_contents($tmpPath, $contents);

        return new UploadedFile(
            $tmpPath,
            'social_photo.jpg',
            'image/jpeg',
            null,
            true
        );
    }
}
