<?php

namespace App\Http\Controllers;

use App\Responder;
use App\Integration;
use Illuminate\Http\Request;
use App\Http\Requests\StoreIntegration;
use Illuminate\Validation\Rules\In;
class AutoResponderController extends Controller
{
    public function index()
    {
        $header_data = [
            'main_name' => 'Autoresponders',
            'parent_data' => [
                ['parent_name' => 'Settings', 'parent_url' => '']
            ],
            'button_show' => true,
            'button_data' => [
                ['button_url' => '', 'button_text' => '']
            ]
        ];

        $integrations = Integration::with('responder')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('backend.auto-responder.index', compact('header_data', 'integrations'));
    }

    public function create(Request $request)
    {
        $header_data = [
            'main_name' => ' New Autoresponder',
            'parent_data' => [
                ['parent_name' => 'Settings', 'parent_url' => ''],
                ['parent_name' => 'Integration', 'parent_url' => secure_redirect(route('autoresponder.index'))],
            ],
            'button_show' => true,
            'button_data' => [
                ['button_url' => '', 'button_text' => '']
            ]
        ];

        $flag = true;

        $responders = Responder::all();

        return view('backend.auto-responder.create-edit', compact('header_data', 'flag', 'responders'));
    }

    public function validateCredentials($data)
    {
        $responder = Responder::findOrFail($data['responder_id']);
        if ($responder->title === 'Sendlane'){
            return $this->sendLane($data, $responder);
        } else if ($responder->title === 'MailChimp'){
            return $this->mailChimp($data, $responder);
        } else if ($responder->title === 'ActiveCampaign'){
            return $this->activeCampaign($data, $responder);
        } else if ($responder->title === 'MailerLite'){
            return $this->mailerLite($data, $responder);
        } else if ($responder->title === 'GetResponse'){
            return $this->getResponse($data, $responder);
        } else if ($responder->title === 'Send In Blue'){
            return $this->sendInBlue($data, $responder);
        } else if ($responder->title === 'Campaign Monitor'){
            return $this->campaignMonitor($data, $responder);
        }
    }

    public function sendLane($data, $responder)
    {
        $msg = null;
        $api_key = $data['api_key'];
        $hash = $data['hash'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $responder->base_url."lists");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$api_key&hash=$hash");
        $result = curl_exec($ch);
        $result = json_decode($result);
        if ($result && isset($result->error)){

            foreach($result->error as $err){
                $msg = $err;
            }

            return [
                'type' => 'error',
                'message' => $msg
            ];
        } else {
            return [
                'type' => 'success',
                'message' => null,
            ];
        }
    }

    public function mailChimp($data, $responder)
    {
        $apikey = $data['api_key'];
        $client = new \GuzzleHttp\Client();
        try{

            $response = $client->request('GET', $responder->base_url, [
                'auth' => ['user', $apikey]
            ]);
            $result = $response->getBody()->getContents();
            $user = json_decode($result);
            if (isset($result->account_id) && isset($result->login_id)){
                return [
                    'type' => 'success',
                    'message' => null,
                ];
            }
        } catch (\Exception $e){
            return [
                'type' => 'error',
                'message' => 'Invalid API key'
            ];
        }


    }

    public function activeCampaign($data, $responder)
    {
        $url     = $data['url'];
        $api_key = $data['api_key'];
        $ac = new \ActiveCampaign($url, $api_key);
        if (!(int)$ac->credentials_test()) {
            return [
                'type' => 'error',
                'message' => 'Invalid credentials (URL and/or API key)'
            ];
        }

        return [
            'type' => 'success',
            'message' => null,
        ];
    }

    public function mailerLite($data, $responder)
    {
        $client = new \GuzzleHttp\Client();
        try{
            $response = $client->request('GET', $responder->base_url, [
                'headers' => [
                    'X-MailerLite-ApiKey' => $data['api_key'],
                ]
            ]);
            return [
                'type' => 'success',
                'message' => null,
            ];
        } catch (\Exception $e){
            return [
                'type' => 'error',
                'message' => 'Unauthorized API-KEY'
            ];
        }

    }

    public function getResponse($data, $responder)
    {
        $client = new \GuzzleHttp\Client();
        try{
            $response = $client->request('GET', $responder->base_url, [
                'headers' => [
                 'X-Auth-Token' => 'api-key ' . $data['api_key']
                ]
            ]);
            return [
                'type' => 'success',
                'message' => null,
            ];
        } catch (\Exception $e){
            return [
                'type' => 'error',
                'message' => 'Unauthorized API-KEY'
            ];
        }
    }

    public function sendInBlue($data, $responder)
    {
        $client = new \GuzzleHttp\Client();
        try{
            $response = $client->request('GET', $responder->base_url, [
                'headers' => [
                 'Content-Type' => 'application/json',
                 'api-key'      => $data['api_key']
                ]
            ]);
            return [
                'type' => 'success',
                'message' => null,
            ];
        } catch (\Exception $e){
            return [
                'type' => 'error',
                'message' => 'Unauthorized API-KEY'
            ];
        }
    }

    public function campaignMonitor($data, $responder)
    {
        $client = new \GuzzleHttp\Client();
        try{
            $response = $client->request('GET', $responder->base_url, [
                'headers' => [
                 'Content-Type'     => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($data['api_key'])
                ]
            ]);
            $result = json_decode($response->getBody()->getContents());
            if (isset($result) && isset($result[0])){
                return [
                    'type' => 'success',
                    'message' => null,
                ];
            }

        } catch (\Exception $e){
            return [
                'type' => 'error',
                'message' => 'Unauthorized API-KEY'
            ];
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $validate = $this->validateCredentials($data);
        if ($validate['type'] === 'error'){
                    return redirect()->back()->with('error',$validate['message'])->withInput($data);
        }
        $integration = Integration::create($data);
        if ($integration){
            session()->flash('success', 'Successfully Created');
        } else {
            session()->flash('error', 'Some error occured');
        }
        return redirect()->route('autoresponder.index');

    }

    public function edit($id)
    {
        $integration = Integration::findOrFail($id);
        $header_data = [
            'main_name' => 'Edit Autoresponder',
            'parent_data' => [
                ['parent_name' => 'Overlay', 'parent_url' => ''],
                ['parent_name' => 'Bars', 'parent_url' => secure_redirect(route('autoresponder.index'))],
            ],
            'button_show' => true,
            'button_data' => [
                ['button_url' => '', 'button_text' => '']
            ]
        ];

        $flag = false;
        $responders = Responder::all();
        return view('backend.auto-responder.create-edit', compact('header_data', 'flag', 'integration', 'responders'));
    }

    public function update($integration, Request $request)
    {
        $integration = Integration::find($integration);
        if ($integration && $integration->update($request->all())){
            return redirect()->back()->with('success','Updated Successfully');
        } else {
            return redirect()->back()->with('error','Integration not found');
        }
    }

    public function destroy($integration)
    {
        Integration::findOrFail($integration)->delete();
        return redirect()->back()->with('success','Deleted Successfully');
    }
}
