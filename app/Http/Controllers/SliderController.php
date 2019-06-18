<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user_id = user()->user_id;
        $sliders = Slider::where('user_id',$user_id)
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
        return view('backend.sliders.edit',['slider'=>null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->name = $request->input('slider_name');
        $slider->user_id = resolve('user')->user_id;
        $slider->heading = $request->input('headline');
        $slider->subheading = $request->input('sub_headline');
        $slider->appearance = $request->input('appearance');

        if($slider->save()){
            return redirect()->back()->withMessage('Appearance saved!');
        } else {
            abort(500,'Unable to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //TODO: got to check if slider is owned by user_id
        return view('backend.sliders.edit',['slider'=>$slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {

        return $slider;
    }

    public function updateSection(Request $request ){
        $id = $request->input('slider_id',null);
        if($id){
           $slider = Slider::find($id);
            if(user()->user_id != $slider->user_id){
                return jsonResponse(false, 403,'Unauthorized Access');
            }
        } else {
            $slider = new Slider();
            $slider->user_id = user()->user_id;
        }
        $name = $request->input('slider_name');
        $type = $request->input('section_type');
        $section_data = $request->except('slider_id','slider_name','section_type');

        $slider->name=$name;

        switch ($type){
            case 'appearance':
                $slider->appearance = $section_data;
                break;
            default:
                return jsonResponse(false,400,'Unrecognized Type', ['type' => $type]);
                break;
        }

        if($slider->save()){
            $respData = [
                'slider'=> $slider,
                'type' => $type
            ];
            return jsonResponse(true,200,'Slider Saved',$respData);
        } else {
            return jsonResponse(false,500,'Unable to save slider');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if($slider->delete()){
            return redirect()->back()->withMessage('Slider Deleted');
        } else {
            abort(505, "Failed to delete Slider");
        }
    }
}
