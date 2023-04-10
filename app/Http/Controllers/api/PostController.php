<?php

namespace App\Http\Controllers\api;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\PostCreatRequest;
use PhpParser\Node\Expr\AssignOp\Pow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create(PostCreatRequest $request)
    {
    
        post::create ([
            'title' => $request->title,
            'contente' => $request->contente,
            'image' => $request->image,
            'likes' => 0,
            'isPublished' => 1,
        ]);
    }

    public function index(Request $request)
    {
        return 'wwww';
        return $request;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;
        return 'wwww';
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
