<?php

namespace App\Http\Controllers;

use App\Models\AmemberAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function login()
    {
        return view('frontend.profile.login');
    }

    public function processLogin(Request $request)
    {
        $amemberClient = new AmemberAPI();
        $response = $amemberClient->checkAccessByLogin($request->get('email'), $request->get('pass'));
        Session::put('user', $response);
        return redirect(route('dashboard'));
    }

    public function logout(){
        Session::remove('user');
        return redirect(route('login'));
    }
}
