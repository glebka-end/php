<?php

namespace App\Http\Controllers\api;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Api\CommentResource;
use App\Http\Requests\Api\CommentsCreatRequests;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
  public function store(CommentsCreatRequests $request, $postId)
  {
    // $post = $user->posts()->create([sss
    //     'title' => $request->title,
    //     'contente' => $request->contente,
    //     'image' => $request->image,
    //     'likes' => 0,
    //     'isPublished' => 1,
    // ]);

    $comment = Comment::create([
      'user_id' => $request->user()->id,
      'post_id' => $postId,
      'comment' => $request->comment,
      // $comment = $postId->comments()->create([    return  "message": "Call to a member function comments() on string",
      //   'user_id' => $request->user()->id,
      //   'comment' => $request->comment,

    ]);

    return CommentResource::make($comment);
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


  public function index(Request $request, int $postId)
  {
    //$comment = $postId->comments()->paginate();
   // $commentt = Comment::withCount('userLikes');
  
    $comment = Comment::where('post_id', $postId)->withCount('userLikes')->get();
    return CommentResource::collection($comment);


  }

  public function show(Post  $postId, $commentId,User $user)
  {
   // $comment =  $postId->comments()->findOrFail($commentId); //для одного 
   $comment = Comment::withCount('userLikes')->find($commentId);
    return CommentResource::make($comment);
  }

  public function update(CommentsCreatRequests $request, Post  $postId, $commentId)
  {
    $user = $request->user();
    $comment =  $postId
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
  public function destroy(Post  $postId, $commentId)
  {

    $comment =  $postId->comments()->findOrFail($commentId); //для одного 
    $comment->delete();

    return response()->json([
      'status' => 'ok',
    ], 200);
  }

  // public function storeLike(Post  $postId, $commentId)
  // {

   

  //   return response()->json([
  //     'status' => 'ok',
  //   ], 200);
  // }
  public function storeLike ($commentId, Request $request, User $user)
    {
      $comment =  $commentId
      ->comments()
      ->where('user_id', $user->id)
      ->findOrFail($commentId);

        $user = $request->user();
         DB::table('likables')->insert(
            ['likable_type' => 'App\Models\Comment ', 'user_id' => $user->id, 'likable_id' => $commentId]
        );
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
