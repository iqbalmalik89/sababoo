<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use BusinessObject\Skill;
use BusinessObject\UserSkill;
use Illuminate\Support\Facades\Event;

use App\Helpers\Helper;
use App\Helpers\ActivityLogManager;
use \StdClass, Carbon\Carbon, \Exception;

class SkillsRepository {


	public $skills_model;
	public $user_skills_model;

	protected $_cacheKey = 'skill-'; 

	public function __construct(Skill $skill, UserSkill $userSkill){

		$this->skills_model 	= $skill;
		$this->user_skills_model = $userSkill;
	}

	 /**
	 *
	 * This method will fetch data of individual skill
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
			$skill = $this->skills_model->find($id);
			if ($skill != NULL) {
				$data = new StdClass;
				$data->id 			=	$skill->id;
				$data->skill 		=	$skill->skill;
				$data->status 		=	$skill->status;

				Cache::forever($this->_cacheKey.$id, $data);

			} else {
				return NULL;
			}
		} 
		// to get total associated users
		$associatedUsers 		= $this->user_skills_model->where('skill_id', '=', $id)->count();
		$data->total_users 		=	$associatedUsers;
		
		return $data;
	}

	/**
	 *
	 * This method will fetch list of all skills
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findByAll($pagination = false, $perPage = 10, array $input = []) {

		$skillIds = $this->skills_model->where('status', '!=', 'delete');

		if (isset($input['keyword']) && $input['keyword'] != '') {
			$skillIds = $skillIds->where('skill','LIKE','%'.$input['keyword'].'%');
		}

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$skillIds = $skillIds->where('status','=',$input['filter_by_status']);
		}
		
		if(isset($input['limit']) && $input['limit'] != 0) {
			$perPage = $input['limit'];
		}

		if ($pagination == true) {
			$skillIdsObj = $skillIds->paginate($perPage, ['id']);
			$skills = $skillIdsObj->items();
			
		} else {
			$skills = $skillIds->get(['id']);
		}

		$data = ['data'=>[]];
		$total = count($skills);
		$data['total'] = $total;
		
		if ($total > 0) {
			$i = 0;
			foreach ($skills as $skill) {
				$skillData = $this->findById($skill->id);
				$data['data'][$i] = $skillData;			
				$i++;
			}
		}

		if ($pagination == true) {
			// call method to paginate records
    		$data = Helper::paginator($data, $skillIdsObj);
		}
		return $data;
	}

	/**
	 *
	 * This method will create a new skill
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function create(array $input = []) {
		$skill 					= new $this->skills_model;
		$skill->skill 			= $input['title'];

		if($skill->save()) {
			
			// to maintain log
			try {
				$newParams = array(
							'user_id' 	=> Auth::user()->id,
							'module' 	=> 'skills',
							'log_id' 	=> $skill->id,
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
	 * This method will update existing skill
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function update(array $input = []) {
		$skill = $this->skills_model->find($input['id']);
		if ($skill != NULL) {
			if (isset($input['title']) && $input['title'] != '') {
				$skill->skill = $input['title'];
		}
			
			if ($skill->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'skills',
								'log_id' 	=> $skill->id,
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
	 * This method will delete an existing skill
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function deleteById($id) {

		$skill = $this->skills_model->find($id);
		if($skill != NULL){
			// to check for associated users
			$associatedUsers = $this->user_skills_model->where('skill_id', '=', $id)->count();
			if($associatedUsers > 0) {
				return 'cannot_delete';
			} else {
				$skill->status = 'delete';
				if ($skill->save()) {
					Cache::forget($this->_cacheKey.$id);
					// to maintain log
					try {
						$newParams = array(
									'user_id' 	=> Auth::user()->id,
									'module' 	=> 'skills',
									'log_id' 	=> $id,
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
     * This method will change skill status (active, inactive)
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateStatus($input) {

		$skill = $this->skills_model->find($input['id']);

		if ($skill != NULL) {
			$skill->status = $input['status'];	

			if ($skill->status == 'disable') {
				// to check for associated users
				$associatedUsers = $this->user_skills_model->where('skill_id', '=', $input['id'])->count();
				if($associatedUsers > 0) {
					return 'cannot_inactivate';
				} 
			}
			
			if ($skill->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'skills',
								'log_id' 	=> $skill->id,
								'log_type' 	=> 'updated_status',
								'text'		=> ($skill->status == 'enable')?'activated':'deactivated'
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}
				return 'success';
			}
		}
	}
}
