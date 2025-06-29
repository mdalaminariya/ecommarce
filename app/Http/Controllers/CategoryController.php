<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    public function store(Request $request){
        $manager = new ImageManager(new Driver());
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
        ]);
        if($request->hasFile('image')){
            $new_name = Auth::user()->id .'-'. now()->format('M d, Y') .'-'. rand(444, 9999) .'.'. $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save( base_path('public/uploads/category/'. $new_name));

           if($request->slug){
             Category::insert([
                'title' => Str::ucfirst($request->title),
                'slug' => Str::slug($request->slug,'-'),
                'image' => $new_name,
                'created_at' => now(),
            ]);
           }else{
            Category::insert([
                'title' => Str::ucfirst($request->title),
                'slug' => Str::slug($request->title,'-'),
                'image' => $new_name,
                'created_at' => now(),
            ]);
            return back()->with('success', 'Category created successfully');
           }

        }else{
            return back();
        }
    }
    public function status($slug){
        $category = Category::where('slug', $slug)->first();
        if($category->status == 'active'){
            Category::find($category->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return back()->with('success', 'Category Status Update successfully');
        }else{
            if($category->status == 'deactive'){
                Category::find($category->id)->update([
                    'status' => 'active',
                    'updated_at' => now(),
                ]);
            return back()->with('success', 'Category Status Update successfully');
            }
        }
    }
    public function edit($slug){
        $category = Category::where('slug', $slug)->first();

        return view('dashboard.categories.edit', compact('category'));
    }
        public function update(Request $request, $slug){
        $manager = new ImageManager(new Driver());
        $category= Category::where('slug',$slug)->first();

        if($request->hasFile('image')){
            if($category->image){
                $old_path = base_path('public/uploads/category/'.$category->image);
                if(file_exists($old_path)){
                    unlink($old_path );
                }
            }
        $new_name = Auth::user()->id .'-'.now()->format('D M, Y') .'-'.rand(0,9999) .'.'.$request->file('image')->getClientOriginalExtension();
        $image = $manager->read($request->file('image'));
        $image->toPng()->save(base_path('public/uploads/category/'.$new_name));

        if($request->slug){
            Category::find($category->id)->update([
                'title' => $request->title,
                'slug' => Str::slug($request->slug,'-'),
                'image' => $new_name,
                'updated_at' => now(),
            ]);
            return redirect()->route('home.category')->with('success','Category Update Successfully..!');
        }else{
            Category::find($category->id)->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title,'-'),
                'image' => $new_name,
                'updated_at' => now(),
            ]);
            return redirect()->route('home.category')->with('success','Category Update Successfully..!');
        }
        }else{
            if($request->slug){
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'updated_at' => now(),
                ]);
                return redirect()->route('home.category')->with('success','Category Update Successfully..!');
            }else{
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'updated_at' => now(),
                ]);
                return redirect()->route('home.category')->with('success','Category Update Successfully..!');
            }
        }
    }

    public function destoy($slug){
        $category = Category::where('slug', $slug)->first();
        if($category->image){
            $old_path = base_path('public/uploads/category/'.$category->image);
            if(file_exists($old_path)){
                unlink($old_path);
            }
        }
        Category::find($category->id)->delete();
        return redirect()->route('home.category')->with('success', 'Category deleted successfully');
    }
}
