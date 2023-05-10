<?php

namespace App\Http\Controllers\api;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\SubscriptionResource;
use App\Http\Requests\Api\PostsCreatRequest;
use PhpParser\Node\Expr\AssignOp\Pow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function indexProfiles( Request $request)
    {
        $indexProfiles = DB::table('profiles')->get();

         return SubscriptionResource::collection($indexProfiles);
    }

}
