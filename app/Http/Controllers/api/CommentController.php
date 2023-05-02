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
    $post = Post::findOrFail($postId);
    Comment::where('post_id', $postId)->withCount('userLikes')->get();

    $comment = $post->comments()->create([
      'user_id' => $request->user()->id,
      'comment' => $request->comment,
    ])
      ->loadCount('userLikes')
      ->load('user');

    return CommentResource::make($comment->loadCount('userLikes'));
  }


  public function index(Request $request, Post  $postId)
  {
    $comment = $postId->comments()->paginate()
      ->loadCount('userLikes')
      ->load('user');

    return CommentResource::collection($comment);
  }

  public function update(CommentsCreatRequests $request, Post  $postId, $commentId,)
  {
    $user = $request->user();
    $comment =  $postId
      ->comments()
      ->where('user_id', $user->id)
      ->findOrFail($commentId);
    $comment = $comment->update([
      'comment' => $request->comment,
    ]);


    return CommentResource::make($comment);
  }


  public function destroy(Post  $postId, $commentId, User $user, Request $request)
  {
   $user = $request->user();
    $comment =  $postId
      ->comments()
      ->where('user_id', $user->id)
      ->findOrFail($commentId);
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
  public function storeLike($commentId, Request $request, User $user)
  {
    $user = $request->user();
    Comment::findOrFail($commentId);
    $result =  $user->commentLike()->toggle($commentId);

    return response()->json([
      'status' => count($result['attached']) === 0 ? false : true,
    ]);
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
