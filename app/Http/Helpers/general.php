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