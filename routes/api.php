<?php
use App\Models\User;//
use Illuminate\Support\Facades\Hash;//
use Illuminate\Support\Str;//

use App\Http\Controllers\api\RegistrationController;//
use App\Http\Controllers\PostControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersController;//
use Doctrine\DBAL\Schema\Index;
use phpseclib3\File\ASN1\Maps\Name;
use App\Http\Controllers\api\logController;
use App\Http\Controllers\api\PostController;

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

Route::post('/users/register', [UsersController::class, 'register']);
Route::post('/users/login', [UsersController::class, 'login']);
Route::middleware('auth:sanctum')->group(function() {
 
    Route::get('/users/self', [UsersController::class, 'self']);
    Route::get('/users', [UsersController::class, 'index']);

// Route::get('/users/show/{id}', [UsersController::class, 'show']);
    Route::post('/users', [UsersController::class, 'store']);
    Route::get('/users/{user}', [UsersController::class, 'show']);
//Route::get('/users/show/{id}', [UsersController::class, 'show']);
    Route::put('/users/self', [UsersController::class, 'selfUpdate']);//metod
    Route::delete('/users/self', [UsersController::class, 'selfDestroy']);
    
//Route::apiResource('/post',PostController::class);
    Route::post('/users/new-post', [PostController::class, 'store']);   
    Route::get('/users/{user}/posts', [PostController::class, 'index']);    
    Route::get('/users/{user}/posts/{postId}', [PostController::class, 'show']); 

});