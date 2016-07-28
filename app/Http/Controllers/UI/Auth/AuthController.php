<?php

namespace App\Http\Controllers\Auth;

use  BusinessObject\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Session;
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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

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

    public function getLogin()
    {
        return view('frontline.auth.signup');
    }
	 protected function getCredentials(Request $request)
    {
        $req = $request->only('email', 'password');
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
       
        $validator = Validator::make($request->all(), [
          'email' => 'required',
          'password' => 'required',
        ]);
        if ($validator->fails()) {

            foreach ($validator->getMessageBag()->toArray() as $error) {
                $err[] = implode("|", $error);
            }
            $err = implode("<br>", $err);

                $response['code'] = 1000;
                $response['status'] = 'error';
                $response['msg'] = $err;
            return $response;
        }
			
			//$pass = $request->only('password');
			//dd(bcrypt($pass['password']));
			 $credentials = $this->getCredentials($request);
		  if (Auth::attempt($credentials, $request->has('remember'))) {
              if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                  $ip = $_SERVER['HTTP_CLIENT_IP'];
              } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
              } else {
                  $ip = $_SERVER['REMOTE_ADDR'];
              }

				$auth = true;
                $user = Auth::user();
                $user->last_login_timestamp = new \DateTime();
                $user->last_login_userip    = $ip;
                $user->save();


        }
 		
     if ($request->ajax()) {
            if ($auth == false) {
                $code = 1000;
                $msg = "Login Failed";
                $status = 'error';
                $detail = $this->getFailedLoginMessage();
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
