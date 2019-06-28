<?php

namespace App\Http\View;

use App\Models\Utils;
use Illuminate\View\View;

class BarsComposer
{
    public function compose(View $view)
    {
        $timezone_list = Utils::timeZones();
    
        $view->with('timezone_list', $timezone_list);
    }
}
