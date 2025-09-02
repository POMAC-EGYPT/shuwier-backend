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

    public static function deleteImage(string $path): void
    {
        if (File::exists($path))
            File::delete($path);
    }
}
