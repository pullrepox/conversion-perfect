<?php


namespace App\Http\Repositories;


use App\Models\Bar;
use App\Models\BarsClickLog;

class BarsRepository extends Repository
{
    public function model()
    {
        return app(Bar::class);
    }
    
    public function model1()
    {
        return app(BarsClickLog::class);
    }
    
    public function checkUniqueLog($bar_id, $user_id, $fp_id, $unique_ref)
    {
        $bar_log = $this->model1()->where('user_id', $user_id)->where('bar_id', $bar_id)
            ->where(function ($q) use ($fp_id, $unique_ref) {
                $q->where('cookie', $fp_id)->orWhere('unique_ref', $unique_ref);
            })->first();
        
        if ($bar_log && !is_null($bar_log)) {
            $bar_log->cookie = $fp_id;
            $bar_log->unique_ref = $unique_ref;
            $bar_log->save();
            
            return false;
        } else {
            return true;
        }
    }
    
    public function setActionBtnClickLog($bar_id, $user_id, $fp_id, $unique_ref)
    {
        $bar_log = $this->model1()->where('user_id', $user_id)->where('bar_id', $bar_id)
            ->where('button_click', 0)
            ->where(function ($q) use ($fp_id, $unique_ref) {
                $q->where('cookie', $fp_id)->orWhere('unique_ref', $unique_ref);
            })->first();
        
        if ($bar_log && !is_null($bar_log)) {
            $bar_log->button_click = 1;
            $bar_log->save();
            
            return true;
        } else {
            return false;
        }
    }
    
    public function setLeadCaptureClickLog($bar_id, $user_id, $fp_id, $unique_ref)
    {
        $bar_log = $this->model1()->where('user_id', $user_id)->where('bar_id', $bar_id)
            ->where('lead_capture', 0)
            ->where(function ($q) use ($fp_id, $unique_ref) {
                $q->where('cookie', $fp_id)->orWhere('unique_ref', $unique_ref);
            })->first();
        
        if ($bar_log && !is_null($bar_log)) {
            $bar_log->lead_capture = 1;
            $bar_log->save();
            
            return true;
        } else {
            return false;
        }
    }
}
