<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\PostCreatRequest;
use PhpParser\Node\Expr\AssignOp\Pow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostController extends Controller
{
    public function store(PostCreatRequest $request)
    {
        $user = $request->user();
        $post = $user->posts()->create([
            'title' => $request->title,
            'contente' => $request->contente,
            'image' => $request->image,
            'likes' => 0,
            'isPublished' => 1,
        ]);

        //    $post = Post::updated ([
        //         'title' => $request->title,
        //         'user_id'=> $request->user()->id,
        //         'contente' => $request->contente,
        //         'image' => $request->image,
        //         'likes' => 0,
        //         'isPublished' => 1,
        //     ]);
        return PostResource::make($post);
    }


    public function index(Request $request, User $user)
    {
        $posts = $user->posts()->paginate();
        return PostResource::collection($posts);

        //  $postt=1;
        //  $postALL = Post::find($postt);
        //  $comments = Post::find($postt)->comments;




        //  $ee = $comments->id;

        //echo $comments->id;

        // foreach ($comments as $comment) {
        ///    echo $comment;
        // }
        // $comments= $comments->comment;
        //$post= Post::all();
        // $Comment=comment::all();
        // $post= Post::where('id')->get();
        // return $post;
        //  return $Comment=comment::find(1);
        // $user_name = Comment::where('post_id',$request->query('name'))->first();

        // return response()->json([

        //    $postALL,
        //    $comments

        //   ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, $postId)
    {
        $post = $user->posts()->findOrFail($postId); //для одного 

        return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function selfUpdatePost(PostCreatRequest $request, User $user, $postId)
    {
        //поля лишнее картинку storeg like 
        $post = $user->posts()->findOrFail($postId);
        //    $post = $request->user();

        $post->title = $request['title'];
        $post->contente= $request['tcontente'];
        $post->title = $request['title'];
        $post->save();


        return PostResource::make($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function selfDestroyPost(PostCreatRequest $request, User $user, $postId)
    {
        
        $post = $user->posts()->findOrFail($postId);//для одного 
        $post->delete();
    
        return response()->json([
          'status' => 'ok',
        ], 200);
    }

}