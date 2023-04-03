<?php

use App\Http\Controllers\api\RegistrationController;//
use App\Http\Controllers\PostControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersControllerApi;//
use Doctrine\DBAL\Schema\Index;
use phpseclib3\File\ASN1\Maps\Name;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/test', function () {
//     return "wdedeedwdwwfwefwefwfwfww";
//     //return $request->user();
// });
// Route::apiresource('/poste',PostControllerApi::class);

// Route::post('/prim', 'MyPlaceController@index');
// Route::post('/primn', 'MyPlaceController@index2');

// Route::get('/baisc', 'baisc@index');


// //Route::post('register', 'UserController@register');
// Route::apiresource('/e',UsersControllerApi::class);

Route::apiresource('/user_Registration',UsersControllerApi::class);
Route::apiresource('/Registration',RegistrationController::class) ;