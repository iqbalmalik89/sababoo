<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

use App\Helpers\Helper;
use App\Helpers\ActivityLogManager;
use \StdClass, Carbon\Carbon, \Session;

class CompanyRepository {

	public $company_model;

	protected $_cacheKey = 'company-'; 

	public function __construct(Company $company){
		$this->company_model 	= $company;
	}

	 /**
	 *
	 * This method will fetch data of individual company
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
			$company = $this->company_model->find($id);
			if ($company != NULL) {

				$data 						= new StdClass;
				$data->id 					= $company->id;
				$data->name 				= $company->name;
				$data->image 				= $company->image;
				$data->url 					= $company->url;
				$data->is_active 			= $company->is_active;
				$data->created_at			= date('d M, Y', strtotime($company->created_at));
				$data->updated_at			= date('d M, Y', strtotime($company->updated_at));

				Cache::forever($this->_cacheKey.$id,$data);			
				
			} else {
				$data = NULL;
			}
		}

		return $data;

	}


	/**
	 *
	 * This method will fetch list of all companys
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findByAll($pagination = false, $perPage = 10, array $input = []) {

		$companyIds = $this->company_model->orderBy('id', 'DESC');

		if (isset($input['keyword']) && $input['keyword'] != '') {
			$companyIds = $companyIds->where('name','LIKE','%'.$input['keyword'].'%');
		}

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$companyIds = $companyIds->where('is_active','=',$input['filter_by_status']);
		}
		
		if(isset($input['limit']) && $input['limit'] != 0) {
			$perPage = $input['limit'];
		}

		if ($pagination == true) {
			$companyIdsObj = $companyIds->paginate($perPage, ['id']);
			$industries = $companyIdsObj->items();
			
		} else {
			$industries = $companyIds->get(['id']);
		}

		$data = ['data'=>[]];
		$total = count($industries);
		$data['total'] = $total;
		
		if ($total > 0) {
			$i = 0;
			foreach ($industries as $industry) {
				$companyData = $this->findById($industry->id);
				$data['data'][$i] = $companyData;			
				$i++;
			}
		}

		if ($pagination == true) {
			// call method to paginate records
    		$data = Helper::paginator($data, $companyIdsObj);
		}
		return $data;
	}

	/**
	 *
	 * This method will create a new company
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function create(array $input = []) {
		$company 					= new $this->company_model;

		if (isset($input['name']) && $input['name'] != '') {
			$company->name 			= $input['name'];
		} else {
			$company->name 			= '';
		}
		
		$company->image 			= $input['image'];

		if (isset($input['url']) && $input['url'] != '') {
			$company->url 			= $input['url'];
		} else {
			$company->url 			= '';
		}

		if($company->save()) {

			// to maintain log
			try {
				$newParams = array(
							'user_id' 	=> Auth::user()->id,
							'module' 	=> 'company',
							'log_id' 	=> $company->id,
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
	 * This method will update existing company
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function update(array $input = []) {
		$company = $this->company_model->find($input['id']);
		if ($company != NULL) {
			if (isset($input['name']) && $input['name'] != '') {
				$company->name = $input['name'];
			}

			if (isset($input['image']) && $input['image'] != '') {
				$company->image = $input['image'];
			}

			if (isset($input['url']) && $input['url'] != '') {
				$company->url = $input['url'];
			}
			
			if ($company->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'company',
								'log_id' 	=> $company->id,
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
	 * This method will delete an existing company
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function deleteById($id) {

		$company = $this->company_model->find($id);
		if($company != NULL){
		
			if ($company->delete()) {
				Cache::forget($this->_cacheKey.$id);
				return 'success';
			} else {
				return 'error';
			}
			
		} else {
			return 'not_found';
		}
	}

   	/**
     *
     * This method will change company status (active, inactive)
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateStatus($input) {

		$company = $this->company_model->find($input['id']);

		if ($company != NULL) {
			$company->is_active = $input['status'];	
			
			if ($company->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'company',
								'log_id' 	=> $company->id,
								'log_type' 	=> 'updated_status',
								'text'		=> ($company->is_active == '1')?'activated':'deactivated'
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}


				return 'success';
			}
		}
	}
}
