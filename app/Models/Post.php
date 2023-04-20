<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\HasMany;//
use Illuminate\Database\Eloquent\Relations\MorphTo;//
use Illuminate\Database\Eloquent\Relations\MorphToMany;//

class Post extends Model
{
    use HasFactory;
    protected $table ="posts";
    protected $guarded =[];

    public function comments(): HasMany//
    {
        return $this->hasMany(Comment::class);//
    }//
    
    
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
