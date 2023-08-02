<?php

namespace App\Http\Controllers\api;
use App\Models\Profile;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\PostsCreatRequest;
use PhpParser\Node\Expr\AssignOp\Pow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(PostsCreatRequest $request)
    {
        //  return $request;
       $path = Storage::putFile('attachments/' . Carbon::now()->format('Y-m-d'), $request->file('immage'), 'public');
        $user = $request->user();
        $post = $user->posts()->create([
            'title' => $request->title,
            'contente' => $request->contente,
            'image' => $path,
            'isPublished' => 1,
        ])
            ->loadCount('userLikes')
            ->load('user');

        return PostResource::make($post->loadCount('userLikes'));
    }
    public function getPosts( User $user,Request $request)
    {
        $user = $request->user();
        $posts = Post::where('user_id', $user->id)
            ->withCount(['userLikes'])
            ->with(['user','comments'])
            ->get();
        return PostResource::collection($posts);
    }
    public function getPostsFriend( Request $request,$profileId)
    {
        $profileId = Profile::findOrFail($profileId);
        $userr = $profileId->user_id;
        $posts = Post::where('user_id', $userr)
            ->withCount(['userLikes'])
            ->with(['user','comments'])
            ->get();
        return PostResource::collection($posts);
    }
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $posts = Post::where('user_id', $userId)
            ->withCount(['userLikes'])
            ->with(['user','comments'])
            ->get();

        return PostResource::collection($posts);
    }

    public function show($postId)
    {
        $post = Post::findOrFail($postId);
        $post = Post::withCount('userLikes')->find($postId)
            ->load('user')
            ->load('comments');
        return PostResource::make($post);
    }

    public function update(PostsCreatRequest $request, User $user, $postId)
    {
        $user = $request->user();
        $post = $user->posts()->findOrFail($postId);

        $post->update([
            'title' => $request->title,
            'contente' => $request->contente,
            'image' =>  $request->image,
        ]);
        $post = Post::withCount('userLikes')->find($postId)
            ->load('user')
            ->load('comments');

        return PostResource::make($post);
    }

    public function destroy(Request $request, User $user, $postId)
    {
        $user = $request->user();
        $post = $user->posts()->findOrFail($postId);
        $post->delete();
        return response()->json([
            'status' => 'ok',
        ], 200);
    }
    public function storeLike($postId, Request $request, User $user)
    {
        $user = $request->user();
        Post::findOrFail($postId);
        $result =  $user->postsLike()->toggle($postId);

        return response()->json([
            'status' => count($result['attached']) === 0 ? false : true,
        ]);
    }

    public function showLike(int $postId, Request $request, User $user)
    {
    }
}
