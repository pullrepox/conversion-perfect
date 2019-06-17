<?php

namespace App\Http\Controllers;

use App\Models;
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
        $user_id = resolve('user')->user_id;
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
        //
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
