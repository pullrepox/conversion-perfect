<?php

function jsonResponse($isSuccess, $statusCode=200, $message='', $data=[]){
    return response()->json([
        'success'=>$isSuccess,
        'message'=> $message,
        'data' => $data,
    ],$statusCode);
}

function user(){
//    return resolve('user');
    return \Illuminate\Support\Facades\Auth::user();
}

function getSliderCode($slider){
    return '<script data-cfasync="false" src="'.url('/').'/sliders/'.$slider->id.'"></script>';
}

function getArrayValue($array,$key,$default){
    return isset($array[$key])?$array[$key]:$default;
}

function routeGroup(){
    $route = url()->current();
    $urlPart = explode('/',$route)[3];
    switch($urlPart){
        case 'sliders':
        case 'bars':
        case 'pages':
        case 'groups':
            return 'slider';
        case 'reports':
            return 'reports';
        case 'settings':
        case 'domain':
        case 'integration':
            return 'settings';
        case 'bonuses':
            return 'bonuses';
        case 'support':
        case 'faq':
            return 'faq';
        case 'account':
            return 'account';
        default:
            return 'dashboard';

    }
}

use Illuminate\Support\Facades\DB;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route, $output = 'active')
    {
        if (is_array($route)) {
            $check = 0;
            for ($i = 0; $i < count($route); $i++) {
                if (Route::currentRouteName() == $route[$i]) {
                    $check = 1;
                    break;
                }
            }
            if ($check) {
                return $output;
            } else {
                return '';
            }
        } else {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }
        
        return '';
    }
}

if (!function_exists('isExpendRoute')) {
    function isExpendRoute($route)
    {
        if (is_array($route)) {
            $check = 0;
            for ($i = 0; $i < count($route); $i++) {
                if (Route::currentRouteName() == $route[$i]) {
                    $check = 1;
                    break;
                }
            }
            
            if ($check) {
                return 'true';
            } else {
                return 'false';
            }
        } else {
            if (Route::currentRouteName() == $route) {
                return 'true';
            }
        }
        
        return 'false';
    }
}

if (!function_exists('isExpendResource')) {
    function isExpendResource($route, $except = true)
    {
        $check = 0;
        
        if (is_array($route)) {
            for ($i = 0; $i < count($route); $i++) {
                if ($except)
                    $resource = [$route[$i], $route[$i] . '.index', $route[$i] . '.create', $route[$i] . '.edit'];
                else
                    $resource = [$route[$i], $route[$i] . '.index', $route[$i] . '.create', $route[$i] . '.show', $route[$i] . '.edit'];
                
                for ($j = 0; $j < count($resource); $j++) {
                    if (Route::currentRouteName() == $resource[$j]) {
                        $check = 1;
                        break;
                    }
                }
                
                if ($check == 1)
                    break;
            }
            
            if ($check) {
                return 'true';
            } else {
                return 'false';
            }
        } else {
            if ($except)
                $resource = [$route, $route . '.index', $route . '.create', $route . '.edit'];
            else
                $resource = [$route, $route . '.index', $route . '.create', $route . '.show', $route . '.edit'];
            
            for ($j = 0; $j < count($resource); $j++) {
                if (Route::currentRouteName() == $resource[$j]) {
                    $check = 1;
                    break;
                }
            }
            
            if ($check) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }
}

if (!function_exists('isActiveResource')) {
    function isActiveResource($route, $except = true, $output = 'active')
    {
        $check = 0;
        
        if (is_array($route)) {
            for ($i = 0; $i < count($route); $i++) {
                if ($except)
                    $resource = [$route[$i], $route[$i] . '.index', $route[$i] . '.create', $route[$i] . '.edit'];
                else
                    $resource = [$route[$i], $route[$i] . '.index', $route[$i] . '.create', $route[$i] . '.show', $route[$i] . '.edit'];
                
                for ($j = 0; $j < count($resource); $j++) {
                    if (Route::currentRouteName() == $resource[$j]) {
                        $check = 1;
                        break;
                    }
                }
                
                if ($check == 1)
                    break;
            }
            
            if ($check) {
                return $output;
            } else {
                return '';
            }
        } else {
            if ($except)
                $resource = [$route, $route . '.index', $route . '.create', $route . '.edit'];
            else
                $resource = [$route, $route . '.index', $route . '.create', $route . '.show', $route . '.edit'];
            
            for ($j = 0; $j < count($resource); $j++) {
                if (Route::currentRouteName() == $resource[$j]) {
                    $check = 1;
                    break;
                }
            }
            
            if ($check) {
                return $output;
            } else {
                return '';
            }
        }
    }
}

if (!function_exists('isSupperAdmin')) {
    function isSupperAdmin()
    {
        if (auth()->user()->email == config('site.admin_email')) {
            return true;
        }
        
        return false;
    }
}

if (!function_exists('isAdminUserByEmail')) {
    function isAdminUserByEmail($userEmail)
    {
        return $userEmail == config('site.admin_email');
    }
}

if (!function_exists('getSecureRedirect')) {
    function getSecureRedirect()
    {
        if (config('app.env') == 'production') {
            return 'https://';
        } else {
            return 'http://';
        }
    }
}

if (!function_exists('secure_redirect')) {
    function secure_redirect($url)
    {
        if (config('site.ssl_tf')) {
            $server_protocol = 'http://';
            $secure_protocol = 'https://';
            $secure_url = str_replace($server_protocol, $secure_protocol, $url);
            return $secure_url;
        } else {
            return $url;
        }
    }
}

if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        
        $string = [
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
        
        if (!$full) $string = array_slice($string, 0, 1);
        
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
