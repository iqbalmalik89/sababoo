<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use BusinessObject\Industry;
use BusinessObject\JobPost;

use App\Helpers\Helper;
use App\Helpers\ActivityLogManager;

use \StdClass, Carbon\Carbon, \Exception;

class NewsRepository {


	public $news_model;
	public $job_model;
	public $industry_model;

	protected $_cacheKey = 'news-'; 

	public function __construct(News $news, Industry $industry, JobPost $job){

		$this->news_model 		= $news;
		$this->job_model 		= $job;
		$this->industry_model 	= $industry;
	}

	 /**
	 *
	 * This method will fetch data of individual news
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
			$news = $this->news_model->find($id);
			if ($news != NULL) {
				$data = new StdClass;
				$data->id 			=	$news->id;
				$data->industry_id 	=	$news->industry_id;
				$data->title 		=	$news->title;
				$data->description 	=	$news->description;
				$data->is_active 	=	$news->is_active;
				$data->created_at 	= 	date('d M, Y', strtotime($news->created_at));
				$data->updated_at	=	date('d M, Y', strtotime($news->updated_at));

				Cache::forever($this->_cacheKey.$id, $data);

			} else {
				return NULL;
			}
		} 
		// to get total associated jobs
		$associatedJobs 		= $this->job_model->where('industry_id', '=', $data->industry_id)->count();
		$data->total_jobs 		=	$associatedJobs;
		
		// to get industry name
		$industryData = $this->industry_model->find($data->industry_id);
		$industryName = '';
		if ($industryData != NULL) {
			$industryName = $industryData->name;
		}
		
		$data->industry_name = $industryName;
		return $data;
	}

	/**
	 *
	 * This method will fetch list of all news
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findByAll($pagination = false, $perPage = 10, array $input = []) {

		$newsIds = $this->news_model;

		if (isset($input['keyword']) && $input['keyword'] != '') {
			$newsIds = $newsIds->where('title','LIKE','%'.$input['keyword'].'%');
		}

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$newsIds = $newsIds->where('is_active','=',$input['filter_by_status']);
		}

		if (isset($input['filter_by_industry']) && $input['filter_by_industry'] != 0) {
			$newsIds = $newsIds->where('industry_id','=',$input['filter_by_industry']);
		}
		
		if(isset($input['limit']) && $input['limit'] != 0) {
			$perPage = $input['limit'];
		}

		if ($pagination == true) {
			$newsIdsObj = $newsIds->paginate($perPage, ['id']);
			$newses = $newsIdsObj->items();
			
		} else {
			$newses = $newsIds->get(['id']);
		}

		$data = ['data'=>[]];
		$total = count($newses);
		$data['total'] = $total;
		
		if ($total > 0) {
			$i = 0;
			foreach ($newses as $news) {
				$newsData = $this->findById($news->id);
				$data['data'][$i] = $newsData;			
				$i++;
			}
		}

		if ($pagination == true) {
			// call method to paginate records
    		$data = Helper::paginator($data, $newsIdsObj);
		}
		return $data;
	}

	/**
	 *
	 * This method will create a new news
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function create(array $input = []) {
		$news 						= new $this->news_model;
		$news->industry_id 			= $input['industry_id'];
		$news->title 				= $input['title'];
		$news->description 			= $input['description'];

		if($news->save()) {
			// to maintain log
			try {
				$newParams = array(
							'user_id' 	=> Auth::user()->id,
							'module' 	=> 'news',
							'log_id' 	=> $news->id,
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
	 * This method will update existing news
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function update(array $input = []) {
		$news = $this->news_model->find($input['id']);
		if ($news != NULL) {
			if (isset($input['title']) && $input['title'] != '') {
				$news->title = $input['title'];
			}
			if (isset($input['industry_id']) && $input['industry_id'] != 0) {
				$news->industry_id = $input['industry_id'];
			}
			if (isset($input['description']) && $input['description'] != '') {
				$news->description = $input['description'];
			}
			$news->updated_at = Carbon::now();
			
			if ($news->save()) {

				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'news',
								'log_id' 	=> $news->id,
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
	 * This method will delete an existing news
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function deleteById($id) {

		$news = $this->news_model->find($id);
		if($news != NULL){
			// to check for associated jobs
			$associatedJobs = $this->job_model->where('industry_id', '=', $id)->count();
			if($associatedJobs > 0) {
				return 'cannot_delete';
			} else {
				if ($news->delete()) {

					// to maintain log
					try {
						$newParams = array(
									'user_id' 	=> Auth::user()->id,
									'module' 	=> 'news',
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
     * This method will change news status (active, inactive)
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateStatus($input) {

		$news = $this->news_model->find($input['id']);

		if ($news != NULL) {
			$news->is_active = $input['status'];	

			if ($news->is_active == 0) {
				// to check for associated jobs
				$associatedJobs = $this->job_model->where('industry_id', '=', $input['id'])->count();
				if($associatedJobs > 0) {
					return 'cannot_inactivate';
				} 
			}
			
			$news->updated_at = Carbon::now();
			if ($news->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'news',
								'log_id' 	=> $news->id,
								'log_type' 	=> 'updated_status',
								'text'		=> ($news->is_active == 1)?'activated':'deactivated'
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}

				return 'success';
			}
		}
	}
}
