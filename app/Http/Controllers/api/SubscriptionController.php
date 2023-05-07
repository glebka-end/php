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
    public function indexFollwing(Request $request,) //ты подписан 
    {
        $user = $request->user();
        $profile = User::find($user->id)->profile;

        $subscriptions = $profile->subscriptions()
            ->where('statuse', '=', 1)
            ->paginate();
        //  ->withCount();
        return SubscriptionResource::collection($subscriptions);
    }
    public function indexFollowers(Request $request,  $userId) //на тебя 
    {
        $user = $request->user();
        $profile = User::find($user->id)->profile;

        $subscriptions = $profile->subscribers()
            ->where('statuse', '=', 1)
            ->paginate();

        return SubscriptionResource::collection($subscriptions);
    }

    public function storeFollwing(Request $request,  $to_profileId)
    {
        $user = $request->user();
        $from_profile = User::find($user->id)->profile;
        $to_profile = profile::findOrFail($to_profileId);

        if (DB::table('profiles')
            ->where('id',  $to_profile->id)
            ->where('status', 1)
            ->exists()
        ) {
            $to_profile = $to_profile->id;
            $result = $from_profile->subscriptions()
                ->toggle([$to_profile => ['statuse' => 1]]);

            return response()->json([
                'status' => count($result['attached']) === 0 ? false : true,
            ]);
        } else {
            $to_profile = $to_profile->id;
            $result = $from_profile->subscriptions()
                ->toggle([$to_profile => ['statuse' =>  2]]);

            return response()->json([
                'status' => count($result['attached']) === 0 ? false : true,
            ]);
        }
    }

    public function applicationsIndexFollowers(Request $request,)
    {
        $user = $request->user();
        $profile = User::find($user->id)->profile;

        $subscriptions = $profile->subscribers()
            ->where('statuse', '=', 2)
            ->paginate();

        return SubscriptionResource::collection($subscriptions);
    }
    // public function viewing(Request $request, User $user, int $userId)
    // {
    //     $user = $request->user();
    //     if ($v = DB::table('friends')->where('friend_id',  $user->id)
    //         ->where('user_id', $userId)->exists()

    //     ) {
    //         return response()->json([
    //             'доступно ' => '',
    //         ], 200);
    //     } else {

    //         return response()->json([
    //             'недоступно' => '',
    //         ], 200);
    //     }
    // }
}
