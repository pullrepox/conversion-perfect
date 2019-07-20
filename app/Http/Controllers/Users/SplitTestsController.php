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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        
        return view('users.splits-edit', compact('header_data', 'flag', 'form_action', 'bars'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SplitTest $splitTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(SplitTest $splitTest)
    {
        //
    }
}
