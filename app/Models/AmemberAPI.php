<?php


namespace App\Models;


use GuzzleHttp\Client;

class AmemberAPI
{
    protected $baseUri = 'https://onlinedesignerfx.com/members/api/';
    protected $key = 'aNNclq4IEwjotVz14qXT';
    protected  $client=null;


    protected $checkAccess = 'check-access/by-login-pass';

    public function __construct(){
        $this->client = new Client(['base_uri'=>$this->baseUri]);
    }

    public function checkAccessByLogin($email,$pass){
        $res = $this->client->request('GET',$this->checkAccess,[
            'query' => [
                '_key'=>$this->key,
                'login'=>$email,
                'pass' =>$pass,
            ]
        ]);
        $statusCode = $res->getStatusCode();
        if(200 == $statusCode){
            return json_decode($res->getBody());
        }
    }

}