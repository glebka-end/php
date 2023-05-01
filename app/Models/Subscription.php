<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;//
use Illuminate\Database\Eloquent\Relations\HasOne;//
use Illuminate\Database\Eloquent\Relations\MorphToMany;//
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Subscription extends Model
{
    use HasFactory;

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'id');
    }

    public function c():HasMany
    {
        return $this->HasMany(Profile::class, 'to_profile_id');
    }
}
