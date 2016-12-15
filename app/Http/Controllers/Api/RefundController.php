<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Data\Models\Refund;
use App\Data\Repositories\RefundRepository;
use Illuminate\Http\Request;

use \Validator, \Session, Carbon\Carbon;;

class RefundController extends Controller {

	const PER_PAGE = 10;

    /**
     *
     * This will hold the instance of RefundRepository class which is used for
     * fetching, modifying, creating and removing data from database.
     *
     * @var object
     * @access private
     *
     **/
	private $_repository;

	public function __construct() {
		$this->_repository = app()->make('RefundRepository');
	}


    /**
     *
     * This method will change refund status
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function updateStatus(Request $request) {

        // input parameters
        $input = $request->only('id', 'status');

        // define validation rules
        $rules = ['id'      => 'required | exists:refunds,id',
                  'status'  => 'required |in:approved,rejected',
                ];

        $messages = [
                'id.required'           => 'Please enter id.',
                'id.exists'             => 'Request not found.',
                'status.required'       => 'Please enter status.',
                'status.in'             => 'Status can only be approved or rejected.'
        ];

        $validator = Validator::make($input,$rules, $messages);

        if($validator->fails()){
            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => [$validator->messages()->first()]]];
        } else {
            $response = $this->_repository->updateStatus($input);
            if ($response == 'success') {
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['Status has been updated successfully.']]];
            } else if ($response == 'not_found'){
                $code = 404;
                $output = ['error'=>['code'=>$code,'messages'=>['Payment not found.']]];
            } else {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occurred while updating status.']]];
            }
        }

        return response()->json($output, $code);
    }

    /**
     *
     * This method will fetch list of all refunds
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function all(Request $request) {

        $input = $request->only('pagination','keyword','limit','filter_by_status', 'start_date', 'end_date');

        $rules = ['pagination' => 'required'];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);

        // if validation fails
        if($validator->fails()) {
            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => [$validator->messages()->first()]]];

        // if validation passes
        } else {
            $code = 200;
            $pagination = false;
            if($input['pagination']) {
                $pagination = true;
            }

            $output = $this->_repository->findByAll($pagination, self::PER_PAGE, $input);
        }
        return response()->json($output, $code);
    }    

}
