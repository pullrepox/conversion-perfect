<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use App\Http\Repositories\TinyMinify;
use App\User;
use Illuminate\Http\Request;
use Soumen\Agent\Facades\Agent;

class OverlaysController extends Controller
{
    protected $barRepo;
    
    public function __construct(BarsRepository $barsRepository)
    {
        $this->barRepo = $barsRepository;
    }
    
    public function index($sub_domain, $link_name)
    {
        $user = User::where('subdomain', $sub_domain)->first();
        $bar = $this->barRepo->model()->where('user_id', $user->id)->where('custom_link_text', $link_name)->first();
        
        if ($bar && !is_null($bar)) {
            $option = 'loaded';
            return view('users.track-partials.preview-html', compact('bar', 'option'));
        } else {
            abort(404, 'No existing is matched Conversion Bar.');
        }
        
        return response('No existing is matched Conversion Bar.');
    }
    
    /**
     * Get conversion bar script code
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getCBScriptCode($id, Request $request)
    {
        $bar = $this->barRepo->model()->find($id);
        
        if ($bar && !is_null($bar)) {
            $fp_id = "";
            if (strpos($request->header("cookie"), "CVP--fp-id=") !== false) {
                $fp_ary = explode('CVP--fp-id=', $request->header("cookie"));
                $fp_ary1 = explode(';', $fp_ary[1]);
                $fp_id = $fp_ary1[0];
            }
            $ip = $request->getClientIp();
            $requestData = sprintf('lang:%s,ua:%s,ip:%s,accept:%s,ref:%s,encode:%s',
                implode(',', $request->getLanguages()), $request->header('user-agent'), $ip,
                $request->header('accept'), $request->header('referer'), implode(',', $request->getEncodings()));
            $unique_id = md5($requestData);
            
            $unique_check = $this->barRepo->checkUniqueLog($bar->id, $bar->user_id, $fp_id, $unique_id);
            
            $browser = Agent::browser();
            $platform = Agent::platform();
            $device = Agent::device();
            $geo_location = geoip()->getLocation($ip);
            
            $ins_log_data = [
                'user_id'          => $bar->user_id,
                'bar_id'           => $bar->id,
                'reset_stats'      => 0,
                'cookie'           => $fp_id,
                'unique_ref'       => $unique_id,
                'unique_click'     => $unique_check ? 1 : 0,
                'button_click'     => 0,
                'lead_capture'     => 0,
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
            $this->barRepo->model1()->insertGetId($ins_log_data);
            
            $splitTest = '';
            
            $html_code = view('users.track-partials.script', compact('bar', 'splitTest'));
            $code = TinyMinify::html($html_code);
            
            header('Content-Type: application/javascript; charset=utf-8;');
            
            exit("document.write('" . addslashes($code) . "')");
        } else {
            abort(404, 'No existing is matched Conversion Bar.');
        }
        
        return response('No existing is matched Conversion Bar.');
    }
    
    public function setActionButtonClick($id, Request $request)
    {
        $bar = $this->barRepo->model()->find($id);
        $set_log = 'success';
        if ($bar && !is_null($bar)) {
            $ip = $request->getClientIp();
            $fp_id = $request->input('cookie');
            $requestData = sprintf('lang:%s,ua:%s,ip:%s,accept:%s,ref:%s,encode:%s',
                implode(',', $request->getLanguages()), $request->header('user-agent'), $ip,
                $request->header('accept'), $request->header('referer'), implode(',', $request->getEncodings()));
            $unique_id = md5($requestData);
            
            $split_bar_id = $request->has('split_bar_id') ? $request->input('split_bar_id') : 0;
            
            $set_log = $this->barRepo->setActionBtnClickLog($bar->id, $bar->user_id, $fp_id, $unique_id, $split_bar_id);
            if (!$set_log) {
                $unique_check = $this->barRepo->checkUniqueLog($bar->id, $bar->user_id, $fp_id, $unique_id, $split_bar_id);
                $browser = Agent::browser();
                $platform = Agent::platform();
                $device = Agent::device();
                $geo_location = geoip()->getLocation($ip);
                
                $ins_log_data = [
                    'user_id'          => $bar->user_id,
                    'bar_id'           => $bar->id,
                    'split_bar_id'     => $split_bar_id,
                    'reset_stats'      => 0,
                    'cookie'           => $fp_id,
                    'unique_ref'       => $unique_id,
                    'unique_click'     => $unique_check ? 1 : 0,
                    'button_click'     => 1,
                    'lead_capture'     => 0,
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
                
                $this->barRepo->model1()->insertGetId($ins_log_data);
            }
        }
        
        return response()->json(['result' => $set_log]);
    }
    
    public function getSplitScriptCode($id, $bar_id, Request $request)
    {
        $splitTest = $this->barRepo->model2()->find($id);
        if (!$splitTest || is_null($splitTest)) {
            abort(404, 'No existing is matched Split Test Bar.');
        }
        if ($splitTest->bar_id != $bar_id) {
            abort(404, 'No existing is matched Conversion Bar.');
        }
        
        $bar = $this->barRepo->model()->find($bar_id);
        if ($bar && !is_null($bar)) {
            $fp_id = "";
            if (strpos($request->header("cookie"), "CVP--fp-id=") !== false) {
                $fp_ary = explode('CVP--fp-id=', $request->header("cookie"));
                $fp_ary1 = explode(';', $fp_ary[1]);
                $fp_id = $fp_ary1[0];
            }
            $ip = $request->getClientIp();
            $requestData = sprintf('lang:%s,ua:%s,ip:%s,accept:%s,ref:%s,encode:%s',
                implode(',', $request->getLanguages()), $request->header('user-agent'), $ip,
                $request->header('accept'), $request->header('referer'), implode(',', $request->getEncodings()));
            $unique_id = md5($requestData);
            
            $unique_check = $this->barRepo->checkUniqueLog($bar->id, $bar->user_id, $fp_id, $unique_id, $splitTest->id);
            
            $browser = Agent::browser();
            $platform = Agent::platform();
            $device = Agent::device();
            $geo_location = geoip()->getLocation($ip);
            
            $ins_log_data = [
                'user_id'          => $bar->user_id,
                'bar_id'           => $bar->id,
                'split_bar_id'     => $splitTest->id,
                'reset_stats'      => 0,
                'cookie'           => $fp_id,
                'unique_ref'       => $unique_id,
                'unique_click'     => $unique_check ? 1 : 0,
                'button_click'     => 0,
                'lead_capture'     => 0,
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
            
            $this->barRepo->model1()->insertGetId($ins_log_data);
            
            $html_code = view('users.track-partials.script', compact('bar', 'splitTest'));
            $code = TinyMinify::html($html_code);
            
            header('Content-Type: application/javascript; charset=utf-8;');
            
            exit("document.write('" . addslashes($code) . "')");
        } else {
            abort(404, 'No existing is matched Conversion Bar.');
        }
        
        return response('No existing is matched Conversion Bar.');
    }
    
    public function getMultiBarScriptCode($id, Request $request)
    {
        $multiBar = $this->barRepo->model3()->find($id);
        if (!$multiBar || is_null($multiBar)) {
            abort(404, 'No existing is matched Multi Bar.');
        }
        
        $bar_ids = $multiBar->bar_ids;
    
        $bar = $this->barRepo->model()->find($bar_ids[0]);
    
        if ($bar && !is_null($bar)) {
            $fp_id = "";
            if (strpos($request->header("cookie"), "CVP--fp-id=") !== false) {
                $fp_ary = explode('CVP--fp-id=', $request->header("cookie"));
                $fp_ary1 = explode(';', $fp_ary[1]);
                $fp_id = $fp_ary1[0];
            }
            $ip = $request->getClientIp();
            $requestData = sprintf('lang:%s,ua:%s,ip:%s,accept:%s,ref:%s,encode:%s',
                implode(',', $request->getLanguages()), $request->header('user-agent'), $ip,
                $request->header('accept'), $request->header('referer'), implode(',', $request->getEncodings()));
            $unique_id = md5($requestData);
        
            $unique_check = $this->barRepo->checkUniqueLog($bar->id, $bar->user_id, $fp_id, $unique_id);
        
            $browser = Agent::browser();
            $platform = Agent::platform();
            $device = Agent::device();
            $geo_location = geoip()->getLocation($ip);
        
            $ins_log_data = [
                'user_id'          => $bar->user_id,
                'bar_id'           => $bar->id,
                'reset_stats'      => 0,
                'cookie'           => $fp_id,
                'unique_ref'       => $unique_id,
                'unique_click'     => $unique_check ? 1 : 0,
                'button_click'     => 0,
                'lead_capture'     => 0,
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
            $this->barRepo->model1()->insertGetId($ins_log_data);
        
            $splitTest = '';
        
            $html_code = view('users.track-partials.script', compact('bar', 'splitTest'));
            $code = TinyMinify::html($html_code);
        
            header('Content-Type: application/javascript; charset=utf-8;');
        
            exit("document.write('" . addslashes($code) . "')");
        } else {
            abort(404, 'No existing is matched Conversion Bar.');
        }
    
        return response('No existing is matched Conversion Bar.');
    }
}
