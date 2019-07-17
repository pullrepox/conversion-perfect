<?php


namespace App\Http\View;


use App\Http\Repositories\ApiRepository;
use App\Models\Upgrade;
use Illuminate\View\View;

class ProfilesComposer
{
    protected $permRepo;
    
    public function __construct(ApiRepository $apiRepository)
    {
        $this->permRepo = $apiRepository;
    }
    
    public function compose(View $view)
    {
        $permissions = auth()->check() && !is_null(auth()->user()->permissions) ? json_encode(auth()->user()->permissions) :
            '{"access":1,"split-test":0,"multi-bar":0,"remove-powered-by":0,"social-buttons":0,"lead-capture":0,"agency":0,"pro-templates":0,"120-templates":0,"240-templates":0,"reseller":0,"maximum-bars":3}';
        
        $upgrade_list = [];
        if (auth()->check()) {
            $upgrades = Upgrade::all();
            $am_plans = explode(',', auth()->user()->amemberplans);
            if ($upgrades && !is_null($upgrades)) {
                foreach ($upgrades as $key => $row) {
                    $upgrade_list[$row->alias] = $row;
                    $upgrade_list[$row->alias]['to_do'] = $row->showwasupgrade ? true : false;
                    for ($i = 0; $i < count($am_plans); $i++) {
                        if (!$row->showwasupgrade) {
                            if ($upgrade_list[$row->alias]['to_do']) {
                                break;
                            }
                            if ($row->id == 2 && $am_plans[$i] == '14') {
                                $upgrade_list[$row->alias]['to_do'] = true;
                                break;
                            } elseif ($row->id == 3 && ($am_plans[$i] == '14' || $am_plans[$i] == '15')) {
                                $upgrade_list[$row->alias]['to_do'] = true;
                                break;
                            }
                        } else {
                            if (!$upgrade_list[$row->alias]['to_do']) {
                                break;
                            }
                            $unless_user_has = explode(',', $row->unlessuserhas);
                            if (array_search($am_plans[$i], $unless_user_has) !== false) {
                                $upgrade_list[$row->alias]['to_do'] = false;
                                break;
                            }
                        }
                    }
                }
            }
        }
        
        $view->with('permissions', $permissions);
        $view->with('upgrades', json_encode($upgrade_list));
    }
}
