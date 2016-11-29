<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use BusinessObject\User;
use BusinessObject\Industry;
use BusinessObject\Employee;
use BusinessObject\Employer;
use BusinessObject\Tradesman;
use BusinessObject\Education;
use BusinessObject\UserSkill;
use BusinessObject\Skill;
use BusinessObject\Experience;
use BusinessObject\Language;
use BusinessObject\UserFiles;
use BusinessObject\Certification;
use App\Helpers\Helper;

use \StdClass, Carbon\Carbon, \Session;

class SiteUserRepository {

	public $user_model;
	public $industry_model;
	public $employee_model;
	public $employer_model;
	public $tradesman_model;
	public $education_model;
	public $skills_model;
	public $user_skills_model;
	public $experience_model;
	public $language_model;
	public $user_files_model;
	public $certification_model;

	protected $_cacheKey = 'user-'; 

	public function __construct(User $user, Industry $industry, Employee $employee, Employer $employer, Tradesman $tradesman, Education $education, UserSkill $user_skills, Skill $skills, Experience $experience, Language $language, UserFiles $userFile, Certification $certification){
		$this->user_model 		= $user;
		$this->industry_model 	= $industry;
		$this->employee_model 	= $employee;
		$this->employer_model 	= $employer;
		$this->tradesman_model 	= $tradesman;
		$this->education_model 	= $education;
		$this->user_skills_model = $user_skills;
		$this->skills_model 	= $skills;
		$this->experience_model = $experience;
		$this->language_model = $language;
		$this->user_files_model = $userFile;
		$this->certification_model = $certification;
	}

	 /**
	 *
	 * This method will fetch data of individual user
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findById($id, $refresh = false, $allData = true) {

		$data = Cache::get($this->_cacheKey.$id);

		if ($data == NULL || $refresh == true) {
			$user = $this->user_model->find($id);
			if ($user != NULL) {

				$data 						= new StdClass;
				$data->id 					= $user->id;
				$data->first_name 			= $user->first_name;
				$data->last_name 			= $user->last_name;
				$data->email 				= $user->email;
				$data->password 			= $user->password;
				$data->is_admin 			= $user->is_admin;
				$data->role 				= $user->role;
				$data->role_id 				= $user->role_id;
				$data->industry_id 			= $user->industry_id;
				$data->status 				= $user->status;
				$data->activation_token		= $user->activation_token;
				$data->country				= $user->country;
				$data->address				= $user->address;
				$data->phone				= $user->phone;
				$data->phone_type			= $user->phone_type;
				$data->image				= $user->image;
				$data->postal_code			= $user->postal_code;
				$data->remember_token		= $user->remember_token;
				$data->created_at			= date('d M, Y', strtotime($user->created_at));
				$data->updated_at			= date('d M, Y', strtotime($user->updated_at));

				Cache::forever($this->_cacheKey.$id,$data);			
				
			} else {
				return NULL;
			}
		}

		// to get industry name
		$data->industry_name = '';
		$industry = $this->industry_model->find($data->industry_id);
		if ($industry != NULL) {
			$data->industry_name = $industry->name;
		}

		if ($allData == true) {

			$data->user = new StdClass;
			if ($data->role == 'employee' || $data->role == 'tradesman') {
				$data->user->experiences = [];
				// basic info
				if ($data->role == 'employee') {
					$empData = $this->employee_model->where('userid', '=', $id)->first();
				} else if ($data->role == 'tradesman') {
					$empData = $this->tradesman_model->where('userid', '=', $id)->first();
				}
				
				if ($empData != NULL) {
					$data->user = $empData;

					// experience
					$data->user->experiences = $this->experience_model->where('employee_id', '=', $empData->id)->where('status', '=', 1)->get();
				}

				// education
				$data->user->educations = $this->education_model->where('userid', '=', $id)->get();

				// skills
				$skillsData = $this->user_skills_model->where('user_id', '=', $id)->get();
				$skillsArray = [];
				if (count($skillsData) > 0) {
					foreach ($skillsData as $key => $skill) {
						$skillData = $this->skills_model->find($skill->skill_id);
						if ($skillData != NULL) {
							$skillsArray[] = $skillData;
						}
						
					}
				}
				$data->user->skills = $skillsArray;

				// Language
				$data->user->languages = $this->language_model->where('user_id', '=', $id)->get();

				// Certification
				$data->user->certifications = $this->certification_model->where('userid', '=', $id)->get();

			} else if ($data->role == 'employer') {
				$empData = $this->employer_model->where('userid', '=', $id)->first();
				if ($empData != NULL) {
					$data->user = $empData;
				}
			}

			// files
			$data->user->files = $this->user_files_model->where('userid', '=', $id)->where('status', '=', 1)->get();
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

		// to get all users
		$objectIds = $this->user_model->where('is_admin', '=', 0)->where('status', '!=', 'delete');

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$objectIds = $objectIds->where('status','=',$input['filter_by_status']);
		}

		if (isset($input['filter_by_role']) && $input['filter_by_role'] != '') {
			$objectIds = $objectIds->where('role','=',$input['filter_by_role']);
		}

		if (isset($input['keyword']) && $input['keyword'] != '') {
			$objectIds = $objectIds->where('first_name','LIKE','%'.$input['keyword'].'%')
									->orwhere('last_name','LIKE','%'.$input['keyword'].'%');
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
				$objectData = $this->findById($object->id, false, false);
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
	 * This method will delete an existing user
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function deleteById($id) {

		$user = $this->user_model->find($id);
		if ($user != NULL) {
			$user->status = 'delete';
			$user->save();
			//$user->delete();
			Cache::forget($this->_cacheKey.$id);
			return true;
		} else {
			return false;
		}
	}

	 /**
     *
     * This method will change user status (active, inactive)
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateStatus($input) {

		$user = $this->user_model->find($input['id']);

		if ($user != NULL) {
			$user->status = $input['status'];			
			$user->updated_at = Carbon::now();
			if ($user->save()) {
				Cache::forget($this->_cacheKey.$input['id']);
				return true;
			}
		}
	}

	public function findByAttribute($attribute, $value) {

		$data = $this->user_model->where($attribute,'=', $value)->first(['id']);

		if ($data != NULL) {
			$data = $this->findById($data->id);
		}

		return $data;
	}
}
