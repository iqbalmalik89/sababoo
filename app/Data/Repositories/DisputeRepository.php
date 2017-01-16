<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use BusinessObject\JobPost;
use BusinessObject\User;
use App\Models\Dispute;
use App\Helpers\Helper;
use App\Helpers\ActivityLogManager;
use \StdClass, Carbon\Carbon, \Session, \Exception;

class DisputeRepository {

	public $job_model;
	public $dispute_model;
	public $user_model;

	protected $_cacheKey = 'dispute-'; 

	public function __construct(JobPost $jobPost,Dispute $dispute, User $user){
		$this->job_model 			= $jobPost;
		$this->dispute_model 		= $dispute;
		$this->user_model 			= $user;

	}

	 /**
	 *
	 * This method will fetch data of individual dispute
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
			$dispute = $this->dispute_model->find($id);
			if ($dispute != NULL) {

				$data 					= new StdClass;
				$data->id 				= $dispute->id;
				$data->user_id 			= $dispute->user_id;
				$data->job_id 			= $dispute->job_id;
				$data->amount 			= $dispute->amount;
				$data->description 		= $dispute->description;
				$data->status			= strtoupper($dispute->status);
				$data->created_at		= date('d M, Y', strtotime($dispute->created_at));
				$data->updated_at		= date('d M, Y', strtotime($dispute->updated_at));

				Cache::forever($this->_cacheKey.$id,$data);			
				
			} else {
				return NULL;
			}
		}
		
		// to get created user name
		$data->created_by_name = '';
		$userData = $this->user_model->find($data->user_id);
		if ($userData != NULL) {
			$data->created_by_name = $userData->first_name.' '.$userData->last_name;
		}

		// to get job name
		$data->job_name = '';
		$jobData = $this->job_model->find($data->job_id);
		if ($jobData != NULL) {
			$data->job_name = $jobData->name;
		}

		return $data;

	}

	/**
	 *
	 * This method will fetch list of all disputes
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function findByAll($pagination = false, $perPage = 10, array $input = []) {

		$start_date = '';
		$end_date = '';
		if (isset($input['start_date']) && $input['start_date'] != '')  {
			$start_date = date('Y-m-d', strtotime($input['start_date']));
		}

		if (isset($input['end_date']) && $input['end_date'] != '')  {
			$end_date = date('Y-m-d', strtotime($input['end_date']));
		} else {
			$end_date = date('Y-m-d');
		}

		$objectIds = $this->dispute_model->orderBy('id', 'DESC');

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$objectIds = $objectIds->where('status','=',$input['filter_by_status']);
		}

		if ($start_date != '') {
			$objectIds = $objectIds->whereIn('payment_id',  function($query) use ($start_date, $end_date)
			 {
			  $query->select('id')
			      ->from(with($this->payment_model)->getTable())
			      ->whereBetween(\DB::raw("date(created_at)"), [$start_date, $end_date]);
			 });
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
     * This method will change dispute status (active, inactive)
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateStatus($input) {

		$dispute = $this->dispute_model->find($input['id']);

		if ($dispute != NULL) {
			$loggedInUserId = Auth::user()->id;

			$dispute->status = $input['status'];
			if ($dispute->save()) {
				Cache::forget($this->_cacheKey.$input['id']);

				// to maintain log
				try {
					$newParams = array(
								'user_id' 	=> Auth::user()->id,
								'module' 	=> 'disputes',
								'log_id' 	=> $dispute->id,
								'log_type' 	=> 'updated_status',
								'text'		=> $dispute->status
							);
					ActivityLogManager::create($newParams);
				} catch(Exception $e){

				}

				$receiver_data = $this->user_model->where('id', '=', $dispute->user_id)->first();
                $sender_data = $this->user_model->where('id', '=', $loggedInUserId)->first();
                $job_data = $this->job_model->where('id', '=', $dispute->job_id)->first();

				$subject = "Sababoo's - Job Dispute Response by " . $sender_data->email;
                $from = "noreply@sababoo.com";

                  $data = [
                     "from"           => $from,
                     "to"             => $receiver_data->email,
                     "subject"        => $subject,
                     "sender_email"   => $sender_data->email,
                     "SERVER_PATH"    => env('URL'),
                     "status"         =>  $dispute->status,
                     "job_name"       =>  $job_data->name

                 ];

                 $mail_response = Helper::sendEmail(
                     $data,
                     ['email_templates/job_dispute_response_html', 'email_templates/job_dispute_response_text']
                 );
               
				return 'success';
			}	
		}
	}

}
