<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\AppliedJob;
use BusinessObject\User;
use BusinessObject\Industry;
use \Validator, \Session;
class HomeController extends Controller {

    public $user_repo;
    public $job_repo;
    public $role_repo;
    public $skill_repo;
    public $news_repo;
    public $industry_repo;
    public $company_repo;

    public $user_model;
    public $industry_model;
    public $role_model;
    public $applied_job_model;

    public function __construct(Role $role, AppliedJob $applied_job, User $user, Industry $industry) {
        $this->user_repo = app()->make('UserRepository');
        $this->job_repo = app()->make('JobRepository');
        $this->role_repo = app()->make('RoleRepository');
        $this->skill_repo = app()->make('SkillsRepository');
        $this->industry_repo = app()->make('IndustryRepository');
        $this->company_repo = app()->make('CompanyRepository');
        $this->news_repo = app()->make('NewsRepository');
        $this->user_model = $user;
        $this->role_model = $role;
        $this->industry_model = $industry;
        $this->applied_job_model = $applied_job;
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
        return view('admin.activation',['code'=>$input['code'],'errors'=>$errors,'hasError'=>$hasError]);
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
        return view('admin.recover-password',['code'=>$input['code'],'errors'=>$errors,'hasError'=>$hasError]);
    }

    /* for users listing */
 	public function showUsers(Request $request) {
        $title  = 'Sababoo | Admin | Users';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');

        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);

        $roles = $this->role_model->where('is_active', '=', 1)->get();
        return view('admin.users',['title'=>$title, 'roles'=>$roles, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for add/update user */
    public function showUser(Request $request) {
        $title = 'Sababoo | Admin | User';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $input = $request->only('id');
        $user_id = 0;
        $user = NULL;
        if (isset($input['id']) && $input['id'] != '') {
            $user_id = $input['id'];
            $user = $this->user_repo->findById($user_id);
            if ($user == NULL) {
                return redirect('/admin/404');
            }
        }

        $roles = $this->role_model->where('is_active', '=', 1)->get();
        return view('admin.user',['title'=>$title, 
                            'user_id' => $user_id, 
                            'user'=>$user,
                            'roles'=>$roles,
                            'logged_in_user'=>$logged_in_user]);
    }

    /* for user's profule update */
    public function showUserProfile(Request $request) {
        $title = 'Sababoo | Admin | Profile';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        return view('admin.user-profile',['title'=>$title, 'logged_in_user'=>$logged_in_user]);
    }

    /* for site users listing */
    public function showSiteUsers(Request $request) {
        $title  = 'Sababoo | Admin | Site Users';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.site-users',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for site user details */
    public function showSiteUser(Request $request) {
        $title = 'Sababoo | Admin | Site User';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $input = $request->only('id');
        $user_id = 0;
        $user = NULL;
        if (isset($input['id']) && $input['id'] != '') {
            $user_id = $input['id'];
            $user = $this->user_repo->findById($user_id, false, true);
            if ($user == NULL) {
                return redirect('/admin/404');
            }
        }
       
        return view('admin.site-user',['title'=>$title, 
                            'user_id' => $user_id, 
                            'user'=>$user,
                            'logged_in_user'=>$logged_in_user]);
    }

    /* for jobs listing */
    public function showJobs(Request $request) {
        $title  = 'Sababoo | Admin | Jobs';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.jobs',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for individual job details */
    public function showJob(Request $request) {
        $title  = 'Sababoo | Admin | Job Details';
        $logged_in_user   = Auth::user();

        $input = $request->only('id');
        $job_id = 0;
        $job = NULL;
        $finalApplied = [];
        if (isset($input['id']) && $input['id'] != '') {
            $job_id = $input['id'];
            $job = $this->job_repo->findById($job_id);
            if ($job == NULL) {
                return redirect('/admin/404');
            } else {
                $applied_jobs = $this->applied_job_model->where('job_id', '=', $job->id)->get();
                
                if (count($applied_jobs) > 0) {
                    $finalApplied = [];
                    $i = 0;
                    foreach ($applied_jobs as $key => $applied_job) {
                        $userData = $this->user_repo->findById($applied_job->user_id, false, false);
                        if ($userData != NULL) {
                            $finalApplied[$i]['id'] = $applied_job->job_id;
                            $finalApplied[$i]['message'] = $applied_job->message;
                            $finalApplied[$i]['user_name'] = $userData->first_name.' '.$userData->last_name;
                            $finalApplied[$i]['applied_on'] = date('d m, Y', strtotime($applied_job->created_at));
                            $i++;
                        }
                    }
                }
            }
        }
        
        //$logged_in_user = Session::get('sa_user');
        return view('admin.job',['title'=>$title, 
                                'job_id' => $job_id, 
                                'job'=>$job,
                                'applied_jobs'=>$finalApplied,
                                'logged_in_user'=>$logged_in_user]);
    }

    /* for roles listing */
    public function showRoles(Request $request) {
        $title  = 'Sababoo | Admin | Roles';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.roles',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for individual role view */
    public function showRole(Request $request) {
        $title  = 'Sababoo | Admin | Role';
        $logged_in_user   = Auth::user();

        $input = $request->only('id');
        $role_id = 0;
        $role = NULL;
        if (isset($input['id']) && $input['id'] != '') {
            $role_id = $input['id'];
            $role = $this->role_repo->findById($role_id);
            if ($role == NULL) {
                return redirect('/admin/404');
            }
        }
        
        //$logged_in_user = Session::get('sa_user');
        return view('admin.role',['title'=>$title, 
                                'role_id' => $role_id, 
                                'role'=>$role,
                                'logged_in_user'=>$logged_in_user]);
    }

    /* for skills listing */
    public function showSkills(Request $request) {
        $title  = 'Sababoo | Admin | Skills';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.skills',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for individual skill view */
    public function showSkill(Request $request) {
        $title  = 'Sababoo | Admin | Skill';
        $logged_in_user   = Auth::user();

        $input = $request->only('id');
        $skill_id = 0;
        $skill = NULL;
        if (isset($input['id']) && $input['id'] != '') {
            $skill_id = $input['id'];
            $skill = $this->skill_repo->findById($skill_id);
            if ($skill == NULL) {
                return redirect('/admin/404');
            }
        }
        
        //$logged_in_user = Session::get('sa_user');
        return view('admin.skill',['title'=>$title, 
                                'skill_id' => $skill_id, 
                                'skill'=>$skill,
                                'logged_in_user'=>$logged_in_user]);
    }

    /* for industries listing */
    public function showIndustries(Request $request) {
        $title  = 'Sababoo | Admin | Industries';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.industries',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for individual industry view */
    public function showIndustry(Request $request) {
        $title  = 'Sababoo | Admin | Industry';
        $logged_in_user   = Auth::user();

        $input = $request->only('id');
        $industry_id = 0;
        $industry = NULL;
        if (isset($input['id']) && $input['id'] != '') {
            $industry_id = $input['id'];
            $industry = $this->industry_repo->findById($industry_id);
            if ($industry == NULL) {
                return redirect('/admin/404');
            }
        }
        
        //$logged_in_user = Session::get('sa_user');
        return view('admin.industry',['title'=>$title, 
                                'industry_id' => $industry_id, 
                                'industry'=>$industry,
                                'logged_in_user'=>$logged_in_user]);
    }

    /* for transactions listing */
    public function showTransactions(Request $request) {
        $title  = 'Sababoo | Admin | Transactions';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.transactions',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for refunds listing */
    public function showRefunds(Request $request) {
        $title  = 'Sababoo | Admin | Refunds';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.refunds',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for disputes listing */
    public function showDisputes(Request $request) {
        $title  = 'Sababoo | Admin | Disputes';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.disputes',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for report view */
    public function showReports(Request $request) {
        $title  = 'Sababoo | Admin | Dashboard';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.reports',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for logs view */
    public function showLogs(Request $request) {
        $title  = 'Sababoo | Admin | Logs';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        $users = $this->user_model->where('is_admin', '=', 1)->where('status', '=', 'enabled')->get();
        return view('admin.logs',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations, 'users'=>$users]);
    }

    /* for newses listing */
    public function showNewses(Request $request) {
        $title  = 'Sababoo | Admin | News';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        $industries = $this->industry_model->where('status', '!=', '3')->get();
        return view('admin.newses',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations, 'industries'=>$industries]);
    }

    /* for individual news view */
    public function showNews(Request $request) {
        $title  = 'Sababoo | Admin | News';
        $logged_in_user   = Auth::user();

        $input = $request->only('id');
        $news_id = 0;
        $news = NULL;
        if (isset($input['id']) && $input['id'] != '') {
            $news_id = $input['id'];
            $news = $this->news_repo->findById($news_id);
            if ($news == NULL) {
                return redirect('/admin/404');
            }
        }
        
        //$logged_in_user = Session::get('sa_user');
        $industries = $this->industry_model->where('status', '!=', '3')->get();
        return view('admin.news',['title'=>$title, 
                                'news_id' => $news_id, 
                                'news'=>$news,
                                'logged_in_user'=>$logged_in_user,
                                'industries'=>$industries]);
    }

    /* for companies listing */
    public function showCompanies(Request $request) {
        $title  = 'Sababoo | Admin | Companies';
        $logged_in_user   = Auth::user();
        //$logged_in_user = Session::get('sa_user');
        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $this->role_repo->getRoleOperations($logged_in_user->role_id);
        return view('admin.companies',['title'=>$title, 'logged_in_user'=>$logged_in_user, 'roleOperations'=>$roleOperations]);
    }

    /* for individual company view */
    public function showCompany(Request $request) {
        $title  = 'Sababoo | Admin | Company';
        $logged_in_user   = Auth::user();

        $input = $request->only('id');
        $company_id = 0;
        $company = NULL;
        if (isset($input['id']) && $input['id'] != '') {
            $company_id = $input['id'];
            $company = $this->company_repo->findById($company_id);
            if ($company == NULL) {
                return redirect('/admin/404');
            }
        }
        
        //$logged_in_user = Session::get('sa_user');
        return view('admin.company',['title'=>$title, 
                                'company_id' => $company_id, 
                                'company'=>$company,
                                'logged_in_user'=>$logged_in_user]);
    }
}
