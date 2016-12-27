<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Data\Repositories\ReportRepository;
use Validator;

class ReportController extends Controller {


	/**
	 *
	 * This will hold the instance of ReportRepository class which is used for
	 * fetching, modifying, creating and removing data from database.
	 *
	 * @var object
	 * @access private
	 *
	 **/
	private $_repository;

	public function __construct() {
		$this->_repository = app()->make('ReportRepository');
	}

	/**
	 *
	 * This method will fetch users report
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra naz
	 *
	 **/
	public function userReport(Request $request) {

		$input = $request->only('start_date','end_date');

		$rules = [];

		$messages = [];

		$validator = Validator::make($input,$rules, $messages);

		if($validator->fails()){
			$code = 406;
			$output = ['error' => ['code' => $code, 'messages' => $validator->messages()->all()]];
		} else {
			$code = 200;
			$output = $this->_repository->userReport($input);
		}

		return response()->json($output, $code);
	}

	/**
	 *
	 * This method will fetch jobs report
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra naz
	 *
	 **/
	public function jobReport(Request $request) {

		$input = $request->only('start_date','end_date');

		$rules = [];

		$messages = [];

		$validator = Validator::make($input,$rules, $messages);

		if($validator->fails()){
			$code = 406;
			$output = ['error' => ['code' => $code, 'messages' => $validator->messages()->all()]];
		} else {
			$code = 200;
			$output = $this->_repository->jobReport($input);
		}

		return response()->json($output, $code);
	}
   
}
