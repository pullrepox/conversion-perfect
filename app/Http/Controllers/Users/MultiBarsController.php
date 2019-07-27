<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use App\Models\MultiBar;
use Illuminate\Http\Request;

class MultiBarsController extends Controller
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
            'main_name'   => 'Multi Bar',
            'parent_data' => []
        ];
        
        $multi_bars = $this->barsRepo->model3()->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('users.multi-bars-list', compact('header_data', 'multi_bars'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header_data = [
            'main_name'   => 'New Multi Bar',
            'parent_data' => []
        ];
        
        $flag = true;
        
        $form_action = secure_redirect(route('multi-bars.store'));
        
        $bars = $this->barsRepo->model()->where('user_id', auth()->user()->id)->where('archive_flag', '0')->get();
        if (is_null($bars) || !$bars) {
            return back()->with('error', 'You have no Conversion Bars. Please add a Conversion Bar by clicking the [New Conversion Bar] button in Conversion Bar page.');
        }
        
        return view('users.multi-bars-edit', compact('header_data', 'form_action', 'bars', 'flag'));
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
            'multi_bar_name' => 'required|unique:multi_bars,multi_bar_name',
            'bar_ids'        => 'required'
        ]);
        
        $params = $request->all();
        foreach ($params as $key => $val) {
            if ($key == 'bar_ids') {
                $params[$key] = implode(',', $request->input('bar_ids'));
            }
            if (is_null($val)) $params[$key] = '';
        }
        
        $multiBar = new MultiBar();
        $multiBar->fill($params);
        $multiBar->user_id = auth()->user()->id;
        $multiBar->save();
        
        session()->flash('success', 'Successfully Created');
        
        return response()->redirectTo('multi-bars');
    }
    
    /**
     * Display the specified resource.
     *
     * @param \App\Models\MultiBar $multiBar
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(MultiBar $multiBar, Request $request)
    {
        if ($request->has('report')) {
            $header_data = [
                'main_name'   => 'Multi Bar Statistics',
                'parent_data' => []
            ];
            
            $log_data = $this->barsRepo->model1()
                ->where('multi_bar_id', $multiBar->id)
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
                $total_visitor = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
                $unique_visitor = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->where('unique_click', 1)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
                $button_click = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->where('button_click', 1)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
                $lead_capture = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->where('lead_capture', 1)->whereRaw('YEAR(created_at) = "' . date('Y') . '"')
                    ->whereRaw('MONTH(created_at) = "' . date('m') . '"')->whereRaw('DAY(created_at) = "' . date('d') . '"')->count();
            } elseif ($request->input('period') == 'week') {
                $total_visitor = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
                $unique_visitor = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->where('unique_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
                $button_click = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->where('button_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
                $lead_capture = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->where('lead_capture', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 7 DAY)')->count();
            } else {
                $total_visitor = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
                $unique_visitor = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->where('unique_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
                $button_click = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->where('button_click', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
                $lead_capture = $this->barsRepo->model1()->where('multi_bar_id', $multiBar->id)->where('lead_capture', 1)->whereRaw('DATE(created_at) >= date_sub(now(), interval 30 DAY)')->count();
            }
            
            $total_sum = [$total_visitor, $unique_visitor, $button_click, $lead_capture];
            
            $searchParams = [
                'report' => 1,
                'period' => $request->input('period')
            ];
            
            $report_data = $this->barsRepo->getLogsChartsData($request->input('period'), 0, 0, $multiBar->id);
            
            $report_data = json_encode($report_data);
            
            return view('users.multi-bars-statistics', compact('header_data', 'multiBar', 'log_data', 'searchParams', 'total_sum', 'report_data'));
        } else {
            return response('Success');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MultiBar $multiBar
     * @return \Illuminate\Http\Response
     */
    public function edit(MultiBar $multiBar)
    {
        $header_data = [
            'main_name'   => 'Edit Multi Bar',
            'parent_data' => []
        ];
        
        $flag = false;
        
        $form_action = secure_redirect(route('multi-bars.update', ['multiBar' => $multiBar->id]));
        
        $bars = $this->barsRepo->model()->where('user_id', auth()->user()->id)->where('archive_flag', '0')->get();
        if (is_null($bars) || !$bars) {
            return back()->with('error', 'You have no Conversion Bars. Please add a Conversion Bar by clicking the [New Conversion Bar] button in Conversion Bar page.');
        }
        
        return view('users.multi-bars-edit', compact('header_data', 'form_action', 'bars', 'flag', 'multiBar'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MultiBar $multiBar
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function update(Request $request, MultiBar $multiBar)
    {
        $this->validate($request, [
            'multi_bar_name' => 'required|unique:multi_bars,multi_bar_name,' . $multiBar->id,
            'bar_ids'        => 'required'
        ]);
        
        $params = $request->all();
        foreach ($params as $key => $val) {
            if ($key == 'bar_ids') {
                $params[$key] = implode(',', $request->input('bar_ids'));
            }
            if (is_null($val)) $params[$key] = '';
        }
        
        $multiBar->fill($params);
        $multiBar->user_id = auth()->user()->id;
        $multiBar->save();
        
        session()->flash('success', 'Successfully Updated');
        
        return response()->redirectTo('multi-bars');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MultiBar $multiBar
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function destroy(MultiBar $multiBar)
    {
        $multiBar->delete();
        
        return response()->json([
            'status' => 'success'
        ]);
    }
}
