<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Permission;

use App\Http\Controllers\Controller;
use Validator, Input, Redirect,Session;

class ActivityLogController extends Controller {

	const PER_PAGE = 10;

	/**
	 *
	 * This will hold the instance of ActivityLogRepository class which is used for
	 * fetching, modifying, creating and removing data from database.
	 *
	 * @var object
	 * @access private
	 *
	 **/
	private $repository;
	
	public function __construct(){
        $this->repository = app()->make('ActivityLogRepository');
	}

	/**
	 *
	 * This method will list all activity logs
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
	public function all(Request $request) {

		$input = $request->only('pagination','keyword','limit', 'start_date', 'end_date', 'filter_by_module', 'filter_by_user');

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
         
            $output = $this->repository->findByAll($pagination, self::PER_PAGE, $input);
        }
        return response()->json($output, $code);
	}

}	