<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\User;
use App\Models\Post;


use App\Http\Resources\Api\CommentResource;
use App\Http\Requests\Api\CommentsCreatRequests;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function index(Request $request, User $user, int $userId)
    {
        //   return $comments = User::find($userId)->friends;
        //$posts = $user->posts()->paginate();

        // $comment = Comment::withCount('friends')->find($userId);
        //  return CommentResource::make($comment);

        $friend_count = DB::table('friends')
            ->where('user_id', '=', $userId)
            ->count();


        return response()->json([
            'friend_count' => $friend_count,
        ], 200);
    }



    public function viewing(Request $request, User $user, int $userId)
    {$user = $request->user();
        if ($v=DB::table('friends')->where('friend_id',  $user->id)
        ->where('user_id', $userId)->exists()
       
    ) {
       return response()->json([
           'доступно ' => '',
       ], 200);
   
    } else {
       
        return response()->json([
            'недоступно' => '',
        ], 200);
    }
       
    }
}
