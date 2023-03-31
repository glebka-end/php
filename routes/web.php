<?php

use App\Http\Controllers\PostController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/e', function () {
    return 'welcome';
});


// CRUD (create, read, update, delete)
//Route::get('posts',[PostController::class, 'index'])->name('posts');
//Route::get('posts/create',[PostController::class, 'create'])->name('postes.create');
//Route::post('posts',[PostController::class, 'store'])->name('posts.store');
//Route::get('posts/{post}',[PostController::class ,'show'])->name('posts.show');
//Route::get('posts/{post}/edit',[PostController::class, 'edit'])->name('posts.edit');
//Route::put('posts/{post}',[PostController::class, 'update'])->name('posts.update');
//Route::delete('posts/{post}',[PostController::class, 'delete'])->name('posts.delete');
//like
Route::resource('poste',PostController::class);
Route::put('posts/{post}/like',[PostController::class, 'like'])->name('posts.like');
// CRUD (create, read, update, delete)