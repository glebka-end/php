<?php

namespace App\Http\Controllers\api;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CommentCreatRequests;
use App\Http\Resources\Api\CommentResource;
use App\Http\Requests\Api\CommentCreatRequest;


class CommentController extends Controller
{
  public function store(CommentCreatRequests $request, $postId)
  {
    //return $postId;
    //$path = $request->file('a')->store('public');
    //  return $path;
    // $user = $request->user();
    // $post = $user->posts()->create([
    //     'title' => $request->title,
    //     'contente' => $request->contente,
    //     'image' => $request->image,
    //     'likes' => 0,
    //     'isPublished' => 1,
    // ]);

    $Comment = Comment::create([

      'user_id' => $request->user()->id,
      'post_id' => $postId,
      'comment' => $request->comment,
    
    ]);
    return CommentResource::make($Comment);
    


    // $user = $request->user();
    // $poste = $user->comments()->create([
    //     'comment' => $request->contente,
    // ]);
    //    return $poste;

    //    $post = Post::updated ([
    //         'title' => $request->title,
    //         'user_id'=> $request->user()->id,
    //         'contente' => $request->contente,
    //         'image' => $request->image,
    //         'likes' => 0,
    //         'isPublished' => 1,
    //     ]);
    //  return PostResource::make($post);
  }


  public function index(Request $request, Post $post)
  {
    $comment = $post->comments()->paginate();
    return CommentResource::collection($comment);

    //  $postt=1;
    //  $postALL = Post::find($postt);
    //  $comments = Post::find($postt)->comments;

  }
  //     // $comments= $comments->comment;
  //     //$post= Post::all();
  //     // $Comment=comment::all();
  //     // $post= Post::where('id')->get();
  //     // return $post;
  //     //  return $Comment=comment::find(1);
  //     // $user_name = Comment::where('post_id',$request->query('name'))->first();
  //     // return response()->json([
  //     //    $postALL,
  //     //    $comments
  //     //   ], 201);
  // }

  
  public function show(Post $post, $commentId)
  {
    $comment = $post->comments()->findOrFail($commentId); //для одного 
    return CommentResource::make($comment);
  }

  public function selfUpdateComment(CommentCreatRequests $request, Post $post, $commentId)
  {
    $user = $request->user();
 
    $comment = $post
      ->comments()
      ->where('user_id', $user->id)
      ->findOrFail($commentId);

    $comment = $comment->update([
      'comment' => $request->comment,
    ]);
    // $comment->comment = $request['comment'];
    // $comment->save();

    return CommentResource::make($comment);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function selfDestroyComment(Post $post, $commentId)
  {

    $comment = $post->comments()->findOrFail($commentId); //для одного 
    $comment->delete();

    return response()->json([
      'status' => 'ok',
    ], 200);
  }

  // public function fil(Request $request)
  // {

  //     //  $path = $request->file('a')->store('public');
  //     // return $path;
  //   //  Storage::disk('public/srorage')->url('APP_URL');
  //     return Storage::url('fWd7QQm1EfV2RIxk4GOgNVd0Wt73S7sPMQMligbn.png');

  //     //  echo asset('storage/file.jpg');
  //     return Storage::download('public');
  //     //  return Storage::download('file.jpg', $name, $headers);
  //     $p = $request->store('uploads', 'public');
  //     return $p;
  //     //    return PostResource::make($post);
  // }
}
