<?php

namespace App\Http\Controllers\api;

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
        $path =  Storage::putFile('attachments/' . Carbon::now()->format('Y-m-d'), $request->file('a'), 'public');

        $user = $request->user();
        $post = $user->posts()->create([
            'title' => $request->title,
            'contente' => $request->contente,
            'image' => $path,
            'isPublished' => 1,
        ])
            ->loadCount('userLikes')
            ->load('user');

        //return PostResource::make($post->loadCount('userLikes'));
        return PostResource::make($post->loadCount('userLikes'));
    }


    public function index(int $user)
    {

        // $posts = $user->posts()->paginate();
        $posts = Post::where('user_id', $user)->get()
            ->loadCount('userLikes')
            ->load('user')
            ->load('comments');
        return PostResource::collection($posts);
    }

    public function show(User $user, $postId)
    {
        $post = $user->posts()->findOrFail($postId);
        // $postq = $user->posts()->findOrFail($postId); //для одного 
        $post = Post::withCount('userLikes')->find($post);
        return PostResource::make($post);
    }

    public function update(PostsCreatRequest $request, User $user, $postId)
    {

        $user = $request->user();
        $post = $user->posts()->findOrFail($postId);

        $post->title = $request->title;
        $post->contente = $request->contente;
        $post->save();
        // $post->update([
        //     'title' => $request->title,
        //     'contente' => $request->content,     // есть такой вариант 
        //     'title' => $request->title,
        // ]);
        return PostResource::make($post);
    }

    public function destroy(PostsCreatRequest $request, User $user, $postId)
    {
        $user = $request->user();
        $post = $user->posts()->findOrFail($postId); //для одного 
        $post->delete();
        return response()->json([
            'status' => 'ok',
        ], 200);
    }

    public function fil(Request $request)
    {

        //  $path = $request->file('a')->store('public');
        //  return $path; 
        //  return Storage::url('fWd7QQm1EfV2RIxk4GOgNVd0Wt73S7sPMQMligbn.png');
        $file = $request->file('a');

        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        return $name;
        //  Storage::disk('public/srorage')->url('APP_URL');
        //  return Storage::url('fWd7QQm1EfV2RIxk4GOgNVd0Wt73S7sPMQMligbn.png');

        //  echo asset('storage/file.jpg');
        //   return Storage::download('public');
        //  return Storage::download('file.jpg', $name, $headers);
        //   $p = $request->store('uploads', 'public');
        //   return $p;
        //    return PostResource::make($post);
    }


    public function storeLike(int $postId, Request $request, User $user)
    {
        $user = $request->user();
        $a = 'App\Models\Post';
        if ($v = DB::table('likables')->where('user_id',  $user->id)
            ->where('likable_id', $postId)
            ->where('likable_type', $a)->exists()
        ) {
            return response()->json([
                'like' => 'уже поставил',
            ], 200);
            //    $v= DB::table('likables')->get(
            //         ['likable_type' => 'App\Models\Post ', 'user_id' => $user->id, 'likable_id' => $postId]
            //     );
            // $v->delete();
        } else {
            DB::table('likables')->insert(
                ['likable_type' => 'App\Models\Post ', 'user_id' => $user->id, 'likable_id' => $postId]
            );
            return response()->json([
                'like' => '+1',
            ], 200);
        }
    }
    public function showLike(int $postId, Request $request, User $user)
    {
        //     $a= 'App\Models\Post';
        //     $user = $request->user();
        //     DB::table('likables')
        //       ->where('likable_type', $a)
        //       ->where('user_id' ,$user->id)
        //       ->where('likable_id' , $postId);
        //       //->findOrFail($commentId);
        // //return 'ee';
        //     //  $comment = $scomment->update([
        //     //  'comment' => $request->comment,
        //     // ]);
        //     DB::table('likables')->insert(
        //         ['likable_type' => 'App\Models\Post ', 'user_id' => $user->id, 'likable_id' => $postId]
        //     );
        //    $post = Post::find(13);
        //   $user = User::find(1);
        //  $post->userLikes()->toggle($user);
        //$post=1;
        //   if (){
        //     return '1w';
        //   }
        // return $post->userLikes()->get();
        //return $post = $post->userLikes()->count();
        //     $post->userLikes()->toggle($user);
        //  return  $post;
        // return   $post->userLikes()->toggle($user);
        // $post->userLikes()->count($user);

        // return response()->json([
        //     'status' => 'ok',
        // ], 200);
    }
}
