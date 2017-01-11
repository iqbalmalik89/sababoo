<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use BusinessObject\User;
use App\Models\Role;
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
use App\Events\Activation;
use App\Events\PasswordRecovered;
use App\Helpers\ActivityLogManager;
use \StdClass, Carbon\Carbon, \Session;

class UserRepository {

	public $user_model;
	public $role_model;
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

	public function __construct(User $user, Role $role, Industry $industry, Employee $employee, Employer $employer, Tradesman $tradesman, Education $education, UserSkill $user_skills, Skill $skills, Experience $experience, Language $language, UserFiles $userFile, Certification $certification){
		$this->user_model 	= $user;
		$this->role_model 	= $role;
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
	public function findById($id, $refresh = false, $allData = false) {

		$data = Cache::get($this->_cacheKey.$id);

		if ($data == NULL || $refresh == true) {
			$user = $this->user_model->find($id);
			if ($user != NULL) {

				$data 						= new StdClass;
				$data->id 					= $user->id;
				$data->name 				= $user->first_name;
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
				$data->recover_password_key = $user->recover_password_key;
				$data->country				= $user->country;
				$data->address				= $user->address;
				$data->phone				= $user->phone;
				$data->phone_type			= $user->phone_type;
				$data->image				= $user->image;
				$data->postal_code			= $user->postal_code;
				$data->remember_token		= $user->remember_token;
				$data->verified_string		= $user->verified_string;
				$data->created_at			= date('d M, Y', strtotime($user->created_at));
				$data->updated_at			= date('d M, Y', strtotime($user->updated_at));
				
				Cache::forever($this->_cacheKey.$id,$data);			
				
			} else {
				return NULL;
			}
		}

		if ($data->role == 'employee') {
			$data->role = ucfirst(env('EMPLOYEE_TITLE'));
		} else if ($data->role == 'employer') {
			$data->role = ucfirst(env('EMPLOYER_TITLE'));
		} else if ($data->role == 'tradesman') {
			$data->role = ucfirst(env('TRADESMAN_TITLE'));
		} else {
			$data->role = $data->role;
		}
		// to get role title
		$data->role_title = '';
		$role = $this->role_model->find($data->role_id);
		if ($role != NULL) {
			$data->role_title = $role->name;
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

		// to get all users except admin user
		if (isset($input['is_admin']) && $input['is_admin'] == 1) {

			$objectIds = $this->user_model->where('is_admin', '=', 1)->where('status', '!=', 'delete')->orderBy('id', 'DESC');

			if (isset($input['filter_by_role']) && $input['filter_by_role'] != 0) {
				$objectIds = $objectIds->where('role_id','=',$input['filter_by_role']);
			}

		} else{

			$objectIds = $this->user_model->where('is_admin', '=', 0)->where('status', '!=', 'delete')->orderBy('id', 'DESC');

			if (isset($input['filter_by_role']) && $input['filter_by_role'] != '') {
				$objectIds = $objectIds->where('role','=',$input['filter_by_role']);
			}

		}
			
		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$objectIds = $objectIds->where('status','=',$input['filter_by_status']);
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
	 * This method will create a new user
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function create(array $input = []) {

		$user 					= $this->user_model;
		$user->first_name		= $input['name']; 
		$user->email  			= $input['email'];
		$user->role_id  		= $input['role_id'];
		$user->status   		= 'enabled';
		$user->is_admin   		= 1;
		$user->activation_token	= Hash::make(time());
		$user->verified_string  = 'unverified';
		if($user->save()) {	

			// to maintain log
			try {
				$newParams = array(
							'user_id' 	=> Auth::user()->id,
							'module' 	=> 'users',
							'log_id' 	=> $user->id,
							'log_type' 	=> 'created'
						);
				ActivityLogManager::create($newParams);
			} catch(Exception $e){

			}

			Event::fire(new Activation($user));
			return true;
		} else {
			return false;
		}
	}

	 /**
	 *
	 * This method will update existing user
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function update(array $input = []) {
		$user = $this->user_model->find($input['id']);
		if ($user != NULL) {

			if (isset($input['name']) && $input['name'] != '') {
				$user->first_name = $input['name'];
			}

			if (isset($input['email']) && $input['email'] != '') {
				$user->email = $input['email'];
			}

			if (isset($input['role_id']) && $input['role_id'] != 0) {
				$user->role_id = $input['role_id'];
			}

			$user->updated_at   = Carbon::now();

			if($user->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'users',
								'log_id' 	=> $user->id,
								'log_type' 	=> 'updated'
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}

				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
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

			// to maintain log
			try {
				$newParams = array(
							'user_id' 	=> Auth::user()->id,
							'module' 	=> 'users',
							'log_id' 	=> $id,
							'log_type' 	=> 'deleted'
						);
				ActivityLogManager::create($newParams);
			} catch(Exception $e){

			}

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

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'users',
								'log_id' 	=> $user->id,
								'log_type' 	=> 'updated_status',
								'text'		=> ($user->status == 'enabled')?'activated':'deactivated'
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}

				return true;
			}
		}
	}

	public function findByAttribute($attribute, $value) {

		$data = $this->user_model->where($attribute,'=', $value)->first(['id']);

		if ($data != NULL) {
			$data = $this->findById($data->id, false, false);
		}

		return $data;
	}

	public function login($input) {
		
		$canLogin = true;
		$userExists = $this->findByAttribute('email',$input['email']);
		
		if($userExists != NULL) {

			// to check for is_admin
			if (isset($input['is_admin']) && ($input['is_admin'] == 1 || $input['is_admin'] == true)) {
				// check user is admin or not
				$isAdmin = $this->user_model->where('id', '=', $userExists->id)->where('is_admin', '=', 1)->count();
				if ($isAdmin == 0) {
					$canLogin = false;
				}

			} else {

				// for other users will implement later
			}

			if ($canLogin == true) {

				if ($userExists->verified_string == 'verified') {
					// check if active or inactive
					if ($userExists->status == 'enabled') {

						// validate User
						if(Hash::check($input['password'],$userExists->password)) {
							$user = $this->user_model->find($userExists->id);
							unset($user->password);

							$output['user_id'] 	= $user->id;
							$output['is_admin'] = $user->is_admin;
							$output['user'] 	= $user;

							//Auth::loginUsingId($user->id, true);

							//Session::put('sa_user', $user);
							if (Auth::attempt($input, false)) {
         
					            $auth = true;
					            $user = Auth::user();
					            $user->save();
						    }

							/*$response = Auth::attempt($input);
							if ($response) {
								Auth::login(Auth::user(), true);
							}*/
							
							Cache::forget($this->_cacheKey.$user->id);

							// to maintain log
							try {
								$newParams = array(
											'user_id' 	=> Auth::user()->id,
											'module' 	=> 'user_profile',
											'log_id' 	=> $user->id,
											'log_type' 	=> 'login'
										);
								ActivityLogManager::create($newParams);
							} catch(Exception $e){

							}

							// return response 200
							return $output;
						} else {
							// return response 404
							return 'not_found';
						}

					} else {
						// return response 404
						return 'not_allowed';
					}
					
				} else {
					// return response 406
					return 'not_activated';
				}
			} else {
				// return 404 response
				return 'not_admin';
			}

		} else {
			// return response 404
			return 'not_found';
		}
	}

	public function createPassword($id, $password) {
		$user = $this->user_model->find($id);
		if($user != NULL) {
			$user->password = Hash::make($password);
			//$user->activation_key = '';
			$user->verified_string = 'verified';
			$user->save();
			Cache::forget($this->_cacheKey.$id);
			return true;
		} else {
			return NULL;
		}
	}

	public function forgotPassword($id) {
		
		$user = $this->user_model->find($id);
		if($user != NULL) {

			$key = Hash::make(time()*rand()*1000);
			$user->recover_password_key = $key;
			$user->save();
			Cache::forget($this->_cacheKey.$id);
			Event::fire(new PasswordRecovered($user));
			return true;
		} else {
			return NULL;
		}
	}

	public function resetPassword($id, $password) {
		$user = $this->user_model->find($id);
		if($user != NULL) {
			$user->password = Hash::make($password);
			$user->recover_password_key = '';
			$user->save();
			Cache::forget($this->_cacheKey.$id);

			return true;
		} else {
			return NULL;
		}

	}

	/**
	 *
	 * This method will update user account info (password)
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function updatePassword($input) {

		// check for user account
		$userAccount = $this->user_model->where('id', '=', $input['id'])->first();

		if ($userAccount != NULL) {

			// check for valid old password
			if (Hash::check($input['old_password'], $userAccount->password)) {
				// update password
				$userAccount->password = Hash::make($input['new_password']);
				if ($userAccount->save()) {
					Cache::forget($this->_cacheKey.$userAccount->id);

					// to maintain log
					try {
						$newParams = array(
									'user_id' 	=> Auth::user()->id,
									'module' 	=> 'user_profile',
									'log_id' 	=> $userAccount->id,
									'log_type' 	=> 'change_password'
								);
						ActivityLogManager::create($newParams);
					} catch(Exception $e){

					}
					return 'success';
				}
			} else {
				return 'invalid_old_password';
			}
		} else {
			return 'not_found';
		}
	}

	/**
	 *
	 * This method will update user account info (personal)
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function updatePersonalInfo($input) {

		// check for user account
		$userAccount = $this->user_model->where('id', '=', $input['id'])->first();

		if ($userAccount != NULL) {

			if (isset($input['name']) && $input['name'] != '') {
				$userAccount->first_name  = $input['name'];
			}
			
			if ($userAccount->save()) {
				Cache::forget($this->_cacheKey.$userAccount->id);
				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'user_profile',
								'log_id' 	=> $userAccount->id,
								'log_type' 	=> 'updated'
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}	
				return 'success';
			}
			
		} else {
			return 'not_found';
		}
	}
}
