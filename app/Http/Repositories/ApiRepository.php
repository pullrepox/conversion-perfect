<?php


namespace App\Http\Repositories;


use App\Models\Permission;
use DrewM\MailChimp\MailChimp;
use Getresponse\Sdk\GetresponseClientFactory;
use Getresponse\Sdk\Operation\Campaigns\GetCampaigns\GetCampaigns;
use Getresponse\Sdk\Operation\Contacts\CreateContact\CreateContact;
use Getresponse\Sdk\Operation\Model\CampaignReference;
use Getresponse\Sdk\Operation\Model\NewContact;
use GuzzleHttp\Client;
use MailerLiteApi\MailerLite;
use SendinBlue\Client\Api\ContactsApi;
use SendinBlue\Client\Configuration;

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
        $this->client = new Client(['base_uri' => $this->baseUri, 'verify' => false]);
    }
    
    public function model()
    {
        return app(Permission::class);
    }
    
    public function checkAccessByLogin($email, $pass)
    {
        $res = $this->client->request('GET', $this->checkAccess, [
            'query'  => [
                '_key'  => $this->key,
                'login' => $email,
                'pass'  => $pass,
            ],
            'verify' => false
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
        
        if (!($perm_data && !is_null($perm_data))) {
            $perm_data = $this->staticList();
            $this->model()->insert($perm_data);
        }
        
        foreach ($perm_data as $row) {
            if (!isset($perms[$row['description']])) {
                $perms[$row['description']] = 0;
            }
            foreach ($subscriptions as $id => $expiry) {
                if ($row['description'] == 'maximum-bars') {
                    $check_perm = $this->model()
                        ->where('description', $row['description'])
                        ->where(function ($q) use ($id) {
                            $q->where('am_plans', $id)
                                ->orWhere('am_plans', 'like', $id . ',%')
                                ->orWhere('am_plans', 'like', '%,' . $id . ',%')
                                ->orWhere('am_plans', 'like', '%,' . $id);
                        })
                        ->first();
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
    
    public function getSendlaneList($integration)
    {
        $msg = 'Error! Sendlane URL seems wrong.';
        $api_key = $integration['api_key'];
        $hash = $integration['hash'];
        $url = $integration->responder->base_url . 'lists';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$api_key&hash=$hash");
        $result = curl_exec($ch);
        $result = json_decode($result);
        if ($result && isset($result->error)) {
            foreach ($result->error as $err) {
                $msg = $err;
            }
            
            return [
                'result'  => 'failure',
                'message' => $msg
            ];
        } else {
            $reMsg = [[
                'key'  => '',
                'name' => '-- Choose List --'
            ]];
            
            $i = 1;
            foreach ($result as $list) {
                $reMsg[$i]['key'] = $list->list_id;
                $reMsg[$i]['name'] = $list->list_name;
                $i++;
            }
            
            return [
                'result'  => 'success',
                'message' => $reMsg
            ];
        }
    }
    
    public function setSendlaneList($integration, $name, $email, $list_id)
    {
        $api_key = $integration['api_key'];
        $hash = $integration['hash'];
        $url = $integration->responder->base_url . 'list-subscribers-add';
        $nameAry = explode(' ', $name);
        $f_name = $nameAry[0];
        $l_name = isset($nameAry[1]) ? $nameAry[1] : '';
        
        $data = [
            'api'     => $api_key,
            'hash'    => $hash,
            'email'   => $f_name . ' ' . $l_name . '<' . $email . '>',
            'list_id' => $list_id,
        ];
        
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $e) {
        }
    }
    
    /**
     * @param $integration
     * @return array
     * @throws \Exception
     */
    public function getMailChimpLists($integration)
    {
        $api_key = $integration['api_key'];
        $MailChimp = new MailChimp($api_key);
        $MailChimp->verify_ssl = false;
        $total_lists = $MailChimp->get('lists');
        $count_lists = $total_lists['total_items'];
        $lists = $MailChimp->get('lists', [
            'count' => $count_lists
        ]);
        
        if (!$lists['lists']) {
            return [
                'result'  => 'failure',
                'message' => 'Nothing in this account. Please add a list to this account.'
            ];
        }
        
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        $i = 1;
        foreach ($lists['lists'] as $list) {
            $reMsg[$i]['key'] = $list['id'];
            $reMsg[$i]['name'] = $list['name'];
            $i++;
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    /**
     * @param $integration
     * @param $name
     * @param $email
     * @param $list_id
     * @param $ip
     * @throws \Exception
     */
    public function setMailChimpLists($integration, $name, $email, $list_id, $ip)
    {
        $nameAry = explode(' ', $name);
        $f_name = $nameAry[0];
        $l_name = isset($nameAry[1]) ? $nameAry[1] : '';
        
        $api_key = $integration['api_key'];
        
        $MailChimp = new MailChimp($api_key);
        $MailChimp->verify_ssl = false;
        $MailChimp->post(("lists/" . $list_id . "/members"), [
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => ['FNAME' => $f_name, 'LNAME' => $l_name],
            'ip_signup'     => $ip
        ]);
    }
    
    public function getConversionPerfectLists()
    {
        $lists = auth()->user()->email_lists;
        
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        $i = 1;
        foreach ($lists as $list) {
            $reMsg[$i]['key'] = $list->id;
            $reMsg[$i]['name'] = $list->list_name;
            $i++;
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    /**
     * @param $integration
     * @return array
     */
    public function getActiveCampaignList($integration)
    {
        $url = $integration['url'];
        $api_key = $integration['api_key'];
        
        $ac = new \ActiveCampaign($url, $api_key);
        
        $list_params = [
            'ids'  => 'all',
            'full' => '0'
        ];
        
        $lists = $ac->api('list/list', $list_params);
        
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        if ($lists) {
            $i = 1;
            foreach ($lists as $list) {
                if (!$list || !isset($list->id)) {
                    continue;
                }
                $reMsg[$i]['key'] = $list->id;
                $reMsg[$i]['name'] = $list->name;
                $i++;
            }
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    /**
     * @param $integration
     * @param $name
     * @param $email
     * @param $list_id
     * @param $ip
     */
    public function setActiveCampaignLists($integration, $name, $email, $list_id, $ip)
    {
        $url = $integration['url'];
        $api_key = $integration['api_key'];
        
        $ac = new \ActiveCampaign($url, $api_key);
        
        $list_params = [
            'ids'  => $list_id,
            'full' => '0'
        ];
        
        $list = $ac->api('list/list', $list_params);
        if ($list) {
            $nameAry = explode(' ', $name);
            $f_name = $nameAry[0];
            $l_name = isset($nameAry[1]) ? $nameAry[1] : '';
            $params = [
                'email'                                 => $email,
                'first_name'                            => $f_name,
                'last_name'                             => $l_name,
                'ip4'                                   => $ip,
                ('p[' . $list_id . ']')                 => $list_id,
                ('status[' . $list_id . ']')            => 1,
                ('instantresponders[' . $list_id . ']') => 1
            ];
            
            $ac->api('contact/add', $params);
        }
    }
    
    /**
     * Get Campaign Monitor Lists.
     * @param $integration
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCampaignMonitorLists($integration)
    {
        $client = new Client(['verify' => false]);
        
        $response = $client->request('GET', $integration->responder->base_url . 'clients/' . $integration['hash'] . '/lists.json', [
            'headers' => [
                'Content-Type'  => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($integration['api_key'])
            ],
            'verify'  => false
        ]);
        
        $lists = json_decode($response->getBody()->getContents());
        
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        if (isset($lists) && isset($lists[0])) {
            $i = 1;
            foreach ($lists as $list) {
                if (!$list || !isset($list->ListID)) {
                    continue;
                }
                $reMsg[$i]['key'] = $list->ListID;
                $reMsg[$i]['name'] = $list->Name;
                $i++;
            }
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    /**
     * @param $integration
     * @param $name
     * @param $email
     * @param $list_id
     * @param $ip
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setCampaignMonitorLists($integration, $name, $email, $list_id, $ip)
    {
        $client = new Client(['verify' => false]);
        
        $client->request('POST', $integration->responder->base_url . 'subscribers/' . $list_id . '.json', [
            'headers' => [
                'Content-Type'  => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($integration['api_key'])
            ],
            'body'    => [
                'EmailAddress'                           => $email,
                'Name'                                   => $name,
                'CustomFields'                           => [
                    [
                        'Key'   => 'Conversion Perfect Bar',
                        'Value' => 'https://conversionperfect.com'
                    ],
                    [
                        'Key'   => 'Subscribed IP Address',
                        'Value' => $ip
                    ],
                ],
                'Resubscribe'                            => true,
                'RestartSubscriptionBasedAutoresponders' => true,
                'ConsentToTrack'                         => "Yes"
            ],
            'verify'  => false
        ]);
    }
    
    /**
     * @param $integration
     * @return array
     * @throws \Getresponse\Sdk\Client\Exception\MalformedResponseDataException
     */
    public function getResponseCampaigns($integration)
    {
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        $client = GetresponseClientFactory::createWithApiKey($integration['api_key']);
        $campaignsOperation = new GetCampaigns();
        $response = $client->call($campaignsOperation);
        if ($response->isSuccess()) {
            $lists = $response->getData();
            if ($lists) {
                $i = 1;
                foreach ($lists as $list) {
                    if (!$list || !isset($list['campaignId'])) {
                        continue;
                    }
                    $reMsg[$i]['key'] = $list['campaignId'];
                    $reMsg[$i]['name'] = $list['name'];
                    $i++;
                }
            }
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    /**
     * @param $integration
     * @param $email
     * @param $list_id
     */
    public function setGetResponseContact($integration, $email, $list_id)
    {
        $createContact = new NewContact(
            new CampaignReference($list_id),
            $email
        );
        
        $createContactOperation = new CreateContact($createContact);
        $client = GetresponseClientFactory::createWithApiKey($integration['api_key']);
        $response = $client->call($createContactOperation);
        
        if ($response->isSuccess()) {
            print 'OK';
        }
    }
    
    /**
     * @param $integration
     * @return array
     * @throws \MailerLiteApi\Exceptions\MailerLiteSdkException
     */
    public function getMailerLiteGroups($integration)
    {
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        $groupsApi = (new MailerLite($integration['api_key']))->groups();
        
        $lists = $groupsApi->get();
        
        if ($lists) {
            $i = 1;
            foreach ($lists as $list) {
                if (!$list || !isset($list->id)) {
                    continue;
                }
                $reMsg[$i]['key'] = $list->id;
                $reMsg[$i]['name'] = $list->name;
                
                $i++;
            }
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    /**
     * @param $integration
     * @param $name
     * @param $email
     * @param $list_id
     * @param $ip
     * @throws \MailerLiteApi\Exceptions\MailerLiteSdkException
     */
    public function setMailerLiteSubscribers($integration, $name, $email, $list_id)
    {
        $groupsApi = (new MailerLite($integration['api_key']))->groups();
        
        if ($groupsApi) {
            $nameAry = explode(' ', $name);
            $f_name = $nameAry[0];
            $l_name = isset($nameAry[1]) ? $nameAry[1] : '';
            
            $subscriber = [
                'email'  => $email,
                'fields' => [
                    'name'      => $f_name,
                    'last_name' => $l_name
                ]
            ];
            
            $groupsApi->addSubscriber($list_id, $subscriber);
        }
    }
    
    /**
     * @param $integration
     * @return array
     * @throws \SendinBlue\Client\ApiException
     */
    public function getSendInBlueLists($integration)
    {
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $integration['api_key']);
        $apiInstance = new ContactsApi(new Client(['verify' => false]), $config);
        $result = $apiInstance->getLists();
        if ($result) {
            $lists = $result['lists'];
            $i = 1;
            foreach ($lists as $list) {
                if (!$list || !isset($list['id'])) {
                    continue;
                }
                $reMsg[$i]['key'] = $list['id'];
                $reMsg[$i]['name'] = $list['name'];
                
                $i++;
            }
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    /**
     * @param $integration
     * @param $name
     * @param $email
     * @param $list_id
     * @throws \SendinBlue\Client\ApiException
     */
    public function setSendInBlueSubscribers($integration, $name, $email, $list_id)
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $integration['api_key']);
        $apiInstance = new ContactsApi(new Client(['verify' => false]), $config);
        
        $nameAry = explode(' ', $name);
        $f_name = $nameAry[0];
        $l_name = isset($nameAry[1]) ? $nameAry[1] : '';
        
        $createContact = new \SendinBlue\Client\Model\CreateContact([
            'email'      => $email,
            'attributes' => ['NAME' => $f_name, 'SURNAME' => $l_name],
            'listid'     => [$list_id]
        ]);
        
        $apiInstance->createContact($createContact);
    }
    
    public function getAWeberLists($integration)
    {
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        $AWeber = new \AWeberAPI(config('site.aweber_consumerKey'), config('site.aweber_consumerSecret'));
        $AWeber->adapter->debug = false;
        $account = $AWeber->getAccount($integration['api_key'], $integration['hash']);
        if ($account->lists) {
            $i = 1;
            foreach ($account->lists as $offset => $list) {
                $reMsg[$i]['key'] = $list->id;
                $reMsg[$i]['name'] = $list->name;
                $i++;
            }
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    public function setAWeberSubscribers($integration, $name, $email, $list_id)
    {
        $AWeber = new \AWeberAPI(config('site.aweber_consumerKey'), config('site.aweber_consumerSecret'));
        $AWeber->adapter->debug = false;
        try {
            $account = $AWeber->getAccount($integration['api_key'], $integration['hash']);
            $list_url = "/accounts/{$integration['url']}/lists/{$list_id}";
            $list = $account->loadFromUrl($list_url);
            
            $params = [
                'email' => $email,
                'name'  => $name
            ];
            
            $subscribers = $list->subscribers;
            $new_subscriber = $subscribers->create($params);
            
            if (!$new_subscriber) {
                echo "There seems to be a problem. You are either already subscribed or your email is incorrect";
                exit;
            }
        } catch (\AWeberAPIException $exc) {
            echo "There seems to be a problem. You are either already subscribed or your email is incorrect";
            exit;
        }
    }
    
    /**
     * @param $integration
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getConstantContactLists($integration)
    {
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        try {
            $response = $this->client->request('GET', $integration->responder->base_url . 'contact_lists', [
                'headers' => [
                    'Cache-Control' => 'no-cache',
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer ' . $integration['api_key']
                ],
                'verify'  => false
            ]);
            
            $body = json_decode($response->getBody(), true);
            if (isset($body['lists'])) {
                $i = 1;
                foreach ($body['lists'] as $list) {
                    $reMsg[$i]['key'] = $list['list_id'];
                    $reMsg[$i]['name'] = $list['name'];
                    
                    $i++;
                }
            }
            
            return [
                'result'  => 'success',
                'message' => $reMsg
            ];
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $res = $this->refreshTokenForConstantContact($integration['hash'], config('site.cs_ct_api_key'), config('site.cs_ct_secret'));
            $re = json_decode($res, true);
            if (isset($re['access_token'])) {
                $integration->api_key = $re['access_token'];
                $integration->hash = $re['refresh_token'];
                $integration->save();
                
                $this->getConstantContactLists($integration);
            }
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    /**
     * @param $refreshToken - The refresh token provided with the previous access token
     * @param $clientId - API Key
     * @param $clientSecret - API Secret
     * @return string - JSON String of results
     */
    public function refreshTokenForConstantContact($refreshToken, $clientId, $clientSecret)
    {
        // Use cURL to get a new access token and refresh token
        $ch = curl_init();
        
        // Define base URL
        $base = 'https://idfed.constantcontact.com/as/token.oauth2';
        
        // Create full request URL
        $url = $base . '?refresh_token=' . $refreshToken . '&grant_type=refresh_token';
        curl_setopt($ch, CURLOPT_URL, $url);
        
        // Set authorization header
        // Make string of "API_KEY:SECRET"
        $auth = $clientId . ':' . $clientSecret;
        // Base64 encode it
        $credentials = base64_encode($auth);
        // Create and set the Authorization header to use the encoded credentials
        $authorization = 'Authorization: Basic ' . $credentials;
        curl_setopt($ch, CURLOPT_HTTPHEADER, [$authorization]);
        
        // Set method and to expect response
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Make the call
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }
    
    /**
     * @param $integration
     * @param $name
     * @param $email
     * @param $list_id
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setConstantContactSubscriber($integration, $name, $email, $list_id)
    {
        $nameAry = explode(' ', $name);
        $f_name = $nameAry[0];
        $l_name = isset($nameAry[1]) ? $nameAry[1] : '';
        
        $url = $integration->responder->base_url . 'contacts?email=' . $email;
        
        try {
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'Cache-Control' => 'no-cache',
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer ' . $integration['api_key']
                ],
                'verify'  => false
            ]);
            
            $body = json_decode($response->getBody(), true);
            if (isset($body['contacts']) && sizeof($body['contacts']) > 0) {
                $url = $integration->responder->base_url . 'contacts/' . $body['contacts'][0]['contact_id'];
                $this->client->request('PUT', $url, [
                    'headers' => [
                        'cache-control' => 'no-cache',
                        'accept'        => 'application/json',
                        'content-type'  => 'application/json',
                        'authorization' => 'Bearer ' . $integration['api_key']
                    ],
                    'verify'  => false,
                    'body'    => json_encode([
                        'email_address'    => [
                            'address'            => $email,
                            'permission_to_send' => 'implicit'
                        ],
                        'first_name'       => $f_name,
                        'last_name'        => $l_name,
                        'update_source'    => 'Contact',
                        'list_memberships' => [$list_id]
                    ])
                ]);
            } else {
                $url = $integration->responder->base_url . 'contacts';
                $this->client->request('POST', $url, [
                    'headers' => [
                        'cache-control' => 'no-cache',
                        'accept'        => 'application/json',
                        'content-type'  => 'application/json',
                        'authorization' => 'Bearer ' . $integration['api_key']
                    ],
                    'verify'  => false,
                    'body'    => json_encode([
                        'email_address'    => [
                            'address'            => $email,
                            'permission_to_send' => 'implicit'
                        ],
                        'first_name'       => $f_name,
                        'last_name'        => $l_name,
                        'create_source'    => 'Contact',
                        'list_memberships' => [$list_id]
                    ])
                ]);
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $res = $this->refreshTokenForConstantContact($integration['hash'], config('site.cs_ct_api_key'), config('site.cs_ct_secret'));
            $re = json_decode($res, true);
            if (isset($re['access_token'])) {
                $integration->api_key = $re['access_token'];
                $integration->hash = $re['refresh_token'];
                $integration->save();
                $this->setConstantContactSubscriber($integration, $name, $email, $list_id);
            }
        }
    }
    
    /**
     * @param $integrations
     * @return array
     */
    public function getSendyLists($integrations)
    {
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        $i = 1;
        if ($integrations) {
            foreach ($integrations as $integration) {
                $url = $integration->url . '/api/subscribers/active-subscriber-count.php';
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "api_key={$integration->api_key}&list_id={$integration->hash}");
                
                $result = curl_exec($ch);
                
                if (!(!is_numeric($result) && $result != 'No data passed')) {
                    $reMsg[$i]['key'] = $integration['hash'];
                    $reMsg[$i]['name'] = 'List of ' . $integration['name'];
                }
                
                $i++;
            }
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
    
    /**
     * Sendy Subscriber set
     * @param $integration
     * @param $name
     * @param $email
     * @param $list_id
     * @throws \Exception
     */
    public function setSendySubscriber($integration, $name, $email, $list_id)
    {
        $url = $integration->url . '/api/subscribers/active-subscriber-count.php';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api_key={$integration->api_key}&list_id={$list_id}");
        
        $result = curl_exec($ch);
        
        if (!(!is_numeric($result) && $result != 'No data passed')) {
            $sendy = new \Micovi\LaravelSendy\LaravelSendy();
            
            $sendy->setURL($integration->url);
            $sendy->setApiKey($integration->api_key);
            $sendy->setListId($list_id);
            
            $sendy->subscribe($email, $name, $list_id);
        }
    }
    
    /**
     * @param $integrations
     * @return array
     */
    public function getHTMLIntegrationList($integrations)
    {
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
    
        $i = 1;
        if ($integrations) {
            foreach ($integrations as $integration) {
                $reMsg[$i]['key'] = $integration->id;
                $reMsg[$i]['name'] = $integration->name;
                
                $i++;
            }
        }
    
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
}
