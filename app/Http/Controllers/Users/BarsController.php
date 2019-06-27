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
            'parent_data' => [],
            'button_show' => true,
            'button_data' => [
                ['button_url' => '', 'button_text' => '']
            ]
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
            ],
            'button_show' => true,
            'button_data' => [
                ['button_url' => '', 'button_text' => '']
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
            ],
            'button_show' => true,
            'button_data' => [
                ['button_url' => '', 'button_text' => '']
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
        
        $bar->headline = !is_null(trim($bar->headline)) && !empty(trim($bar->headline)) ? addslashes(stripslashes($bar->headline)) : json_encode([['attributes' => [], 'insert' => '']]);
        
        $bar->sub_headline = !is_null(trim($bar->sub_headline)) && !empty(trim($bar->sub_headline)) ? addslashes(stripslashes($bar->sub_headline)) : json_encode([['attributes' => [], 'insert' => '']]);
        $bar->sub_headline_color = is_null($bar->sub_headline_color) ? '#FFFFFF' : $bar->sub_headline_color;
        $bar->sub_background_color = is_null($bar->sub_background_color) ? '#3BAF85' : $bar->sub_background_color;
        $bar->video = $bar->video ? true : false;
        
        $bar->drop_shadow = $bar->drop_shadow ? true : false;
        $bar->close_button = $bar->close_button ? true : false;
        $bar->background_gradient = $bar->background_gradient ? true : false;
        $bar->gradient_end_color = is_null($bar->gradient_end_color) ? '#3BAF85' : $bar->gradient_end_color;
        
        $bar->button_background_color = is_null($bar->button_background_color) ? '#515f7f' : $bar->button_background_color;
        $bar->button_text_color = is_null($bar->button_text_color) ? '#FFFFFF' : $bar->button_text_color;
        $bar->button_open_new = $bar->button_open_new ? true : false;
        
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
        
        $bar->friendly_name = $request->input('friendly_name');
        $bar->position = $request->input('position');
        $bar->group_id = $request->input('group_id');
        $bar->headline_color = $request->input('headline_color');
        $bar->background_color = $request->input('background_color');
        $bar->opt_preview = $request->input('opt_preview') == 'true' ? 1 : 0;
        
        $headline = $request->input('headline');
        $upd_headline = [[
            'insert' => ''
        ]];
        for ($i = 0; $i < count($headline); $i++) {
            $upd_headline[$i]['insert'] = addslashes($headline[$i] . ($i < (count($headline) - 1) ? ' ' : ''));
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
        
        $bar->headline = json_encode($upd_headline);
        
        if ($request->input('opt_display') == 'true') {
            $bar->opt_display = 1;
            $bar->show_bar_type = $request->input('show_bar_type');
            $bar->frequency = $request->input('frequency');
            $bar->delay_in_seconds = $request->input('delay_in_seconds');
            $bar->scroll_point_percent = $request->input('scroll_point_percent');
            $rules['delay_in_seconds'] = 'numeric';
            $rules['scroll_point_percent'] = 'numeric';
        } else {
            $bar->opt_display = 0;
        }
        
        if ($request->input('opt_content') == 'true') {
            $bar->opt_content = 1;
            
            $sub_headline = $request->input('sub_headline');
            $upd_sub_headline = [[
                'insert' => ''
            ]];
            for ($i = 0; $i < count($sub_headline); $i++) {
                $upd_sub_headline[$i]['insert'] = addslashes($sub_headline[$i] . ($i < (count($sub_headline) - 1) ? ' ' : ''));
                if (!is_null($request->input('sub_headline_bold')[$i])) {
                    $upd_sub_headline[$i]['attributes']['bold'] = true;
                }
                if (!is_null($request->input('sub_headline_italic')[$i])) {
                    $upd_sub_headline[$i]['attributes']['italic'] = true;
                }
                if (!is_null($request->input('sub_headline_underline')[$i])) {
                    $upd_sub_headline[$i]['attributes']['underline'] = true;
                }
                if (!is_null($request->input('sub_headline_strike')[$i])) {
                    $upd_sub_headline[$i]['attributes']['strike'] = true;
                }
            }
            
            $bar->sub_headline = json_encode($upd_sub_headline);
            $bar->sub_headline_color = $request->input('sub_headline_color');
            $bar->sub_background_color = $request->input('sub_background_color');
            $bar->video = $request->input('video') ? 1 : 0;
            $bar->video_code = $request->input('video_code');
            $bar->video_auto_play = is_null($request->input('video_auto_play')) ? 0 : 1;
            
            $rules['sub_headline'] = 'required';
            if ($request->input('video')) {
                $rules['video_code'] = 'required';
            }
        } else {
            $bar->opt_content = 0;
        }
        
        if ($request->input('opt_appearance') == 'true') {
            $bar->opt_appearance = 1;
            $bar->opacity = $request->input('opacity');
            $bar->drop_shadow = $request->input('drop_shadow') ? 1 : 0;
            $bar->close_button = $request->input('close_button') ? 1 : 0;
            $bar->background_gradient = $request->input('background_gradient') ? 1 : 0;
            $bar->gradient_end_color = $request->input('gradient_end_color');
            $bar->gradient_angle = $request->input('gradient_angle');
            $bar->powered_by_position = $request->input('powered_by_position');
            $rules['opacity'] = 'numeric|max:100|min:0';
        } else {
            $bar->opt_appearance = 0;
        }
        
        if ($request->input('opt_button') == 'true') {
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
        } else {
            $bar->opt_button = 0;
        }
        
        $this->validate($request, $rules);
        
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
