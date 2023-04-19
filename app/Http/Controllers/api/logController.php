<?php

namespace App\Http\Controllers\api;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;
use App\Models\Post_comment_like;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
//use App\Http\Resources\RegistrationResourse;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class logController extends Controller

{
    public function fill(Request $request)
    {
        //    // return 'login';
        //     $user = User::find(20);
        //    // return $user;
        // $userDob = $user->profile->status;
        // return $userDob;
        // //$userBio = $user->profile->bio;
        $profile = new Profile();
        $profile->status = '20-03-1999';

        $user = User::find(20);
        $user->profile()->save($profile);
    }

    public function tabl(Request $request)
    {
        //    use App\Models\Comment;
        // $post = Post::find(12);
        // foreach ($post->post_comment_likes as $post_comment_likes) {
        //     // ...
        // }
        //return $post;
       

        $comment = Post_comment_like::find(12);
       // $comment1 = Comment::find(12);
        $commentable = $comment->post_comment_like_tabl;
     //   return $comment1 ;
        return $commentable;
    }
}
