<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:49 AM
 */


namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use BusinessLogic\EmployeeServiceProvider;
use BusinessLogic\SkillServiceProvider;
use BusinessLogic\LanguageServiceProvider;
use BusinessLogic\UserServiceProvider;
use BusinessLogic\JobPostServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;
use Validator;
use  BusinessObject\User;
use  BusinessObject\Education;
use  BusinessObject\Experience;
use  BusinessObject\Employee;
use  BusinessObject\JobPost;
use  BusinessObject\Industry;


class JobPostController extends Controller
{
    private $jobpostServiceProvider;
    public function __construct()
    {
        $this->middleware('auth');
        $this->logged_user = Auth::user();
        $this->jobpostServiceProvider = new JobPostServiceProvider();
    }

    public function jobPost(Request $request){

        $post_data=$request->all();

        $matchThese = ['status'=>1];
        $industry = Industry::where($matchThese)->get();

        $job_data= null;
         if(isset($post_data['id'])){
            $job_data=$this->jobpostServiceProvider->getJobByJobId($post_data['id']);
        }
        return view('frontend.job.job_posting',['industry'=>$industry,'job_data'=>$job_data]);
     }

    public function jobCreate(Request $request){

        $post_data = $request->all();
        $this->logged_user = Auth::user();
        $validate_array = array(
            'title'         => "required",
            'location'      => "required",
            'description'   => "required",
            'requirement'   => "required",
            'job_day'       => "required",
            'job_month'     => "required",
            'job_year'      => "required",
            'industry'      => "required",
        );
        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        $post_data['userid']= $this->logged_user->id;

        return  $this->jobpostServiceProvider->createJob($post_data);

    }

    public function userJobList(Request $request){
        $this->logged_user = Auth::user();
        $post_data = $request->all();

        $paging['page_num']  = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order']   = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('orderby', '0');
        $filters['userid']   =  $this->logged_user->id;
        if((isset($post_data['name']))){
            $filters['name'] =   $post_data['name'];
        }
        if((isset($post_data['location']))){
            $filters['location'] =   $post_data['location'];
        }
        $my_jobs=  $this->jobpostServiceProvider->userJobList($filters,$order_by,$paging);

        return view ('frontend.job.user_job_listing',array('my_jobs'=>$my_jobs));
    }

    public function delJob(Request $request){
        $post_data = $request->all();
        return  $this->jobpostServiceProvider->jobDelByJobId($post_data['job_id']);
    }

    public function getTerm(Request $request){
        $this->logged_user = Auth::user();
        $post_data= $request->all();
        $post_data['userid']=$this->logged_user->id;
        return  $this->jobpostServiceProvider->getJobTerms($post_data);
    }















}



