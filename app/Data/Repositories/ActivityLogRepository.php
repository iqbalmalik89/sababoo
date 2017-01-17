<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityLog;
use App\Models\Role;
use BusinessObject\User;
use BusinessObject\JobPost;
use BusinessObject\Skill;
use BusinessObject\Industry;
use App\Models\Refund;
use App\Models\Dispute;
use App\Models\News;
use App\Helpers\Helper;

use \StdClass, Carbon\Carbon, \Exception, \DB;

class ActivityLogRepository {

	public $log_model;
	public $user_model;
	public $role_model;
	public $job_model;
	public $skills_model;
	public $industries_model;
	public $refund_model;
	public $news_model;
	public $dispute_model;
	public $user_repo;

	public function __construct(ActivityLog $log, User $user, Role $role, JobPost $job, Skill $skill, Industry $industry, Refund $refund, News $news, Dispute $dispute){
		$this->log_model 	= $log;
		$this->user_model 	= $user;
		$this->role_model 	= $role;
		$this->job_model 	= $job;
		$this->skills_model = $skill;
		$this->industries_model = $industry;
		$this->refund_model = $refund;
		$this->news_model = $news;
		$this->dispute_model = $dispute;
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
					if ($roleData != NULL) {
						if ($log->log_type == 'updated_status') {
							$activity = $userName.'<strong>'.$log->text.'</strong> '.$roleData->name.' <strong>role</strong>.';
						} else {
							$activity = $userName.'<strong>'.$log->log_type.'</strong> '.$roleData->name.' <strong>role</strong>.';
						}
					}
				} else if ($log->module == 'users') {

					$userData = $this->user_model->find($log->log_id);
					if ($userData != NULL) {
						if ($log->log_type == 'updated_status') {
							$activity = $userName.'<strong>'.$log->text.'</strong> user <strong>'.$userData->first_name.' '.$userData->last_name.' </strong>.';
						} else {
							$activity = $userName.'<strong>'.$log->log_type.'</strong> user <strong>'.$userData->first_name.' '.$userData->last_name.' </strong>.';
						}
					}
				} else if ($log->module == 'jobs') {
					$jobData = $this->job_model->withTrashed()->find($log->log_id);
					if ($jobData != NULL) {
						if ($log->log_type == 'updated_status') {
							$activity = $userName.'<strong>'.$log->text.'</strong> '.$jobData->name.' <strong>job</strong>.';
						} else {
							$activity = $userName.'<strong>'.$log->log_type.'</strong> '.$jobData->name.' <strong>job</strong>.';
						}
					}
				} else if ($log->module == 'skills') {
					$skillsData = $this->skills_model->find($log->log_id);
					if ($skillsData != NULL) {
						if ($log->log_type == 'updated_status') {
							$activity = $userName.'<strong>'.$log->text.'</strong> '.$skillsData->skill.' <strong>skill</strong>.';
						} else {
							$activity = $userName.'<strong>'.$log->log_type.'</strong> '.$skillsData->skill.' <strong>skill</strong>.';
						}
					}
				} else if ($log->module == 'industries') {
					$industryData = $this->industries_model->find($log->log_id);
					if ($industryData != NULL) {
						if ($log->log_type == 'updated_status') {
							$activity = $userName.'<strong>'.$log->text.'</strong> '.$industryData->name.' <strong>industry</strong>.';
						} else {
							$activity = $userName.'<strong>'.$log->log_type.'</strong> '.$industryData->name.' <strong>industry</strong>.';
						}
					}
				} else if ($log->module == 'news') {
					$newsData = $this->news_model->find($log->log_id);
					if ($newsData != NULL) {
						$industryData = $this->industries_model->find($newsData->industry_id);
						if ($industryData != NULL) {
							if ($log->log_type == 'updated_status') {
								$activity = $userName.'<strong>'.$log->text.'</strong> '.$newsData->title.' <strong>news</strong> of '.$industryData->name.' industry.';
							} else {
								$activity = $userName.'<strong>'.$log->log_type.'</strong> '.$newsData->title.' <strong>news</strong> of '.$industryData->name.' industry.';
							}	
						} else {
							if ($log->log_type == 'updated_status') {
								$activity = $userName.'<strong>'.$log->text.'</strong> '.$newsData->title.' <strong>news</strong>.';
							} else {
								$activity = $userName.'<strong>'.$log->log_type.'</strong> '.$newsData->title.' <strong>news</strong>.';
							}
						}
					}
				} else if ($log->module == 'transactions') {
					// no activity till yet
				} else if ($log->module == 'refunds') {
					$refundData = $this->refund_model->find($log->log_id);
					if ($refundData != NULL) {
						if ($log->log_type == 'updated_status') {
							$jobData = $this->job_model->find($refundData->job_id);
							if ($jobData != NULL) {
								$activity = $userName.'<strong>'.$log->text.'</strong> refund request of <strong>'.env('CURRENCY', '$').$refundData->amount.'</strong> of '.$jobData->name.' job.';
							} else {
								$activity = $userName.'<strong>'.$log->text.'</strong> refund request of <strong>'.env('CURRENCY', '$').$refundData->amount.'</strong>.';
							}
							
						} 
					}
					
				} else if ($log->module == 'disputes') {
					$disputeData = $this->dispute_model->find($log->log_id);
					if ($disputeData != NULL) {
						if ($log->log_type == 'updated_status') {
							$jobData = $this->job_model->find($disputeData->job_id);
							if ($jobData != NULL) {
								$activity = $userName.'<strong>'.$log->text.'</strong> dispute of <strong>'.env('CURRENCY', '$').$disputeData->amount.'</strong> of '.$jobData->name.' job.';
							} else {
								$activity = $userName.'<strong>'.$log->text.'</strong> dispute of <strong>'.env('CURRENCY', '$').$disputeData->amount.'</strong>.';
							}
							
						} 
					}
					
				} else if ($log->module == 'user_profile') {
					if ($log->log_type == 'login') {
						if ($log->text != '') {
							$activity = $userName.'<strong>'.$log->log_type.'</strong> to the site.';
						} else {
							$activity = $userName.'<strong>'.$log->log_type.'</strong> to the system.';
						}
					} else if ($log->log_type == 'logout') {
						if ($log->text != '') {
							$activity = $userName.'<strong>'.$log->log_type.'</strong> from the site.';
						} else {
							$activity = $userName.'<strong>'.$log->log_type.'</strong> from the system.';
						}
					} else if ($log->log_type == 'change_password') {
						$activity = $userName.' updated your account\'s <strong>password</strong>.';
					} else if ($log->log_type == 'updated') {
						$activity = $userName.' updated your account\'s <strong>personal info</strong>.';
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
