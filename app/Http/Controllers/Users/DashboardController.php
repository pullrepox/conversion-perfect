<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Training;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $redirectTo = '/dashboard';
    
    public function index()
    {
        return view('users.dashboard');
    }
    
    public function subDomainRegister()
    {
        return view('users.sub-domain-register');
    }
    
    public function setSubDomainRegister(Request $request)
    {
        $this->validate($request, [
            'sub_domain' => 'required|string|min:3|max:25|alpha_num|unique:users,subdomain',
        ]);
        
        $user = auth()->user();
        $user->subdomain = $request->input('sub_domain');
        $user->save();
        
        return redirect()->intended($this->redirectTo, 302, [], config('site.ssl_tf'));
    }
    
    public function trainingIndex()
    {
        $header_data = [
            'main_name'   => 'Training',
            'parent_data' => [
                ['parent_name' => 'Support', 'parent_url' => '']
            ]
        ];
        
        $trainings = Training::orderBy('sort_order')->get();
        
        return view('users.trainings', compact('trainings', 'header_data'));
    }
    
    public function bonusesIndex()
    {
        $header_data = [
            'main_name'   => 'Bonuses',
            'parent_data' => []
        ];
        
        $bonuses = Bonus::orderBy('sort_order');
        $user_plans = auth()->user()->amemberplans;
        if ($user_plans != '') {
            $plans = explode(",", $user_plans);
            $bonuses->where(function ($q) use ($plans) {
                for ($i = 0; $i < count($plans); $i++) {
                    if ($i === 0) {
                        $q->where('plans', $plans[$i]);
                    } else {
                        $q->orWhere('plans', $plans[$i]);
                    }
                    $q->orWhere('plans', 'like', $plans[$i] . ',%')
                        ->orWhere('plans', 'like', '%,' . $plans[$i])
                        ->orWhere('plans', 'like', '%,' . $plans[$i] . ',%');
                }
            });
        }
        $bonuses = $bonuses->get();
        
        return view('users.bonuses', compact('bonuses', 'header_data'));
    }
    
    public function profileIndex()
    {
        $header_data = [
            'main_name'   => 'Account',
            'parent_data' => []
        ];
        
        $am_plans = explode(',', auth()->user()->amemberplans);
        
        return view('users.profile', compact('header_data', 'am_plans'));
    }
}
