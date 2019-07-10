<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bar;
use App\User;
use Illuminate\Http\Request;

class OverlaysController extends Controller
{
    public function index($sub_domain, $link_name, Request $request)
    {
        $user = User::where('subdomain', $sub_domain)->first();
        $bar = Bar::where('user_id', $user->id)->where('custom_link_text', $link_name);
        
        
    }
}
