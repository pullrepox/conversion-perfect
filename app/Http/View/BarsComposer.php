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
        
        $custom_links = [
            0  => 'https://' . auth()->user()->subdomain . '.cnvp.me/',
            -1 => 'http://' . auth()->user()->subdomain . '.cnvp.in/'
        ];
        
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
        
        $group_list[0] = [
            'id'   => '0',
            'name' => 'All Bars'
        ];
        $groups = auth()->user()->groups;
        if ($groups) {
            foreach ($groups as $key => $g_row) {
                $group_list[($key + 1)] = [
                    'id'   => $g_row->id,
                    'name' => $g_row->name,
                ];
            }
        }
        
        $sys_temp_avail = array_search(auth()->user()->email, explode(',', trim(config('site.sys_temp_creators')))) !== false;
        
        $view->with('group_list', $group_list);
        $view->with('timezone_list', $timezone_list);
        $view->with('custom_links', $custom_links);
        $view->with('responder_list', $responder_list);
        $view->with('sys_temp_avail', $sys_temp_avail);
    }
}
