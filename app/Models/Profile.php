<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;//
use Illuminate\Database\Eloquent\Relations\HasOne;//
use Illuminate\Database\Eloquent\Relations\MorphToMany;//
class Profile extends Model
{
    use HasFactory;
    // protected $table = 'profiles';
    //  protected $fillable = ['status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subscriptions(): HasMany//potsssss
    {
        return $this->hasMany(Subscription::class, 'to_profile_id');//
    }

}
