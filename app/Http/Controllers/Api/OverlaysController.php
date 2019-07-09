<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OverlaysController extends Controller
{
    public function index(Request $request)
    {
        $link_name = $request->route()->parameter('link_name');
        
    }
}
