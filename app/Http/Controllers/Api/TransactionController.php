<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Payment;
use BusinessObject\User;
use App\Data\Repositories\TransactionRepository;

use App\Http\Controllers\Controller;
use Validator, Input, Redirect,Session, App;

class TransactionController extends Controller {
    const PER_PAGE = 10;

    /**
	 *
	 * This will hold the instance of TransactionRepository class which is used for
	 * fetching, modifying, creating and removing data from database.
	 *
	 * @var object
	 * @access private
	 *
	 **/
    private $_repository;

    public function __construct() {
        $this->_repository = app()->make('TransactionRepository');
    }

    /**
	 *
	 * This method will fetch data of individual transaction
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
   	public function view(Request $request){

        $input = $request->only('id');
        $rules = ['id'=>'required|exists:payments,id'
                	];

        $messages = ['id.required' => 'Please enter payment id',
                    'id.exists' => 'Transaction not found'
        			];

        $validator = Validator::make( $input, $rules, $messages);

        if ($validator->fails()) {
            $code = 406;
            $output = ['error'=>['code'=>$code,'messages'=>$validator->messages()->all()]];
        } else{
            $code = 200;
            $output = $this->_repository->findById($input['id']);
        }
        return response()->json($output, $code);
   	}

   	/**
	 *
	 * This method will fetch list of all transactions
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
   	public function all(Request $request) {
  
        $input = $request->only('pagination','keyword','limit', 'start_date', 'end_date');
        $rules = [];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);

        // if validation fails
        if($validator->fails()) {
            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => $validator->messages()->all()]];
        
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
