<?php


namespace App\Http\Repositories;


use App\Models\Bar;
use DrewM\MailChimp\MailChimp;

class BarsRepository extends Repository
{
    public function model()
    {
        // TODO: Implement model() method.
        return app(Bar::class);
    }
    
    public function getSendlaneList($integration)
    {
        $msg = 'Error! Sendlane URL seems wrong.';
        $api_key = $integration['api_key'];
        $hash = $integration['hash'];
        $url = $integration->responder->base_url . 'lists';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$api_key&hash=$hash");
        $result = curl_exec($ch);
        $result = json_decode($result);
        if ($result && isset($result->error)) {
            foreach ($result->error as $err) {
                $msg = $err;
            }
            
            return [
                'result'  => 'failure',
                'message' => $msg
            ];
        } else {
            $reMsg = [[
                'key'  => '',
                'name' => '-- Choose List --'
            ]];
            
            $i = 1;
            foreach ($result as $list) {
                $reMsg[$i]['key'] = $list->list_id;
                $reMsg[$i]['name'] = $list->list_name;
                $i++;
            }
            
            return [
                'result'  => 'success',
                'message' => $reMsg
            ];
        }
    }
    
    /**
     * @param $integration
     * @throws \Exception
     * @return array
     */
    public function getMailChimpLists($integration)
    {
        $api_key = $integration['api_key'];
        $MailChimp = new MailChimp($api_key);
        $MailChimp->verify_ssl = false;
        $total_lists = $MailChimp->get('lists');
        $count_lists = $total_lists['total_items'];
        $lists = $MailChimp->get('lists', [
            'count' => $count_lists
        ]);
        
        if (!$lists['lists']) {
            return [
                'result'  => 'failure',
                'message' => 'Nothing in this account. Please add a list to this account.'
            ];
        }
    
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
    
        $i = 1;
        foreach ($lists['lists'] as $list) {
            $reMsg[$i]['key'] = $list['id'];
            $reMsg[$i]['name'] = $list['name'];
            $i++;
        }
    
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
}
