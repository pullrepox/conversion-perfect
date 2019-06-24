<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $sliders = Slider::where('user_id',user()->id)
                    ->paginate(10);

        $bc = ['active'=>'Sliders'];
        return view('backend.sliders.index',['sliders'=>$sliders,'bc'=>$bc]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bc = ['active'=>'Sliders'];
        return view('backend.sliders.edit',['slider'=>null,'bc'=>$bc]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        $page = view('backend.sliders.partials.slider-template',['slider'=>$slider])->render();
        $html = str_replace(["\n","\r"],'',$page);
        return 'document.write(\''."$html".'\');';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
       if(user()->id != $slider->user_id){
           abort(401, 'You are not authorized to access this!');
       }

        return view('backend.sliders.edit',['slider'=>$slider]);
    }


    public function updateSection(SliderRequest $request ){

        $id = $request->input('slider_id',-1);
        if(-1 != $id){
           $slider = Slider::find($id);
            if(user()->id != $slider->user_id){
                return jsonResponse(false, 403,'Unauthorized Access');
            }
        } else {
            $slider = new Slider();
            $slider->user_id = user()->id;
        }
        $slider->name = $request->input('slider_name');
        $slider->html = $request->input('html');

        $slider->appearance = $request->input('appearance');
        $slider->settings = $request->input('settings');
        $slider->countdown = $request->input('countdown');
        $slider->button = $request->input('button');
        $slider->opt_in_appearance = $request->input('opt_in_appearance');
        $slider->opt_in_settings = $request->input('opt_in_settings');
        $slider->pro_features = $request->input('pro_features');

        if($slider->save()){
            $respData = [
                'id'=>$slider->id,
                'name'=>$slider->name
                ];
            return jsonResponse(true,200,'Slider Saved',$respData);
        } else {
            return jsonResponse(false,500,'Unable to save slider');
        }

    }

    public function toggleSliderStatus(Slider $slider){
        $this->authorizationCheck($slider);

        $slider->status = !$slider->status;
        if($slider->save()){
            Toastr::success('Slider status changed','Success');
        } else {
            Toastr::error('Failed to change slider status','Error');
        }
        return redirect()->back();
    }

    public function previewSlider(Slider $slider){
        return view('backend.sliders.preview',['slider'=>$slider]);
    }

    public function cloneSlider(Slider $slider){
        $this->authorizationCheck($slider);

        $newSlider = $slider->replicate();
        $newSlider->save();
        return redirect()->back();
    }

    public function clearStats(Slider $slider){

        $this->authorizationCheck($slider);

        $slider->link_click=0;
        $slider->email_options=0;
        $slider->total_views=0;
        $slider->unique_views=0;

        if($slider->save()){
            Toastr::success('Slider stats cleared','Success');
        }else {
            Toastr::error('Unable to clear stats','Error');
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $this->authorizationCheck($slider);
        if($slider->delete()){
            Toastr::success('Slider deleted','Success');
        } else {
            Toastr::error('Failed to delete slider','Error');
        }
        return redirect()->back();
    }
    private function authorizationCheck($slider){
        if(user()->id != $slider->user_id){
            abort(403,'You are not authorized to perform this action');
        }
    }
}
