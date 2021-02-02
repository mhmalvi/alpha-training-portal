<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class HomeController extends Controller
{
    /**
     * default business page
     * itec landing page
     */
    public function index(){
        $blogs = Blog::OrderBy('created_at', 'desc')->paginate(6);
        return view('home', compact('blogs'));
    }
}
