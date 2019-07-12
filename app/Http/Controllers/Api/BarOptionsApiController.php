<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use App\Integration;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class BarOptionsApiController extends Controller
{
    protected $barsRepo;
    
    public function __construct(BarsRepository $barsRepository)
    {
        $this->barsRepo = $barsRepository;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
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
            $re = $this->barsRepo->getConversionPerfectLists();
        } else {
            $integration = Integration::with('responder')->where('user_id', auth()->user()->id)->where('responder_id', $responder_id)->first();
            
            if ($integration->responder->title == 'Sendlane') {
                $re = $this->barsRepo->getSendlaneList($integration);
            } else if ($integration->responder->title == 'Mailchimp') {
                $re = $this->barsRepo->getMailChimpLists($integration);
            }
        }
        
        
        return response()->json($re);
    }
    
    public function setSubscribersOfLists($bar_id, Request $request)
    {
        $bar = $this->barsRepo->model()->find($bar_id);
        
        if ($bar && !is_null($bar)) {
            $subscriber_name = $request->input('lead_capture_cta_name__cp_bar_' . $bar->id);
            $subscriber_email = $request->input('lead_capture_cta_email__cp_bar_' . $bar->id);
            $ip = $request->ip();
            $list_id = $bar->list;
            
            if ($bar->integration_type == 'conversion_perfect') {
                $subscriber = new Subscriber();
                $subscriber->list_id = $list_id;
                $subscriber->email_address = $subscriber_email;
                $subscriber->user_name = $subscriber_name;
                $subscriber->ip_address = $ip;
                $subscriber->save();
            }
        }
        
        return response()->json([
            'status' => 'success'
        ]);
    }
}
