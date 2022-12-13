<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImage
{
    public function uploadImage($file, $path)
    {
        $file->storeAs('public/img/'.$path, $file->hashName());
    }

    public function removeImage($filename, $path)
    {
        Storage::disk('local')->delete('public/img/'.$path.'/'.basename($filename));
    }
}
