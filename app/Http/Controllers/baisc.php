<?php

namespace App\Http\Controllers;
use app\Models\users;
use Illuminate\Http\Request;

class baisc extends Controller
{
     public function index()
    {
    return users::all();
    //return 'wdwdwa';
    }
}
