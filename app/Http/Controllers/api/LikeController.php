<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\api;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CommentCreatRequests;
use App\Http\Resources\Api\CommentResource;
use App\Http\Requests\Api\CommentCreatRequest;

class LikeController extends Controller
{
    public function index()
    {
       // $user = User::first();
        $post = Post::with('userLikes')->first();
      //  $post->userLikes()->get();  j
       // return $post;

        //$user = User::first();
        // return $user;
        $comment = Comment::with('userLikes')->find(2);
            return  $post;

        //return $Comment->CommentLikes()->get(); //return  []
        // $user=User::first();
        // $post=Post::first();
        // $post->userLikes()->get()
        // $post->userLikes()->toggle($user)
        // $post->userLikes()->count()
        // $post=Post::withCount('userLikes')->first();
//         > App\Models\Comment::first()->userLikes()->attach(User::first())
// [!] Aliasing 'User' to 'App\Models\User' for this Tinker session.
// = null
    }
}
