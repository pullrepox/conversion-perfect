<?php

namespace App\Http\Controllers;

use App\Models\AmemberAPI;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = User::findOrCreate($response->email, $response);
        if ($user) {
            Auth::login($user);
            return redirect(route('dashboard'));
        } else {
            return redirect()->back()->withErrors('Unable to save user');
        }
        
    }
    
    public function logout()
    {
        Auth::logout();
        Session::remove('user');
        return redirect(route('login'));
    }
    
    public function showResetForm()
    {
        return view('frontend.profile.forgot-password');
    }
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        
        $amemberClient = new AmemberAPI();
        $response = $amemberClient->sendResetPasswordEmail($request->input('email'));
        
        if ($response->ok) {
            Toastr::success('Password reset email sent to user', 'Success');
            return redirect()->back();
        } else {
            Toastr::error($response->message, 'Error');
            return redirect()->back();
        }
        
    }
    
    public function getSubdomainForm()
    {
        return view('frontend.profile.register-subdomain');
    }
    
    public function registerSubdomain(Request $request)
    {
        
        $request->validate([
            'subdomain' => 'required'
        ]);
        
        dd($request->input('subdomain'));
    }
}
