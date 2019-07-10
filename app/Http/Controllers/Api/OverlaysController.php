<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use App\User;

class OverlaysController extends Controller
{
    protected $barRepo;
    
    public function __construct(BarsRepository $barsRepository)
    {
        $this->barRepo = $barsRepository;
    }
    
    public function index($sub_domain, $link_name)
    {
        $user = User::where('subdomain', $sub_domain)->first();
        $bar = $this->barRepo->model()->where('user_id', $user->id)->where('custom_link_text', $link_name)->first();
        
        return view('users.track-partials.preview-html', compact('bar'));
    }
}
