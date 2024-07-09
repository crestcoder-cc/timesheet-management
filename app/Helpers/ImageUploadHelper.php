<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class ImageUploadHelper
{
    public static function imageUpload($files, $folder): string
    {
        $image_path = 'uploads/' . $folder . '/' . date('Y') . '/' . date('m');
        if (!File::exists(public_path() . "/" . $image_path)) {
            File::makeDirectory(public_path() . "/" . $image_path, 0777, true);
        }
        $extension = $files->getClientOriginalExtension();
        $destination_path = public_path() . '/' . $image_path;
        $file_name = uniqid() . '.' . $extension;
        $files->move($destination_path, $file_name);
        return $image_path . '/' . $file_name;
    }

    public static function customImageUpload($files, $folder): string
    {
        $image_path = public_path() . "/" . 'uploads/' . $folder;
        if (!File::exists($image_path)) {
            File::makeDirectory($image_path, 0777, true);
        }
        $extension = $files->getClientOriginalExtension();
        $destination_path = $image_path;
        $file_name = uniqid() . '.' . $extension;
        $files->move($destination_path, $file_name);
        return $file_name;
    }

    public static function deleteImage($path)
    {
        if (File::exists($path)) {
            File::delete($path);
            // File successfully deleted
        }
    }
}
