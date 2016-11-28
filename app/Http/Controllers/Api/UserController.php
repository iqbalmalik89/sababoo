<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\Repositories\UserRepository;
use Illuminate\Http\Request;

use \Validator, \Session, Carbon\Carbon;;

class UserController extends Controller {

	const PER_PAGE = 10;

    /**
     *
     * This will hold the instance of UserRepository class which is used for
     * fetching, modifying, creating and removing data from database.
     *
     * @var object
     * @access private
     *
     **/
	private $_repository;

	public function __construct() {
		$this->_repository = app()->make('UserRepository');
	}

    /**
     *
     * This method will create a new user
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function create(Request $request){

        $input = $request->only('name','email', 'role_id');

        $rules = [
                    'name'          =>  'required',
                    'email'         =>  'required|email|unique:users,email',
                    'role_id'       =>  'required|exists:roles,id'
                ];
        $messages = [
                'name.required'     => 'Please enter name.',
                'email.required'    => 'Please enter email address.',
                'email.email'       => 'Please enter valid email address.',
                'email.unique'      => 'This email is already present in the system, Please try a different one.',
                'role_id.required'  => 'Please select role.',
                'role_id.exists'    => 'Role not found.',

        ];

        $validator = Validator::make( $input, $rules, $messages);

        // if validation fails
        if ( $validator->fails() ) {
            $code = 406;
            $output = ['error'=>['code'=>$code,'messages'=>[$validator->messages()->first()]]];

        } else {
            $userExists = $this->_repository->findByAttribute('email',$input['email']);
            if($userExists == NULL){
                $response = $this->_repository->create($input);
                if($response == true) {
                    $code = 200;
                    $output = ['success'=>['code'=>$code,'messages'=>['User has been created successfully.']]];
                    
                } else {
                    $code = 406;
                    $output = ['error'=>['code'=>$code,'messages'=>['An error occured while creating user.']]];
                }
            } else {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['This email is already present in the system, Please try a different one.']]];
            }
        }
        return response()->json($output, $code);
    }

    /**
     *
     * This method will update an existing user
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function update(Request $request){

        $input = $request->only('id', 'name', 'email', 'role_id');

        $rules = [
                    'id'    =>  'required|exists:admin_users,id',
                    'name'  =>  'required',
                    'email' =>  'required|unique:admin_users,email,'.$input['id'],
                    'role_id'    =>  'required|exists:roles,id',
                ];
        $messages = [
                'id.required'       => 'Please enter user id.',
                'id.exists'         => 'User not found.',
                'name.required'     => 'Please enter user name.',
                'email.required'    => 'Please enter email address.',
                'email.unique'      => 'This email is already present in the system, Please try a different one.',
                'role_id.required'  => 'Please select role.',
                'role_id.exists'    => 'Role not found.',
        ];

        $validator = Validator::make( $input, $rules, $messages);

        if ($validator->fails()) {
            $code = 406;
            $output = ['error'=>['code'=>$code,'messages'=>[$validator->messages()->first()]]];

        } else {
            $userExists = $this->_repository->findByAttribute('email',$input['email']);
            if($userExists == NULL || ($userExists->email == $input['email'] && $userExists->id == $input['id'] ) ){
                $response = $this->_repository->update($input);
                if($response) {
                    $code = 200;
                    $output = ['success'=>['code'=>$code,'messages'=>['User has been updated successfully.']]];
                } else {
                    $code = 406;
                    $output = ['error'=>['code'=>$code,'messages'=>['An error occured while updating user.']]];
                }
            } else{
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>['This email is already present in the system, Please try a different one.']]];
            }
        }
        return response()->json($output, $code);
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
        $rules = ['id'      => 'required | exists:admin_users,id',
                  'status'  => 'required |in:1,0',
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

        $rules = ['id' => 'required|exists:admin_users,id'];

        $messages = ['id.required'      => 'Please enter user id.',
                    'id.exists'         => 'Usder not found.'
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
        $user = Auth::user();
        dd($user);die;
        $input = $request->only('id');

        $rules = [
                    'id'=>'required|exists:admin_users,id'
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

    /**
     *
     * This method will authenticate user and logged in for true credentials
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function login(Request $request) {

        $input = $request->only('email','password','is_admin');

        $rules = ['email'           => 'required|exists:admin_users,email',
                  'password'        => 'required',
                  'is_admin'        => 'required|in:1,0'];

        $messages = ['email.required' => 'Please enter email address.',
                    'password.required' => 'Please enter password.',
                    ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()) {
            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => [$validator->messages()->first()]]];
        } else {
            $response = $this->_repository->login($input);
            if($response == 'not_found') {
                $code = 404;
                $output = ['error' => ['code' => $code, 'messages' => ['That email and password combination is not correct.']]];
            } else if ($response == 'not_activated') {
                $code = 406;
                $output = ['error' => ['code' => $code, 'messages' => ['You need to activate your account first.']]];
            } else if ($response == 'error') {
                $code = 405;
                $output = ['error' => ['code' => $code, 'messages' => ['An error occurred while trying to login. Please try again.']]];
            } else if ($response == 'not_allowed') {
                $code = 406;
                $output = ['error' => ['code' => $code, 'messages' => ['Your are not allowed to login.']]];
            } else if ($response == 'not_admin') {
                $code = 401;
                $output = ['error' => ['code' => $code, 'messages' => ['Sorry! you are not an admin.']]];
            } else {
                $code = 200;
                $output = ['data'=>$response];
            }
        }
        return response()->json($output, $code);
    }

    /**
     *
     * This method will logged out a logged in user
     * and will return output back to client as json
     *
     * @access public
     * @return mixed
     *
     * @author Bushra Naz
     *
     **/
    public function logout(Request $request){

        $input = $request->only('is_admin');

        $rules = ['is_admin' => ''];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()) {

            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => [$validator->messages()->first()] ]];
            return response()->json($output);
        } else  {

            Auth::guard('admin_users')->logout();
            //Session::flush('sa_user');
            return ['response'=>['code'=>200,'messages'=>['You have successfully logged out.']]];

        }
    }

    public function createPassword(Request $request) {

        $input = $request->only('code','password','confirm_password');

        $rules = [
                  'code' => 'required',
                  'password' => 'required',
                  'confirm_password' => 'required | same:password'
                  ];

        $messages = [
                    'code.required' => 'Please enter code.',
                    'password.required' => 'Please enter password.',
                    'confirm_password.required' => 'Please enter password again.'
                    ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()) {

            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => [$validator->messages()->first()]]];
        } else {
            $user = $this->_repository->findByAttribute('activation_key',$input['code']);
            if($user != NULL) {
                if($user->activated_on == NULL){
                    $response = $this->_repository->createPassword($user->id, $input['password']);
                    if($response) {
                        $code = 200;
                        $output = ['response' =>['code'=> $code, 'messages' => ['Password created successfully. Now you can login.']]];
                    }else {
                        $code = 406;
                        $output = ['error' => ['code'=> $code, 'messages' => ['An error occured while creating your password.']]];
                    }
                }else{
                    $code = 401;
                    $output = ['error' => ['code'=>$code, 'messages' => ['Your account has already been activated.']]];
                }
            } else {
                $code = 404;
                $output = ['error' => ['code'=>$code, 'messages' => ['Incorrect or invalid activation code']]];
            }
        }

        return response()->json($output, $code);
    }

    public function forgotPassword(Request $request) {

        $input = $request->only('email');
        $rules = ['email' => 'required|email'];

        $messages = ['email.required' => 'Please enter email address.'];

        $validator = Validator::make($input,$rules,$messages);

        if($validator->fails()) {

            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => $validator->messages()->all() ]];
        } else {
            $user = $this->_repository->findByAttribute('email',$input['email']);
            if($user != NULL) {
                if($user->activated_on != NULL){
                    $response = $this->_repository->forgotPassword($user->id);
                    if($response == NULL) {
                        $code = 406;
                        $output = ['error' => ['code'=>$code, 'messages' => ['An error occurred while trying to send you an email. Please try again.']]];
                    } else {
                        $code = 200;
                        $output = ['success' => ['code'=> $code, 'messages' => ['Password recovered successfully. Check your email!']]];                            
                    }
                } else {
                    $code = 406;
                    $output = ['error'=> ['code' => $code, 'messages' => ['Your account has not yet been activated.']]];
                }
                
            } else {
                    $code = 404;
                    $output = ['error'=> ['code' => $code, 'messages' => ['Incorrect or invalid email address']]];
            }
        }

        return response()->json($output, $code);
    }

    public function resetPassword(Request $request) {
        $input = $request->only('code','password','confirm_password');

        $rules = [
                  'code' => 'required',
                  'password' => 'required',
                  'confirm_password' => 'required | same:password'
                  ];

        $messages = [
                    'code.required' => 'Please enter code.',
                    'password.required' => 'Please enter password.',
                    'confirm_password.required' => 'Please enter password again.'
                    ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()) {

            $code = 406;
            $output = ['error' => ['code' => $code, 'messages' => $validator->messages()->all() ]];
        } else {
            $user = $this->_repository->findByAttribute('recover_password_key',$input['code']);
            if($user != NULL) {
                $response = $this->_repository->resetPassword($user->id, $input['password']);
                if($response == NULL) {
                    $code = 406;
                    $output = ['error' => ['code'=> $code, 'messages' => ['An error occured while reseting your password.']]];
                } else {
                    $code = 200;
                    $output = ['response' =>['code'=> $code, 'messages' => ['Password has been reset successfully.']]];
                }
            } else {
                $code = 404;
                $output = ['error' => ['code'=>$code, 'messages' => ['Incorrect or invalid recover code']]];
            }
        }

        return response()->json($output, $code);
    }

    public function updatePassword(Request $request){
        
        $user = Auth::user();
        if ($user != NULL) {
            $input = $request->only('old_password','new_password');
            $input['id'] = $user->id;
            $rules = [
                        'old_password' =>'required',
                        'new_password'=>  'required|min:6',
                    ];
            $messages = ['old_password.required'=> 'Please enter current password.',
                            'new_password.required'=> 'Please enter new password.',
                            'new_password.min'=> 'Password must be atleast 6 characters long.',
                    ];


            $validator = Validator::make( $input, $rules, $messages);  

            // if validation fails
            if ( $validator->fails() ) {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>$validator->messages()->all()]];

            } else { 
                $response = $this->_repository->updatePassword($input);
                if($response == 'not_found'){
                    $code = 404;
                    $output = ['error'=>['code'=>$code,'messages'=>['User account not found.']]];
                } else if($response == 'invalid_old_password') {
                    $code = 405;
                    $output = ['error'=>['code'=>$code,'messages'=>['Please enter valid current password.']]];
                } else if($response == 'success') {
                    $code = 200;
                    $output = ['success'=>['code'=>$code,'messages'=>['Password has been updated successfully.']]];
                } else {
                    $code = 406;
                    $output = ['error'=>['code'=>$code,'messages'=>['An error occured while updating password.']]];
                }
            }
        } else {
            $code = 401;
            $output = ['error'=>['code'=>$code,'messages'=>['You nedd to login.']]];
        }
        
        return response()->json($output, $code);
    }

    public function updatePersonalInfo(Request $request){
        
        $user = Auth::user();
        if ($user != NULL) {
            $input = $request->only('name');
            $input['id'] = $user->id;
            $rules = [
                        'name' =>'required'
                    ];
            $messages = ['name.required'=> 'Please enter full name.'
                    ];

            $validator = Validator::make( $input, $rules, $messages);  

            // if validation fails
            if ( $validator->fails() ) {
                $code = 406;
                $output = ['error'=>['code'=>$code,'messages'=>$validator->messages()->all()]];

            } else { 
                $response = $this->_repository->updatePersonalInfo($input);
                if($response == 'not_found'){
                    $code = 404;
                    $output = ['error'=>['code'=>$code,'messages'=>['User account not found.']]];
                }else if($response == 'success') {
                    $code = 200;
                    $output = ['success'=>['code'=>$code,'messages'=>['Personal information has been updated successfully.']]];
                } else {
                    $code = 406;
                    $output = ['error'=>['code'=>$code,'messages'=>['An error occured while updating personal information.']]];
                }
            }

        } else {
            $code = 401;
            $output = ['error'=>['code'=>$code,'messages'=>['You need to login.']]];
        }    
        
        return response()->json($output, $code);
    }
}
