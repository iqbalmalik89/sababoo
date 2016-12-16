<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Data\Models\Job;
use App\Data\Repositories\JobRepository;
use Illuminate\Http\Request;

use \Validator, \Session, Carbon\Carbon;;

class JobController extends Controller {

	const PER_PAGE = 10;

    /**
     *
     * This will hold the instance of JobRepository class which is used for
     * fetching, modifying, creating and removing data from database.
     *
     * @var object
     * @access private
     *
     **/
	private $_repository;

	public function __construct() {
		$this->_repository = app()->make('JobRepository');
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
    public function updateStatus(Request $request) {

        // input parameters
        $input = $request->only('id', 'status');

        // define validation rules
        $rules = ['id'      => 'required | exists:job_post,id',
                  'status'  => 'required |in:1,0',
                ];

        $messages = [
                'id.required'           => 'Please enter job id.',
                'id.exists'             => 'Job not found.',
                'status.required'       => 'Please enter status.',
                'status.in'             => 'Status can only be 0 or 1.'
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
            } else if ($response == 'cannot_inactivate') {
                $code = 401;
                $output = ['error' => ['code'=>$code,'messages'=>['Sorry you cannot de-activate this job.']]];
            } else {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occurred while updating status.']]];
            }
        }

        return response()->json($output, $code);
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
    public function updateJobStatus(Request $request) {

        // input parameters
        $input = $request->only('id', 'status');

        // define validation rules
        $rules = ['id'      => 'required | exists:job_post,id',
                  'status'  => 'required |in:in-progress,completed',
                ];

        $messages = [
                'id.required'           => 'Please enter job id.',
                'id.exists'             => 'Job not found.',
                'status.required'       => 'Please enter status.',
                'status.in'             => 'Status can only be in-progress or completed.'
        ];

        $validator = Validator::make($input,$rules, $messages);

        if($validator->fails()){
            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => [$validator->messages()->first()]]];
        } else {
            $response = $this->_repository->updateJobStatus($input);
            if ($response == 'success') {
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['Job status has been updated successfully.']]];
            } else {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occurred while updating job status.']]];
            }
        }

        return response()->json($output, $code);
    }

    /**
     *
     * This method will delete an existing job
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

        $rules = ['id' => 'required|exists:job_post,id'];

        $messages = ['id.required'      => 'Please enter job id.',
                    'id.exists'         => 'Job not found.'
                    ];

        $validator = Validator::make($input,$rules,$messages);

        // if validation fails
        if($validator->fails()) {
            $code = 406;
            $output = ['error' => ['code'=>$code,'messages'=>[$validator->messages()->first()]]];
        
        // if validation passes
        } else {
            $response = $this->_repository->deleteById($input['id']);

            if($response == 'success') {   
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['Job has been deleted successfully.']]];
            }  else if ($response == 'cannot_delete') {
                $code = 401;
                $output = ['error' => ['code'=>$code,'messages'=>['Sorry you cannot remove this job.']]];
            } else {
                $code = 405;
                $output = ['error' => ['code'=>$code,'messages'=>['An error occured while deleting this job.']]];
            } 
        }
        
        return response()->json($output, $code);
    }

    /**
     *
     * This method will fetch data of individual job
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
                    'id'=>'required|exists:job_post,id'
                ];
        $messages = [
                'id.required'   => 'Please enter job id.',
                'id.exists'     => 'Job not found.'
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
                $output = ['error' => ['code'=>$code,'messages'=>['Job not found.']]];
            } else {
                $output = $response;
            }
        }

        return response()->json($output, $code);
    }

    /**
     *
     * This method will fetch list of all jobs
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function all(Request $request) {

        $input = $request->only('pagination','keyword','limit','filter_by_status', 'filter_by_job_status');

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
