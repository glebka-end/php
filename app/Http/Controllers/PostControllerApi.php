<?php

namespace App\Http\Controllers;
use App\Models\User;//
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class PostControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function e(Request $request)
    {
        return $request;
        $user = User::whereEmail($request->query('email'))->first();
        if (Hash::check($request->query('password'), $user->password))
            return "OK";
        else
            return "NE OK";
    }
    public function index(Request $request)
    {
        $user = User::whereEmail($request->query('email'))->first();
        if (Hash::check($request->query('password'), $user->password))
            return "OK";
        else
            return "NE OK";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::whereEmail($request->query('email'))->first();
        if (Hash::check($request->query('password'), $user->password))
            return "OK";
        else
            return "NE OK";
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return'api_showw';

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return'api_update';

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "api_destroy";
    }
}
