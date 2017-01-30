<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Data\Repositories\CompanyRepository;
use \Validator, \Session;

class CompanyController extends Controller {

    const PER_PAGE = 10;
    /**
     *
     * This will hold the instance of SettingsRepository class which is used for
     * fetching, modifying, creating and removing data from database.
     *
     * @var object
     * @access private
     *
     **/
    private $_repository;

    public function __construct() {
        $this->_repository = app()->make('CompanyRepository');
    }

    /**
     *
     * This method will create a new Company
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function create(Request $request) {
        
        $input = $request->only('name', 'image', 'url');
        $rules = [  
                    'name'=>'required',
                    'url'=>'required',
                    'image'=>'required',
                ];
        $messages = [
                    'name'=> 'Please enter name',
                    'url'=> 'Please enter url',
                    'image'=> 'Please select image'
                ];

        $validator = Validator::make( $input, $rules, $messages);

        if ($validator->fails()) {
            $code = 406;
            $output = ['error'=>['code'=>$code,'messages'=>$validator->messages()->all()]];
        } else {      
            $response = $this->_repository->create($input); 
            if($response == false) {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occured while creating company.']]];
            } else {
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['Company has been created successfully.']]];
            }
        } 
        return response()->json($output, $code);
    }

    /**
     *
     * This method will update existing company
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function update(Request $request){
        
        $input = $request->only('id','name', 'image', 'url');
        $rules = [
                    'id'            =>  'required|exists:companies,id',
                    'image'         =>  'required',
                    'name'         =>  'required'
                ];
        $messages = [
                    'id.required'       => 'Please enter company id',
                    'id.exists'         => 'Company not found',
                    'image.required'     => 'Please enter image',
                    'name.required'     => 'Please enter name'
                    ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            $code = 406;
            $output = ['error'=>['code'=>$code,'messages'=>$validator->messages()->all()]];
        } else {
            $response = $this->_repository->update($input);
            if($response == NULL || $response == false) {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occured while updating company.']]];
            } else {
                $code = 200;
                $output = ['success'=>['code'=>$code,'messages'=>['Company has been updated successfully ']]];
            }
        }
        return response()->json($output, $code);
    }

    /**
     *
     * This method will fetch data of individual company
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
        $rules = ['id'=>'required|exists:companies,id'
                    ];

        $messages = ['id.required' => 'Please enter company id',
                    'id.exists' => 'Company not found'
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
     * This method will fetch list of all companys
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
     * This method will delete an existing company
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
        $rules = ['id' => 'required|exists:companies,id'];

        $messages = ['id.required' => 'Please enter company id.',
                    'id.exists' => 'Company not found.'
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
                $output = ['success'=>['code'=>$code,'messages'=>['Company has been deleted successfully.']]];
            } else if ($response == 'error') {
                $code = 405;
                $output = ['error' => ['code'=>$code,'messages'=>['An error occur while deleting this company.']]];
            } else if ($response == 'not_found') {
                $code = 404;
                $output = ['error' => ['code'=>$code,'messages'=>['Company not found.']]];
            } 
         }
         return response()->json($output, $code);
    }

    /**
     *
     * This method will change company status (active, inactive)
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
        $rules = ['id'      => 'required | exists:companies,id',
                  'status'  => 'required |in:1,0',
                ];

        $messages = [
                'id.required'           => 'Please enter company id.',
                'id.exists'             => 'Company not found.',
                'status.required'       => 'Please enter status.',
                'status.in'             => 'Status can only be 1 or 0.'
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
            } else {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['An error occurred while updating status.']]];
            }
        }

        return response()->json($output, $code);
    }
}
