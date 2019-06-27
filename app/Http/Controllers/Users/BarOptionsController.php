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
            $upd_sub_headline = [];
            
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
            $bar->sub_headline = '';
            $bar->sub_headline_color = '#ffffff';
            $bar->sub_background_color = '#3BAF85';
            $bar->video = 0;
            $bar->video_code = '';
            $bar->video_auto_play = 0;
        }
        
        $bar->save();
        
        return response()->json([
            'status' => 'success'
        ]);
    }
}
