<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    /**
     * Default Category Page
     */
    public function index(){
        $data = Category::all();

        return view('admin.categories.index', compact('data'));
    }


    /**
     * store newly created category
     */
    public function store(Request $request){
        $data = [
            'category' => $request->category
        ];

        try {
            Category::create($data);

            $notification = [
                'message'   =>  $request->category.' saved successfully!',
                'alert-type'    =>  'success'
            ];
    
            return redirect()->back()->with($notification);

        } catch (\Throwable $th) {
            $notification = [
                'message'   =>  'Something went wrong',
                'alert-type'    =>  'warning'
            ];
    
            return redirect()->back()->with($notification);
        }
    }


    /**
     * Edit Specific item
     */
    public function edit($id){
        $catId = Crypt::decryptString($id);

        $data = Category::findOrFail($catId);

        $headers = [
            'Content-Type' => 'application/json'
        ];

        return response()->json($data, 200, $headers);
    }


    /**
     * Update specific item
     */
    public function update(Request $request){
        try {
            $data = Category::firstWhere('id', $request->id);
            $data->category = $request->category;
            $data->save();

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


    /**
     * Delete specific item
     */
    public function destroy($id){
        $data = Category::findOrFail($id);

        $data->delete();

        return response()->json(['status' => 200]);
    }
}
