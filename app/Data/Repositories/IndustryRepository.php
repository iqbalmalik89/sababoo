<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use BusinessObject\Industry;
use BusinessObject\User;
use Illuminate\Support\Facades\Event;

use App\Helpers\Helper;
use App\Helpers\ActivityLogManager;
use \StdClass, Carbon\Carbon, \Exception;

class IndustryRepository {


	public $industry_model;
	public $user_model;

	protected $_cacheKey = 'industry-'; 

	public function __construct(Industry $industry, User $user){

		$this->industry_model 	= $industry;
		$this->user_model 		= $user;
	}

	 /**
	 *
	 * This method will fetch data of individual industry
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
			$industry = $this->industry_model->find($id);
			if ($industry != NULL) {
				$data = new StdClass;
				$data->id 			=	$industry->id;
				$data->name 		=	$industry->name;
				$data->status 		=	$industry->status;

				Cache::forever($this->_cacheKey.$id, $data);

			} else {
				return NULL;
			}
		} 
		// to get total associated users
		$associatedUsers 		= $this->user_model->where('industry_id', '=', $id)->count();
		$data->total_users 		=	$associatedUsers;
		
		return $data;
	}

	/**
	 *
	 * This method will fetch list of all industries
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findByAll($pagination = false, $perPage = 10, array $input = []) {

		$industryIds = $this->industry_model->where('status', '!=', 3);

		if (isset($input['keyword']) && $input['keyword'] != '') {
			$industryIds = $industryIds->where('name','LIKE','%'.$input['keyword'].'%');
		}

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$industryIds = $industryIds->where('status','=',$input['filter_by_status']);
		}
		
		if(isset($input['limit']) && $input['limit'] != 0) {
			$perPage = $input['limit'];
		}

		if ($pagination == true) {
			$industryIdsObj = $industryIds->paginate($perPage, ['id']);
			$industries = $industryIdsObj->items();
			
		} else {
			$industries = $industryIds->get(['id']);
		}

		$data = ['data'=>[]];
		$total = count($industries);
		$data['total'] = $total;
		
		if ($total > 0) {
			$i = 0;
			foreach ($industries as $industry) {
				$industryData = $this->findById($industry->id);
				$data['data'][$i] = $industryData;			
				$i++;
			}
		}

		if ($pagination == true) {
			// call method to paginate records
    		$data = Helper::paginator($data, $industryIdsObj);
		}
		return $data;
	}

	/**
	 *
	 * This method will create a new industry
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function create(array $input = []) {
		$industry 					= new $this->industry_model;
		$industry->name 			= $input['name'];

		if($industry->save()) {
			
			// to maintain log
			try {
				$newParams = array(
							'user_id' 	=> Auth::user()->id,
							'module' 	=> 'industries',
							'log_id' 	=> $industry->id,
							'log_type' 	=> 'created'
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
	 * This method will update existing industry
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function update(array $input = []) {
		$industry = $this->industry_model->find($input['id']);
		if ($industry != NULL) {
			if (isset($input['name']) && $input['name'] != '') {
				$industry->name = $input['name'];
		}
			
			if ($industry->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'industries',
								'log_id' 	=> $industry->id,
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
	 * This method will delete an existing industry
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function deleteById($id) {

		$industry = $this->industry_model->find($id);
		if($industry != NULL){
			// to check for associated users
			$associatedUsers = $this->user_model->where('industry_id', '=', $id)->count();
			if($associatedUsers > 0) {
				return 'cannot_delete';
			} else {
				$industry->status = 3;
				if ($industry->save()) {
					Cache::forget($this->_cacheKey.$id);
					// to maintain log
					try {
						$newParams = array(
									'user_id' 	=> Auth::user()->id,
									'module' 	=> 'industries',
									'log_id' 	=> $industry->id,
									'log_type' 	=> 'deleted'
								);
						ActivityLogManager::create($newParams);
					} catch(Exception $e){

					}
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
     * This method will change industry status (active, inactive)
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateStatus($input) {

		$industry = $this->industry_model->find($input['id']);

		if ($industry != NULL) {
			$industry->status = $input['status'];	

			if ($industry->status == '2') {
				// to check for associated users
				$associatedUsers = $this->user_model->where('industry_id', '=', $input['id'])->count();
				if($associatedUsers > 0) {
					return 'cannot_inactivate';
				} 
			}
			
			if ($industry->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'industries',
								'log_id' 	=> $industry->id,
								'log_type' 	=> 'updated_status',
								'text'		=> ($industry->status == '1')?'activated':'deactivated'
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}

				return 'success';
			}
		}
	}
}
