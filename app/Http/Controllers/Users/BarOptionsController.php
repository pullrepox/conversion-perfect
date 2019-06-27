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
        if ($opt_key == 'display') {
            $bar->opt_display = 1;
            $bar->show_bar_type = $request->input('show_bar_type');
            $bar->frequency = $request->input('frequency');
            $bar->delay_in_seconds = $request->input('delay_in_seconds');
            $bar->scroll_point_percent = $request->input('scroll_point_percent');
            $rules['delay_in_seconds'] = 'numeric';
            $rules['scroll_point_percent'] = 'numeric';
        }
        
        if ($opt_key == 'content') {
            $bar->opt_content = 1;
            
            $sub_headline = $request->input('sub_headline');
            $upd_sub_headline = [[
                'insert' => ''
            ]];
            for ($i = 0; $i < count($sub_headline); $i++) {
                if (trim($sub_headline[$i]['insert']) == '' || is_null($sub_headline[$i]['insert'])) {
                    continue;
                }
                $upd_sub_headline[$i]['insert'] = addslashes($sub_headline[$i]['insert']);
                if (isset($sub_headline[$i]['attributes'])) {
                    if (isset($sub_headline[$i]['attributes']['bold'])) {
                        $upd_sub_headline[$i]['attributes']['bold'] = true;
                    }
                    if (isset($sub_headline[$i]['attributes']['italic'])) {
                        $upd_sub_headline[$i]['attributes']['italic'] = true;
                    }
                    if (isset($sub_headline[$i]['attributes']['underline'])) {
                        $upd_sub_headline[$i]['attributes']['underline'] = true;
                    }
                    if (isset($sub_headline[$i]['attributes']['strike'])) {
                        $upd_sub_headline[$i]['attributes']['strike'] = true;
                    }
                }
            }
            
            $bar->sub_headline = json_encode($upd_sub_headline);
            $bar->sub_headline_color = $request->input('sub_headline_color');
            $bar->sub_background_color = $request->input('sub_background_color');
            $bar->video = $request->input('video') ? 1 : 0;
            $bar->video_code = $request->input('video_code');
            $bar->video_auto_play = $request->input('video_auto_play') ? 1 : 0;
            
            $rules['sub_headline'] = 'required';
            if ($request->input('video')) {
                $rules['video_code'] = 'required';
            }
        }
    
        if ($opt_key == 'appearance') {
            $bar->opt_appearance = 1;
            $bar->opacity = $request->input('opacity');
            $bar->drop_shadow = $request->input('drop_shadow') ? 1 : 0;
            $bar->close_button = $request->input('close_button') ? 1 : 0;
            $bar->background_gradient = $request->input('background_gradient') ? 1 : 0;
            $bar->gradient_end_color = $request->input('gradient_end_color');
            $bar->gradient_angle = $request->input('gradient_angle');
            $bar->powered_by_position = $request->input('powered_by_position');
            $rules['opacity'] = 'numeric|max:100|min:0';
        }
    
        if ($opt_key == 'button') {
            $bar->opt_button = 1;
            $bar->button_type = $request->input('button_type');
            $bar->button_location = $request->input('button_location');
            $bar->button_label = $request->input('button_label');
            $bar->button_background_color = $request->input('button_background_color');
            $bar->button_text_color = $request->input('button_text_color');
            $bar->button_animation = $request->input('button_animation');
            $bar->button_action = $request->input('button_action');
            $bar->button_click_url = $request->input('button_click_url');
            $bar->button_open_new = $request->input('button_open_new') ? 1 : 0;
            if ($request->input('button_type') != 'none') {
                $rules['button_label'] = 'required';
            }
            if ($request->input('button_action') == 'open_click_url') {
                $rules['button_click_url'] = 'required';
            }
        }
        
        $validate = Validator::make($request->all(), $rules);
        
        if ($validate->fails()) {
            return response()->json($validate->errors()->toArray(), 422);
        }
        
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
        if ($opt_key == 'display') {
            $bar->opt_display = 0;
            $bar->show_bar_type = 'immediate';
            $bar->frequency = 'every';
            $bar->delay_in_seconds = 0;
            $bar->scroll_point_percent = 0;
        }
        
        if ($opt_key == 'content') {
            $bar->opt_content = 0;
            $bar->sub_headline = json_encode([['attributes' => [], 'insert' => '']]);
            $bar->sub_headline_color = '#FFFFFF';
            $bar->sub_background_color = '';
            $bar->video = 0;
            $bar->video_code = '';
            $bar->video_auto_play = 0;
        }
    
        if ($opt_key == 'appearance') {
            $bar->opt_appearance = 0;
            $bar->opacity = 100;
            $bar->drop_shadow = 0;
            $bar->close_button = 0;
            $bar->background_gradient = 0;
            $bar->gradient_end_color = '#3BAF85';
            $bar->gradient_angle = 0;
            $bar->powered_by_position = 'bottom_right';
        }
    
        if ($opt_key == 'button') {
            $bar->opt_button = 0;
            $bar->button_type = 'none';
            $bar->button_location = 'right';
            $bar->button_label = '';
            $bar->button_background_color = '#515f7f';
            $bar->button_text_color = '#FFFFFF';
            $bar->button_animation = 'none';
            $bar->button_action = 'hide_bar';
            $bar->button_click_url = '';
            $bar->button_open_new = 0;
        }
        
        $bar->save();
        
        return response()->json([
            'status' => 'success'
        ]);
    }
}
