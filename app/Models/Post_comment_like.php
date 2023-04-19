<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;//

class Post_comment_like extends Model
{
    use HasFactory;

    public function post_comment_like_tabl():MorphTo
    {
        return $this->morphTo();
    }
}
