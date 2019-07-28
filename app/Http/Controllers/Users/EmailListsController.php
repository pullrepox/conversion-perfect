<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Bar;
use App\Models\EmailList;
use Illuminate\Http\Request;

class EmailListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header_data = [
            'main_name'   => 'Email Lists',
            'parent_data' => []
        ];
        
        $email_lists = EmailList::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('users.emails-list', compact('header_data', 'email_lists'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header_data = [
            'main_name'   => 'New Email List',
            'parent_data' => []
        ];
        
        $flag = true;
        $form_action = secure_redirect(route('email-lists.store'));
        
        return view('users.emails-edit', compact('header_data', 'flag', 'form_action'));
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
            'list_name' => 'required|max:200|unique:email_lists,list_name,user_id'
        ]);
        
        $ins_data = [
            'user_id'     => auth()->user()->id,
            'list_name'   => $request->input('list_name'),
            'description' => is_null($request->input('description')) ? '' : $request->input('description')
        ];
        
        EmailList::insertGetId($ins_data);
        
        session()->flash('success', 'Successfully Created');
        
        return response()->redirectTo('email-lists');
    }
    
    /**
     * Display the specified resource.
     *
     * @param \App\Models\EmailList $emailList
     * @return \Illuminate\Http\Response
     */
    public function show(EmailList $emailList)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EmailList $emailList
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailList $emailList)
    {
        $header_data = [
            'main_name'   => 'Edit Email List',
            'parent_data' => []
        ];
        
        $flag = false;
        $form_action = secure_redirect(route('email-lists.update', ['emailList' => $emailList->id]));
        
        return view('users.emails-edit', compact('header_data', 'flag', 'form_action', 'emailList'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmailList $emailList
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function update(Request $request, EmailList $emailList)
    {
        if ($request->has('flag')) {
            if ($request->input('flag') == 'clear') {
                $subscribers = $emailList->subscribers;
                if ($subscribers) {
                    foreach ($subscribers as $subscriber) {
                        $subscriber->delete();
                    }
                }
                
                session()->flash('success', 'Successfully Cleared Captured Emails to ' . $emailList->list_name . '\'s.');
                
                return response()->json([
                    'result' => 'success'
                ]);
            }
        } else {
            $this->validate($request, [
                'list_name' => 'required|max:200|unique:email_lists,list_name,' . $emailList->id . ',user_id'
            ]);
            
            $emailList->fill($request->all());
            
            $emailList->save();
            
            session()->flash('success', 'Successfully Updated');
            
            return response()->redirectTo('email-lists');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EmailList $emailList
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function destroy(EmailList $emailList)
    {
        $list_id = $emailList->id;
    
        $using_bars_check = Bar::where('integration_type', 'conversion_perfect')->where('list', $list_id)->count();
        if ($using_bars_check > 0) {
            $msg = 'Sorry, we cannot delete this list as it is being used in these Conversion Bars: ';
            $using_bars = Bar::where('integration_type', 'conversion_perfect')->where('list', $list_id)->get();
            foreach ($using_bars as $row) {
                $msg .= $row->friendly_name . ', ';
            }
            $msg = substr($msg, 0, -2);
            $msg .= '. Please remove this list from all Conversion Bars prior to deleting this list.';
            session()->flash('error', $msg);
        
            return response()->json([
                'result' => 'failure'
            ]);
        }
    
        $emailList->delete();
    
        session()->flash('success', 'Successfully Deleted');
    
        return response()->json([
            'result' => 'success'
        ]);
    }
}
