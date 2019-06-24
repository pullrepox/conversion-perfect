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
                '_key' => $this->key,
                'login' => $email,
                'pass' => $pass,
            ]
        ]);
        $statusCode = $res->getStatusCode();
        $responseBody = json_decode($res->getBody());
        if (200 == $statusCode && $responseBody->ok) {
            if (isset($responseBody->subscriptions)) {
                Subscription::syncAmemberSubscriptions($responseBody->subscriptions);
            }
            return $responseBody;
        } else if (500 == $statusCode) {
            abort(500, 'Something wrong with amember api');
        } else {
            abort(400, 'Something unknown happened with fetching amember api');
        }
    }

    public function sendResetPasswordEmail($email)
    {
        $res = $this->client->request('GET', $this->sendReset, [
            'query' => [
                '_key' => $this->key,
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
                    'ok'=>false,
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
