<?php

namespace App\Http\Controllers\api;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Http\Resources\RegistrationResourse;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class logController extends Controller

{
    public function fill (Request $request)
    {
//    // return 'login';
//     $user = User::find(20);
//    // return $user;
// $userDob = $user->profile->status;
// return $userDob;
// //$userBio = $user->profile->bio;
$profile = new Profile();
$profile->status = '20-03-1999';

$user = User::find(20);
$user->profile()->save($profile);
    }
}
