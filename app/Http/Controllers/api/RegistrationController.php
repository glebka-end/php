<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RegistrationResourse;

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
        
        $ww=user::find($request);
        return  ($ww); 
       if ($ww==[]){
            return  ($ww); 
        }
        $crated_desk =user::create($request->all());
        return new RegistrationResourse($crated_desk);
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
