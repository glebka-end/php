<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Requests\Api\UsersRegisterRequest;

use App\Http\Resources\Api\UserResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UsersIpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\UserloginRequest;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function register(UsersRegisterRequest $request)
  {
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);
   
    $token = $user->createToken('login')->plainTextToken;

    return response()->json([
      'user' => UserResource::make($user),
      'token' => $token,
    ], 201);
  }
  //  UsersRegisterRequest 
  public function login(UserloginRequest  $request)
  
  {
    
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
      return response()->json([
        'message' => 'Неверно указан почта  или пароль',
        'errors' => 'Unauthorised'
      ], 401);
    }
    $user = User::where('email', $request->email)->first();
    $token = $token = $user->createToken('login')->plainTextToken;

    return response()->json([
      'user' => UserResource::make($user),
      'token' => $token,
    ], 201);
  }
  public function self(Request $request)
  {
    $user = $request->user();
    return UserResource::make($user);
  }
  public function index()
  {

    return UserResource::collection(User::paginate());
  }


  public function show(User $user)
  {

    // $user = User::findOrFail($id);
    // return UserResource::make($user);

    // $userShow=User::find($id);
    //   return response()->json([
    //     $user
    //   ], );

    return UserResource::make($user);
  }

  /**
   * Update the specified resource in storage.
   */
  public function selfUpdate(UsersIpdateRequest $request)
  {

    $user = $request->user();
    $user->name = $request['name'];
    $user->save();



    return UserResource::make($user);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function selfDestroy(Request $request)
  {
    $user = $request->user();
    $user->tokens()->delete();
    $user->delete();

    return response()->json([
      'status' => 'ok',
    ], 204);
  }
}
