<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //Logout
    public function Logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout');    }
}
