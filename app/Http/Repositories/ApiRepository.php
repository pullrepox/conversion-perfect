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
    
    const AM_ACCESS = ['14', '15', '16'];
    
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
        $access_ary = $access_list && !is_null($access_list) ? explode(',', $access_list->am_plans) : self::AM_ACCESS;
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
                abort(403, 'You are not able to access to this app.');
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
        
        if ($perm_data && !is_null($perm_data)) {
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
        } else {
            $perm_data = $this->staticList();
            $this->model()->insert($perm_data);
            foreach ($perm_data as $row) {
                if (!isset($perms[$row['description']])) {
                    $perms[$row['description']] = 0;
                }
                foreach ($subscriptions as $id => $expiry) {
                    if ($row['description'] == 'maximum-bars') {
                        $check_perm = $this->model()->where('description', $row['description'])->where('am_plans', 'like', '%' . $id . '%')->first();
                        if ($check_perm && !is_null($check_perm)) {
                            $perms[$row['description']] = $check_perm->am_maximum_bars;
                        }
                    } else {
                        if (array_search($id, explode(',', $row['am_plans'])) !== false) {
                            $perms[$row['description']] = 1;
                        }
                    }
                }
            }
        }
        
        $user->permissions = json_encode($perms);
        $user->save();
    }
    
    public function staticList()
    {
        $list = [
            [
                'description'         => 'access',
                'am_plans'            => '14,15,16',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0
            ],
            [
                'description'         => 'split-test',
                'am_plans'            => '18,19',
                'am_upgrade_required' => 3,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => 'multi-bar',
                'am_plans'            => '18,19',
                'am_upgrade_required' => 3,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => 'remove-powered-by',
                'am_plans'            => '18,19,22,23',
                'am_upgrade_required' => 3,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => 'social-buttons',
                'am_plans'            => '14',
                'am_upgrade_required' => 2,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => 'lead-capture',
                'am_plans'            => '17',
                'am_upgrade_required' => 4,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => 'agency',
                'am_plans'            => '22,23',
                'am_upgrade_required' => 5,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => 'pro-templates',
                'am_plans'            => '18',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => '120-templates',
                'am_plans'            => '21',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => '240-templates',
                'am_plans'            => '20',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => 'reseller',
                'am_plans'            => '25,26,27',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0,
            ],
            [
                'description'         => 'maximum-bars',
                'am_plans'            => '14',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 3,
            ],
            [
                'description'         => 'maximum-bars',
                'am_plans'            => '15',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 50,
            ],
            [
                'description'         => 'maximum-bars',
                'am_plans'            => '16,22,23',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => (-1),
            ],
        ];
        
        return $list;
    }
}
