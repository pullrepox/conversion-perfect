<?php


namespace App\Http\Repositories;


use App\Models\Bar;
use App\Models\BarsClickLog;
use Illuminate\Support\Facades\DB;

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
            if ($bar_log->cookie == '' || is_null($bar_log->cookie)) {
                $bar_log->cookie = $fp_id;
                $bar_log->save();
            }
            
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
    
    public function getLogsChartsData($period, $bar_id = 0)
    {
        $current_date = date('d-m-Y');
        
        $calc_data = [
            'xLabel'         => [],
            'totalVisitors'  => [],
            'uniqueVisitors' => [],
            'buttonClicks'   => [],
            'leadCaptures'   => []
        ];
        
        if ($period == 'day') {
            $total_visitors = $this->model1()
                ->select('id', DB::raw('count(id) as total_visitors'), DB::raw('DATE_FORMAT(created_at, "%l%p") as created_hour'))
                ->where('user_id', auth()->user()->id)
                ->whereRaw('date(created_at) = curdate()')
                ->where('reset_stats', '0');
            if ($bar_id != 0) {
                $total_visitors = $total_visitors->where('bar_id', $bar_id);
            }
            $total_visitors = $total_visitors->groupBy(DB::raw('hour(created_at)'))->orderBy(DB::raw('hour(created_at)'))->get();
            
            $unique_visitors = $this->model1()
                ->select('id', DB::raw('count(id) as unique_visitors'), DB::raw('DATE_FORMAT(created_at, "%l%p") as created_hour'))
                ->where('user_id', auth()->user()->id)
                ->whereRaw('date(created_at) = curdate()')
                ->where('unique_click', '1')
                ->where('reset_stats', '0');
            if ($bar_id != 0) {
                $unique_visitors = $unique_visitors->where('bar_id', $bar_id);
            }
            $unique_visitors = $unique_visitors->groupBy(DB::raw('hour(created_at)'))->orderBy(DB::raw('hour(created_at)'))->get();
            
            $button_clicks = $this->model1()
                ->select('id', DB::raw('count(id) as button_clicks'), DB::raw('DATE_FORMAT(created_at, "%l%p") as created_hour'))
                ->where('user_id', auth()->user()->id)
                ->whereRaw('date(created_at) = curdate()')
                ->where('button_click', '1')
                ->where('reset_stats', '0');
            if ($bar_id != 0) {
                $button_clicks = $button_clicks->where('bar_id', $bar_id);
            }
            $button_clicks = $button_clicks->groupBy(DB::raw('hour(created_at)'))->orderBy(DB::raw('hour(created_at)'))->get();
            
            $lead_captures = $this->model1()
                ->select('id', DB::raw('count(id) as lead_captures'), DB::raw('DATE_FORMAT(created_at, "%l%p") as created_hour'))
                ->where('user_id', auth()->user()->id)
                ->whereRaw('date(created_at) = curdate()')
                ->where('lead_capture', '1')
                ->where('reset_stats', '0');
            if ($bar_id != 0) {
                $lead_captures = $lead_captures->where('bar_id', $bar_id);
            }
            $lead_captures = $lead_captures->groupBy(DB::raw('hour(created_at)'))->orderBy(DB::raw('hour(created_at)'))->get();
            
            if ($total_visitors && !is_null($total_visitors)) {
                foreach ($total_visitors as $total_visitor) {
                    $calc_data['totalVisitors'][$total_visitor->created_hour] = $total_visitor->total_visitors;
                }
            }
            
            if ($unique_visitors && !is_null($unique_visitors)) {
                foreach ($unique_visitors as $unique_visitor) {
                    $calc_data['uniqueVisitors'][$unique_visitor->created_hour] = $unique_visitor->unique_visitors;
                }
            }
            
            if ($button_clicks && !is_null($button_clicks)) {
                foreach ($button_clicks as $button_click) {
                    $calc_data['buttonClicks'][$button_click->created_hour] = $button_click->button_clicks;
                }
            }
            
            if ($lead_captures && !is_null($lead_captures)) {
                foreach ($lead_captures as $lead_capture) {
                    $calc_data['leadCaptures'][$lead_capture->created_hour] = $lead_capture->lead_captures;
                }
            }
            
            $calc_data['xLabel'] = [
                '12AM', '1AM', '2AM', '3AM', '4AM', '5AM', '6AM', '7AM', '8AM', '9AM', '10AM', '11AM', '12PM', '1PM', '2PM', '3PM', '4PM', '5PM', '6PM', '7PM', '8PM', '9PM',
                '10PM', '11PM'
            ];
        } else {
            $cal_number = $period == 'week' ? 7 : 30;
            $QueryInterval = 'interval ' . $cal_number . ' DAY';
            
            $log_data = $this->model1()
                ->select('id', 'unique_click', 'button_click', 'lead_capture', 'created_at')
                ->where('user_id', auth()->user()->id)
                ->whereRaw('DATE(created_at) >= date_sub(now(), ' . $QueryInterval . ')')
                ->where('reset_stats', '0');
            if ($bar_id != 0) {
                $log_data = $log_data->where('bar_id', $bar_id);
            }
            
            $log_data = $log_data->orderBy('created_at')->get();
            
            if ($log_data && !is_null($log_data)) {
                for ($i = 1; $i <= $cal_number; $i++) {
                    $dStr = date('d/m', strtotime($current_date . ' - ' . ($cal_number * 1 - $i) . ' days'));
                    $calc_data['totalVisitors'][$dStr] = 0;
                    $calc_data['uniqueVisitors'][$dStr] = 0;
                    $calc_data['buttonClicks'][$dStr] = 0;
                    $calc_data['leadCaptures'][$dStr] = 0;
                }
                
                foreach ($log_data as $row) {
                    $dStr = date('d/m', strtotime($row->created_at));
                    if (!isset($calc_data['totalVisitors'][$dStr])) {
                        continue;
                    }
                    
                    $calc_data['totalVisitors'][$dStr] += 1;
                    $calc_data['uniqueVisitors'][$dStr] += $row->unique_click;
                    $calc_data['buttonClicks'][$dStr] += $row->button_click;
                    $calc_data['leadCaptures'][$dStr] += $row->lead_capture;
                }
                
                $calc_data['xLabel'] = [$current_date];
                for ($i = 1; $i < $cal_number; $i++) {
                    $dStr = date('d-m-Y', strtotime("-" . $i . " day", strtotime($current_date)));
                    $calc_data['xLabel'][] = $dStr;
                }
                
                $sortTime = [];
                foreach ($calc_data['xLabel'] as $key => $values) {
                    $sortTime[] = strtotime($values);
                }
                asort($sortTime);
                
                $calc_data['xLabel'] = [];
                foreach ($sortTime as $value) {
                    $calc_data['xLabel'][] = date('d/m', $value);
                }
                
                $calc_data['xLabel'] = array_unique($calc_data['xLabel']);
            }
        }
        
        $get_data = $this->getClicksData($calc_data['xLabel'], $calc_data['totalVisitors'], $calc_data['uniqueVisitors'], $calc_data['buttonClicks'], $calc_data['leadCaptures']);
        $calc_data['totalVisitors'] = $get_data[0];
        $calc_data['uniqueVisitors'] = $get_data[1];
        $calc_data['buttonClicks'] = $get_data[2];
        $calc_data['leadCaptures'] = $get_data[3];
        
        return $calc_data;
    }
    
    public function getClicksData($date, $tVisitor, $uVisitor, $bClick, $lCapture)
    {
        $total_visitor = $unique_visitor = $button_click = $lead_capture = [];
        
        if (sizeof($date) > 0) {
            foreach ($date as $key => $row) {
                $total_visitor[$key] = $unique_visitor[$key] = $button_click[$key] = $lead_capture[$key] = 0;
                if (array_key_exists($row, $tVisitor)) {
                    $total_visitor[$key] = $tVisitor[$row];
                }
                if (array_key_exists($row, $uVisitor)) {
                    $unique_visitor[$key] = $uVisitor[$row];
                }
                if (array_key_exists($row, $bClick)) {
                    $button_click[$key] = $bClick[$row];
                }
                if (array_key_exists($row, $lCapture)) {
                    $lead_capture[$key] = $lCapture[$row];
                }
            }
        }
        
        return [$total_visitor, $unique_visitor, $button_click, $lead_capture];
    }
}
