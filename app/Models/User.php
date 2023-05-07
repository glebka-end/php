<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;//
use Illuminate\Database\Eloquent\Relations\HasOne;//
use Illuminate\Database\Eloquent\Relations\MorphToMany;//

class User extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable;
//protected $fillable=['name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(): HasMany//potsssss
    {
        return $this->hasMany(Post::class, 'user_id');//
    }
    public function comments(): HasMany//potsssss
    {
        return $this->hasMany(Post::class, );//
    }
   
    public function profile():HasOne
{
    return $this->hasOne(Profile::class);
}

public function friends(): HasMany//potsssss
    {
        return $this->hasMany(Friend::class, );//
    }
   
public function CommentLike(): MorphToMany
{
    return $this->morphedByMany(Comment::class, 'likable');
}

public function postsLike(): MorphToMany
{
    return $this->morphedByMany(Post::class, 'likable');
}
}

