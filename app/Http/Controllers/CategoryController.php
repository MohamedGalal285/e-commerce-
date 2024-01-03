<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view("admin.categories.all-categories",compact("categories"));
    }
    public function create(){
        return view("admin.categories.create-category");
    }
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => $request->has('image') ? 'image|mimes:jpeg,png,jpg' : 'nullable',
        ]);
        if($request->has('image')){
            $path = $request->file('image')->store('images/categories', 'public');
        }
        $data['image'] = $path;
        $data['role'] = $request->role;
        Category::create($data);
        return redirect()->route('category.index')->with('success','Category created Successfully!');
    }
    public function edit(Category $category){
        return view('admin.categories.edit-category',compact('category'));
    }
    public function update(Request $request,Category $category){
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => $request->has('image') ? 'image|mimes:jpeg,png,jpg' : 'nullable',
        ]);
        $oldImage = $category->image;
        if($request->has('image')){
            $path = $request->file('image')->store('images/categories', 'public');
            $data['image'] = $path;
        }
        $category->update($data);
        if($oldImage && $request->has('image')){
            Storage::disk('public')->delete($oldImage);
        }
        return redirect()->route('category.index')->with('success','Category Updated Successfully!');
    }
    public function destroy(Category $category){
        $image = $category->image;
        $category->delete();
        Storage::disk('public')->delete($image);
        return redirect()->route('category.index')->with('success','Category Deleted Successfully!');
    }
}

