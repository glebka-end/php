<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return'api_index';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        return'api_store';
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