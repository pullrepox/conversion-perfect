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
     * @return \Illuminate\Http\Response
     */
    public function show(MultiBar $multiBar)
    {
        //
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
