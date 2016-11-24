<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use \Validator, \Session;
class HomeController extends Controller {

    public $user_repo;
    public $job_repo;

    public function __construct() {
        $this->user_repo = app()->make('UserRepository');
        $this->job_repo = app()->make('JobRepository');

    }

 	public function showLogin(Request $request) {
        $title = 'Sababoo | Admin | Login';
        return view('admin.login',['title'=>$title]);
    }
    public function showNotFound(Request $request) {
        $title = 'Sababoo | Admin | 404';
        return view('admin.errors.404',['title'=>$title]);
    }
    public function showUnAuthorized(Request $request) {
        $title = 'Sababoo | Admin | 401';
        return view('admin.errors.401',['title'=>$title]);
    }

    public function showActivation(Request $request) {
        
        $input = $request->only('code');

        $rules = ['code' => 'required'];

        $messages = ['code.required' => 'No Activation Code Found.'
                    ];      
        $errors = [];

        $validator = Validator::make($input, $rules, $messages); 
        $hasError = false;

        if($validator->fails()) {
            $hasError = true;
            $errors = $validator->messages()->all();
        } else {
            $user = $this->user_repo->findByAttribute('activation_key',$input['code']);
            if ($user == NULL) {
                $hasError = true;
                $errors[] = 'Invalid Activation Code';
            } else {
                if($user->activated_on != NULL) {
                    $hasError = true;
                    $errors[] = 'Account Already Activated';
                }
            }
        }
        return view('pages.activation',['code'=>$input['code'],'errors'=>$errors,'hasError'=>$hasError]);
    }

    public function showRecover(Request $request) {
        $input = $request->only('code');

        $rules = ['code' => 'required'];

        $messages = ['code.required' => 'No Forgot Password Code Found.'
                    ];      
        $errors = [];
        $validator = Validator::make($input, $rules, $messages); 
        $hasError = false;
        if($validator->fails()) {
            $errors = $validator->messages()->all();
            $hasError = true;
        } else {
            $user = $this->user_repo->findByAttribute('recover_password_key',$input['code']);
            if ($user == NULL) {
                $hasError = true;
                $errors[] = 'Invalid Forgot Password Code';
            }
        }
        return view('pages.recover-password',['code'=>$input['code'],'errors'=>$errors,'hasError'=>$hasError]);
    }

    /* for users listing */
 	public function showUsers(Request $request) {
        $title  = 'Sababoo | Admin | Users';
        $logged_in_user   = Auth::guard('admin_users')->user();
        //$logged_in_user = Session::get('sa_user');
        return view('admin.users',['title'=>$title, 'logged_in_user'=>$logged_in_user]);
    }

    /* for add/update user */
    public function showUser(Request $request) {
        $title = 'Sababoo | Admin | User';
        $logged_in_user   = Auth::guard('admin_users')->user();
        //$logged_in_user = Session::get('sa_user');
        $input = $request->only('id');
        $user_id = 0;
        $user = NULL;
        if (isset($input['id']) && $input['id'] != '') {
            $user_id = $input['id'];
            $user = $this->user_repo->findById($user_id);
        }

        if ($user == NULL) {
            return redirect('/admin/404');
        }
        return view('admin.user',['title'=>$title, 
                            'user_id' => $user_id, 
                            'user'=>$user,
                            'logged_in_user'=>$logged_in_user]);
    }

    /* for user's profule update */
    public function showUserProfile(Request $request) {
        $title = 'Sababoo | Admin | Profile';
        $logged_in_user   = Auth::guard('admin_users')->user();
        //$logged_in_user = Session::get('sa_user');
        return view('admin.user-profile',['title'=>$title, 'logged_in_user'=>$logged_in_user]);
    }

    /* for jobs listing */
    public function showJobs(Request $request) {
        $title  = 'Sababoo | Admin | Jobs';
        $logged_in_user   = Auth::guard('admin_users')->user();
        //$logged_in_user = Session::get('sa_user');
        return view('admin.jobs',['title'=>$title, 'logged_in_user'=>$logged_in_user]);
    }

    /* for individual job details */
    public function showJob(Request $request) {
        $title  = 'Sababoo | Admin | Job Details';
        $logged_in_user   = Auth::guard('admin_users')->user();

        $input = $request->only('id');
        $job_id = 0;
        $job = NULL;
        if (isset($input['id']) && $input['id'] != '') {
            $job_id = $input['id'];
            $job = $this->job_repo->findById($job_id);
        }
        if ($job == NULL) {
            return redirect('/admin/404');
        }
        //$logged_in_user = Session::get('sa_user');
        return view('admin.job',['title'=>$title, 
                                'job_id' => $job_id, 
                                'job'=>$job,
                                'logged_in_user'=>$logged_in_user]);
    }
}
