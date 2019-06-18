<?php

function jsonResponse($isSuccess, $statusCode=200, $message='', $data=[]){
    return response()->json([
        'success'=>$isSuccess,
        'message'=> $message,
        'data' => $data,
    ],$statusCode);
}

function user(){
    return resolve('user');
}

function getArrayValue($array,$key,$default){
    return isset($array[$key])?$array[$key]:$default;
}