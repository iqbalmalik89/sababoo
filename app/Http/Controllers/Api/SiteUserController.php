<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\Repositories\SiteUserRepository;
use Illuminate\Http\Request;

use \Validator, \Session, Carbon\Carbon;;

class SiteUserController extends Controller {

	const PER_PAGE = 10;

    /**
     *
     * This will hold the instance of SiteUserRepository class which is used for
     * fetching, modifying, creating and removing data from database.
     *
     * @var object
     * @access private
     *
     **/
	private $_repository;

	public function __construct() {
		$this->_repository = app()->make('SiteUserRepository');
	}

    /**
     *
     * This method will change user status (active, inactive)
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
        $rules = ['id'      => 'required | exists:users,id',
                  'status'  => 'required |in:enabled,disabled',
                ];

        $messages = [
                'id.required'           => 'Please enter user id.',
                'id.exists'             => 'User not found.',
                'status.required'       => 'Please enter status.',
                'status.in'             => 'Status can only be 0 or 1.'
        ];

        $validator = Validator::make($input,$rules, $messages);

        if($validator->fails()){
            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => [$validator->messages()->first()]]];
        } else {
            $response = $this->_repository->updateStatus($input);
            if ($response) {
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['Status has been updated successfully.']]];
            } else {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occurred while updating status.']]];
            }
        }

        return response()->json($output, $code);
    }

    /**
     *
     * This method will delete an existing user
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function remove(Request $request){

        $input = $request->only('id');

        $rules = ['id' => 'required|exists:users,id'];

        $messages = ['id.required'      => 'Please enter user id.',
                    'id.exists'         => 'User not found.'
                    ];

        $validator = Validator::make($input,$rules,$messages);

        // if validation fails
        if($validator->fails()) {
            $code = 406;
            $output = ['error' => ['code'=>$code,'messages'=>[$validator->messages()->first()]]];
        
        // if validation passes
        } else {
            $response = $this->_repository->deleteById($input['id']);

            if($response == true) {   
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['User has been deleted successfully.']]];
            } else {
                $code = 405;
                $output = ['error' => ['code'=>$code,'messages'=>['An error occured while deleting this user.']]];
            } 
        }
        
        return response()->json($output, $code);
    }

    /**
     *
     * This method will fetch data of individual user
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

        $rules = [
                    'id'=>'required|exists:users,id'
                ];
        $messages = [
                'id.required'   => 'Please enter user id.',
                'id.exists'     => 'User not found.'
                ];

        $validator = Validator::make( $input, $rules, $messages);

        if ($validator->fails()) {
            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => [$validator->messages()->first()]]];
        } else {
            $code = 200;
            $response = $this->_repository->findById($input['id']);

            if ($response == NULL || $response == false) {
                $code = 404;
                $output = ['error' => ['code'=>$code,'messages'=>['User not found.']]];
            } else {
                $output = $response;
            }
        }

        return response()->json($output, $code);
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
    public function all(Request $request) {

        $input = $request->only('pagination','keyword','limit','filter_by_status', 'filter_by_role');

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
