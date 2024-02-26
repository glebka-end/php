<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\SubscriptionResource;
use App\Http\Resources\Api\ProfilsResource;
use App\Http\Requests\Api\PostsCreatRequest;
use App\Models\Profile;
use PhpParser\Node\Expr\AssignOp\Pow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function getProfile(Request $request)
    {
        $user = $request->user();
       return $profile = $user->profile;
    }
    public function indexProfiles(Request $request)
    {
        $indexProfiles = DB::table('profiles')->get();

        return SubscriptionResource::collection($indexProfiles);
    }

    public function  showProfiles(Request $request, $to_Profile)
    {
        $user = $request->user();
        $profile = $user->profile;
        $to_Profile = Profile::findOrFail($to_Profile);

        if (DB::table('profiles') //нужно переделать них.... не понятно ) но работает 
            ->where('id',  $to_Profile->id) //пока оставим так 
            ->where('status', 1)
            ->exists()
        ) {
            return SubscriptionResource::make($to_Profile); //all profile
        }
        if (DB::table('profiles')
            ->where('id',  $to_Profile->id)
            ->where('status', 2)
            ->exists()
        ) {
            $user = $request->user();
            $profile = $user->profile;

            if (DB::table('subscriptions')
                ->where('to_profile_id',  $to_Profile->id)
                ->where('from_profile_id', $profile->id)
                ->where('statuse', 1)
                ->exists()
            ) {
                return SubscriptionResource::make($to_Profile); //all profile
            } {
                return ProfilsResource::make($to_Profile); //cloc=k profile
            }
        }
        //  return SubscriptionResource::collection($indexProfiles);
    }



    public function updateProfiles(Request $request, User $user)
    {
        $user = $request->user();
        $profile = $user->profile;
        // return  $request;
        $profile->update([
            'first_name' => $request->first_name,
            'status' => $request->status,
            'is_online'=> $request->is_online,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'gender'=>$request->gender,
            //  'gender' => $request->gender,
            // 'image' =>  $request->image,
        //     "first_name": "123zxc",
        //     "last_name": "pytko",
        //      "age": "13",
        //    "gender": "m"
        
        ]);
        return $profile;
        return SubscriptionResource::make($profile);
    }
}
