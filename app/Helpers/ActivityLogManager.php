<?php

namespace App\Helpers;
use App\Models\ActivityLog;

class ActivityLogManager {

	/**
	 *
	 * This method will create new log of specific type
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 **/
	public static function create($params) {
		$activityData = new ActivityLog;
		if (isset($params['user_id'])) {
			$activityData->user_id = $params['user_id'];
		}
	
		if (isset($params['module'])) {
			$activityData->module = $params['module'];
		}
		
		if (isset($params['log_id'])) {
			$activityData->log_id = $params['log_id'];
		}

		if (isset($params['log_type'])){
			$activityData->log_type = $params['log_type'];
		}
		
		if (isset($params['text'])) {
			$activityData->text = $params['text'];
		}

		if (isset($params['sub_text'])) {
			$activityData->sub_text = $params['sub_text'];
		}
		$activityData->save();
	}
}
