<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarOptionsController extends Controller
{
    protected $barsRepo;
    
    public function __construct(BarsRepository $barsRepository)
    {
        $this->barsRepo = $barsRepository;
    }
    
    public function hideBarOption(Request $request)
    {
        $bar_id = $request->route()->parameter('id');
        $bar = $this->barsRepo->find($bar_id);
        $opt_key = $request->input('option_key');
        $opt_param = 'opt_' . $opt_key;
        $bar->$opt_param = 0;
        
        $bar->save();
        
        return response()->json([
            'status' => 'success'
        ]);
    }
    
    public function saveBarOption(Request $request)
    {
        $bar_id = $request->route()->parameter('id');
        $bar = $this->barsRepo->find($bar_id);
        $opt_key = $request->input('option_key');
        $rules = [];
        
        $params = $request->all();
        $radio_keys = ['video_auto_play', 'drop_shadow', 'close_button', 'background_gradient', 'button_open_new'];
        foreach ($params as $key => $val) {
            if (false !== array_search($key, $radio_keys)) {
                $params[$key] = $val ? 1 : 0;
            } else {
                if (is_null($val)) $params[$key] = '';
            }
            
            if ($key == 'sub_headline') {
                $upd_sub_headline = [[
                    'insert' => ''
                ]];
                for ($i = 0; $i < count($val); $i++) {
                    if (trim($val[$i]['insert']) == '' || is_null($val[$i]['insert'])) {
                        continue;
                    }
                    $upd_sub_headline[$i]['insert'] = addslashes($val[$i]['insert']);
                    if (isset($val[$i]['attributes'])) {
                        if (isset($val[$i]['attributes']['bold'])) {
                            $upd_sub_headline[$i]['attributes']['bold'] = true;
                        }
                        if (isset($val[$i]['attributes']['italic'])) {
                            $upd_sub_headline[$i]['attributes']['italic'] = true;
                        }
                        if (isset($val[$i]['attributes']['underline'])) {
                            $upd_sub_headline[$i]['attributes']['underline'] = true;
                        }
                        if (isset($val[$i]['attributes']['strike'])) {
                            $upd_sub_headline[$i]['attributes']['strike'] = true;
                        }
                    }
                }
                
                $params[$key] = json_encode($upd_sub_headline);
            }
            
            if ($key == 'countdown_end_date') {
                $params[$key] = date('Y-m-d', strtotime($val));
            }
            
            if ($key == 'countdown_end_time') {
                $params[$key] = date('H:i:s', strtotime($val));
            }
        }
        
        if ($opt_key == 'display') {
            $bar->opt_display = 1;
            $rules['delay_in_seconds'] = 'numeric';
            $rules['scroll_point_percent'] = 'numeric';
        }
        
        if ($opt_key == 'content') {
            $bar->opt_content = 1;
            if ($request->input('video_type') != 'none') {
                if ($request->input('video_type') == 'youtube') {
                    $rules['content_youtube_url'] = 'required|url';
                } else if ($request->input('video_type') == 'vimeo') {
                    $rules['content_vimeo_url'] = 'required|url';
                } else {
                    $rules['video_code'] = 'required';
                }
            }
        }
        
        if ($opt_key == 'appearance') {
            $bar->opt_appearance = 1;
            $rules['opacity'] = 'numeric|max:100|min:0';
            $rules['gradient_angle'] = 'numeric|max:360|min:0';
        }
        
        if ($opt_key == 'button') {
            $bar->opt_button = 1;
            if ($request->input('button_type') != 'none') {
                $rules['button_label'] = 'required';
            }
            if ($request->input('button_action') == 'open_click_url') {
                $rules['button_click_url'] = 'required';
            }
        }
        
        if ($opt_key == 'countdown') {
            $bar->opt_countdown = 1;
            if ($request->input('countdown_on_expiry') == 'display_text') {
                $rules['countdown_expiration_text'] = 'required|max:200';
            }
            if ($request->input('countdown_on_expiry') == 'redirect') {
                $rules['countdown_expiration_url'] = 'required|max:200';
            }
            if ($request->input('countdown') == 'calendar') {
                $rules['countdown_end_date'] = 'date_format:m/d/Y';
            }
            if ($request->input('countdown') == 'evergreen') {
                $rules['countdown_days'] = 'numeric|min:0|max:30';
                $rules['countdown_hours'] = 'numeric|min:0|max:23';
                $rules['countdown_minutes'] = 'numeric|min:0|max:59';
            }
        }
    
        if ($opt_key == 'overlay') {
            $bar->opt_overlay = 1;
            $rules['custom_link_text'] = 'required';
            $rules['third_party_url'] = 'required';
        }
    
        if ($opt_key == 'autoresponder') {
            if ($request->input('integration_type') != 'none') {
                if ($request->input('integration_type') != 'conversion_perfect') {
                    $rules['list'] = 'required';
                }
        
                if ($request->input('after_submit') == 'show_message') {
                    $rules['message'] = 'required';
                } else {
                    $rules['redirect_url'] = 'required';
                }
            }
        }
        
        $validate = Validator::make($request->all(), $rules);
        
        if ($validate->fails()) {
            return response()->json($validate->errors()->toArray(), 422);
        }
        
        $bar->fill($params);
        
        $bar->save();
        
        return response()->json([
            'status' => 'success'
        ]);
    }
    
    public function clearBarOption(Request $request)
    {
        $bar_id = $request->route()->parameter('id');
        $bar = $this->barsRepo->find($bar_id);
        $opt_key = $request->input('option_key');
        
        $opt_param = 'opt_' . $opt_key;
        $bar->$opt_param = 0;
        
        $params = $request->input('data');
        foreach ($params as $key => $val) {
            if (is_null($val)) $params[$key] = '';
            if ($key == 'sub_headline') {
                $params[$key] = json_encode([['attributes' => [], 'insert' => '']]);
            }
        }
        
        $bar->fill($params);
        
        $bar->save();
        
        return response()->json([
            'status' => 'success'
        ]);
    }
}
