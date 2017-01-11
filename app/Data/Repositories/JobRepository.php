<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\Model;
use BusinessObject\JobPost;
use BusinessObject\User;
use BusinessObject\Industry;
use App\Helpers\Helper;
use App\Helpers\ActivityLogManager;
use \StdClass, Carbon\Carbon, \Session, \Exception;

class JobRepository {

	public $job_model;
	public $industry_model;
	public $user_model;

	protected $_cacheKey = 'job-'; 

	public function __construct(JobPost $jobPost,Industry $industry, User $user){
		$this->job_model 			= $jobPost;
		$this->industry_model 		= $industry;
		$this->user_model 			= $user;
	}

	 /**
	 *
	 * This method will fetch data of individual job
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findById($id, $refresh = false) {

		$data = Cache::get($this->_cacheKey.$id);

		if ($data == NULL || $refresh == true) {
			$job = $this->job_model->find($id);
			if ($job != NULL) {

				$data 						= new StdClass;
				$data->id 					= $job->id;
				$data->userid 				= $job->userid;
				$data->industry_id 			= $job->industry_id;
				$data->name 				= $job->name;
				$data->description 			= $job->description;
				$data->type 				= $job->type;
				$data->location				= $job->location;
				$data->salary				= $job->salary;
				$data->job_deadline_date 	= date('d M, Y', strtotime($job->job_deadline_date));
				$data->requirement			= $job->requirement;
				$data->responsibilities		= $job->responsibilities;
				$data->experience			= $job->experience;
				$data->status				= $job->status;
				$data->terms				= $job->terms;
				$data->is_active			= $job->is_active;
				$data->job_status			= strtoupper($job->job_status);
				$data->created_at			= date('d M, Y', strtotime($job->created_at));
				$data->updated_at			= date('d M, Y', strtotime($job->updated_at));

				Cache::forever($this->_cacheKey.$id,$data);			
				
			} else {
				return NULL;
			}
		}

		// to get user name
		$data->user_name = '';
		$user = $this->user_model->find($data->userid);
		if ($user != NULL) {
			$data->user_name = $user->first_name.' '.$user->last_name;
		}
		
		// to get industry name
		$data->industry_name = '';
		$industry = $this->industry_model->find($data->industry_id);
		if ($industry != NULL) {
			$data->industry_name = $industry->name;
		}

		return $data;

	}

	/**
	 *
	 * This method will fetch list of all users
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findByAll($pagination = false, $perPage = 10, array $input = []) {

		$objectIds = $this->job_model->orderBy('id', 'DESC');
				
		if (isset($input['keyword']) && $input['keyword'] != '') {
			$objectIds = $objectIds->where('name','LIKE','%'.$input['keyword'].'%');
		}

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$objectIds = $objectIds->where('is_active','=',$input['filter_by_status']);
		}

		if (isset($input['filter_by_job_status']) && $input['filter_by_job_status'] != '') {
			$objectIds = $objectIds->where('job_status','=',$input['filter_by_job_status']);
		}

		if(isset($input['limit']) && $input['limit'] != 0) {
			$perPage = $input['limit'];
		}

		if ($pagination == true) {
			$objectIdsPaginate = $objectIds->paginate($perPage, ['id']);
			$objects = $objectIdsPaginate->items();
			
		} else {
			$objects = $objectIds->get(['id']);
		}

		$data = ['data'=>[]];
		
		if (count($objects) > 0) {
			$i = 0;
			foreach ($objects as $object) {
				$objectData = $this->findById($object->id);
				$data['data'][$i] = $objectData;			
				$i++;
			}
		}

		if ($pagination == true) {
			// call method to paginate records
    		$data = Helper::paginator($data, $objectIdsPaginate);
		}
		return $data;
	}

	/**
	 *
	 * This method will delete an existing job
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function deleteById($id) {

		$job = $this->job_model->find($id);
		if ($job != NULL) {
			if($job->job_status == 'in-progress') {
				return 'cannot_delete';
			} 
			$job->delete();
			Cache::forget($this->_cacheKey.$id);
			// to maintain log
			try {
				$newParams = array(
							'user_id' 	=> Auth::user()->id,
							'module' 	=> 'jobs',
							'log_id' 	=> $id,
							'log_type' 	=> 'deleted'
						);
				ActivityLogManager::create($newParams);
			} catch(Exception $e){

			}
			return 'success';
		} else {
			return false;
		}
	}

	 /**
     *
     * This method will change job status (active, inactive)
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateStatus($input) {

		$job = $this->job_model->find($input['id']);

		if ($job != NULL) {
			$job->is_active = $input['status'];

			if ($job->is_active == 0) {
				if($job->job_status == 'in-progress') {
					return 'cannot_inactivate';
				} 
			}

			$job->updated_at = Carbon::now();
			if ($job->save()) {
				Cache::forget($this->_cacheKey.$input['id']);
				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'jobs',
								'log_id' 	=> $job->id,
								'log_type' 	=> 'updated_status',
								'text'		=> ($job->is_active == 1)?'activated':'deactivated'
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}
				return 'success';
			}
		}
	}

	 /**
     *
     * This method will change job status (active, inactive)
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateJobStatus($input) {

		$job = $this->job_model->find($input['id']);

		if ($job != NULL) {
			$job->job_status = $input['status'];
			$job->updated_at = Carbon::now();
			if ($job->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'jobs',
								'log_id' 	=> $job->id,
								'log_type' 	=> 'updated_status',
								'text'		=> $job->job_status
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}

				return 'success';
			}
		}
	}
}
