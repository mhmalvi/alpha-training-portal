<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100|unique:App\Models\Blog,blog_title',
            'blog_slug' => 'unique:App\Models\Blog,blog_slug',
            'summary' => 'required|max:255',
            'summernote' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
