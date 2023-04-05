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
    
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsersIpdateRequest $request, User $id)
    {
        // return $id;
        // return $request;
        
        $id->update($request->all());
        return User::find($id);
        return redirect('id');
        // $aa=User::find($id);
        // return $aa;
        // $affected = User::table('users')
        //       ->where('id', 1)
        //       ->update(['name' => 'eee']);

        // $rrr->update($request->all());
        // return $rrr;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $id)
    {
        $user->delete();
        return 'успешно '
    }
}
