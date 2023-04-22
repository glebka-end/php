<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class Comment extends Model
{
    use HasFactory;
    protected $table ="comments";
    protected $guarded =[];


    // public function post_comment_likes(): MorphMany
    // {
    //     return $this->morphMany(post_comment_like::class, 'post_comment_like_tabl');
    // }


    public function userLikes():MorphToMany
    {
        return $this->morphToMany(User::class, 'likable');
    }
    // $user=User::first();
    // $post=Post::first();
    // $post->userLikes()->get()
    // $post->userLikes()->toggle($user)
    // $post->userLikes()->count()
    // $post=Post::withCount('userLikes')->first();

}

