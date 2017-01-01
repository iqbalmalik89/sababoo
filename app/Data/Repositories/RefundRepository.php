<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use BusinessObject\JobPost;
use BusinessObject\User;
use App\Models\Refund;
use App\Models\Payment;
use App\Helpers\Helper;
use App\Helpers\ActivityLogManager;
use \StdClass, Carbon\Carbon, \Session, \Exception;

class RefundRepository {

	public $job_model;
	public $refund_model;
	public $user_model;
	public $payment_model;

	protected $_cacheKey = 'refund-'; 

	public function __construct(JobPost $jobPost,Refund $refund, User $user, Payment $payment){
		$this->job_model 			= $jobPost;
		$this->refund_model 		= $refund;
		$this->user_model 			= $user;
		$this->payment_model 		= $payment;

	}

	 /**
	 *
	 * This method will fetch data of individual refund
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
			$refund = $this->refund_model->find($id);
			if ($refund != NULL) {

				$data 					= new StdClass;
				$data->id 				= $refund->id;
				$data->payment_id 		= $refund->payment_id;
				$data->job_id 			= $refund->job_id;
				$data->requested_by 	= $refund->requested_by;
				$data->amount 			= $refund->amount;
				$data->reason 			= $refund->reason;
				$data->status			= strtoupper($refund->status);
				$data->created_at		= date('d M, Y', strtotime($refund->created_at));

				Cache::forever($this->_cacheKey.$id,$data);			
				
			} else {
				return NULL;
			}
		}

		// to get payment details
		$data->payment = new StdClass;
		$paymentData = $this->payment_model->find($data->payment_id);
		if ($paymentData != NULL) {
			$data->payment = $paymentData;
		}
		
		// to get requested user name
		$data->requested_by_name = '';
		$userData = $this->user_model->find($data->requested_by);
		if ($userData != NULL) {
			$data->requested_by_name = $userData->first_name.' '.$userData->last_name;
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

		$objectIds = $this->refund_model;

		if (isset($input['filter_by_status']) && $input['filter_by_status'] != '') {
			$objectIds = $objectIds->where('status','=',$input['filter_by_status']);
		}

		if ($start_date != '') {
			$objectIds = $objectIds->whereIn('payment_id',  function($query) use ($start_date, $end_date)
			 {
			  $query->select('id')
			      ->from(with($this->payment_model)->getTable())
			      ->whereBetween(\DB::raw("date(createdtime)"), [$start_date, $end_date]);
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

		$refund = $this->refund_model->find($input['id']);

		if ($refund != NULL) {

			$paymentInfo = $this->payment_model->find($refund->payment_id);

			if ($paymentInfo != NULL) {
				$loggedInUserId = Auth::user()->id;

				$refund->status = $input['status'];
				if ($refund->save()) {
					Cache::forget($this->_cacheKey.$input['id']);

					// to maintain log
					try {
						$newParams = array(
									'user_id' 	=> Auth::user()->id,
									'module' 	=> 'refunds',
									'log_id' 	=> $refund->id,
									'log_type' 	=> 'updated_status',
									'text'		=> $refund->status
								);
						ActivityLogManager::create($newParams);
					} catch(Exception $e){

					}

					$receiver_data = $this->user_model->where('id', '=', $refund->requested_by)->first();
	                $sender_data = $this->user_model->where('id', '=', $loggedInUserId)->first();
	                $job_data = $this->job_model->where('id', '=', $refund->job_id)->first();

					$subject = "Sababoo's - Refund request Response by " . $sender_data->email;
	                $from = "noreply@sababoo.com";

	                  $data = [
	                     "from"           => $from,
	                     "to"             => $receiver_data->email,
	                     "subject"        => $subject,
	                     "sender_email"   => $sender_data->email,
	                     "SERVER_PATH"    => env('URL'),
	                     "status"         =>  $refund->status,
	                     "job_name"       =>  $job_data->name

	                 ];

	                 $mail_response = Helper::sendEmail(
	                     $data,
	                     ['email_templates/job_refund_response_html', 'email_templates/job_refund_response_text']
	                 );
	               
					return 'success';
				}

			} else {
				return 'not_found';
			}
			
		}
	}

}
