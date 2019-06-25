<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    //
    public function index()
    {
        if (auth()->check()) {
            $domain = strtolower(auth()->user()->subdomain);
            if ($domain == '' || is_null($domain)) {
                return redirect()->to('/sub-domain-register', 302, [], config('site.ssl_tf'))->send();
            }
            
            return redirect()->to('/dashboard', 302, [], config('site.ssl_tf'))->send();
        } else {
            return view('auth.login');
        }
    }
}
