<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ApiRepository;
use App\Http\Repositories\ArListRepository;
use App\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntegrationsApiController extends Controller
{
	protected $apiRepo;
	protected $arListRepo;
	
	public function __construct(ApiRepository $apiRepository, ArListRepository $arListRepository)
	{
		$this->apiRepo = $apiRepository;
		$this->arListRepo = $arListRepository;
	}
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws
	 */
	public function refreshList(Request $request)
	{
		$validate = Validator::make($request->all(), [
			'token'           => 'required',
			'userid'          => 'required',
			'autoresponderid' => 'required',
		]);
		
		if ($validate->fails()) {
			return response()->json($validate->errors()->toArray());
		}
		
		$token = $request->input('token');
		if ($token != config('site.api_token')) {
			return response()->json([
				'status' => 'Invalid API Token',
			], 401);
		}
		
		$user_id = $request->input('userid');
		$responder_id = $request->input('autoresponderid');
		$integration = Integration::with('responder')->where('user_id', $user_id)->where('responder_id', $responder_id)->first();
		
		$re_data['result'] = '';
		if ($integration->responder->title == 'Sendlane') {
			$re_data = $this->apiRepo->getSendlaneList($integration);
		} else if ($integration->responder->title == 'MailChimp') {
			$re_data = $this->apiRepo->getMailChimpLists($integration);
		} else if ($integration->responder->title == 'ActiveCampaign') {
			$re_data = $this->apiRepo->getActiveCampaignList($integration);
		} else if ($integration->responder->title == 'Campaign Monitor') {
			$re_data = $this->apiRepo->getCampaignMonitorLists($integration);
		} else if ($integration->responder->title == 'GetResponse') {
			$re_data = $this->apiRepo->getResponseCampaigns($integration);
		} else if ($integration->responder->title == 'MailerLite') {
			$re_data = $this->apiRepo->getMailerLiteGroups($integration);
		} else if ($integration->responder->title == 'Send In Blue') {
			$re_data = $this->apiRepo->getSendInBlueLists($integration);
		} else if ($integration->responder->title == 'Aweber') {
			$re_data = $this->apiRepo->getAWeberLists($integration);
		} else if ($integration->responder->title == 'Constant Contact') {
			$re_data = $this->apiRepo->getConstantContactLists($integration);
		} else if ($integration->responder->title == 'Sendy') {
			$integrations = Integration::with('responder')->where('user_id', $user_id)->where('responder_id', $responder_id)->get();
			
			$re_data = $this->apiRepo->getSendyLists($integrations);
		} else if ($integration->responder->title == 'HTML Integration') {
			$integrations = Integration::with('responder')->where('user_id', $user_id)->where('responder_id', $responder_id)->get();
			
			$re_data = $this->apiRepo->getHTMLIntegrationList($integrations);
		}
		
		if ($re_data['result'] == 'success') {
			$this->arListRepo->setArList($user_id, $integration->id, $re_data['message']);
		} else {
			return response()->json([
				'status' => $re_data['message'],
			], 401);
		}
		
		return response()->json([
			'status' => 'success'
		], 201);
	}
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \MailerLiteApi\Exceptions\MailerLiteSdkException
	 * @throws \SendinBlue\Client\ApiException
	 * @throws \Exception
	 */
	public function addRecipient(Request $request)
	{
		$validate = Validator::make($request->all(), [
			'token'    => 'required',
			'arlistid' => 'required',
			'name'     => 'required',
			'email'    => 'required',
		]);
		
		if ($validate->fails()) {
			return response()->json($validate->errors()->toArray());
		}
		
		$token = $request->input('token');
		if ($token != config('site.api_token')) {
			return response()->json([
				'status' => 'Invalid API Token',
			], 401);
		}
		
		$subscriber_name = $request->input('name');
		$subscriber_email = $request->input('email');
		
		$ar_list = $this->arListRepo->model()->find($request->input('arlistid'));
		if ($ar_list && !is_null($ar_list)) {
			$ip = $request->getClientIp();
			
			$integration = Integration::with('responder')->where('id', $ar_list->integration_id)->first();
			if ($integration && !is_null($integration)) {
				if ($integration->responder->title == 'Sendlane') {
					$this->apiRepo->setSendlaneList($integration, $subscriber_name, $subscriber_email, $ar_list->list_id);
				} else if ($integration->responder->title == 'MailChimp') {
					$this->apiRepo->setMailChimpLists($integration, $subscriber_name, $subscriber_email, $ar_list->list_id, $ip);
				} else if ($integration->responder->title == 'ActiveCampaign') {
					$this->apiRepo->setActiveCampaignLists($integration, $subscriber_name, $subscriber_email, $ar_list->list_id, $ip);
				} else if ($integration->responder->title == 'Campaign Monitor') {
					$this->apiRepo->setCampaignMonitorLists($integration, $subscriber_name, $subscriber_email, $ar_list->list_id, $ip);
				} else if ($integration->responder->title == 'GetResponse') {
					$this->apiRepo->setGetResponseContact($integration, $subscriber_email, $ar_list->list_id);
				} else if ($integration->responder->title == 'MailerLite') {
					$this->apiRepo->setMailerLiteSubscribers($integration, $subscriber_name, $subscriber_email, $ar_list->list_id);
				} else if ($integration->responder->title == 'Send In Blue') {
					$this->apiRepo->setSendInBlueSubscribers($integration, $subscriber_name, $subscriber_email, $ar_list->list_id);
				} else if ($integration->responder->title == 'Aweber') {
					$this->apiRepo->setAWeberSubscribers($integration, $subscriber_name, $subscriber_email, $ar_list->list_id);
				} else if ($integration->responder->title == 'Constant Contact') {
					$this->apiRepo->setConstantContactSubscriber($integration, $subscriber_name, $subscriber_email, $ar_list->list_id);
				} else if ($integration->responder->title == 'Sendy') {
					$integration = Integration::with('responder')->where('user_id', $ar_list->user_id)
						->where('responder_id', $integration->responder_id)->where('hash', $ar_list->list_id)
						->first();
					
					$this->apiRepo->setSendySubscriber($integration, $subscriber_name, $subscriber_email, $ar_list->list_id);
				}
			}
		}
		
		return response()->json([
			'status' => 'success'
		], 201);
	}
}
