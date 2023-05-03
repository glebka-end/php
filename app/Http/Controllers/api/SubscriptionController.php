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
use App\Http\Resources\Api\SubscriptionResource;
use App\Http\Requests\Api\CommentsCreatRequests;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

class SubscriptionController extends Controller
{
    public function indexFollwing(Request $request,  $userId) //ты подписан 
    {
        $profile = profile::findOrFail(1);
        $subscriptions = $profile->subscriptions()
            ->where('statuse', '=', 1)
            ->paginate();
        //  ->withCount();
        return SubscriptionResource::collection($subscriptions);
        // // ->withCount('to_profile_id');
        // $friend_count = DB::table('subscriptions')
        //     ->where('to_profile_id', '=', 1)
        //     ->where('statuse', '=', 1);

        // //     // ->loadCount('c');
        // //     // ->load('user')
        // //     // ->load('comments');
        // $posts = Subscription::where('to_profile_id', 1)
        //     ->where('statuse', '=', 1)
        //     ->get();
    }
    public function indexFollowers(Request $request,  $userId) //на тебя 
    {
        $profile = profile::findOrFail(1);
        $subscriptions = $profile->subscribers()
            ->where('statuse', '=', 1)
            ->paginate();

        return SubscriptionResource::collection($subscriptions);
    }

    public function storeFollwing(Request $request,  $profileId)
    {
        $user = $request->user();
      return  $post = $user->Profile()->paginate();//->findOrFail($postId);
        $profile2 = profile::findOrFail($profileId);
        return $result = $profile2->a()
            ->toggle([1 => ['statuse' => 2]]);

        return SubscriptionResource::collection($subscriptions);
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
