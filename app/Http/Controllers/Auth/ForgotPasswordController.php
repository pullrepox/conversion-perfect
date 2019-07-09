<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ApiRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    
    use SendsPasswordResetEmails;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        
        $apiRepo = new ApiRepository();
        $response = $apiRepo->sendResetPasswordEmail($request->input('email'));
        
        if ($response->ok) {
            Toastr::success('Password reset email sent to user', 'Success');
            return redirect()->back();
        } else {
            Toastr::error($response->message, 'Error');
            return redirect()->back();
        }
    }
}
