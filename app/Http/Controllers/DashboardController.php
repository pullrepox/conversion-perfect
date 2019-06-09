<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function dashboard(){
        $user = Session::get('user');
        return view('backend.dashboard',['user'=>$user]);
    }
}
