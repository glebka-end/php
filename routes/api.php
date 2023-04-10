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
Route::get('/users/login', [UsersController::class, 'login']);
Route::middleware('auth:sanctum')->group(function() {
 
Route::get('/users/self', [UsersController::class, 'self']);
Route::get('/users/show', [UsersController::class, 'show']);
Route::put('/users/update', [UsersController::class, 'update']);
Route::delete('/users/destroy', [UsersController::class, 'destroy']);
    
//Route::apiResource('/post',PostController::class);
Route::get('/post/index', [PostController::class, 'index']);    
Route::get('/post/create', [PostController::class, 'create']);    

});

//Route::get('/users/index', [UsersController::class, 'index']);


//Route::delete('/users/destroy{id}', [UsersController::class, 'destroy']);



 

// Route::post('/test', function () {
//     return "wdedeedwdwwfwefwefwfwfww";
//     //return $request->user();
// });
// Route::apiresource('/poste',PostControllerApi::class);

// Route::post('/prim', 'MyPlaceController@index');
// // Route::post('/primn', 'MyPlaceController@index2');

// // Route::get('/baisc', 'baisc@index');


// // //Route::post('register', 'UserController@register');
// // Route::apiresource('/e',UsersControllerApi::class);

// Route::apiresource('/user_Registration',UsersControllerApi::class);
// Route::apiresource('/Registration',RegistrationController::class) ;
// // Route::get('user/{user}' ,function(request $request, User $user){
// //     $user =\App\Models\User::find($id);
// //     if(!$user) return response ('wew' ,404);
// //     return $user;
// // });
// //Route::post('/log','logController@login');
// Route::post('/log',function(Request $request){
//    // return $request;
//     $user = User::wherename($request->query('name'))->first();
//         if (Hash::check($request->query('password'), $user->password))
//             return "OK";
//         else
//       return "NE OK";
// });