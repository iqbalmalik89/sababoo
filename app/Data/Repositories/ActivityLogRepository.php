<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityLog;
use App\Models\Role;
use BusinessObject\User;

use App\Helpers\Helper;

use \StdClass, Carbon\Carbon, \Exception, \DB;

class ActivityLogRepository {

	public $log_model;
	public $user_model;
	public $role_model;
	public $user_repo;

	public function __construct(ActivityLog $log, User $user, Role $role){
		$this->log_model 	= $log;
		$this->user_model 	= $user;
		$this->role_model 	= $role;
		$this->user_repo 	= app()->make('UserRepository');
	}

	/**
	 *
	 * This method will fetch list of all logs
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findByAll($pagination = false, $perPage = 10, array $input = []) {

		$loggedInUserId = Auth::user()->id;
		if (isset($input['start_date']) && $input['start_date'] != '') {
			$start_date = date('Y-m-d', strtotime($input['start_date']));
		} else {
			$start_date = '';
		}

		if (isset($input['end_date']) && $input['end_date'] != '') {
			$end_date = date('Y-m-d', strtotime($input['end_date']));
		} else {
			$end_date = date('Y-m-d');
		}

		$objectIds = $this->log_model->orderBy('created_at', 'DESC');

		if (isset($input['filter_by_module']) && $input['filter_by_module'] != '') {
			$objectIds = $objectIds->where('module','=',$input['filter_by_module']);
		}

		if (isset($input['filter_by_user']) && $input['filter_by_user'] != 0) {
			$objectIds = $objectIds->where('user_id','=',$input['filter_by_user']);
		}
		
		if ($start_date != '') {
			$objectIds = $objectIds->whereBetween(DB::raw('date(created_at)'), [$start_date, $end_date]);
		}

		if(isset($input['limit']) && $input['limit'] != 0) {
			$perPage = $input['limit'];
		}

		if ($pagination == true) {
			$objectIdsObj = $objectIds->paginate($perPage);
			$logs = $objectIdsObj->items();
			
		} else {
			$logs = $objectIds->get();
		}

		$data = ['data'=>[]];
		$total = count($logs);
		$data['total'] = $total;
		
		if ($total > 0) {
			$i = 0;
			foreach ($logs as $log) {
				$userName = '';
				$activity = '';
				if ($log->user_id == $loggedInUserId) {
					$userName = '<strong>You</strong> have ';
				} else {
					$userData = $this->user_repo->findById($log->user_id, false, false);
				
					if ($userData != NULL) {
						$userName = '<strong>'.$userData->first_name.' '.$userData->last_name.'</strong> has ';
					}
				}
				
				if ($log->module == 'roles') {
					$roleData = $this->role_model->withTrashed()->find($log->log_id);
					if ($log->log_type == 'updated_status') {
						$activity = $userName.'<strong>'.$log->text.'</strong> '.$roleData->name.' <strong>role</strong>.';
					} else {
						$activity = $userName.'<strong>'.$log->log_type.'</strong> '.$roleData->name.' <strong>role</strong>.';
					}
					
				} else if ($log->module == 'users') {

					$userData = $this->user_model->find($log->log_id);
					if ($log->log_type == 'updated_status') {
						$activity = $userName.'<strong>'.$log->text.'</strong> user <strong>'.$userData->first_name.' '.$userData->last_name.' </strong>.';
					} else {
						$activity = $userName.'<strong>'.$log->log_type.'</strong> user <strong>'.$userData->first_name.' '.$userData->last_name.' </strong>.';
					}

				} else if ($log->module == 'site_users') {
					
				} else if ($log->module == 'jobs') {
					
				} else if ($log->module == 'skills') {
					
				} else if ($log->module == 'industries') {
					
				} else if ($log->module == 'transactions') {
					
				} else if ($log->module == 'refunds') {
					
				} else if ($log->module == 'user_profile') {
					if ($log->log_type == 'login') {
						$activity = $userName.'<strong>'.$log->log_type.'</strong> to the system.';
					} else if ($log->log_type == 'logout') {
						$activity = $userName.'<strong>'.$log->log_type.'</strong> from the system.';
					}
				} 
				$data['data'][$i]['id'] = $log->id;
				$data['data'][$i]['activity'] = $activity;
				$data['data'][$i]['created_at'] = date('d M, Y h:i a', strtotime($log->created_at));			
				$i++;
			}
		}

		if ($pagination == true) {
			// call method to paginate records
    		$data = Helper::paginator($data, $objectIdsObj);
		}
		return $data;

	}
}
