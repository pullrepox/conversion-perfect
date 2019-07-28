<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ApiRepository;
use App\Http\Repositories\BarsRepository;
use App\Integration;
use App\Models\Bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarsController extends Controller
{
    protected $barsRepo;
    protected $apiRepo;
    
    public function __construct(BarsRepository $barsRepository, ApiRepository $apiRepository)
    {
        $this->barsRepo = $barsRepository;
        $this->apiRepo = $apiRepository;
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
        
        $bars = Bar::where('user_id', auth()->user()->id)->where('archive_flag', '0')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('users.bars-list', compact('header_data', 'bars'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function create(Request $request)
    {
        $header_data = [
            'main_name'   => 'New Conversion Bar',
            'parent_data' => []
        ];
        
        if ($request->input('flag') == 'template') {
            $header_data['main_name'] = 'Choose Bar Template';
            
            $template_list = $this->barsRepo->model()->where(function ($q) {
                $q->where('sys_temp_flag', 1)
                    ->where('archive_flag', '0');
            })->orWhere(function ($q) {
                $q->where('user_id', auth()->user()->id)
                    ->where('template_flag', 1)
                    ->where('archive_flag', '0');
            })->orderBy('created_at', 'desc')->paginate(10);
            
            return view('users.bars-template', compact('header_data', 'template_list'));
        } elseif ($request->input('flag') == 'template_edit') {
            $bar_id = $request->input('number');
            $bar = $this->barsRepo->model()->find($bar_id);
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
                    } else if ($integration->responder->title == 'MailChimp') {
                        $re_data = $this->barsRepo->getMailChimpLists($integration);
                    } else if ($integration->responder->title == 'ActiveCampaign') {
                        $re_data = $this->barsRepo->getActiveCampaignList($integration);
                    } else if ($integration->responder->title == 'Campaign Monitor') {
                        $re_data = $this->barsRepo->getCampaignMonitorLists($integration);
                    } else if ($integration->responder->title == 'GetResponse') {
                        $re_data = $this->barsRepo->getResponseCampaigns($integration);
                    } else if ($integration->responder->title == 'MailerLite') {
                        $re_data = $this->barsRepo->getMailerLiteGroups($integration);
                    } else if ($integration->responder->title == 'Send In Blue') {
                        $re_data = $this->barsRepo->getSendInBlueLists($integration);
                    }
                    
                    if ($re_data['result'] == 'success') {
                        $re = $re_data['message'];
                    }
                }
            }
            $list_array = json_encode($re);
            $sel_tab = 'main';
            $flag = true;
            $form_action = secure_redirect(route('bars.store'));
            
            return view('users.bars-template-edit', compact('header_data', 'flag', 'bar', 'form_action', 'list_array', 'sel_tab'));
        } else {
            $flag = true;
            $form_action = secure_redirect(route('bars.store'));
            $list_array = json_encode([['key' => '', 'name' => '-- Choose List --']]);
            $sel_tab = 'main';
            
            return view('users.bars-edit', compact('header_data', 'flag', 'form_action', 'list_array', 'sel_tab'));
        }
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
        if (array_search(auth()->user()->email, explode(',', trim(config('site.sys_temp_creators')))) === false) {
            $bars_count = auth()->user()->bars->count();
            if (!is_null(auth()->user()->permissions)) {
                if (auth()->user()->permissions['maximum-bars'] != '-1') {
                    if ($bars_count >= auth()->user()->permissions['maximum-bars']) {
                        if ($request->ajax()) {
                            return response()->json([
                                'result'  => 'failure',
                                'message' => ('Your Maximum Bars Permission is ' . auth()->user()->permissions['maximum-bars'])
                            ]);
                        } else {
                            session()->flash('error', 'Your Maximum Bars Permission is ' . auth()->user()->permissions['maximum-bars']);
                            return response()->redirectTo('bars');
                        }
                    }
                }
            }
        }
        
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
//            $rules['third_party_url'] = 'required';
            $rules['custom_link_text'] = 'required|unique:bars,custom_link_text';
        }
        $rules['days_label'] = 'required';
        $rules['hours_label'] = 'required';
        $rules['minutes_label'] = 'required';
        $rules['seconds_label'] = 'required';
        $rules['opt_in_name_placeholder'] = 'required';
        $rules['opt_in_email_placeholder'] = 'required';
        
        $this->validate($request, $rules);
        
        unset($params['sel_tab']);
        
        $bar = new Bar();
        $bar->fill($params);
        $bar->user_id = auth()->user()->id;
        if (array_search(auth()->user()->email, explode(',', trim(config('site.sys_temp_creators')))) !== false) {
            $bar->template_flag = 1;
            $bar->sys_temp_flag = 1;
            $bar->template_name = !is_null($request->input('template_name')) ? $request->input('template_name') : $params['friendly_name'];
        } else {
            $bar->template_flag = 0;
            $bar->sys_temp_flag = 0;
            $bar->template_name = is_null($request->input('template_name')) || empty($request->input('template_name')) ? '' : $request->input('template_name');
        }
        
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function show(Bar $bar, Request $request)
    {
        if ($request->has('report')) {
            $header_data = [
                'main_name'   => 'Conversion Bar Statistics',
                'parent_data' => []
            ];
            
            $log_data = $this->barsRepo->model1()
                ->where('bar_id', $bar->id)
                ->where('user_id', auth()->user()->id);
            if ($request->input('period') == 'day') {
                $log_data = $log_data->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"');
            } elseif ($request->input('period') == 'week') {
                $log_data = $log_data->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)');
            } else {
                $log_data = $log_data->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)');
            }
            
            $log_data = $log_data->orderBy('created_at', 'desc')->paginate(10);
            
            if ($request->input('period') == 'day') {
                $total_visitor = $bar->logs()->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
                $unique_visitor = $bar->logs()->where('unique_click', 1)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
                $button_click = $bar->logs()->where('button_click', 1)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
                $lead_capture = $bar->logs()->where('lead_capture', 1)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
            } elseif ($request->input('period') == 'week') {
                $total_visitor = $bar->logs()->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
                $unique_visitor = $bar->logs()->where('unique_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
                $button_click = $bar->logs()->where('button_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
                $lead_capture = $bar->logs()->where('lead_capture', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
            } else {
                $total_visitor = $bar->logs()->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
                $unique_visitor = $bar->logs()->where('unique_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
                $button_click = $bar->logs()->where('button_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
                $lead_capture = $bar->logs()->where('lead_capture', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
            }
            
            $total_sum = [$total_visitor, $unique_visitor, $button_click, $lead_capture];
            
            $searchParams = [
                'report' => 1,
                'period' => $request->input('period')
            ];
            
            $report_data = $this->barsRepo->getLogsChartsData($request->input('period'), $bar->id);
            
            $report_data = json_encode($report_data);
            
            return view('users.bars-statistics', compact('header_data', 'bar', 'log_data', 'searchParams', 'total_sum', 'report_data'));
        } else {
            $option = 'preview';
            return view('users.track-partials.preview-html', compact('bar', 'option'));
        }
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
            'parent_data' => []
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
                $re_data = $this->apiRepo->getConversionPerfectLists();
                if ($re_data['result'] == 'success') {
                    $re = $re_data['message'];
                }
            } else if ($bar->integration_type != 'none') {
                $integration = Integration::with('responder')->where('user_id', auth()->user()->id)->where('responder_id', $bar->integration_type)->first();
                
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
            } elseif ($request->input('flag') == 'archive') {
                $bar->archive_flag = 1;
                $bar->save();
            } elseif ($request->input('flag') == 'reset_stats') {
//                $this->barsRepo->model1()->where('user_id', auth()->user()->id)->where('bar_id', $bar->id)->update([
//                    'reset_stats' => 1
//                ]);
                $this->barsRepo->model1()->where('user_id', auth()->user()->id)->where('bar_id', $bar->id)->delete();
            } elseif ($request->input('flag') == 'template') {
//                if (array_search(auth()->user()->email, explode(',', trim(config('site.sys_temp_creators')))) === false) {
//                    $bars_count = auth()->user()->bars->count();
//                    if (!is_null(auth()->user()->permissions)) {
//                        if (auth()->user()->permissions['pro-templates'] != '-1' &&
//                            auth()->user()->permissions['120-templates'] != '-1' &&
//                            auth()->user()->permissions['240-templates'] != '-1') {
//                            if ($bars_count >= auth()->user()->permissions['pro-templates']) {
//                                session()->flash('error', 'Your Maximum Bars Permission is ' . auth()->user()->permissions['maximum-bars']);
//                                return response()->redirectTo('bars');
//                            }
//                        }
//                    }
//                }
                $bar->template_flag = 1;
                $bar->template_name = $request->input('template_name');
                
                $temp_thumb_path = public_path('uploads/temp_thumb_' . $bar->id . '.png');
                $success = file_put_contents($temp_thumb_path, file_get_contents($request->input('thumbnail')));
                if ($success) {
                    $content = file_get_contents($temp_thumb_path);
                    Storage::put('bars/options/' . $bar->id . '/temp_thumb_' . $bar->id . '.png', $content, ['visibility' => 'public']);
                    if (file_exists($temp_thumb_path)) {
                        unlink($temp_thumb_path);
                    }
                }
                
                $bar->save();
            }
            
            return response()->json([
                'result' => 'success'
            ]);
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
//                $rules['third_party_url'] = 'required';
                $rules['custom_link_text'] = 'required|unique:bars,custom_link_text,' . $bar->id;
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
            
            if (array_search(auth()->user()->email, explode(',', trim(config('site.sys_temp_creators')))) !== false) {
                $bar->template_flag = 1;
                $bar->sys_temp_flag = 1;
                $bar->template_name = !is_null($request->input('template_name')) ? $request->input('template_name') : $params['friendly_name'];
            } else {
                $bar->sys_temp_flag = 0;
                $bar->template_name = is_null($request->input('template_name')) ? '' : $request->input('template_name');
            }
            
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
