<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = ['user_id', 'blog_title', 'blog_slug', 'category_id', 'blog_summery', 'blog_details', 'thumbnail'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'blog_slug' => [
                'source' => 'blog_title'
            ]
        ];
    }

    /**
     * Author
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
