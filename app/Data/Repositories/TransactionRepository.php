<?php
namespace App\Data\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use BusinessObject\User;
use BusinessObject\JobPost;
use Illuminate\Support\Facades\Event;

use App\Helpers\Helper;

use \StdClass, Carbon\Carbon;

class TransactionRepository {


	public $payment_model;
	public $user_model;
	public $job_model;

	protected $_cacheKey = 'payment-'; 

	public function __construct(Payment $payment, User $user, JobPost $jobPost){

		$this->payment_model 	= $payment;
		$this->user_model 		= $user;
		$this->job_model 		= $jobPost;
	}

	 /**
	 *
	 * This method will fetch data of individual payment
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
			$payment = $this->payment_model->find($id);
			if ($payment != NULL) {
				$data = new StdClass;
				$data->id 					=	$payment->id;
				$data->payment_id 			=	$payment->payment_id;
				$data->payment_amount 		=	$payment->payment_amount;
				$data->payment_status 		=	$payment->payment_status;
				$data->job_id 				=	$payment->job_id;
				$data->payer_id 			=	$payment->payer_id;
				$data->user_id 				=	$payment->user_id;
				$data->createdtime 			=	date('d M, Y', strtotime($payment->createdtime));

				Cache::forever($this->_cacheKey.$id, $data);

			} else {
				return NULL;
			}
		} 

		// to get job details
		$jobData 		= $this->job_model->find($data->job_id);
		$data->job_name 		=	'';
		if ($jobData != NULL) {
			$data->job_name = $jobData->name;
		}

		// to get payer details
		$payerData 		= $this->user_model->find($data->user_id);
		$data->payer_name 		=	'';
		if ($payerData != NULL) {
			$data->payer_name = $payerData->first_name.' '.$payerData->last_name;
		}
		return $data;
	}

	/**
	 *
	 * This method will fetch list of all payments
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
		$paymentIds = $this->payment_model;

		if (isset($input['keyword']) && $input['keyword'] != '') {
			$paymentIds = $paymentIds->whereIn('user_id',  function($query) use ($input)
			 {
			  $query->select('id')
			      ->from(with($this->user_model)->getTable())
			      ->where('first_name','LIKE','%'.$input['keyword'].'%')
			      ->orwhere('last_name','LIKE','%'.$input['keyword'].'%')
			      ->orwhere('email','LIKE','%'.$input['keyword'].'%');

			 });
		}

		if ($start_date != '') {
			$paymentIds = $paymentIds->whereBetween(\DB::raw("date(createdtime)"), [$start_date, $end_date]);
		}
		
		if(isset($input['limit']) && $input['limit'] != 0) {
			$perPage = $input['limit'];
		}

		if ($pagination == true) {
			$paymentIdsObj = $paymentIds->paginate($perPage, ['id']);
			$payments = $paymentIdsObj->items();
			
		} else {
			$payments = $paymentIds->get(['id']);
		}

		$data = ['data'=>[]];
		$total = count($payments);
		$data['total'] = $total;
		
		if ($total > 0) {
			$i = 0;
			foreach ($payments as $payment) {
				$paymentData = $this->findById($payment->id);
				$data['data'][$i] = $paymentData;			
				$i++;
			}
		}

		if ($pagination == true) {
			// call method to paginate records
    		$data = Helper::paginator($data, $paymentIdsObj);
		}
		return $data;
	}
}
