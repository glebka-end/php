<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RegistrationResourse;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */    

    public function index()
    {
        return'wwew';
        return user::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    //     $ww=user::find($request);
    // //     $token = $request->user()->createToken($request->token_name);
    // //     return ['token' => $token->plainTextToken];
    // //     return  ($request); 
    // //    if ($ww==[]){
    // //         return  ($ww); 
    // //     }

    // $user = $request->user();g
    // return $user;
    $user_name = User::where('name',$request->query('name'))->first();
    if ($user_name) return response('name is busy', 409)->header('Content-Type', 'text/plain');
    $user = User::whereEmail($request->query('email'))->first();
     if ($user) return response('email is busy', 409)->header('Content-Type', 'text/plain');

    // $user_name = User::wherepassword($request->query('name'))->first();
    // if ($user_name) return response('passwors is busy', 409)->header('Content-Type', 'text/plain');
  
   $request['password']=Hash::make($request['password']);     //passwors
   $request['remember_token'] = Str::random(10);
 
   $user = User::create($request->toArray());
   
   $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
   $response = ['token' => $token];
   //$user = User::create($token->all());

   return response($response, 200);
    }

    /**
     * Display the specified resource.
     */
//     public function show(Request $request)
//     {
        
//    $request['password']=Hash::make($request['password']);     //passwors
//    $request['remember_token'] = Str::random(10);
 
//    $user = User::create($request->toArray());
   
//    $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
//    $response = ['token' => $token];
//     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
