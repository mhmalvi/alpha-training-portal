<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use DB;

class HomeController extends Controller
{
    /**
     * default business page
     * itec landing page
     */
    public function index(){
        $blogs = DB::table('blogs')->orderBy('id', 'desc')->paginate(6);
        return view('home', compact('blogs'));
    }
}
