<?php

namespace App\Http\View;

use App\Integration;
use App\Models\Utils;
use Illuminate\View\View;

class BarsComposer
{
    public function compose(View $view)
    {
        $timezone_list = Utils::timeZones();
        
        $custom_links = config('site.custom_link');
    
        $responder_list = [
            'none' => 'None'
        ];
        $integration_list = Integration::where('user_id', auth()->user()->id)->get();
        if ($integration_list) {
            foreach ($integration_list as $row) {
                $responder_list[$row->responder_id] = $row->name;
            }
        }
        $responder_list['conversion_perfect'] = 'Conversion Perfect';
        
        $view->with('timezone_list', $timezone_list);
        $view->with('custom_links', $custom_links);
        $view->with('responder_list', $responder_list);
    }
}
