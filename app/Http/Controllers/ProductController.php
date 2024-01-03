<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view("admin.products.all-products",compact("products"));
    }
    public function create(){
        return view("admin.products.create-product");
    }
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => $request->has('image') ? 'image|mimes:jpeg,png,jpg' : 'nullable',
        ]);
        if($request->has('image')){
            $path = $request->file('image')->store('images/products', 'public');
        }
        $data['image'] = $path;
        $data['role'] = $request->role;
        Product::create($data);
        return redirect()->route('product.index')->with('success','Product created Successfully!');
    }
    public function edit(Product $product){
        return view('admin.products.edit-product',compact('product'));
    }
    public function update(Request $request,Product $product){
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => $request->has('image') ? 'image|mimes:jpeg,png,jpg' : 'nullable',
        ]);
        $oldImage = $product->image;
        if($request->has('image')){
            $path = $request->file('image')->store('images/products', 'public');
            $data['image'] = $path;
        }
        $product->update($data);
        if($oldImage && $request->has('image')){
            Storage::disk('public')->delete($oldImage);
        }
        return redirect()->route('product.index')->with('success','Product Updated Successfully!');
    }
    public function destroy(Product $product){
        $image = $product->image;
        $product->delete();
        Storage::disk('public')->delete($image);
        return redirect()->route('product.index')->with('success','Product Deleted Successfully!');
    }
}
