<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use BusinessObject\Skill;
use App\Data\Repositories\SkillsRepository;

use App\Http\Controllers\Controller;
use Validator, Input, Redirect,Session, App;

class SkillsController extends Controller {
    const PER_PAGE = 10;

    /**
	 *
	 * This will hold the instance of SkillsRepository class which is used for
	 * fetching, modifying, creating and removing data from database.
	 *
	 * @var object
	 * @access private
	 *
	 **/
    private $_repository;

    public function __construct() {
        $this->_repository = app()->make('SkillsRepository');
    }

    /**
	 *
	 * This method will create a new skill
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
    public function create(Request $request) {
        
        $input = $request->only('title');
        $rules = [
                    'title'=>'required|unique:skills,skill'
                ];
        $messages = [
                	'title'=> 'Please enter the title',
        		];

        $validator = Validator::make( $input, $rules, $messages);

        if ($validator->fails()) {
            $code = 406;
            $output = ['error'=>['code'=>$code,'messages'=>$validator->messages()->all()]];
        } else {      
            $response = $this->_repository->create($input); 
            if($response == false) {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occured while creating skill.']]];
            } else {
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['Skill has been created successfully.']]];
            }
        } 
        return response()->json($output, $code);
    }

    /**
	 *
	 * This method will update existing skill
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
    public function update(Request $request){
        
        $input = $request->only('id','title');
        $rules = [
                    'id'    		=>  'required|exists:skills,id',
                    'title'  		=>  'required|unique:skills,skill,'.$input['id']
                ];
        $messages = [
	                'id.required'   	=> 'Please enter skill id',
	                'id.exists'   		=> 'Skill not found',
	                'title.required' 	=> 'Please enter the title'
        			];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            $code = 406;
            $output = ['error'=>['code'=>$code,'messages'=>$validator->messages()->all()]];
        } else {
            $response = $this->_repository->update($input);
            if($response == NULL || $response == false) {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occured while updating skill.']]];
            } else {
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['Skill has been updated successfully ']]];
            }
        }
        return response()->json($output, $code);
    }

    /**
	 *
	 * This method will fetch data of individual skill
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
        $rules = ['id'=>'required|exists:skills,id'
                	];

        $messages = ['id.required' => 'Please enter skill id',
                    'id.exists' => 'Skill not found'
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
	 * This method will fetch list of all roles
	 * and will return output back to client as json
	 *
	 * @access public
	 * @return mixed
	 *
	 * @author Bushra Naz
	 *
	 **/
   	public function all(Request $request) {
  
        $input = $request->only('pagination','keyword','limit', 'filter_by_status');
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

    /**
	 *
	 * This method will delete an existing role
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
        $rules = ['id' => 'required|exists:skills,id'];

        $messages = ['id.required' => 'Please enter skill id.',
        			'id.exists' => 'Skill not found.'
        			];

        $validator = Validator::make($input,$rules,$messages);

        // if validation fails
        if($validator->fails()) {
            $code = 406;
            $output = ['error' => ['code'=>$code,'messages'=>$validator->messages()->all()]];
        
        // if validation passes
        } else {
            $response = $this->_repository->deleteById($input['id']);

            if($response == 'success') {   
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['Skill has been deleted successfully.']]];
            } else if ($response == 'cannot_delete') {
                $code = 401;
                $output = ['error' => ['code'=>$code,'messages'=>['Sorry you cannot remove this skill as it is associated with some users.']]];
            } else if ($response == 'error') {
                $code = 405;
                $output = ['error' => ['code'=>$code,'messages'=>['An error occur while deleting this skill.']]];
            } else if ($response == 'not_found') {
                $code = 404;
                $output = ['error' => ['code'=>$code,'messages'=>['Skill not found.']]];
            } 
         }
         return response()->json($output, $code);
    }

    /**
     *
     * This method will change skill status (active, inactive)
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
        $rules = ['id'      => 'required | exists:skills,id',
                  'status'  => 'required |in:enable,disable',
                ];

        $messages = [
                'id.required'           => 'Please enter skill id.',
                'id.exists'             => 'Skill not found.',
                'status.required'       => 'Please enter status.',
                'status.in'             => 'Status can only be enable or disable.'
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
                $output = ['error' => ['code'=>$code,'messages'=>['Sorry you cannot de-activate this skill as it is associated with some users.']]];
            } else {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occurred while updating status.']]];
            }
        }

        return response()->json($output, $code);
    }

}
