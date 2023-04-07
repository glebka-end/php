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





//         return $request->all();
//         $user_name = User::where('name',$request->query('name'))->first();
//     if ($user_name) return response('name is busy', 409)->header('Content-Type', 'text/plain');
//     $user = User::whereEmail($request->query('email'))->first();
//      if ($user) return response('email is busy', 409)->header('Content-Type', 'text/plain');

    
  
//    $request['password']=Hash::make($request['password']);     //passwors
//    $request['remember_token'] = Str::random(10);
 
//    $user = User::create($request->toArray());
   
//    $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
//    $response = ['token' => $token];
   //$user = User::create($token->all());

   // return response($response, 200);
    
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
        
        return 'красава ';
//         $user_name = User::where('name',$request->query('name'))->first();
//             if ($user_name) return response('name is busy', 409)->header('Content-Type', 'text/plain');
// return $user_name
        //    $user = User::whereEmail($request->query('email'))->first();
        //      if ($user) return response('email is busy', 409)->header('Content-Type', 'text/plain');
       // $user = $request->user();//пользователя как токины удалить   
       // return UserResource::make($user);
      
    }
    public function self(Request $request)
    {
         $user = $request->user();
       return UserResource::make($user);
    }
    public function index()
    {
        //return '222';
        return UserResource::collection(User::paginate());
    }

  
    public function show( string $id)
    {
    
      $userShow=User::find($id);
        return response()->json([
          $userShow
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsersIpdateRequest $request)
    {
        // return $id;
        // return $request;
        $user = $request->user();
        $user->name = $request['name'];
        $user->save();
        // $id->update($request->all());

        // $userUpdate=User::find($id);
        return response()->json([
          $user
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
      $user = $request->user();
      $user->tokens()->delete();
        $user->delete();
     
        return response()->json([
           'status' => 'ok',
        ], 201);
       // $user_name = User::where('name',$request->query('name'))->first();
        //     if ($user_name) return response('name is busy', 409)->header('Content-Type', 'text/plain');
    }
}
