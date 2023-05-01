<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\Subscription;
use App\Models\Profile;
use App\Models\User;
use App\Models\Post;


use App\Http\Resources\Api\CommentResource;

use App\Http\Resources\Api\FriendResource;
use App\Http\Requests\Api\CommentsCreatRequests;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

class FriendController extends Controller
{
    public function index(Request $request,  $userId)


    {
       
        // $user = User::findOrFail(20);
        //return $posts = $user->posts()->paginate();
        $profile = profile::findOrFail(1);
  $profile->subscriptions()->paginate()
            ->where('to_profile_id', '=', 1)
            ->where('statuse', '=', 1);
            
            // ->withCount('to_profile_id');
            $friend_count = DB::table('subscriptions')
                ->where('to_profile_id', '=', 1)
                ->where('statuse', '=', 1);
               
        //     // ->loadCount('c');
        //     // ->load('user')
        //     // ->load('comments');
        $posts = Subscription::where('to_profile_id', 1 )
        ->where('statuse', '=', 1)
        ->get();
        
        



        return FriendResource::collection($posts);
        // $comments = Profile::find($userId);
        //$posts = $user->posts()->paginate();

        // $comment = Comment::withCount('friends')->find($userId);
        //  return CommentResource::make($comment);
        // $user = $request->user();
        // return  $comments->subscriptions()->paginate();
        // return FriendResource::make($comments);
        // $friend_count = DB::table('friends')
        //     ->where('user_id', '=', $userId)
        //     ->count();


        // return response()->json([
        //     'friend_count' => $friend_count,
        // ], 200);
    }



    public function viewing(Request $request, User $user, int $userId)
    {
        $user = $request->user();
        if ($v = DB::table('friends')->where('friend_id',  $user->id)
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
