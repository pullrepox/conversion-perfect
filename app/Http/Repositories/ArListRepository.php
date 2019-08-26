<?php


namespace App\Http\Repositories;


use App\Models\ArList;

class ArListRepository extends Repository
{
	public function model()
	{
		return app(ArList::class);
	}
	
	public function getArListOptions($user_id, $integration_id)
	{
		$ar_lists = $this->model()->where('user_id', $user_id)->where('integration_id', $integration_id)->orderBy('created_at', 'DESC')->get();
		
		if ($ar_lists && !is_null($ar_lists)) {
			$reMsg = [[
				'key'  => '',
				'name' => '-- Choose List --'
			]];
			
			foreach ($ar_lists as $key => $row) {
				$reMsg[($key + 1)]['key'] = $row['list_id'];
				$reMsg[($key + 1)]['name'] = $row['list_name'];
			}
			
			return $reMsg;
		} else {
			return [];
		}
	}
	
	/**
	 * @param $user_id
	 * @param $integration_id
	 * @param $lists
	 */
	public function setArList($user_id, $integration_id, $lists)
	{
		if (sizeof($lists) > 0) {
			foreach ($lists as $row) {
				if ($row['key'] == '' || $row['key'] == 'null' || is_null($row['key']) || empty($row['key'])) {
					continue;
				}
				
				$ar_list = $this->model()->where('user_id', $user_id)
					->where('integration_id', $integration_id)->where('list_id', $row['key'])->first();
				
				if ($ar_list && !is_null($ar_list)) {
					$ar_list->list_name = $row['name'];
				} else {
					$ar_list = new ArList();
					$ar_list->user_id = $user_id;
					$ar_list->integration_id = $integration_id;
					$ar_list->list_id = $row['key'];
					$ar_list->list_name = $row['name'];
				}
				
				$ar_list->save();
			}
		}
	}
}