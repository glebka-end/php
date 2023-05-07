<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;//
use Illuminate\Database\Eloquent\Relations\HasOne;//
use Illuminate\Database\Eloquent\Relations\MorphToMany;//
use Illuminate\Database\Eloquent\Relations\belongsToMany;//
use Illuminate\Database\Eloquent\Relations\BelongsTo;//

class Profile extends Model
{
    use HasFactory;
    // protected $table = 'profiles';
    //  protected $fillable = ['status'];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function subscribers(): belongsToMany//potsssss
    {
        return $this->belongsToMany(Profile::class, 'subscriptions', 'to_profile_id' ,'from_profile_id')->withPivot('statuse');
    }

    public function subscriptions(): belongsToMany//potsssss
    {
        return $this->belongsToMany(Profile::class, 'subscriptions', 'from_profile_id' ,'to_profile_id')->withPivot('statuse');
    }
    
}
