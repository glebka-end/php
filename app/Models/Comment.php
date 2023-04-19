<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    use HasFactory;
    protected $table ="comments";
    protected $guarded =[];


    public function post_comment_likes(): MorphMany
    {
        return $this->morphMany(post_comment_like::class, 'post_comment_like_tabl');
    }
}
