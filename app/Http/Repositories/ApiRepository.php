<?php


namespace App\Http\Repositories;


use App\Models\Permission;
use GuzzleHttp\Client;

class ApiRepository extends Repository
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
    
    public function model()
    {
        return app(Permission::class);
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
        $access_list = $this->model()->where('description', 'access')->first();
        $access_ary = explode(',', $access_list->am_plans);
        if (200 == $statusCode && $responseBody->ok) {
            $accessible = false;
            if (isset($responseBody->subscriptions)) {
                foreach ($responseBody->subscriptions as $id => $expiry) {
                    if (array_search($id, $access_ary) !== false) {
                        if (date('Y-m-d') > date('Y-m-d', strtotime($expiry))) {
                            abort(419, 'Your subscription has been expired.');
                        } else {
                            $accessible = true;
                            break;
                        }
                    }
                }
            }
            
            if (!$accessible) {
                abort(419, 'You are not able to access to this app.');
            }
            
            return $responseBody;
        } else if (500 == $statusCode) {
            abort(500, 'Something wrong with the server api.');
        } else {
            abort(400, 'Something unknown happened with fetching server api');
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
            abort(500, 'Something wrong with server api');
        } else {
            abort(400, 'Something unknown happened with server api');
        }
        
        return false;
    }
    
    public function setUserPermissions($subscriptions, $user)
    {
        $perms = [];
        $perm_data = $this->all();
        foreach ($perm_data as $row) {
            if (!isset($perms[$row->description])) {
                $perms[$row->description] = 0;
            }
            foreach ($subscriptions as $id => $expiry) {
                if ($row->description == 'maximum-bars') {
                    $check_perm = $this->model()->where('description', $row->description)->where('am_plans', 'like', '%' . $id . '%')->first();
                    if ($check_perm && !is_null($check_perm)) {
                        $perms[$row->description] = $check_perm->am_maximum_bars;
                    }
                } else {
                    if (array_search($id, explode(',', $row->am_plans)) !== false) {
                        $perms[$row->description] = 1;
                    }
                }
            }
        }
        
        $user->permissions = json_encode($perms);
        $user->save();
    }
}
