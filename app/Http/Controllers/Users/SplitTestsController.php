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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(SplitTest $splitTest, Request $request)
    {
        if ($request->has('report')) {
            $header_data = [
                'main_name'   => 'Split Test Bar Statistics',
                'parent_data' => []
            ];
            
            $bar = $this->barsRepo->model()->find($splitTest->bar_id);
            
            $log_data = $this->barsRepo->model1()
                ->where('bar_id', $bar->id)
                ->where('split_bar_id', $splitTest->id)
                ->where('user_id', auth()->user()->id);
            if ($request->input('period') == 'day') {
                $log_data = $log_data->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"');
            } elseif ($request->input('period') == 'week') {
                $log_data = $log_data->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)');
            } else {
                $log_data = $log_data->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)');
            }
            
            $log_data = $log_data->paginate(5);
            
            if ($request->input('period') == 'day') {
                $total_visitor = $bar->logs()->where('split_bar_id', $splitTest->id)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
                $unique_visitor = $bar->logs()->where('split_bar_id', $splitTest->id)->where('unique_click', 1)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
                $button_click = $bar->logs()->where('split_bar_id', $splitTest->id)->where('button_click', 1)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
                $lead_capture = $bar->logs()->where('split_bar_id', $splitTest->id)->where('lead_capture', 1)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
            } elseif ($request->input('period') == 'week') {
                $total_visitor = $bar->logs()->where('split_bar_id', $splitTest->id)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
                $unique_visitor = $bar->logs()->where('split_bar_id', $splitTest->id)->where('unique_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
                $button_click = $bar->logs()->where('split_bar_id', $splitTest->id)->where('button_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
                $lead_capture = $bar->logs()->where('split_bar_id', $splitTest->id)->where('lead_capture', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
            } else {
                $total_visitor = $bar->logs()->where('split_bar_id', $splitTest->id)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
                $unique_visitor = $bar->logs()->where('split_bar_id', $splitTest->id)->where('unique_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
                $button_click = $bar->logs()->where('split_bar_id', $splitTest->id)->where('button_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
                $lead_capture = $bar->logs()->where('split_bar_id', $splitTest->id)->where('lead_capture', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
            }
            
            $total_sum = [$total_visitor, $unique_visitor, $button_click, $lead_capture];
            
            $searchParams = [
                'report' => 1,
                'period' => $request->input('period')
            ];
            
            $report_data = $this->barsRepo->getLogsChartsData($request->input('period'), $bar->id, $splitTest->id);
            
            $report_data = json_encode($report_data);
            
            return view('users.split-test-statistics', compact('header_data', 'splitTest', 'log_data', 'searchParams', 'total_sum', 'report_data'));
        } else {
            return response('Success');
        }
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
                if ($row->id == $splitTest->id) {
                    continue;
                }
                $split_list[$key] = [
                    'id'               => $row->id,
                    'split_bar_name'   => $row->split_bar_name,
                    'split_bar_weight' => $row->split_bar_weight,
                ];
                $w += $row->split_bar_weight;
            }
        }
        
        $w += $splitTest->split_bar_weight;
        
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
