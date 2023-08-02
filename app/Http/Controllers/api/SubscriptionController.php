<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Subscription;
use App\Models\Profile;
use App\Models\User;
use App\Models\Post;
use App\Http\Resources\Api\CommentResource;
use App\Http\Resources\Api\SubscriptionResource;
use App\Http\Requests\Api\CommentsCreatRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
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
        // ->withCount('Followers');

        return SubscriptionResource::collection($subscriptions);
    }
    public function indexFollwingById(Request $request, $profileId) // подписки другого профиля  
    {
        $user = $request->user();
        $profileId = Profile::findOrFail($profileId);


        $subscriptions = $profileId->subscriptions()
            ->where('statuse', '=', 1)
            ->paginate();
        // ->withCount('Followers');

        return SubscriptionResource::collection($subscriptions);
    }
    public function indexFollowers(Request $request,  $userId) //на тебя 
    {
        $user = $request->user();
        $profile = $user->profile; //заменить ВСЕ

        $subscriptions = $profile->subscribers()
            ->where('statuse', '=', 1)
            //->withCount('Followers')
            ->paginate();

        return SubscriptionResource::collection($subscriptions);
    }

    public function signedOrNot(Request $request, string $profileId): JsonResponse //ты подписан или нет )) 
    {
        $user = $request->user();

        $fromFrofile = $user->profile;
        $toProfile = Profile::findOrFail($profileId);

        $isSubscriptionExists = DB::table('subscriptions')
            ->where('to_profile_id', $toProfile->id)
            ->where('from_profile_id', $fromFrofile->id)
            ->where(function (Builder $query) {
                $query->whereIn('statuse', [1, 2]);
            })
            ->exists();

        return response()->json([
            'status' => $isSubscriptionExists,
        ]);
    }

    public function storeFollwing(Request $request,  $to_profileId)
    {
        $user = $request->user();
        $from_profile = User::find($user->id)->profile;
        $to_profile = Profile::findOrFail($to_profileId);

        if ($from_profile->id === $to_profile->id) {
            return response()->json([
                'status' => '-'
            ]);
        }
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

    public function applicationsIndexFollowers(Request $request,) //просмотр запросов на подписку ) на себя
    {
        $user = $request->user();
        $profile = User::find($user->id)->profile;


        $subscriptions = $profile->subscribers()
            ->where('statuse', '=', 2)
            ->paginate();

        return SubscriptionResource::collection($subscriptions);
    }
    public function acceptTheApplicationsFollowers(Request $request, $profileId) //принять  запрос 
    {
        $user = $request->user();
        $from_profile = User::find($user->id)->profile;
        $profileId = Profile::findOrFail($profileId);

        if (DB::table('subscriptions')
            ->where('to_profile_id',  $from_profile->id)
            ->where('from_profile_id', $profileId->id)
            ->where('statuse', 2)
            ->exists()
        ) {

            DB::table('subscriptions')
                ->where('to_profile_id',  $from_profile->id)
                ->where('from_profile_id',  $profileId->id)
                ->where('statuse',  2)
                ->update(['statuse' => 1]);
            return response()->json([
                'status' => "ok"
            ]);
        } else {
            return response()->json([
                'status' => "-"
            ]);
        }
    }

    public function doesNotAcceptTheApplicationsFollowers(Request $request, $profileId) //не принять или отклонить запрос 
    {

        $user = $request->user();
        $from_profile = User::find($user->id)->profile;
        $profileId = Profile::findOrFail($profileId);

        if (DB::table('subscriptions')
            ->where('to_profile_id',  $from_profile->id)
            ->where('from_profile_id', $profileId->id)
            ->where('statuse', 2)
            ->exists()
        ) {
            DB::table('subscriptions')
                ->where('to_profile_id',  $from_profile->id)
                ->where('from_profile_id',  $profileId->id)
                ->where('statuse',  2)
                ->update(['statuse' => 3]);
            return response()->json([
                'status' => "ok"
            ]);
        } else {
            return response()->json([
                'status' => "-"
            ]);
        }
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
