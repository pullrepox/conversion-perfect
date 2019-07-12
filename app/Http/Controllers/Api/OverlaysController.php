<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use App\Http\Repositories\TinyMinify;
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
        
        if ($bar && !is_null($bar)) {
            return view('users.track-partials.preview-html', compact('bar'));
        } else {
            abort(404, 'No existing is matched Conversion Bar.');
        }
        
        return response('No existing is matched Conversion Bar.');
    }
    
    public function getCBScriptCode($id)
    {
        $bar = $this->barRepo->model()->find($id);
        
        if ($bar && !is_null($bar)) {
            $html_code = view('users.track-partials.script', compact('bar'));
            $code = TinyMinify::html($html_code);
            
            header('Content-Type: application/javascript; charset=utf-8;');
            exit('document.write("test")');
//            return view('users.track-partials.preview-scripts', compact('code'));
        } else {
            abort(404, 'No existing is matched Conversion Bar.');
        }
        
        return response('No existing is matched Conversion Bar.');
    }
    
    public function getScriptFrameCode($id)
    {
        $bar = $this->barRepo->model()->find($id);
        
        return view('users.track-partials.preview-layout', compact('bar'));
    }
}
