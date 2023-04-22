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
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(PostsCreatRequest $request)
    {
        $path =  Storage::putFile('attachments/' . Carbon::now()->format('Y-m-d'), $request->file('a'), 'public');
        // $path = $request->file('a')->store('public');
        //  return $path;
        $user = $request->user();
        $post = $user->posts()->create([
            'title' => $request->title,
            'contente' => $request->contente,
            'image' => $path,
            'isPublished' => 1,
        ]);
        //    $post = Post::updated ([
        //         'title' => $request->title,
        //         'user_id'=> $request->user()->id,
        //         'contente' => $request->contente,
        //         'image' => $request->image,
        //         'likes' => 0,
        //         'isPublished' => 1,
        //     ]);
        return PostResource::make($post);
    }


    public function index(Request $request, User $user)
    {
        $posts = $user->posts()->paginate();
        return PostResource::collection($posts);

        //  $postt=1;
        //  $postALL = Post::find($postt);
        //  $comments = Post::find($postt)->comments;
        //  $ee = $comments->id
        //echo $comments->id;
        // foreach ($comments as $comment) {
        ///    echo $comment;
        // }
        // $comments= $comments->comment;
        //$post= Post::all();
        // $Comment=comment::all();
        // $post= Post::where('id')->get();
        // return $post;
        //  return $Comment=comment::find(1);
        // $user_name = Comment::where('post_id',$request->query('name'))->first()
        // return response()->json([
        //    $postALL,
        //    $comments
        //   ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, $postId)
    {

        //  $post = $user->posts()->findOrFail($postId); //для одного 
        $post = Post::find($postId);
        return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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


    public function showLike($postId, User $user)
    {
        // return  $postId;
        $post = Post::with('userLikes')->find($postId);
        return  $post;

        $post = Post::find(4);
        $user = User::find(1);
        $post->userLikes()->toggle($user);
        //$post->userLikes()->get();
        $post = $post->userLikes()->count();
        // $post->userLikes()->toggle($user);
        return  $post;
        // $post->userLikes()->toggle($user)
        // $post->userLikes()->count()

        // return response()->json([
        //     'status' => 'ok',
        // ], 200);
    }
}
