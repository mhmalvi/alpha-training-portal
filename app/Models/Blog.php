<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

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
