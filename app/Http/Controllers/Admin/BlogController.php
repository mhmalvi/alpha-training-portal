<?php

namespace App\Http\Controllers\Admin;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        try {
            $request->save();

            $notification = [
                'message'   =>  'Successfully saved.',
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'message'   =>  'oops! Something went wrong',
                'alert-type'    =>  'warning'
            ];

            return redirect()->back()->with($notification);
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
        $blog = Blog::findOrFail($blogId);
        $categories = Category::all();

        return view('admin.blogs.edit', compact('blog', 'categories'));
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
            $slug = SlugService::createSlug(Blog::class, 'blog_slug', $request->title);

            $data->blog_title = $request->title;
            $data->blog_slug = $slug;
            $data->blog_summery = $request->summary;
            $data->blog_details = $request->summernote;
            $data->category_id = $request->category;
            $data->meta_tags = $request->meta_tags;
            $data->meta_keys = $request->meta_keys;
            $data->meta_desc = $request->meta_desc;

            if ($request->hasFile('image')) {
                //delete the old image first
                Storage::delete('public/blogs/' . $data->thumbnail);

                $image = $request->file('image');
                $imgExtension = $image->getClientOriginalExtension();

                $file = date('dmy-hms') . '.' . $imgExtension;

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
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $request->file('file')->move(public_path('blogImages'), $fileName);

            $url = asset('blogImages/' . $fileName);


            return response()->json(['location' => $url])->header('content-type', 'application/json');
        }
    }
}
