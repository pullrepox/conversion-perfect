<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use App\Models\SplitTest;
use Illuminate\Http\Request;

class SplitTestsController extends Controller
{
    protected $barsRepo;
    
    public function __construct(BarsRepository $barsRepository)
    {
        $this->barsRepo = $barsRepository;
    }
    
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('flag')) {
                if ($request->input('flag') == 'list-of-bar') {
                    $split_tests = auth()->user()->split_tests()->where('bar_id', $request->input('bar_id'))->get();
                    $split_list = [];
                    $w = 0;
                    if ($split_tests && !is_null($split_tests)) {
                        foreach ($split_tests as $key => $row) {
                            $split_list[$key] = [
                                'id'               => $row->id,
                                'split_bar_name'   => $row->split_bar_name,
                                'split_bar_weight' => $row->split_bar_weight,
                            ];
                            $w += $row->split_bar_weight;
                        }
                    }
                    
                    $split_weight = (100 - $w) > 0 ? (100 - $w) : 0;
                    
                    return response()->json([
                        'status'      => 'success',
                        'splits_list' => $split_list,
                        'main_weight' => $split_weight
                    ]);
                }
            }
        }
        $header_data = [
            'main_name'   => 'Split Test',
            'parent_data' => []
        ];
        
        $split_tests = $this->barsRepo->model2()->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->orderBy('bar_id', 'asc')->paginate(10);
        
        return view('users.splits-list', compact('header_data', 'split_tests'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header_data = [
            'main_name'   => 'Add Split Test',
            'parent_data' => []
        ];
        
        $flag = true;
        
        $form_action = secure_redirect(route('split-tests.store'));
        $bars = $this->barsRepo->model()->where('user_id', auth()->user()->id)->where('archive_flag', '0')->get();
        if (is_null($bars) || !$bars) {
            return back()->with('error', 'You have no Conversion Bars. Please add a Conversion Bar by clicking the [New Conversion Bar] button in Conversion Bar page.');
        }
        
        $split_tests = auth()->user()->split_tests()->where('bar_id', $bars[0]->id)->get();
        $split_list = [];
        $w = 0;
        if ($split_tests && !is_null($split_tests)) {
            foreach ($split_tests as $key => $row) {
                $split_list[$key] = [
                    'id'               => $row->id,
                    'split_bar_name'   => $row->split_bar_name,
                    'split_bar_weight' => $row->split_bar_weight,
                ];
                $w += $row->split_bar_weight;
            }
        }
        
        $split_weight = (100 - $w) > 0 ? (100 - $w) : 0;
        
        return view('users.splits-edit', compact('header_data', 'flag', 'form_action', 'bars', 'split_list', 'split_weight'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            if ($request->input('flag') == 'create') {
                $splitTests = new SplitTest();
                $splitTests->fill($request->all());
                $splitTests->user_id = auth()->user()->id;
                $splitTests->save();
                
                return response()->json([
                    'status' => 'success',
                    'id'     => $splitTests->id
                ]);
            } elseif ($request->input('flag') == 'average') {
                $this->barsRepo->model2()->where('bar_id', $request->input('bar_id'))->where('user_id', auth()->user()->id)->update([
                    'split_bar_weight' => $request->input('average_weight')
                ]);
            }
            
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->redirectTo(route('split-tests'));
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param \App\Models\SplitTest $splitTest
     * @return \Illuminate\Http\Response
     */
    public function show(SplitTest $splitTest)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SplitTest $splitTest
     * @return \Illuminate\Http\Response
     */
    public function edit(SplitTest $splitTest)
    {
        $header_data = [
            'main_name'   => 'Edit Split Test',
            'parent_data' => []
        ];
    
        $flag = false;
    
        $form_action = secure_redirect(route('split-tests.update', ['splitTest' => $splitTest]));
        $bars = $this->barsRepo->model()->where('user_id', auth()->user()->id)->where('archive_flag', '0')->get();
        $split_tests = auth()->user()->split_tests()->where('bar_id', $splitTest->bar_id)->get();
        $split_list = [];
        $w = 0;
        if ($split_tests && !is_null($split_tests)) {
            foreach ($split_tests as $key => $row) {
                $split_list[$key] = [
                    'id'               => $row->id,
                    'split_bar_name'   => $row->split_bar_name,
                    'split_bar_weight' => $row->split_bar_weight,
                ];
                $w += $row->split_bar_weight;
            }
        }
    
        $split_weight = (100 - $w) > 0 ? (100 - $w) : 0;
    
        return view('users.splits-edit', compact('header_data', 'flag', 'form_action', 'bars', 'split_list', 'split_weight', 'splitTest'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SplitTest $splitTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SplitTest $splitTest)
    {
        $splitTest->split_bar_name = $request->input('split_bar_name');
        $splitTest->split_bar_weight = $request->input('split_bar_weight');
        $splitTest->save();
    
        return response()->redirectTo(route('split-tests'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SplitTest $splitTest
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function destroy(SplitTest $splitTest)
    {
        $this->barsRepo->model1()->where('split_bar_id', $splitTest->id)->delete();
        $splitTest->delete();
    
        return response()->json([
            'status' => 'success'
        ]);
    }
}
