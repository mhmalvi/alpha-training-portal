<?php

namespace App\Http\Controllers\Admin;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        if($request->hasFile('image')){
            $slug = SlugService::createSlug(Blog::class, 'blog_slug', $request->title);
            
            //check if directory exist or not
            if (!Storage::exists("public/blogs")) {
                Storage::makeDirectory("public/blogs");
            }

            $image = $request->file('image');
            $imgExtension = $image->getClientOriginalExtension();

            $file = date('dmy-hms').'.'.$imgExtension;
            
            $category = $request->category;

            if(is_null($request->category)){
                $category = null;
            }

            $data = [
                'user_id' => Auth::id(),
                'blog_title' => $request->title,
                'blog_slug' => $slug,
                'category_id' => $category,
                'blog_summery' => $request->summary,
                'blog_details' => $request->summernote,
                'thumbnail' => $file
            ];

            try {
                Blog::create($data);
                //store image into storage directory
                Storage::putFileAs('public/blogs', $image, $file);

                $notification = [
                    'message'   =>  'nothing went wrong',
                    'alert-type'    =>  'success'
                ];
        
                return redirect()->back()->with($notification);

            } catch (\Throwable $th) {
                $notification = [
                    // 'message'   =>  'oops! Something went wrong',
                    'message'   =>  $th->getMessage(),
                    'alert-type'    =>  'warning'
                ];
        
                return redirect()->back()->with($notification);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogId = Crypt::decryptString($id);
        $data = Blog::findOrFail($blogId);
        $categories = Category::all();

        return view('admin.blogs.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Blog::firstWhere('id', $id);
        

            $data->blog_title = $request->title;
            $slug = SlugService::createSlug(Blog::class, 'blog_slug', $request->title);
            $data->blog_slug = $slug;
            $data->blog_summery = $request->summary;
            $data->blog_details = $request->summernote;
            $data->category_id = $request->category;
    
            if($request->hasFile('image')){
                //delete the old image first
                Storage::delete('public/blogs/' . $data->thumbnail);
    
                $image = $request->file('image');
                $imgExtension = $image->getClientOriginalExtension();
    
                $file = date('dmy-hms').'.'.$imgExtension;
    
                $data->thumbnail = $file;

                //store image into storage directory
                Storage::putFileAs('public/blogs', $image, $file);
            }
            
            $data->save();

            $notification = [
                'message'   =>  'nothing went wrong',
                'alert-type'    =>  'success'
            ];
    
            return redirect()->route('admin.blog.index')->with($notification);

        } catch (\Throwable $th) {
            $notification = [
                // 'message'   =>  'oops! Something went wrong',
                'message'   =>  $th,
                'alert-type'    =>  'warning'
            ];
    
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Blog::findOrFail($id);
        
        Storage::delete('public/blogs/' . $data->thumbnail);

        $data->delete();

        return response()->json(['status' => 200]);
    }


    /**
     * Upload image with tinymce
     */
    public function uploadFile(Request $request){
        if($request->hasFile('file')) {
            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
        
            $request->file('file')->move(public_path('blogImages'), $fileName);
   
            $url = asset('blogImages/'.$fileName); 


            return response()->json(['location' => $url])->header('content-type', 'application/json');
        }
    }

}