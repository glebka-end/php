<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;//


class friend extends Model
{
    use HasFactory;

    public function posts(): HasMany//potsssss
    {
        return $this->hasMany(Post::class);//
    }
}
