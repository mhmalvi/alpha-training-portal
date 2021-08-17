<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogRequest extends FormRequest
{
    public function saveFile()
    {
        $file = $this->file('image');
        $imageTitle = $this->thumbnail_title ? Str::slug($this->thumbnail_title) : Str::slug($this->title);
        $ext = $file->getClientOriginalExtension();
        $image = "{$imageTitle}.{$ext}";

        //check if directory exist or not
        if (!Storage::exists("public/blogs")) {
            Storage::makeDirectory("public/blogs");
        }

        Storage::putFileAs('public/blogs', $file, $image);

        return $image;
    }
}
