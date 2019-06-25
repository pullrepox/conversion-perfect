<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $redirectTo = '/dashboard';
    
    public function index()
    {
        return view('users.dashboard');
    }
    
    public function subDomainRegister()
    {
        return view('users.sub-domain-register');
    }
    
    public function setSubDomainRegister(Request $request)
    {
        $this->validate($request, [
            'sub_domain' => 'required|string|min:3|max:25|alpha_num|unique:users,subdomain',
        ]);
        
        $user = auth()->user();
        $user->subdomain = $request->input('sub_domain');
        $user->save();
        
        return redirect()->intended($this->redirectTo, 302, [], config('site.ssl_tf'));
    }
}
