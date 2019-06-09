<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function login(){
        return view('frontend.profile.login');
    }
}
