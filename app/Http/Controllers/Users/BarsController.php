<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use App\Integration;
use App\Models\Bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $list_array = json_encode([['key' => '', 'name' => '-- Choose List --']]);
        $sel_tab = 'main';
        
        return view('users.bars-edit', compact('header_data', 'flag', 'form_action', 'list_array', 'sel_tab'));
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
        
        $rules = [
            'friendly_name'    => 'required|max:100',
            'headline'         => 'required',
            'headline_color'   => 'required',
            'background_color' => 'required'
        ];
        
        $params = $request->all();
        $radio_keys = ['video_auto_play', 'drop_shadow', 'close_button', 'background_gradient', 'button_open_new', 'opt_in_video_auto_play'];
        $string_keys = [
            'friendly_name', 'button_label', 'countdown_expiration_text', 'custom_link_text', 'meta_title', 'opt_in_button_label',
            'days_label', 'hours_label', 'minutes_label', 'seconds_label', 'opt_in_name_placeholder', 'opt_in_email_placeholder', 'powered_by_label', 'disclaimer'
        ];
        foreach ($params as $key => $val) {
            if (false !== array_search($key, $radio_keys)) {
                $params[$key] = $val ? 1 : 0;
            } else if (false !== array_search($key, $string_keys)) {
                $params[$key] = htmlspecialchars($val);
            } else {
                if (is_null($val)) $params[$key] = '';
            }
            
            if ($key == 'headline' || $key == 'sub_headline' || $key == 'call_to_action' || $key == 'subscribe_text') {
                if ($key == 'headline') {
                    $upd_headline = [['insert' => 'Your Headline']];
                } else if ($key == 'subscribe_text') {
                    $upd_headline = [['insert' => 'Enter Your Name And Email Below...']];
                } else if ($key == 'call_to_action') {
                    $upd_headline = [['insert' => 'Call To Action Text Here']];
                } else {
                    $upd_headline = [['insert' => '']];
                }
                if ($request->ajax()) {
                    for ($i = 0; $i < count($val); $i++) {
                        if (trim($val[$i]['insert']) == '' || is_null($val[$i]['insert'])) {
                            continue;
                        }
                        $upd_headline[$i]['insert'] = addslashes($val[$i]['insert'] . ($i < (count($val) - 1) ? ' ' : ''));
                        if (isset($val[$i]['attributes'])) {
                            if (isset($val[$i]['attributes']['bold'])) {
                                $upd_headline[$i]['attributes']['bold'] = true;
                            }
                            if (isset($val[$i]['attributes']['italic'])) {
                                $upd_headline[$i]['attributes']['italic'] = true;
                            }
                            if (isset($val[$i]['attributes']['underline'])) {
                                $upd_headline[$i]['attributes']['underline'] = true;
                            }
                            if (isset($val[$i]['attributes']['strike'])) {
                                $upd_headline[$i]['attributes']['strike'] = true;
                            }
                        }
                    }
                } else {
                    for ($i = 0; $i < count($val); $i++) {
                        if (trim($val[$i]) == '' || is_null($val[$i])) {
                            continue;
                        }
                        $upd_headline[$i]['insert'] = addslashes($val[$i] . ($i < (count($val) - 1) ? ' ' : ''));
                        if (!is_null($request->input($key . '_bold')[$i])) {
                            $upd_headline[$i]['attributes']['bold'] = true;
                        }
                        if (!is_null($request->input($key . '_italic')[$i])) {
                            $upd_headline[$i]['attributes']['italic'] = true;
                        }
                        if (!is_null($request->input($key . '_underline')[$i])) {
                            $upd_headline[$i]['attributes']['underline'] = true;
                        }
                        if (!is_null($request->input($key . '_strike')[$i])) {
                            $upd_headline[$i]['attributes']['strike'] = true;
                        }
                    }
                }
                
                $params[$key] = json_encode($upd_headline);
            }
            
            if ($key == 'countdown_end_date') {
                $params[$key] = date('Y-m-d', strtotime($val));
            }
            
            if ($key == 'countdown_end_time') {
                $params[$key] = date('H:i:s', strtotime($val));
            }
        }
        
        if ($request->input('video_type') != 'none') {
            if ($request->input('video_type') == 'youtube') {
                $rules['content_youtube_url'] = 'required|url';
            } else if ($request->input('video_type') == 'vimeo') {
                $rules['content_vimeo_url'] = 'required|url';
            } else {
                $rules['video_code'] = 'required';
            }
        }
        if ($request->input('button_type') != 'none') {
            $rules['button_label'] = 'required';
        }
        if ($request->input('button_action') == 'open_click_url') {
            $rules['button_click_url'] = 'required';
        }
        
        if ($request->input('countdown_on_expiry') == 'display_text') {
            $rules['countdown_expiration_text'] = 'required|max:200';
        }
        if ($request->input('countdown_on_expiry') == 'redirect') {
            $rules['countdown_expiration_url'] = 'required|max:200';
        }
        if ($request->input('countdown') == 'calendar') {
            $rules['countdown_end_date'] = 'date_format:m/d/Y';
        }
        if ($request->input('integration_type') != 'none') {
            if ($request->input('integration_type') != 'conversion_perfect') {
                $rules['list'] = 'required';
            }
            
            if ($request->input('after_submit') == 'redirect') {
                $rules['redirect_url'] = 'required';
            } else {
                $rules['message'] = 'required';
            }
            
            $rules['call_to_action'] = 'required';
            if ($request->input('opt_in_type') != 'standard') {
                if ($request->input('opt_in_type') == 'img-online') {
                    $rules['image_url'] = 'required|url';
                } else if ($request->input('opt_in_type') == 'vid-youtube') {
                    $rules['opt_in_youtube_url'] = 'required|url';
                } else if ($request->input('opt_in_type') == 'vid-vimeo') {
                    $rules['opt_in_vimeo_url'] = 'required|url';
                } else if ($request->input('opt_in_type') == 'vid-other') {
                    $rules['opt_in_video_code'] = 'required';
                }
            }
        }
        if ($request->input('sel_tab') == 'overlay') {
            $rules['third_party_url'] = 'required';
            $rules['custom_link_text'] = 'required';
        }
        $rules['days_label'] = 'required';
        $rules['hours_label'] = 'required';
        $rules['minutes_label'] = 'required';
        $rules['seconds_label'] = 'required';
        $rules['opt_in_name_placeholder'] = 'required';
        $rules['opt_in_email_placeholder'] = 'required';
        
        $this->validate($request, $rules);

//        session(['sel_tab' => $request->input('sel_tab')]);
        
        unset($params['sel_tab']);
        
        $bar = new Bar();
        $bar->fill($params);
        $bar->user_id = auth()->user()->id;
        $bar->save();
        
        if ($request->ajax()) {
            return response()->json([
                'result'      => 'success',
                'id'          => $bar->id,
                'form_action' => secure_redirect(route('bars.update', ['bar' => $bar->id]))
            ]);
        } else {
            session()->flash('success', 'Successfully Created');
            
            return response()->redirectTo('bars/' . $bar->id . '/edit');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Http\Response
     */
    public function show(Bar $bar)
    {
        return view('users.track-partials.preview-html', compact('bar'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Bar $bar
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function edit(Bar $bar)
    {
        $header_data = [
            'main_name'   => 'Edit Conversion Bar',
            'parent_data' => [
                ['parent_name' => 'Conversion Bars', 'parent_url' => secure_redirect(route('bars'))],
            ]
        ];
        
        $bar->headline = !is_null(trim($bar->headline)) && !empty(trim($bar->headline)) ? stripslashes($bar->headline) : json_encode([['attributes' => [], 'insert' => 'Your Headline']]);
        
        $bar->sub_headline = !is_null(trim($bar->sub_headline)) && !empty(trim($bar->sub_headline)) ? stripslashes($bar->sub_headline) : json_encode([['attributes' => [], 'insert' => '']]);
        $bar->sub_headline_color = (is_null($bar->sub_headline_color) || $bar->sub_headline_color == '') ? '#FFFFFF' : $bar->sub_headline_color;
        $bar->video_auto_play = $bar->video_auto_play ? true : false;
        
        $bar->drop_shadow = $bar->drop_shadow ? true : false;
        $bar->close_button = $bar->close_button ? true : false;
        $bar->background_gradient = $bar->background_gradient ? true : false;
        $bar->gradient_end_color = (is_null($bar->gradient_end_color) || $bar->gradient_end_color == '') ? '#3BAF85' : $bar->gradient_end_color;
        
        $bar->button_label = (is_null($bar->button_label) || $bar->button_label == '') ? 'Click Here' : $bar->button_label;
        $bar->button_background_color = (is_null($bar->button_background_color) || $bar->button_background_color == '') ? '#515f7f' : $bar->button_background_color;
        $bar->button_text_color = (is_null($bar->button_text_color) || $bar->button_text_color == '') ? '#FFFFFF' : $bar->button_text_color;
        $bar->button_open_new = $bar->button_open_new ? true : false;
        $bar->delay_in_seconds = $bar->delay_in_seconds ? $bar->delay_in_seconds : 3;
        $bar->scroll_point_percent = $bar->scroll_point_percent ? $bar->scroll_point_percent : 10;
        
        $bar->countdown_timezone = (is_null($bar->countdown_timezone) || $bar->countdown_timezone == '') ? 'America/New_York' : $bar->countdown_timezone;
        $bar->countdown_end_date = $bar->countdown_end_date != '0000-00-00' ? date('m/d/Y', strtotime($bar->countdown_end_date)) : date('m/d/Y');
        
        $bar->autohide_delay_seconds = $bar->autohide_delay_seconds ? $bar->autohide_delay_seconds : 3;
        $bar->integration_type = (is_null($bar->integration_type) || $bar->integration_type == '') ? 'none' : $bar->integration_type;
        $bar->after_submit = (is_null($bar->after_submit) || $bar->after_submit == '') ? 'show_message' : $bar->after_submit;
        $bar->message = (is_null($bar->message) || $bar->message == '') ? 'Thank You!' : $bar->message;
        $bar->panel_color = (is_null($bar->panel_color) || $bar->panel_color == '') ? '#F0F0F0' : $bar->panel_color;
        $bar->subscribe_text_color = (is_null($bar->subscribe_text_color) || $bar->subscribe_text_color == '') ? '#666666' : $bar->subscribe_text_color;
        
        $re = [['key' => '', 'name' => '-- Choose List --']];
        if (!is_null($bar->list) && $bar->list != '') {
            if ($bar->integration_type == 'conversion_perfect') {
                $re_data = $this->barsRepo->getConversionPerfectLists();
                if ($re_data['result'] == 'success') {
                    $re = $re_data['message'];
                }
            } else if ($bar->integration_type != 'none') {
                $integration = Integration::with('responder')->where('user_id', auth()->user()->id)->where('responder_id', $bar->integration_type)->first();
                
                $re_data['result'] = '';
                if ($integration->responder->title == 'Sendlane') {
                    $re_data = $this->barsRepo->getSendlaneList($integration);
                } else if ($integration->responder->title == 'Mailchimp') {
                    $re_data = $this->barsRepo->getMailChimpLists($integration);
                }
                
                if ($re_data['result'] == 'success') {
                    $re = $re_data['message'];
                }
            }
        }
        $list_array = json_encode($re);
        
        $bar->opt_in_video_auto_play = $bar->opt_in_video_auto_play ? true : false;
        $bar->call_to_action = !is_null(trim($bar->call_to_action)) && !empty(trim($bar->call_to_action)) ?
            stripslashes($bar->call_to_action) : json_encode([['attributes' => [], 'insert' => 'Call To Action Text Here']]);
        $bar->subscribe_text = !is_null(trim($bar->subscribe_text)) && !empty(trim($bar->subscribe_text)) ?
            stripslashes($bar->subscribe_text) : json_encode([['attributes' => [], 'insert' => 'Enter Your Name And Email Below...']]);
        
        $flag = false;
        $form_action = secure_redirect(route('bars.update', ['bar' => $bar->id]));
        
        $sel_tab = !session()->get('sel_tab') || session()->get('sel_tab') == '' ? 'main' : session()->get('sel_tab');
        session(['sel_tab' => '']);
        
        return view('users.bars-edit', compact('header_data', 'flag', 'form_action', 'bar', 'list_array', 'sel_tab'));
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
        if ($request->has('flag')) {
            // Clone Bar
            if ($request->input('flag') == 'clone') {
                $duplicate_row = $bar->replicate(['id', 'created_at', 'updated_at']);
                $duplicate_row->friendly_name = $bar->friendly_name . ' - Clone';
                $duplicate_row->save();
                
                session()->flash('success', 'Successfully Cloned.');
                
                return response()->json([
                    'result' => 'success',
                    'id'     => $duplicate_row->id
                ]);
            } else {
                return response()->json([
                    'result' => 'success'
                ]);
            }
        } else {
            $rules = [
                'friendly_name'    => 'required|max:100',
                'headline'         => 'required',
                'headline_color'   => 'required',
                'background_color' => 'required'
            ];
            
            $params = $request->all();
            $radio_keys = ['video_auto_play', 'drop_shadow', 'close_button', 'background_gradient', 'button_open_new', 'opt_in_video_auto_play'];
            $string_keys = [
                'friendly_name', 'button_label', 'countdown_expiration_text', 'custom_link_text', 'meta_title', 'opt_in_button_label',
                'days_label', 'hours_label', 'minutes_label', 'seconds_label', 'opt_in_name_placeholder', 'opt_in_email_placeholder', 'powered_by_label', 'disclaimer'
            ];
            foreach ($params as $key => $val) {
                if (false !== array_search($key, $radio_keys)) {
                    $params[$key] = $val ? 1 : 0;
                } else if (false !== array_search($key, $string_keys)) {
                    $params[$key] = htmlspecialchars($val);
                } else {
                    if (is_null($val)) $params[$key] = '';
                }
                
                if ($key == 'headline' || $key == 'sub_headline' || $key == 'call_to_action' || $key == 'subscribe_text') {
                    if ($key == 'headline') {
                        $upd_headline = [['insert' => 'Your Headline']];
                    } else if ($key == 'subscribe_text') {
                        $upd_headline = [['insert' => 'Enter Your Name And Email Below...']];
                    } else if ($key == 'call_to_action') {
                        $upd_headline = [['insert' => 'Call To Action Text Here']];
                    } else {
                        $upd_headline = [['insert' => '']];
                    }
                    for ($i = 0; $i < count($val); $i++) {
                        if (trim($val[$i]) == '' || is_null($val[$i])) {
                            continue;
                        }
                        $upd_headline[$i]['insert'] = addslashes($val[$i] . ($i < (count($val) - 1) ? ' ' : ''));
                        if (!is_null($request->input($key . '_bold')[$i])) {
                            $upd_headline[$i]['attributes']['bold'] = true;
                        }
                        if (!is_null($request->input($key . '_italic')[$i])) {
                            $upd_headline[$i]['attributes']['italic'] = true;
                        }
                        if (!is_null($request->input($key . '_underline')[$i])) {
                            $upd_headline[$i]['attributes']['underline'] = true;
                        }
                        if (!is_null($request->input($key . '_strike')[$i])) {
                            $upd_headline[$i]['attributes']['strike'] = true;
                        }
                    }
                    
                    $params[$key] = json_encode($upd_headline);
                }
                
                if ($key == 'countdown_end_date') {
                    $params[$key] = date('Y-m-d', strtotime($val));
                }
                
                if ($key == 'countdown_end_time') {
                    $params[$key] = date('H:i:s', strtotime($val));
                }
            }

//            session(['sel_tab' => $request->input('sel_tab')]);
            
            if ($request->input('sel_tab') == 'content') {
                if ($request->input('video_type') != 'none') {
                    if ($request->input('video_type') == 'youtube') {
                        $rules['content_youtube_url'] = 'required|url';
                    } else if ($request->input('video_type') == 'vimeo') {
                        $rules['content_vimeo_url'] = 'required|url';
                    } else {
                        $rules['video_code'] = 'required';
                    }
                }
                if ($request->input('button_type') != 'none') {
                    $rules['button_label'] = 'required';
                }
                if ($request->input('button_action') == 'open_click_url') {
                    $rules['button_click_url'] = 'required';
                }
            }
            
            if ($request->input('sel_tab') == 'timer') {
                if ($request->input('countdown_on_expiry') == 'display_text') {
                    $rules['countdown_expiration_text'] = 'required|max:200';
                }
                if ($request->input('countdown_on_expiry') == 'redirect') {
                    $rules['countdown_expiration_url'] = 'required|max:200';
                }
                if ($request->input('countdown') == 'calendar') {
                    $rules['countdown_end_date'] = 'date_format:m/d/Y';
                }
            }
            
            if ($request->input('sel_tab') == 'overlay') {
                $rules['third_party_url'] = 'required';
                $rules['custom_link_text'] = 'required';
            }
            
            if ($request->input('sel_tab') == 'lead_capture') {
                if ($request->input('integration_type') != 'none') {
                    if ($request->input('integration_type') != 'conversion_perfect') {
                        $rules['list'] = 'required';
                    }
                    
                    if ($request->input('after_submit') == 'redirect') {
                        $rules['redirect_url'] = 'required';
                    } else {
                        $rules['message'] = 'required';
                    }
                    
                    $rules['call_to_action'] = 'required';
                    if ($request->input('opt_in_type') != 'standard') {
                        if ($request->input('opt_in_type') != 'img-upload') {
                            $old_file = $bar->image_upload;
                            $file_name = basename($old_file);
                            $old_path = 'bars/options/' . $bar->id . '/' . $file_name;
                            if (Storage::exists($old_path)) {
                                Storage::delete($old_path);
                                Storage::deleteDirectory('bars/options/' . $bar->id);
                            }
                        }
                        if ($request->input('opt_in_type') == 'img-online') {
                            $rules['image_url'] = 'required|url';
                        } else if ($request->input('opt_in_type') == 'vid-youtube') {
                            $rules['opt_in_youtube_url'] = 'required|url';
                        } else if ($request->input('opt_in_type') == 'vid-vimeo') {
                            $rules['opt_in_vimeo_url'] = 'required|url';
                        } else if ($request->input('opt_in_type') == 'vid-other') {
                            $rules['opt_in_video_code'] = 'required';
                        }
                    }
                }
            }
            
            if ($request->input('sel_tab') == 'translation') {
                $rules['days_label'] = 'required';
                $rules['hours_label'] = 'required';
                $rules['minutes_label'] = 'required';
                $rules['seconds_label'] = 'required';
                $rules['opt_in_name_placeholder'] = 'required';
                $rules['opt_in_email_placeholder'] = 'required';
            }
            
            $this->validate($request, $rules);
            
            unset($params['sel_tab']);
            $bar->fill($params);
            
            $bar->save();
            
            session()->flash('success', 'Successfully Updated');
            
            return response()->redirectTo('bars');
        }
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
        $old_file = $bar->image_upload;
        $file_name = basename($old_file);
        $old_path = 'bars/options/' . $bar->id . '/' . $file_name;
        if (Storage::exists($old_path)) {
            Storage::delete($old_path);
            Storage::deleteDirectory('bars/options/' . $bar->id);
        }
        
        $bar->delete();
        
        return response()->json([
            'result' => 'success'
        ]);
    }
}
