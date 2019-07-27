<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ApiRepository;
use App\Http\Repositories\BarsRepository;
use App\Integration;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Soumen\Agent\Facades\Agent;

class BarOptionsApiController extends Controller
{
    protected $barsRepo;
    protected $apiRepo;
    
    public function __construct(BarsRepository $barsRepository, ApiRepository $apiRepository)
    {
        $this->barsRepo = $barsRepository;
        $this->apiRepo = $apiRepository;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws
     */
    public function getAutoResponderLists(Request $request)
    {
        $responder_id = $request->input('responder_id');
        
        $re = [
            'result'  => 'success',
            'message' => [
                [
                    'key'  => '',
                    'name' => '-- Choose List --'
                ]
            ]
        ];
        
        if ($responder_id == 'none') {
            return response()->json($re);
        }
        
        if ($responder_id == 'conversion_perfect') {
            $re = $this->apiRepo->getConversionPerfectLists();
        } else {
            $integration = Integration::with('responder')->where('user_id', auth()->user()->id)->where('responder_id', $responder_id)->first();
            
            if ($integration->responder->title == 'Sendlane') {
                $re = $this->apiRepo->getSendlaneList($integration);
            } else if ($integration->responder->title == 'MailChimp') {
                $re = $this->apiRepo->getMailChimpLists($integration);
            } else if ($integration->responder->title == 'ActiveCampaign') {
                $re = $this->apiRepo->getActiveCampaignList($integration);
            } else if ($integration->responder->title == 'Campaign Monitor') {
                $re = $this->apiRepo->getCampaignMonitorLists($integration);
            } else if ($integration->responder->title == 'GetResponse') {
                $re = $this->apiRepo->getResponseCampaigns($integration);
            } else if ($integration->responder->title == 'MailerLite') {
                $re = $this->apiRepo->getMailerLiteGroups($integration);
            } else if ($integration->responder->title == 'Send In Blue') {
                $re = $this->apiRepo->getSendInBlueLists($integration);
            }
        }
        
        
        return response()->json($re);
    }
    
    /**
     * @param $bar_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws
     */
    public function setSubscribersOfLists($bar_id, Request $request)
    {
        $bar = $this->barsRepo->model()->find($bar_id);
        
        $set_log = 'success';
        if ($bar && !is_null($bar)) {
            $subscriber_name = $request->input('lead_capture_cta_name__cp_bar_' . $bar->id);
            $subscriber_email = $request->input('lead_capture_cta_email__cp_bar_' . $bar->id);
            $ip = $request->getClientIp();
            $list_id = $bar->list;
            
            if ($bar->integration_type == 'conversion_perfect') {
                $subscriber = new Subscriber();
                $subscriber->list_id = $list_id;
                $subscriber->email_address = $subscriber_email;
                $subscriber->user_name = $subscriber_name;
                $subscriber->ip_address = $ip;
                $subscriber->save();
            } else if ($bar->integration_type != 'none') {
                $integration = Integration::with('responder')->where('user_id', auth()->user()->id)->where('responder_id', $bar->integration_type)->first();
                if ($integration->responder->title == 'Sendlane') {
                    $this->apiRepo->setSendlaneList($integration, $subscriber_name, $subscriber_email, $list_id);
                } else if ($integration->responder->title == 'MailChimp') {
                    $this->apiRepo->setMailChimpLists($integration, $subscriber_name, $subscriber_email, $list_id, $ip);
                } else if ($integration->responder->title == 'ActiveCampaign') {
                    $this->apiRepo->setActiveCampaignLists($integration, $subscriber_name, $subscriber_email, $list_id, $ip);
                } else if ($integration->responder->title == 'Campaign Monitor') {
                    $this->apiRepo->setCampaignMonitorLists($integration, $subscriber_name, $subscriber_email, $list_id, $ip);
                } else if ($integration->responder->title == 'GetResponse') {
                    $this->apiRepo->setGetResponseContact($integration, $subscriber_email, $list_id);
                } else if ($integration->responder->title == 'MailerLite') {
                    $this->apiRepo->setMailerLiteSubscribers($integration, $subscriber_name, $subscriber_email, $list_id);
                } else if ($integration->responder->title == 'Send In Blue') {
                    $this->apiRepo->setSendInBlueSubscribers($integration, $subscriber_name, $subscriber_email, $list_id);
                }
            }
            
            $fp_id = $request->input('cookie');
            $requestData = sprintf('lang:%s,ua:%s,ip:%s,accept:%s,ref:%s,encode:%s',
                implode(',', $request->getLanguages()), $request->header('user-agent'), $ip,
                $request->header('accept'), $request->header('referer'), implode(',', $request->getEncodings()));
            $unique_id = md5($requestData);
            
            $split_bar_id = $request->has('split_bar_id') ? $request->input('split_bar_id') : 0;
            $multi_bar_id = $request->has('multi_bar_id') ? $request->input('multi_bar_id') : 0;
            
            $set_log = $this->barsRepo->setLeadCaptureClickLog($bar->id, $bar->user_id, $fp_id, $unique_id, $split_bar_id, $multi_bar_id);
            if (!$set_log) {
                $bar_id_p = ($multi_bar_id == 0) ? $bar->id : 0;
                $unique_check = $this->barsRepo->checkUniqueLog($bar_id_p, $bar->user_id, $fp_id, $unique_id, $split_bar_id, $multi_bar_id);
                $browser = Agent::browser();
                $platform = Agent::platform();
                $device = Agent::device();
                $geo_location = geoip()->getLocation($ip);
                
                $ins_log_data = [
                    'user_id'          => $bar->user_id,
                    'bar_id'           => $bar->id,
                    'split_bar_id'     => $split_bar_id,
                    'multi_bar_id'     => $multi_bar_id,
                    'reset_stats'      => 0,
                    'cookie'           => $fp_id,
                    'unique_ref'       => $unique_id,
                    'unique_click'     => $unique_check ? 1 : 0,
                    'button_click'     => 0,
                    'lead_capture'     => 1,
                    'ip_address'       => $ip,
                    'agents'           => $request->header('user-agent'),
                    'kind'             => $device->getFamily(),
                    'model'            => $device->getModel(),
                    'platform'         => $platform->getName(),
                    'platform_version' => $platform->getVersion(),
                    'is_mobile'        => $device->getIsMobile(),
                    'browser'          => $browser->getName(),
                    'domain'           => parse_url($request->header('referer'))['host'],
                    'latitude'         => $geo_location['lat'],
                    'longitude'        => $geo_location['lon'],
                    'country_code'     => $geo_location['iso_code'],
                    'country_name'     => $geo_location['country'],
                    'language_range'   => implode(',', $request->getLanguages()),
                ];
                
                $this->barsRepo->model1()->insertGetId($ins_log_data);
            }
        }
        
        return response()->json([
            'status' => $set_log
        ]);
    }
}
