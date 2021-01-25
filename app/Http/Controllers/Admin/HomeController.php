<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Home funciton
     */
    public function index(){
        return view('admin.index');
    }


    /**
     * User profile
     */
    public function profile(){
        return view('admin.settings.profile');
    }


    /**
     * User Profile Update
     */
    public function profileUpdate(ProfileRequest $request){
        try {
            $data = User::firstWhere('id', Auth::id());

            $data->name = $request->username;
            $data->email = $request->email;
    
            if($request->hasFile('file')){
                //delete old image
                Storage::delete('public/users/' . $data->profile_photo_path);
                //check if directory exist or not
                if (!Storage::exists("public/users")) {
                    Storage::makeDirectory("public/users");
                }
    
                $image = $request->file('file');
                $imgExtension = $image->getClientOriginalExtension();
    
                $file = Auth::user()->name.'.'.$imgExtension;
    
                $data->profile_photo_path = $file;

                //store image into storage directory
                Storage::putFileAs('public/users', $image, $file);
            }
            
            $data->save();

            $notification = [
                'message'   =>  'Profile successfully updated!',
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
