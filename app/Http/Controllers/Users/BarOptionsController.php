<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BarsRepository;
use Illuminate\Http\Request;

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
}
