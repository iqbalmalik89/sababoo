<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use BusinessObject\User;
use Carbon\Carbon;

use \StdClass,\DB;

class ReportRepository  {

	public $user_model;

	public function __construct(User $user){

		$this->user_model = $user;
	}

	public function userReport($input) {

		$dateSql = '';
		if (isset($input['start_date']) && $input['start_date'] != '' && isset($input['end_date']) && $input['end_date'] != '') {
    		$input['start_date'] = date('Y-m-d', strtotime($input['start_date']));
    		$input['end_date'] = date('Y-m-d', strtotime($input['end_date']));
    		$dateSql = 'AND DATE(created_at) BETWEEN \''.$input['start_date'].'\' AND \''.$input['end_date'].'\'';
    	}

    	$data = [];

    	$sql = 'SELECT COUNT(DISTINCT CASE WHEN `status` = \'enabled\' AND `is_admin` = 0 '.$dateSql.' THEN users.id ELSE NULL END) AS total_users';
    	$sql .= ', COUNT(DISTINCT CASE WHEN `status` = \'enabled\' AND `is_admin` = 0 AND `role` = \'employee\' '.$dateSql.' THEN users.id ELSE NULL END) AS total_employees';
    	$sql .= ', COUNT(DISTINCT CASE WHEN `status` = \'enabled\' AND `is_admin` = 0 AND `role` = \'employer\' '.$dateSql.' THEN users.id ELSE NULL END) AS total_employers';
    	$sql .= ', COUNT(DISTINCT CASE WHEN `status` = \'enabled\' AND `is_admin` = 0 AND `role` = \'tradesman\' '.$dateSql.' THEN users.id ELSE NULL END) AS total_tradesman';

    	$sql .= ' FROM users';
    	$sql = DB::select($sql);

		$data['data']['total_users'] = $sql[0]->total_users;
		$data['data']['total_employees'] = $sql[0]->total_employees;
		$data['data']['total_employers'] = $sql[0]->total_employers;
		$data['data']['total_tradesman'] = $sql[0]->total_tradesman;

		return $data;
	}

	public function jobReport($input) {

		$dateSql = '';
		if (isset($input['start_date']) && $input['start_date'] != '' && isset($input['end_date']) && $input['end_date'] != '') {
    		$input['start_date'] = date('Y-m-d', strtotime($input['start_date']));
    		$input['end_date'] = date('Y-m-d', strtotime($input['end_date']));
    		$dateSql = 'AND DATE(created_at) BETWEEN \''.$input['start_date'].'\' AND \''.$input['end_date'].'\'';
    	}

    	$data = [];

    	$sql = 'SELECT COUNT(DISTINCT CASE WHEN `deleted_at` IS NULL AND `is_active` = 1 '.$dateSql.' THEN job_post.id ELSE NULL END) AS posted_jobs';
    	$sql .= ', COUNT(DISTINCT CASE WHEN `deleted_at` IS NULL AND `is_active` = 1 AND `job_status` = \'completed\' '.$dateSql.' THEN job_post.id ELSE NULL END) AS completed_jobs';

    	$sql .= ' FROM job_post';
    	$sql = DB::select($sql);

    	$sql2 = 'SELECT COUNT(DISTINCT CASE WHEN `deleted_at` IS NULL '.$dateSql.' THEN applied_jobs.id ELSE NULL END) AS applied_jobs';

    	$sql2 .= ' FROM applied_jobs';
    	$sql2 = DB::select($sql2);

		$data['data']['posted_jobs'] = $sql[0]->posted_jobs;
		$data['data']['completed_jobs'] = $sql[0]->completed_jobs;
		$data['data']['applied_jobs'] = $sql2[0]->applied_jobs;

		return $data;
	}

}
