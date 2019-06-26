<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarOptionsController extends Controller
{
    protected $barsRepo;
    
    public function __construct(BarsRepository $barsRepository)
    {
        $this->barsRepo = $barsRepository;
    }
    
    public function hideBarOption(Request $request)
    {
        $bar_id = $request->route()->parameter('id');
        $bar = $this->barsRepo->find($bar_id);
        $opt_key = $request->input('option_key');
        if ($opt_key == 'preview') {
            $bar->opt_preview = 0;
        }
        
        $bar->save();
        
        return response()->json([
            'status' => 'success'
        ]);
    }
    
    public function saveBarOption(Request $request)
    {
        $bar_id = $request->route()->parameter('id');
        $bar = $this->barsRepo->find($bar_id);
        $opt_key = $request->input('option_key');
        $rules = [];
        if ($opt_key == 'display') {
            $bar->opt_display = 1;
            $bar->show_bar_type = $request->input('show_bar_type');
            $bar->frequency = $request->input('frequency');
            $bar->delay_in_seconds = $request->input('delay_in_seconds');
            $bar->scroll_point_percent = $request->input('scroll_point_percent');
            $rules['delay_in_seconds'] = 'numeric';
            $rules['scroll_point_percent'] = 'numeric';
        }
        
        $validate = Validator::make($request->all(), $rules);
        
        if ($validate->fails()) {
            return response()->json($validate->errors()->toArray(), 422);
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
        $opt_key = $request->input('option_key');
        if ($opt_key == 'display') {
            $bar->opt_display = 0;
            $bar->show_bar_type = 'immediate';
            $bar->frequency = 'every';
            $bar->delay_in_seconds = 0;
            $bar->scroll_point_percent = 0;
        }
        
        $bar->save();
        
        return response()->json([
            'status' => 'success'
        ]);
    }
}
