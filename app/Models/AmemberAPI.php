<?php


namespace App\Models;


use GuzzleHttp\Client;

class AmemberAPI
{
    protected $baseUri;
    protected $key;
    protected $client = null;
    
    protected $checkAccess = 'check-access/by-login-pass';
    protected $sendReset = 'check-access/send-pass';
    
    const AM_ACCESS = ['14', '15', '16'];
    const AM_SPLIT_TEST = ['18', '19'];
    const AM_MULTI_BAR = ['18', '19'];
    const AM_REMOVE_POWERED_BY = ['18', '19', '22', '23'];
    const AM_SOCIAL_BUTTON = ['14'];
    const AM_AGENCY = ['22', '23'];
    const AM_PRO = ['18'];
    const AM_120 = ['21'];
    const AM_240 = ['20'];
    const AM_RESELLER = ['25', '26', '27'];
    
    public function __construct()
    {
        $this->baseUri = env('AMEMBER_BASE_URL');
        $this->key = env('AMEMBER_API_KEY');
        $this->client = new Client(['base_uri' => $this->baseUri]);
    }
    
    public function checkAccessByLogin($email, $pass)
    {
        $res = $this->client->request('GET', $this->checkAccess, [
            'query' => [
                '_key'  => $this->key,
                'login' => $email,
                'pass'  => $pass,
            ]
        ]);
        
        $statusCode = $res->getStatusCode();
        $responseBody = json_decode($res->getBody());
        if (200 == $statusCode && $responseBody->ok) {
            $accessible = false;
            if (isset($responseBody->subscriptions)) {
                foreach ($responseBody->subscriptions as $id => $expiry) {
                    if (array_search($id, self::AM_ACCESS) !== false) {
                        $accessible = true;
                        break;
                    }
                }
            }

            if (!$accessible) {
                abort(403, 'You are not able to access to this app.');
            }
            
            return $responseBody;
        } else if (500 == $statusCode) {
            abort(500, 'Something wrong with amember api');
        } else {
            abort(400, 'Something unknown happened with fetching amember api');
        }
        
        return false;
    }
    
    public function sendResetPasswordEmail($email)
    {
        $res = $this->client->request('GET', $this->sendReset, [
            'query' => [
                '_key'  => $this->key,
                'login' => $email
            ]
        ]);
        $statusCode = $res->getStatusCode();
        $responseBody = json_decode($res->getBody());
        if (200 == $statusCode) {
            if ($responseBody->ok) {
                return $responseBody;
            } else {
                return (object)[
                    'ok'      => false,
                    'message' => 'Email does not exists on server',
                ];
            }
        } else if (500 == $statusCode) {
            abort(500, 'Something wrong with amember api');
        } else {
            dd('here 400');
            abort(400, 'Something unknown happened with amember api');
        }
    }
    
}
