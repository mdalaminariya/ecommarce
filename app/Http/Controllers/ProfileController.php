<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile.index');
    }

// name upadte
    public function name_update(Request $request){
        $request->validate([
            'name' => 'required|ascii',
        ]);

        User::find(auth()->user()->id)->update([
            'name' => $request->name,
            'updated_at' => now(),
        ]);
        return back()->with('success','Name Update Successfully..!');
    }
//email update
    public function email_update(Request $request){
        $request->validate([
            'email' => 'required',
        ]);

        User::find(auth()->user()->id)->update([
            'email' => $request->email,
            'updated_at' => now(),
        ]);
        return back()->with('success','Email Update Successfully..!');
    }
    public function password_update(Request $request){
        $request->validate([
            'current_password'=> 'required',
            'password' => 'required',
        ]);
        if(Hash::check($request->current_password, auth()->user()->password)){
        User::find(auth()->user()->id)->update([
            'password' => $request->password,
            'updated_at' => now(),
        ]);
        return back()->with('success','Password Update Successfully..!');
        }else{
            return back();
        }
    }
    public function image_update(Request $request){
        $request->validate([
            'image' => 'required|image',
        ]);
        $manager = new ImageManager(new Driver());
        if($request->hasFile('image')){
            if(auth()->user()->image){
                $old_image = base_path('public/uploads/profile/'. auth()->user()->image);
                if(file_exists($old_image)){
                    unlink($old_image);
                }
            }
            $new_name = Auth::user()->id .'-'. now()->format('d M ,Y') .'-'. rand(1000, 9999) .'.'. $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/profile/'. $new_name));
            User::find(auth()->user()->id)->update([
            'image' => $new_name,
            'updated_at' => now(),
        ]);
        return back()->with('success','Image Update Successfully..!');
        }
    }
}
