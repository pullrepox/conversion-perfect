<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use App\Integration;
use Illuminate\Http\Request;

class BarOptionsApiController extends Controller
{
    protected $barsRepo;
    
    public function __construct(BarsRepository $barsRepository)
    {
        $this->barsRepo = $barsRepository;
    }
    
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
        
        if ($responder_id == 'conversion_perfect' || $responder_id == 'none') {
            return response()->json($re);
        }
        
        $integration = Integration::with('responder')->where('user_id', auth()->user()->id)->where('responder_id', $responder_id)->first();
        
        if ($integration->responder->title == 'sendlane') {
            $re = $this->barsRepo->getSendlaneList($integration);
        } else if ($integration->responder->title == 'mailchimp'){
            $re = $this->barsRepo->getMailChimpLists($integration);
        }
        
        return response()->json($re);
    }
}
