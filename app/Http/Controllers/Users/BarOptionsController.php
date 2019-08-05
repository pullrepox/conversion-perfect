<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarOptionsController extends Controller
{
    protected $barsRepo;
    
    public function __construct(BarsRepository $barsRepository)
    {
        $this->barsRepo = $barsRepository;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveBarOption(Request $request)
    {
        $bar_id = $request->route()->parameter('id');
        $bar = $this->barsRepo->find($bar_id);
        $opt_key = $request->input('option_key');
        $rules = [];
        
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
                    $upd_sub_headline = [['insert' => 'Your Headline']];
                } else if ($key == 'subscribe_text') {
                    $upd_sub_headline = [['insert' => 'Enter Your Name And Email Below...']];
                } else if ($key == 'call_to_action') {
                    $upd_sub_headline = [['insert' => 'Call To Action Text Here']];
                } else {
                    $upd_sub_headline = [['insert' => '']];
                }
                
                for ($i = 0; $i < count($val); $i++) {
                    if (trim($val[$i]['insert']) == '' || is_null($val[$i]['insert'])) {
                        continue;
                    }
                    
                    $upd_sub_headline[$i]['insert'] = addslashes($val[$i]['insert'] . ($i < (count($val) - 1) ? ' ' : ''));
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
        
        if ($opt_key == 'main') {
            $rules['friendly_name'] = 'required|max:100';
            $rules['headline'] = 'required';
            $rules['headline_color'] = 'required';
            $rules['background_color'] = 'required';
            if (array_search(auth()->user()->email, explode(',', trim(config('site.sys_temp_creators')))) !== false) {
                $bar->template_flag = 1;
                $bar->sys_temp_flag = 1;
                $params['template_name'] = !is_null($params['template_name']) ? $params['template_name'] : $params['friendly_name'];
            } else {
                $bar->sys_temp_flag = 0;
                $params['template_name'] = is_null($request->input('template_name')) ? '' : $request->input('template_name');
            }
        }
        
        if ($opt_key == 'content') {
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
        
        if ($opt_key == 'timer') {
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
//            $rules['third_party_url'] = 'required';
            $rules['custom_link_text'] = 'required|unique:bars,custom_link_text';
        }
        
        if ($opt_key == 'lead_capture') {
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
                        $old_path = 'bars/options/' . $bar_id . '/' . $file_name;
                        if (Storage::exists($old_path)) {
                            Storage::delete($old_path);
                            Storage::deleteDirectory('bars/options/' . $bar_id);
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
        
        if ($opt_key == 'translation') {
            $rules['days_label'] = 'required';
            $rules['hours_label'] = 'required';
            $rules['minutes_label'] = 'required';
            $rules['seconds_label'] = 'required';
            $rules['opt_in_name_placeholder'] = 'required';
            $rules['opt_in_email_placeholder'] = 'required';
        }
        
        $validate = Validator::make($request->all(), $rules);
        
        if ($validate->fails()) {
            return response()->json($validate->errors()->toArray(), 422);
        }
        
        $bar->fill($params);
        
        if ($opt_key == 'main') {
            if (array_search(auth()->user()->email, explode(',', trim(config('site.sys_temp_creators')))) !== false) {
                $bar->template_flag = 1;
                $bar->sys_temp_flag = 1;
                $bar->template_name = !is_null($request->input('template_name')) ? $request->input('template_name') : $params['friendly_name'];
            } else {
                $bar->sys_temp_flag = 0;
                $bar->template_name = is_null($request->input('template_name')) ? '' : $request->input('template_name');
            }
        }
        
        if (!is_null($request->input('thumbnail')) && $request->input('thumbnail') != '') {
            $temp_thumb_path = public_path('uploads/temp_thumb_' . $bar->id . '.png');
            $success = file_put_contents($temp_thumb_path, file_get_contents($request->input('thumbnail')));
            if ($success) {
                $content = file_get_contents($temp_thumb_path);
                Storage::put('bars/options/' . $bar->id . '/temp_thumb_' . $bar->id . '.png', $content, ['visibility' => 'public']);
                if (file_exists($temp_thumb_path)) {
                    unlink($temp_thumb_path);
                }
            }
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
        
        $params = $request->input('data');
        foreach ($params as $key => $val) {
            if (is_null($val)) $params[$key] = '';
            if ($key == 'sub_headline') {
                $params[$key] = json_encode([['attributes' => [], 'insert' => '']]);
            }
            if ($key == 'call_to_action') {
                $params[$key] = json_encode([['attributes' => [], 'insert' => 'Call To Action Text Here']]);
            }
            if ($key == 'subscribe_text') {
                $params[$key] = json_encode([['attributes' => [], 'insert' => 'Enter Your Name And Email Below...']]);
            }
        }
        
        $bar->fill($params);
        
        $bar->save();
        
        return response()->json([
            'status' => 'success'
        ]);
    }
    
    public function uploadImageFile(Request $request)
    {
        if ($request->hasFile('image-upload')) {
            $bar_id = $request->route()->parameter('id');
            $bar = $this->barsRepo->find($bar_id);
            $old_file = $bar->image_upload;
            $file_name = basename($old_file);
            $old_path = 'bars/options/' . $bar_id . '/' . $file_name;
            if (Storage::exists($old_path)) {
                Storage::delete($old_path);
            }
            
            $tempImage = $request->file('image-upload');
            $extension = $tempImage->getClientOriginalExtension();
            $f_name = $bar_id . '_' . time() . '_opt_in_image_upload.' . $extension;
            Storage::PutFileAs('bars/options/' . $bar_id, $tempImage, $f_name, ['visibility' => 'public']);
            $image_url = Storage::url('bars/options/' . $bar_id . '/' . $f_name);
            
            $bar->image_upload = $image_url;
            $bar->save();
            
            return [
                'result'  => 'success',
                'message' => $image_url
            ];
        } else {
            return [
                'result'  => 'failure',
                'message' => 'Image Upload Failed! Please make sure your image file.'
            ];
        }
    }
}
