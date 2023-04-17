<?php

use App\Models\User; //
use Illuminate\Support\Facades\Hash; //
use Illuminate\Support\Str; //

use App\Http\Controllers\api\RegistrationController; //
use App\Http\Controllers\PostControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersController; //
use Doctrine\DBAL\Schema\Index;
use phpseclib3\File\ASN1\Maps\Name;
use App\Http\Controllers\api\logController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/user/register', [UsersController::class, 'register']);
Route::post('/user/login', [UsersController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/users/self', [UsersController::class, 'self']);
    Route::get('/users', [UsersController::class, 'index']);
    // Route::get('/users/show/{id}', [UsersController::class, 'show']);
    Route::post('/users', [UsersController::class, 'store']);
    Route::get('/users/{userId}', [UsersController::class, 'show']);
    //Route::get('/users/show/{id}', [UsersController::class, 'show']);
    Route::put('/user/self', [UsersController::class, 'selfUpdate']); //metod
    Route::delete('/user/self', [UsersController::class, 'selfDestroy']);

    //Route::apiResource('/post',PostController::class);
    Route::post('/users/self-new-post', [PostController::class, 'store']);
    Route::get('/users/{userId}/posts', [PostController::class, 'index']);
    Route::get('/users/{user}/post/{post}', [PostController::class, 'show']);
    Route::put('/users/{user}/post/{post}', [PostController::class, 'selfUpdatePost']);
    Route::delete('/users/{user}/post/{post}', [PostController::class, 'selfDestroyPost']);

    Route::post('users/post/{post}/comments', [CommentController::class, 'store']);
    Route::get('posts/{post}/comments', [CommentController::class, 'index']);
    Route::get('posts/{post}/comments/{comment}', [CommentController::class, 'show']);
    Route::put('posts/{post}/comments/{comment}', [CommentController::class, 'selfUpdateComment']);
    Route::delete('/user/post/{post}/comment/{comment}', [CommentController::class, 'selfDestroyComment']);
});
Route::post('/users/fil', [PostController::class, 'fil']);