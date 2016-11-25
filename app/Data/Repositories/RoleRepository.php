<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\AdminUser;
use App\Models\Operation;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Facades\Event;

use App\Helpers\Helper;

use \StdClass, Carbon\Carbon;

class RoleRepository {


	public $role_model;
	public $permission_model;
	public $operation_model;
	public $module_model;
	public $admin_user_model;

	protected $_cacheKey = 'role-'; 

	public function __construct(Role $role, Permission $permissionModel, Operation $operationModel, Module $module, AdminUser $adminUser){

		$this->role_model 		= $role;
		$this->permission_model = $permissionModel;
		$this->operation_model 	= $operationModel;
		$this->module_model 	= $module;
		$this->admin_user_model = $adminUser;
	}

	 /**
	 *
	 * This method will fetch data of individual role
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findById($id, $refresh = false , $data = []) { 
		$data = Cache::get($this->_cacheKey.$id);
		if ($data == NULL || $refresh == true) {
			$role = $this->role_model->find($id);
			if ($role != NULL) {
				$data = new StdClass;
				$data->id 			=	$role->id;
				$data->title 		=	$role->name;
				$data->is_active 	=	$role->is_active;
				$data->created_at 	= 	($role->created_at->year == -1)?'0000-00-00 00:00:00':$role->created_at->toFormattedDateString();
				$data->updated_at	=	($role->updated_at->year == -1)?'0000-00-00 00:00:00':$role->updated_at->toFormattedDateString();

				Cache::forever($this->_cacheKey.$id, $data);

			} else {
				return NULL;
			}
		} 
		// to get total associated users
		$associatedUsers 		= $this->admin_user_model->where('role_id', '=', $id)->count();
		$data->total_users 		=	$associatedUsers;
		$roleOperations			= 	$this->permission_model->where('role_id', '=', $data->id)->where('is_allowed', '=', 1)->get();
		$operations = [];
		if(count($roleOperations) > 0){
			foreach ($roleOperations as $key => $roleOperation) {
				$operations[] = $roleOperation->operation_id;
			}
		} 
		$data->operations = $operations; 
		
		return $data;
	}

	/**
	 *
	 * This method will fetch list of all roles
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findByAll($pagination = false, $perPage = 10, array $input = []) {

		$roleIds = $this->role_model;

		if (isset($input['keyword']) && $input['keyword'] != '') {
			$roleIds = $roleIds->where('name','LIKE','%'.$input['keyword'].'%');
		}

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$roleIds = $roleIds->where('is_active','=',$input['filter_by_status']);
		}
		
		if(isset($input['limit']) && $input['limit'] != 0) {
			$perPage = $input['limit'];
		}

		if ($pagination == true) {
			$roleIdsObj = $roleIds->paginate($perPage, ['id']);
			$roles = $roleIdsObj->items();
			
		} else {
			$roles = $roleIds->get(['id']);
		}

		$data = ['data'=>[]];
		$total = count($roles);
		$data['total'] = $total;
		
		if ($total > 0) {
			$i = 0;
			foreach ($roles as $role) {
				$roleData = $this->findById($role->id);
				$data['data'][$i] = $roleData;			
				$i++;
			}
		}

		if ($pagination == true) {
			// call method to paginate records
    		$data = Helper::paginator($data, $roleIdsObj);
		}
		return $data;
	}

	/**
	 *
	 * This method will create a new role
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function create(array $input = []) {
		$role 					= new $this->role_model;
		$role->name 			= $input['title'];

		if($role->save()) {
			// for inserting associated permission
			if (isset($input['operations']) && count($input['operations']) > 0) {
				foreach ($input['operations'] as $key => $operation) {
					$permissionObj = new $this->permission_model;
					$permissionObj->role_id = $role->id;
					$permissionObj->is_allowed = 1;
					$permissionObj->operation_id = $operation;
					$permissionObj->save();
				}
			}
			return true;
		} else {
			return false;
		}

	}

	 /**
	 *
	 * This method will update existing role
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function update(array $input = []) {
		$role = $this->role_model->find($input['id']);
		if ($role != NULL) {
			if (isset($input['title']) && $input['title'] != '') {
				$role->name = $input['title'];
			}
			$role->updated_at = Carbon::now();
			
			if ($role->save()) {

				if (isset($input['operations']) && count($input['operations']) > 0) { 
					foreach ($input['operations'] as $key => $operationId) {

						$checkPermissionExist = $this->permission_model->where('operation_id', '=', $operationId)->where('role_id', '=', $input['id'])->count();

						if ($checkPermissionExist > 0) {
							// permission exist already 
							$this->permission_model->where('operation_id', '=', $operationId)->where('role_id', '=', $input['id'])->update(['updated_at'=>Carbon::now(),'is_allowed'=>1]);

						} else {
							// add new permission 
							$permissionObj 					= new $this->permission_model;
							$permissionObj->role_id 		= $role->id;
							$permissionObj->operation_id 	= $operationId; 
							$permissionObj->is_allowed 		= 1;
							$permissionObj->save();
						}
					}
				}

				// to remove permissions from db
				$dbPermissions = $this->permission_model->where('role_id', '=', $input['id'])->get();
				if (count($dbPermissions) > 0) {
					foreach ($dbPermissions as $key => $dbPermission) {
						if (!in_array($dbPermission->operation_id, $input['operations'])) {
							$this->permission_model->where('operation_id', '=', $dbPermission->operation_id)->where('role_id', '=', $input['id'])->update(['updated_at'=>Carbon::now(),'is_allowed'=>0]);
						}
					}
				}

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
	 * This method will delete an existing role
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function deleteById($id) {

		$role = $this->role_model->find($id);
		if($role != NULL){
			// to check for associated users
			$associatedUsers = $this->admin_user_model->where('role_id', '=', $id)->count();
			if($associatedUsers > 0) {
				return 'cannot_delete';
			} else {
				if ($role->delete()) {
					return 'success';
				} else {
					return 'error';
				}
			}
		} else {
			return 'not_found';
		}
	}

	/**
	 *
	 * This method will fetch All Modules and their operations
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
   	public function fetchAllModules(){
   		$data = ['data'=>[]];
        $modules = $this->module_model->all();
        $moduleArr = [];
        if (count($modules) > 0) {
            $i = 0;
            foreach ($modules as $key => $module) {
                $moduleArr[$i]['id'] = $module->id;
                $moduleArr[$i]['name'] = $module->name;
                $moduleArr[$i]['operations'] = [];
                // to get associated operations of each module
                $operations = $this->operation_model->where('module_id', '=', $module->id)->get();
                if (count($operations) > 0) {
                    $j = 0;
                    foreach ($operations as $key => $operation) {
                        $moduleArr[$i]['operations'][$j]['id'] = $operation->id;
                        $moduleArr[$i]['operations'][$j]['module_id'] = $operation->module_id;
                        $moduleArr[$i]['operations'][$j]['is_applied'] = $operation->is_applied;
                        $moduleArr[$i]['operations'][$j]['name'] = $operation->name;
                        $j++;
                    }
                } 
                $i++; 
            }
            $data['data'] = $moduleArr;
        }

        return $data;
   	}

   	/**
     *
     * This method will change role status (active, inactive)
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateStatus($input) {

		$role = $this->role_model->find($input['id']);

		if ($role != NULL) {
			$role->is_active = $input['status'];			
			$role->updated_at = Carbon::now();
			if ($role->save()) {
				Cache::forget($this->_cacheKey.$input['id']);
				return true;
			}
		}
	}

	public function getRoleOperations($role_id){

        $roleOperations = $this->permission_model->where('role_id', '=', $role_id)->where('is_allowed', '=', 1)->pluck('operation_id')->toArray();
        if (empty($roleOperations)) {
        	$roleOperations = [0];
        }
	    return $roleOperations;
	}
}
