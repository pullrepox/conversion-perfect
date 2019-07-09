<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AmemberAPI;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request)
    {
        $aMemberClient = new AmemberAPI();
        
        $response = $aMemberClient->checkAccessByLogin($request->input('email'), $request->input('password'));
        
        if ($response) {
            $user = User::findOrCreate($response->email, $response);
            
            if ($user) {
                Auth::login($user, $request->input('remember') == 'on');
                
                return redirect()->intended($this->redirectPath(), 302, [], config('site.ssl_tf'));
            } else {
                $request->session()->flash('error', trans('auth.failed'));
                
                Auth::logout();
                
                return $this->sendFailedLoginResponse($request);
            }
        } else {
            $request->session()->flash('error', trans('auth.failed'));
    
            Auth::logout();
    
            return $this->sendFailedLoginResponse($request);
        }
    }
}
