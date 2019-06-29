<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use App\Models\Bar;
use Illuminate\Http\Request;

class BarsController extends Controller
{
    protected $barsRepo;
    
    public function __construct(BarsRepository $barsRepository)
    {
        $this->barsRepo = $barsRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header_data = [
            'main_name'   => 'Conversion Bars',
            'parent_data' => []
        ];
        
        $bars = Bar::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('users.bars-list', compact('header_data', 'bars'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header_data = [
            'main_name'   => 'New Conversion Bar',
            'parent_data' => [
                ['parent_name' => 'Conversion Bars', 'parent_url' => secure_redirect(route('bars'))],
            ]
        ];
        
        $flag = true;
        $form_action = secure_redirect(route('bars.store'));
        
        return view('users.bars-edit', compact('header_data', 'flag', 'form_action'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'friendly_name'    => 'required|max:100',
            'headline'         => 'required',
            'headline_color'   => 'required',
            'background_color' => 'required'
        ]);
        
        $ins_data = [
            'user_id'          => auth()->user()->id,
            'friendly_name'    => $request->input('friendly_name'),
            'position'         => $request->input('position'),
            'group_id'         => $request->input('group_id'),
            'headline_color'   => $request->input('headline_color'),
            'background_color' => $request->input('background_color'),
            'opt_preview'      => 1
        ];
        
        $headline = $request->input('headline');
        $ins_data['headline'] = [[
            'insert' => 'Your Headline'
        ]];
        for ($i = 0; $i < count($headline); $i++) {
            $ins_data['headline'][$i]['insert'] = addslashes($headline[$i] . ($i < (count($headline) - 1) ? ' ' : ''));
            if (!is_null($request->input('headline_bold')[$i])) {
                $ins_data['headline'][$i]['attributes']['bold'] = true;
            }
            if (!is_null($request->input('headline_italic')[$i])) {
                $ins_data['headline'][$i]['attributes']['italic'] = true;
            }
            if (!is_null($request->input('headline_underline')[$i])) {
                $ins_data['headline'][$i]['attributes']['underline'] = true;
            }
            if (!is_null($request->input('headline_strike')[$i])) {
                $ins_data['headline'][$i]['attributes']['strike'] = true;
            }
        }
        
        $ins_data['headline'] = json_encode($ins_data['headline']);
        
        $bar_id = $this->barsRepo->model()->insertGetId($ins_data);
        
        session()->flash('success', 'Successfully Created');
        
        return response()->redirectTo('bars/' . $bar_id . '/edit');
    }
    
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Http\Response
     */
    public function show(Bar $bar)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Http\Response
     */
    public function edit(Bar $bar)
    {
        $header_data = [
            'main_name'   => 'Edit Conversion Bar',
            'parent_data' => [
                ['parent_name' => 'Conversion Bars', 'parent_url' => secure_redirect(route('bars'))],
            ]
        ];
        
        $bar->opt_preview = $bar->opt_preview ? 'true' : 'false';
        $bar->opt_display = $bar->opt_display ? 'true' : 'false';
        $bar->opt_content = $bar->opt_content ? 'true' : 'false';
        $bar->opt_appearance = $bar->opt_appearance ? 'true' : 'false';
        $bar->opt_button = $bar->opt_button ? 'true' : 'false';
        $bar->opt_countdown = $bar->opt_countdown ? 'true' : 'false';
        $bar->opt_opt_in = $bar->opt_opt_in ? 'true' : 'false';
        $bar->opt_overlay = $bar->opt_overlay ? 'true' : 'false';
        $bar->opt_custom_text = $bar->opt_custom_text ? 'true' : 'false';
        
        $bar->headline = !is_null(trim($bar->headline)) && !empty(trim($bar->headline)) ? addslashes(stripslashes($bar->headline)) : json_encode([['attributes' => [], 'insert' => 'Your Headline']]);
        
        $bar->sub_headline = !is_null(trim($bar->sub_headline)) && !empty(trim($bar->sub_headline)) ? addslashes(stripslashes($bar->sub_headline)) : json_encode([['attributes' => [], 'insert' => '']]);
        $bar->sub_headline_color = is_null($bar->sub_headline_color) ? '#FFFFFF' : $bar->sub_headline_color;
        $bar->video_auto_play = $bar->video_auto_play ? true : false;
        
        $bar->drop_shadow = $bar->drop_shadow ? true : false;
        $bar->close_button = $bar->close_button ? true : false;
        $bar->background_gradient = $bar->background_gradient ? true : false;
        $bar->gradient_end_color = is_null($bar->gradient_end_color) ? '#3BAF85' : $bar->gradient_end_color;
        
        $bar->button_label = is_null($bar->button_label) ? 'Click Here' : $bar->button_label;
        $bar->button_background_color = is_null($bar->button_background_color) ? '#515f7f' : $bar->button_background_color;
        $bar->button_text_color = is_null($bar->button_text_color) ? '#FFFFFF' : $bar->button_text_color;
        $bar->button_open_new = $bar->button_open_new ? true : false;
        $bar->delay_in_seconds = $bar->delay_in_seconds ? $bar->delay_in_seconds : 3;
        $bar->scroll_point_percent = $bar->scroll_point_percent ? $bar->scroll_point_percent : 10;
        
        $bar->countdown_end_date = $bar->countdown_end_date != '0000-00-00' ? date('m/d/Y', strtotime($bar->countdown_end_date)) : date('m/d/Y');
        
        $flag = false;
        $form_action = secure_redirect(route('bars.update', ['bar' => $bar->id]));
        
        return view('users.bars-edit', compact('header_data', 'flag', 'form_action', 'bar'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function update(Request $request, Bar $bar)
    {
        $rules = [
            'friendly_name'    => 'required|max:100',
            'headline'         => 'required',
            'headline_color'   => 'required',
            'background_color' => 'required'
        ];
        
        $params = $request->all();
        $radio_keys = ['video_auto_play', 'drop_shadow', 'close_button', 'background_gradient', 'button_open_new'];
        $option_keys = ['opt_preview', 'opt_display', 'opt_content', 'opt_appearance', 'opt_button', 'opt_countdown', 'opt_overlay', 'opt_opt_in', 'opt_custom_text'];
        foreach ($params as $key => $val) {
            if (false !== array_search($key, $radio_keys)) {
                $params[$key] = $val ? 1 : 0;
            } else if (false !== array_search($key, $option_keys)) {
                $params[$key] = $val == 'true' ? 1 : 0;
            } else {
                if (is_null($val)) $params[$key] = '';
            }
            
            if ($key == 'headline' || $key == 'sub_headline') {
                $upd_headline = [[
                    'insert' => ($key == 'headline' ? 'Your Headline' : '')
                ]];
                for ($i = 0; $i < count($val); $i++) {
                    $upd_headline[$i]['insert'] = addslashes($val[$i] . ($i < (count($val) - 1) ? ' ' : ''));
                    if (!is_null($request->input('headline_bold')[$i])) {
                        $upd_headline[$i]['attributes']['bold'] = true;
                    }
                    if (!is_null($request->input('headline_italic')[$i])) {
                        $upd_headline[$i]['attributes']['italic'] = true;
                    }
                    if (!is_null($request->input('headline_underline')[$i])) {
                        $upd_headline[$i]['attributes']['underline'] = true;
                    }
                    if (!is_null($request->input('headline_strike')[$i])) {
                        $upd_headline[$i]['attributes']['strike'] = true;
                    }
                }
                
                $params[$key] = json_encode($upd_headline);
            }
            
            if ($key == 'countdown_end_date') {
                $params[$key] = date('m/d/Y', strtotime($val));
            }
            
            if ($key == 'countdown_end_time') {
                $params[$key] = date('H:i:s', strtotime($val));
            }
        }
        
        if ($request->input('opt_display') == 'true') {
            $rules['delay_in_seconds'] = 'numeric';
            $rules['scroll_point_percent'] = 'numeric';
        }
        
        if ($request->input('opt_content') == 'true') {
//            $rules['sub_headline'] = 'required';
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
        
        if ($request->input('opt_appearance') == 'true') {
            $rules['opacity'] = 'numeric|max:100|min:0';
            $rules['gradient_angle'] = 'numeric|max:360|min:0';
        }
        
        if ($request->input('opt_button') == 'true') {
            if ($request->input('button_type') != 'none') {
                $rules['button_label'] = 'required';
            }
            if ($request->input('button_action') == 'open_click_url') {
                $rules['button_click_url'] = 'required';
            }
        }
        
        if ($request->input('opt_countdown') == 'true') {
            if ($request->input('countdown_on_expiry') == 'display_text') {
                $rules['countdown_expiration_text'] = 'required|max:200';
            }
            if ($request->input('countdown_on_expiry') == 'redirect') {
                $rules['countdown_expiration_url'] = 'required|max:200';
            }
            if ($request->input('countdown') == 'calendar') {
                $rules['countdown_end_date'] = 'date_format:Y-m-d';
            }
            if ($request->input('countdown') == 'evergreen') {
                $rules['countdown_days'] = 'numeric|min:0';
                $rules['countdown_hours'] = 'numeric|min:0|max:23';
                $rules['countdown_minutes'] = 'numeric|min:0|max:59';
            }
        }
        
        $this->validate($request, $rules);
        
        $bar->fill($params);
        
        $bar->save();
        
        session()->flash('success', 'Successfully Updated');
        
        return response()->redirectTo('bars');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function destroy(Bar $bar)
    {
        $bar->delete();
        
        return response()->json([
            'result' => 'success'
        ]);
    }
}
