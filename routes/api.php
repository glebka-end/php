<?php

use App\Http\Controllers\PostControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/test', function () {
    return "wdedeedwdwwfwefwefwfwfww";
    //return $request->user();
});
Route::apiresource('/poste',PostControllerApi::class);

Route::post('/prim', 'MyPlaceController@index');
Route::post('/primn', 'MyPlaceController@index2');

Route::get('/baisc', 'baisc@index');

