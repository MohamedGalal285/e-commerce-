<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('admin.admin-index');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('users')->group(function(Router $route){
    $route->get('/',[UserController::class,'index'])->name('user.index');
    $route->get('/create',[UserController::class,'create'])->name('user.create');
    $route->post('/store',[UserController::class,'store'])->name('user.store');
    $route->get('/edit/{user}',[UserController::class,'edit'])->name('user.edit');
    $route->post('/update',[UserController::class,'update'])->name('user.update');
    $route->get('/delete/{user}',[UserController::class,'delete'])->name('user.delete');
});
Route::prefix('products')->group(function(Router $route){
    $route->get('/',[ProductController::class,'index'])->name('product.index');
    $route->get('/create',[ProductController::class,'create'])->name('product.create');
    $route->post('/store',[ProductController::class,'store'])->name('product.store');
    $route->get('/edit/{product}',[ProductController::class,'edit'])->name('product.edit');
    $route->post('/update',[ProductController::class,'update'])->name('product.update');
    $route->get('/delete/{product}',[ProductController::class,'delete'])->name('product.delete');
});
Route::prefix('categories')->group(function(Router $route){
    $route->get('/',[CategoryController::class,'index'])->name('category.index');
    $route->get('/create',[CategoryController::class,'create'])->name('category.create');
    $route->post('/store',[CategoryController::class,'store'])->name('category.store');
    $route->get('/edit/{category}',[CategoryController::class,'edit'])->name('category.edit');
    $route->post('/update',[CategoryController::class,'update'])->name('category.update');
    $route->get('/delete/{category}',[CategoryController::class,'delete'])->name('category.delete');
});



require __DIR__.'/auth.php';
