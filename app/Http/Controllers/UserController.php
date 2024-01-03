<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view("admin.users.all-users",compact("users"));
    }
    public function create(){
        return view("admin.users.create-user");
    }
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'image' => $request->has('image') ? 'image|mimes:jpeg,png,jpg' : 'nullable',
            'address' => 'required|min:3',
            'phone' => 'required|unique:users,phone',
            'password' => 'required'
        ]);
        if($request->has('image')){
            $path = $request->file('image')->store('images/users', 'public');
        }
        $data['image'] = $path;
        $data['role'] = $request->role;
        User::create($data);
        return redirect()->route('user.index')->with('success','User created Successfully!');
    }
    public function edit(User $user){
        return view('admin.users.edit-user',compact('user'));
    }
    public function update(Request $request,User $user){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'image' => $request->has('image') ? 'image|mimes:jpeg,png,jpg' : 'nullable',
            'address' => 'required|min:3',
            'phone' => 'required|unique:users,phone',
            'password' => 'required'
        ]);
        $oldImage = $user->image;
        if($request->has('image')){
            $path = $request->file('image')->store('images/users', 'public');
            $data['image'] = $path;
        }
        $user->update($data);
        if($oldImage && $request->has('image')){
            Storage::disk('public')->delete($oldImage);
        }
        return redirect()->route('user.index')->with('success','User Updated Successfully!');
    }
    public function destroy(User $user){
        $image = $user->image;
        $user->delete();
        Storage::disk('public')->delete($image);
        return redirect()->route('user.index')->with('success','User Deleted Successfully!');
    }
}
