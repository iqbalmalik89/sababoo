<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\Model;
use BusinessObject\JobPost;
use BusinessObject\User;
use BusinessObject\Industry;
use App\Helpers\Helper;

use \StdClass, Carbon\Carbon, \Session;

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
				$data->is_admin_job			= $job->is_admin_job;
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

		$objectIds = $this->job_model;
				
		if (isset($input['keyword']) && $input['keyword'] != '') {
			$objectIds = $objectIds->where('name','LIKE','%'.$input['keyword'].'%');
		}

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$objectIds = $objectIds->where('is_active','=',$input['filter_by_status']);
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

		$user = $this->job_model->find($id);
		if ($user != NULL) {
			$user->delete();
			Cache::forget($this->_cacheKey.$id);
			return true;
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

		$user = $this->job_model->find($input['id']);

		if ($user != NULL) {
			$user->is_active = $input['status'];
			$user->updated_at = Carbon::now();
			if ($user->save()) {
				Cache::forget($this->_cacheKey.$input['id']);
				return true;
			}
		}
	}
}
