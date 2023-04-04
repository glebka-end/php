<?php

namespace App\Http\Controllers\api;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Http\Resources\RegistrationResourse;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class logController extends Controller

{
    public function login (Request $request)
    {
    return 'login';
    }
}
