<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminUser;
use App\Models\Role;
use App\Helpers\Helper;
use App\Events\Activation;
use App\Events\PasswordRecovered;

use \StdClass, Carbon\Carbon, \Session;

class UserRepository {

	public $user_model;
	public $role_model;

	protected $_cacheKey = 'admin-user-'; 

	public function __construct(AdminUser $adminUser, Role $role){
		$this->user_model 	= $adminUser;
		$this->role_model 	= $role;
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
	public function findById($id, $refresh = false) {

		$data = Cache::get($this->_cacheKey.$id);

		if ($data == NULL || $refresh == true) {
			$user = $this->user_model->find($id);
			if ($user != NULL) {

				$data 						= new StdClass;
				$data->id 					= $user->id;
				$data->name 				= $user->name;
				$data->email 				= $user->email;
				$data->password 			= $user->password;
				$data->is_admin 			= $user->is_admin;
				$data->role_id 				= $user->role_id;
				$data->is_active 			= $user->is_active;
				$data->activation_key		= $user->activation_key;
				$data->activated_on			= $user->activated_on;
				$data->recover_password_key = $user->recover_password_key;
				$data->last_logged_in		= $user->last_logged_in;
				$data->attempts				= $user->attempts;
				$data->created_at			= ($user->created_at->year == -1)?'0000-00-00 00:00:00':$user->created_at->toDateTimeString();
				$data->updated_at			= ($user->updated_at->year == -1)?'0000-00-00 00:00:00':$user->updated_at->toDateTimeString();

				Cache::forever($this->_cacheKey.$id,$data);			
				
			} else {
				return NULL;
			}
		}

		// to get role title
		$data->role_title = '';
		$role = $this->role_model->find($data->role_id);
		if ($role != NULL) {
			$data->role_title = $role->name;
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
		$objectIds = $this->user_model->where('is_admin', '=', 1);
				
		if (isset($input['keyword']) && $input['keyword'] != '') {
			$objectIds = $objectIds->where('name','LIKE','%'.$input['keyword'].'%');
		}

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$objectIds = $objectIds->where('is_active','=',$input['filter_by_status']);
		}

		if (isset($input['filter_by_role']) && $input['filter_by_role'] != 0) {
			$objectIds = $objectIds->where('role_id','=',$input['filter_by_role']);
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
		$user->name 			= $input['name']; 
		$user->email  			= $input['email'];
		$user->role_id  		= $input['role_id'];
		$user->is_active   		= 1;
		$user->is_admin   		= 1;
		$user->activation_key 	= Hash::make(time());
		if($user->save()) {	
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
				$user->name = $input['name'];
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
			$user->delete();
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
			$user->is_active = $input['status'];

			if ($user->is_active == 1) {
				$user->status = 1;
			} else {
				$user->status = 2;
			}
			
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

				if ($userExists->activated_on != NULL) {
					// check if active or inactive
					if ($userExists->is_active == 1) {

						// validate User
						if(Hash::check($input['password'],$userExists->password)) {
							$user = $this->user_model->find($userExists->id);
							unset($user->password);

							$output['user_id'] 	= $user->id;
							$output['is_admin'] = $user->is_admin;
							$output['user'] 	= $user;

							//Auth::loginUsingId($user->id, true);

							//Session::put('sa_user', $user);
							if (Auth::guard('admin_users')->attempt($input, false)) {
         
					            $auth = true;
					            $user = Auth::guard('admin_users')->user();
					            $user->save();

            					Auth::logout();
						    }

							/*$response = Auth::attempt($input);
							if ($response) {
								Auth::login(Auth::user(), true);
							}*/
							
							$this->user_model->where('id', '=', $user->id)->update(['last_logged_in'=> Carbon::now()]);

							Cache::forget($this->_cacheKey.$user->id);

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
			$user->activated_on = Carbon::now();
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
				$userAccount->name  = $input['name'];
			}
			
			if ($userAccount->save()) {
				Cache::forget($this->_cacheKey.$userAccount->id);
				return 'success';
			}
			
		} else {
			return 'not_found';
		}
	}
}
