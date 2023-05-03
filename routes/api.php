<?php

use App\Models\User; //
use Illuminate\Support\Facades\Hash; //
use Illuminate\Support\Str; //

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersController; //
use Doctrine\DBAL\Schema\Index;
use phpseclib3\File\ASN1\Maps\Name;
use App\Http\Controllers\api\logController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\SubscriptionController;

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
    Route::post('/users', [UsersController::class, 'store']);
    Route::get('/users/{userId}', [UsersController::class, 'show']);
    Route::put('/user/self', [UsersController::class, 'selfUpdate']);
    Route::delete('/user/self', [UsersController::class, 'selfDestroy']);


    Route::post('/users/self-new-post', [PostController::class, 'store']);
    Route::get('/users/{userId}/posts', [PostController::class, 'index']);
    Route::get('/users/post/{postId}', [PostController::class, 'show']);
    Route::put('/users/post/{postId}', [PostController::class, 'update']);
    Route::delete('/users/post/{postId}', [PostController::class, 'destroy']);
    Route::get('/users/post/{post}/likes', [PostController::class, 'showLike']);
    Route::put('/users/post/{post}/likes', [PostController::class, 'storeLike']);


    Route::post('users/post/{postId}/comments', [CommentController::class, 'store']);
    Route::get('posts/{postId}/comments', [CommentController::class, 'index']);
    Route::put('posts/{postId}/comments/{commentId}', [CommentController::class, 'update']);
    Route::delete('posts/{postId}/comments/{commentid}', [CommentController::class, 'destroy']);
    Route::put('/comment/{commentId}/likes', [CommentController::class, 'storeLike']);
    Route::get('/comment/{commentId}/likes', [CommentController::class, 'showLike']);

    Route::put('users/users/throwInFriends/{userId}', [SubscriptionController::class, 'viewing']);
    Route::get('users/users/indexFollwing/{profileId}', [SubscriptionController::class, 'indexFollwing']);
    Route::get('users/users/indexFollowers/{profileId}', [SubscriptionController::class, 'indexFollowers']);
    Route::post('users/users/storeFollwing/{profileId}', [SubscriptionController::class, 'storeFollwing']);

});
Route::post('/users/fil', [PostController::class, 'fil']);
Route::get('/user/fill', [LogController::class, 'fill']);
Route::get('/user/tabl', [LogController::class, 'tabl']);
