<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogRequest extends FormRequest
{
    public function saveFile()
    {
        $file = $this->file('image');
        $imageTitle = $this->thumbnail_title ? Str::slug($this->thumbnail_title) : Str::slug($this->title);
        $ext = $file->getClientOriginalExtension();
        $filename = "{$imageTitle}.{$ext}";

        //check if directory exist or not
        if (!Storage::exists("public/blogs")) {
            Storage::makeDirectory("public/blogs");
        }

        Image::make($file)
            ->fit(1285, 720)
            ->save(storage_path('app/public/blogs/' . $filename));

        Image::make($file)
            ->fit(822, 480)
            ->save(storage_path('app/public/thumbnails/' . $filename));

        return $filename;
    }
}
