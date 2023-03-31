<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'сраница  списка постов ';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'сраница создания постов  ';

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'запрос создания  постов ';

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'страница проссмотр постов  ';

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return 'сраница  изменения  постов ';

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return 'запрос удаление постов ';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return 'хз';

    }

    public function like(string $id)
    {
        return 'like +1';

    }
}