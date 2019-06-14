<?php


namespace App\Models;


use GuzzleHttp\Client;

class AmemberAPI
{
    protected $baseUri;
    protected $key;
    protected $client=null;


    protected $checkAccess = 'check-access/by-login-pass';

    public function __construct(){
        $this->baseUri = env('AMEMBER_BASE_URL');
        $this->key = env('AMEMBER_API_KEY');
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
            $responseBody = json_decode($res->getBody());
            Subscription::syncAmemberSubscriptions( $responseBody->subscriptions );
            return $responseBody;
        } else if(500 == $statusCode){
            abort(500,'Something wrong with amember api');
        }else {
            abort(400,'Something unknown happend with fetching amember api');
        }
    }

}
