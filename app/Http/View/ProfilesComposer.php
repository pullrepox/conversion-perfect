<?php


namespace App\Http\View;


use Illuminate\View\View;

class ProfilesComposer
{
    public function compose(View $view)
    {
        $permissions = auth()->check() && !is_null(auth()->user()->permissions) ? json_encode(auth()->user()->permissions) :
            '{"access":1,"split-test":0,"multi-bar":0,"remove-powered-by":0,"social-buttons":0,"lead-capture":0,"agency":0,"pro-templates":0,"120-templates":0,"240-templates":0,"reseller":0,"maximum-bars":3}';
    
        $view->with('permissions', $permissions);
    }
}
