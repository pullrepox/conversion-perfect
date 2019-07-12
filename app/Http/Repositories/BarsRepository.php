<?php


namespace App\Http\Repositories;


use App\Models\Bar;
use DrewM\MailChimp\MailChimp;

class BarsRepository extends Repository
{
    public function model()
    {
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
    
    public function setSendlaneList($integration, $name, $email, $list_id)
    {
        $api_key = $integration['api_key'];
        $hash = $integration['hash'];
        $url = $integration->responder->base_url . 'list-subscribers-add';
        $nameAry = explode(' ', $name);
        $f_name = $nameAry[0];
        $l_name = isset($nameAry[1]) ? $nameAry[1] : '';
        
        $data = [
            'api'     => $api_key,
            'hash'    => $hash,
            'email'   => $f_name . ' ' . $l_name . '<' . $email . '>',
            'list_id' => $list_id,
        ];
        
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $e) {
        }
    }
    
    /**
     * @param $integration
     * @return array
     * @throws \Exception
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
    
    /**
     * @param $integration
     * @param $name
     * @param $email
     * @param $list_id
     * @param $ip
     * @throws \Exception
     */
    public function setMailChimpLists($integration, $name, $email, $list_id, $ip)
    {
        $nameAry = explode(' ', $name);
        $f_name = $nameAry[0];
        $l_name = isset($nameAry[1]) ? $nameAry[1] : '';
        $api_key = $integration['api_key'];
        $MailChimp = new MailChimp($api_key);
        $MailChimp->verify_ssl = false;
        $MailChimp->post(("lists/" . $list_id . "/members"), [
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => ['FNAME' => $f_name, 'LNAME' => $l_name],
            'ip_signup'     => $ip
        ]);
    }
    
    public function getConversionPerfectLists()
    {
        $lists = auth()->user()->email_lists;
        
        $reMsg = [[
            'key'  => '',
            'name' => '-- Choose List --'
        ]];
        
        $i = 1;
        foreach ($lists as $list) {
            $reMsg[$i]['key'] = $list->id;
            $reMsg[$i]['name'] = $list->list_name;
            $i++;
        }
        
        return [
            'result'  => 'success',
            'message' => $reMsg
        ];
    }
}
