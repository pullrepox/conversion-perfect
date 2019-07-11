<?php

function jsonResponse($isSuccess, $statusCode = 200, $message = '', $data = [])
{
    return response()->json([
        'success' => $isSuccess,
        'message' => $message,
        'data'    => $data,
    ], $statusCode);
}

function user()
{
    return \Illuminate\Support\Facades\Auth::user();
}

function getSliderCode($slider)
{
    return '<script data-cfasync="false" src="' . url('/') . '/sliders/' . $slider->id . '"></script>';
}

function getArrayValue($array, $key, $default)
{
    return isset($array[$key]) ? $array[$key] : $default;
}

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

if (!function_exists('quickRandom')) {
    function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}

if (!function_exists('calcCountdownTime')) {
    function calcDaysCurrAndGiven($end_date)
    {
        $end_time = strtotime($end_date);
        $now = time();
        $diff = abs($end_time - $now);

//        $years = floor($diff / (365 * 60 * 60 * 24));
//        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
//        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        
        $days = round($diff / (60 * 60 * 24));
        
        return $days;
    }
}

if (!function_exists('getCountdownTarget')) {
    function getCountdownTarget($days, $hours, $minutes, $start)
    {
        $min_start = date('Y-m-d H:i:s', strtotime('+' . $minutes . ' minutes', strtotime($start)));
        $hour_start = date('Y-m-d H:i:s', strtotime('+' . $hours . ' hours', strtotime($min_start)));
        $day_end = date('F d, Y H:i:s', strtotime('+' . $days . ' days', strtotime($hour_start)));
        
        return $day_end;
    }
}

