<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
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
            'parent_data' => [
                ['parent_name' => 'Settings', 'parent_url' => ''],
            ]
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
            'parent_data' => [
                ['parent_name' => 'Settings', 'parent_url' => ''],
                ['parent_name' => 'Email Lists', 'parent_url' => secure_redirect(route('email-lists'))],
            ]
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
            'list_name' => 'required|max:200'
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
            'parent_data' => [
                ['parent_name' => 'Settings', 'parent_url' => ''],
                ['parent_name' => 'Email Lists', 'parent_url' => secure_redirect(route('email-lists'))],
            ]
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
        $this->validate($request, [
            'list_name' => 'required|max:200'
        ]);
    
        $emailList->fill($request->all());
    
        $emailList->save();
    
        session()->flash('success', 'Successfully Updated');
    
        return response()->redirectTo('email-lists');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EmailList $emailList
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailList $emailList)
    {
        //
    }
}
