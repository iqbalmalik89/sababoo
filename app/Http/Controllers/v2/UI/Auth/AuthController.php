<?php

namespace App\Http\Controllers\v2\UI\Auth;

use  BusinessObject\User;
use  BusinessObject\Employee;
use  BusinessObject\Employer;
use  BusinessObject\Tradesman;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Authenticatable;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Session;
use  App\Validator\Validate;
use App\Helpers\ActivityLogManager;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use ThrottlesLogins;


	/**
     * User model instance
     * @var User
     */
    protected $user; 
    
    /**
     * For Guard
     *
     * @var Authenticator
     */
    protected $auth;

  
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
     /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct( User $user)
    {
        $this->user = $user; 
       // $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogout(){

        if (Auth::user() != NULL) {
            if (Auth::user()->is_admin == 1) {
                // to maintain log
                try {
                    $newParams = array(
                                'user_id'   => Auth::user()->id,
                                'module'    => 'user_profile',
                                'log_id'    => Auth::user()->id,
                                'log_type'  => 'logout',
                                'text'      => 'site'
                            );
                    ActivityLogManager::create($newParams);
                } catch(\Exception $e){
                }
            }
            Auth::logout();

            Session::flush();
            return redirect('/v2');
        }
    
    }
     public function getLogin()
    {
       // return view('frontline.auth.signup');
    }
	 protected function getCredentials(Request $request)
    {
        $req = $request->only('email');
        $pasword = $request->only('password');
        $req['password']=$pasword['password'];
		$req['status']='enabled';
		$req['verified_string']='verified';
        
        return $req;
    }
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $auth = false;
        $code = 301;
        $msg = "";
        $detail = '';
        $status = 'success';
        $url="";
       
        
        $validate_array = array('email' => "required|email",'password'=>'required');
        $post_data = $request->all();
        $validation_res = Validate::validateMe(array('email' => $post_data['email'],'password' => $post_data['password']), $validate_array);
         //dd($validation_res);
        if ($validation_res['code'] == 401) {
            return $validation_res;
        }
        
			//$pass = $request->only('password');
			//dd(bcrypt($pass['password']));
			 $credentials = $this->getCredentials($request);
            
            
		  //if (Auth::attempt($credentials, $request->has('remember'))) {
             
        if (Auth::attempt($credentials, false)) {
         

				$auth = true;
                $user = Auth::user();
                $user->save();


        }
 		
     if ($request->ajax()) {
             if ($auth == false) {
                $code = 1000;
                $msg = "Login Failed";
                $status = 'error';
                $detail = 'Incorrect Username or Password.';
                if(!\Session::get('redirect_url')){
                    \Session::put('redirect_url',\Redirect::intended()->getTargetUrl());
                }
            }else{
                $code = 200;
                $msg = "Login Success";
                $status = 'success';
                $detail = 'You are login successfully....';
                $url="/v2/home";
                
                /*if ($user->role == 'employee') {
                    $employee = Employee::where('userid', '=' , $user->id)->first();
                    $url="/employee/view/".$employee->id;
                } else if ($user->role == 'employer') {
                    $employer = Employer::where('userid', '=' , $user->id)->first();
                    $url="/employer/view/".$employer->id;
                } else if ($user == 'tradesman') {
                    $tradesman = Tradesman::where('userid', '=' , $user->id)->first();
                    $url="/tradesman/view/".$tradesman->id;
                }*/
                 Session::forget('redirect_url');

                 if($user->is_admin == 1) {
                    // to maintain log
                    try {
                        $newParams = array(
                                    'user_id'   => Auth::user()->id,
                                    'module'    => 'user_profile',
                                    'log_id'    => $user->id,
                                    'log_type'  => 'login',
                                    'text'      => 'site'
                                );
                        ActivityLogManager::create($newParams);
                    } catch(\Exception $e){

                    }
                 }
                 Auth::login($user);

            }


            return response()->json([
              'url' => ($url!="" ? $url:\Redirect::intended()->getTargetUrl()),
              'code' => $code,
              'status' => $status,
              'msg' => $detail,
            ]);
        }

        return redirect($this->loginPath())
          ->withInput($request->only($this->loginUsername(), 'remember'))
          ->withErrors([
            $this->loginUsername() => $this->getFailedLoginMessage(),
          ]);
    }
	
 
   
}
