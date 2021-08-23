<?php

namespace App\Http\Actions;

use Illuminate\Support\Facades\Storage;

class ImageAction
{
    public static function storeImage($path, $image, $fileName)
    {
        return Storage::putFileAs($path, $image, $fileName, 'public');
    }

    public static function replaceImage($path, $oldImagePath, $image)
    {
        $fileName = str_replace($path . '/', '', $oldImagePath);
        Storage::delete($oldImagePath);
        return Storage::putFileAs($path, $image, $fileName, 'public');
    }

    public static function deleteImage($path)
    {
        return Storage::delete($path);
    }
}
