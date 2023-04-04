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
    $user = User::whereEmail($request->query('email'))->first();
    if ($user) return response('User exists', 409)->header('Content-Type', 'text/plain');
   $request['password']=Hash::make($request['password']);
   $request['remember_token'] = Str::random(10);
   $user = User::create($request->toArray());
   $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
   $response = ['token' => $token];
   return response($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
