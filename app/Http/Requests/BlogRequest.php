<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class BlogRequest extends FormRequest
{
    public function saveFile()
    {
        $image = $this->file('image');
        $ext = $image->getClientOriginalExtension();
        $name = "{$this->title}.{$ext}";

        if (!Storage::exists("public/blogs")) {
            Storage::makeDirectory("public/blogs");
        }

        Storage::putFileAs('public/blogs', $image, $name);

        return $name;
    }
}
