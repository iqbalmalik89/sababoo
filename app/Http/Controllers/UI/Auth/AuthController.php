<?php

namespace App\Http\Controllers\UI\Auth;

use  BusinessObject\User;
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
        Auth::logout();

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
       
        
        $validate_array = array('email' => "required|email",'password'=>'required');
        $post_data = $request->all();
        $validation_res = Validate::validateMe(array('email' => $post_data['email'],'password' => $post_data['password']), $validate_array);

        if ($validation_res['code'] == 401) {
            return $validation_res;
        }
        
			//$pass = $request->only('password');
			//dd(bcrypt($pass['password']));
			 $credentials = $this->getCredentials($request);
            
            
		  if (Auth::attempt($credentials, $request->has('remember'))) {
             

				$auth = true;
                $user = Auth::user();
                $user->last_login_timestamp = new \DateTime();
                $user->save();


        }
 		
     if ($request->ajax()) {
            if ($auth == false) {
                $code = 1000;
                $msg = "Login Failed";
                $status = 'error';
                
            }

            return response()->json([
              'url' => '/home',
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
