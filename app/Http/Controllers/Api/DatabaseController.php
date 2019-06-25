<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class DatabaseController extends Controller
{
    public function index()
    {
        return 'here';
    }
    
    //
    public function mainDbReset()
    {
        Artisan::call('tables:clear');
        sleep(5);
        Artisan::call('migrate');
        
        return 'Success';
    }
    
}
