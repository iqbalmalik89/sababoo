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
use BusinessLogic\NetworkServiceProvider;
use BusinessLogic\CommentServiceProvider;
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
use  BusinessObject\Employer;
use  BusinessObject\Tradesman;
use  BusinessObject\JobPost;
use  BusinessObject\Industry;


class JobPostController extends Controller
{
    private $jobpostServiceProvider;
    public function __construct()
    {

        $this->jobpostServiceProvider = new JobPostServiceProvider();
    }

    public function jobPost(Request $request){

        $post_data=$request->all();

         if (Auth::user() != NULL) {
          $this->logged_user = Auth::user();
        } else {
          return redirect('login');
        }

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
        if (Auth::user() != NULL) {
          $this->logged_user = Auth::user();
        } else {
          return redirect('login');
        }
        
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
        $post_data['is_admin']= $this->logged_user->is_admin;

        return  $this->jobpostServiceProvider->createJob($post_data, $this->logged_user);

    }

    public function userJobList(Request $request){
        if (Auth::user() != NULL) {
          $this->logged_user = Auth::user();
        } else {
          return redirect('login');
        }
        
        $post_data = $request->all();

        $paging['page_num']  = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order']   = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('orderby', '0');
        $filters['userid']   =  $this->logged_user->id;
        $filters['is_admin']   =  $this->logged_user->is_admin;
        if((isset($post_data['name']))){
            $filters['name'] =   $post_data['name'];
        } else {
          $filters['name'] = '';
        }
        if((isset($post_data['location']))){
            $filters['location'] =   $post_data['location'];
        } else {
          $filters['location'] = '';
        }
        if((isset($post_data['category']))){
            $filters['category'] =   $post_data['category'];
        } else {
          $filters['category'] = '';
        }
        if((isset($post_data['type']))){
            $filters['type'] =   $post_data['type'];
        } else {
          $filters['type'] = '';
        }
        $my_jobs=  $this->jobpostServiceProvider->userJobList($filters,$order_by,$paging);

        return view ('frontend.job.user_job_listing',array('my_jobs'=>$my_jobs));
    }

    public function userAppliedJobs(Request $request){
        if (Auth::user() != NULL) {
          $this->logged_user = Auth::user();
        } else {
          return redirect('login');
        }
        
        $post_data = $request->all();

        $paging['page_num']  = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order']   = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('orderby', '0');
        $filters['userid']   =  $this->logged_user->id;
        $filters['is_admin']   =  $this->logged_user->is_admin;
        if((isset($post_data['name']))){
            $filters['name'] =   $post_data['name'];
        } else {
          $filters['name'] = '';
        }
        if((isset($post_data['location']))){
            $filters['location'] =   $post_data['location'];
        } else {
          $filters['location'] = '';
        }
        if((isset($post_data['message']))){
            $filters['message'] =   $post_data['message'];
        } else {
          $filters['message'] = '';
        }
        if((isset($post_data['type']))){
            $filters['type'] =   $post_data['type'];
        } else {
          $filters['type'] = '';
        }
        $my_applied_jobs=  $this->jobpostServiceProvider->userAppliedJobs($filters,$order_by,$paging);

        return view ('frontend.job.user_applied_jobs',array('my_applied_jobs'=>$my_applied_jobs));
    }

    public function jobProposalsList(Request $request, $id){
        if (Auth::user() != NULL) {
          $this->logged_user = Auth::user();
        } else {
          return redirect('login');
        }
        //$input = $request->only('id');

        $paging['page_num']  = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order']   = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('orderby', '0');
        $filters['userid']   =  $this->logged_user->id;
        $filters['is_admin']   =  $this->logged_user->is_admin;
        $filters['job_id']   =  $id;
        if((isset($post_data['name']))){
            $filters['name'] =   $post_data['name'];
        } else {
          $filters['name'] = '';
        }
        if((isset($post_data['location']))){
            $filters['location'] =   $post_data['location'];
        } else {
          $filters['location'] = '';
        }
        $job_proposals=  $this->jobpostServiceProvider->jobProposalsList($filters,$order_by,$paging);

        return view ('frontend.job.job_proposals',array('job_proposals'=>$job_proposals));
    }

    public function delJob(Request $request){
        $post_data = $request->all();
        return  $this->jobpostServiceProvider->jobDelByJobId($post_data['job_id']);
    }

    public function searchJob(Request $request){
        if (Auth::user() != NULL) {
          $this->logged_user = Auth::user();
        } else {
          return redirect('login');
        }
        $post_data = $request->all();
        $paging['page_num']  = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order']   = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('orderby', '0');
        $filters['userid']   = $this->logged_user->id;
        $filters['search']   = $request->input('search','');
        $filters['search_by']   = $request->input('search_by','');
        $all_jobs=  $this->jobpostServiceProvider->allJobList($filters,$order_by,$paging);
        if ($request->ajax()) {
            $view = view('frontend.job.job_search_part')->with(
                [ 'all_jobs' => $all_jobs]
            );
            $response = array(
                'code' => 200,
                'status' => 'ok',
                'rows' => $view->render()
            );
            return response(json_encode($response))->header('Content-Type', 'json');
        }
        return view('frontend.job.job_search',array('all_jobs'=>$all_jobs));
     }

    public function viewJob(Request $request, $id){

      if (Auth::user() != NULL) {
        $this->logged_user = Auth::user();
      } else {
        return redirect('login');
      }

        $this->networkServiceProvider = new NetworkServiceProvider();
        $this->commentServiceProvider = new CommentServiceProvider();
       if($id){
            $post_data = $request->all();

            $job =  $this->jobpostServiceProvider->getJobByJobId($id);
           $user = User::where('id', '=' , $job->userid)->firstOrFail();

            if (count($post_data) > 0) {
              $post_data['user_id'] = $this->logged_user->id;
              $post_data['job_id']  = $job->id;
              return $this->jobpostServiceProvider->applyJob($post_data);

            } else {
                $job_comments =$this->commentServiceProvider->getJobComments($id);

                 $user_array=array();
                 if($job->role=='tradesman'){
                     $td_ob = Tradesman::where('userid', '=' , $job->userid)->firstOrFail();
                     $user_array['name']= $job->first_name." ".$job->last_name;
                     $user_array['desc']= $td_ob->background;
                 }else if($job->role=='employee'){
                     $td_ob = Employee::where('userid', '=' , $job->userid)->firstOrFail();
                     $user_array['name']= $job->first_name." ".$job->last_name;
                     $user_array['desc']= $td_ob->summary;
                 }else if($job->role=='employer'){
                     $td_ob = Employer::where('userid', '=' , $job->userid)->firstOrFail();
                     $user_array['name']= $td_ob->company_name;
                     $user_array['desc']= $td_ob->description;
                 } else {
                    $user_array['name']= '';
                     $user_array['desc']= '';
                 }

                 $user_array['url'] =$this->networkServiceProvider->getViewUrl($user);
                 $user_array['image'] =($job->image != null)?$job->image:'';
                 $user_array['userid'] =$user->id;

                 return view('frontend.job.job_view',array('job'=>$job,'user_array'=>$user_array,'user'=> $this->logged_user,'job_comments'=>$job_comments));
            }
       }

    }

    public function applyJob(Request $request){
      if (Auth::user() != NULL) {
        $this->logged_user = Auth::user();
      }
      $post_data= $request->all();
      $post_data['user_id']=$this->logged_user->id;
     return $this->jobpostServiceProvider->applyJob($post_data);

    }

    public function payment(Request $request){
      if (Auth::user() != NULL) {
        $this->logged_user = Auth::user();
      }
      $post_data= $request->all();
      $post_data['user_id']=$this->logged_user->id;
     return $this->jobpostServiceProvider->payment($post_data);

    }

    public function askRefund(Request $request){
      if (Auth::user() != NULL) {
        $this->logged_user = Auth::user();
      }
      $post_data= $request->all();
      $post_data['user_id']=$this->logged_user->id;
     return $this->jobpostServiceProvider->askRefund($post_data);

    }

    public function userTransactions(Request $request){
        if (Auth::user() != NULL) {
          $this->logged_user = Auth::user();
        } else {
          return redirect('login');
        }
        
        $post_data = $request->all();

        $paging['page_num']  = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order']   = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('orderby', '0');
        $filters['userid']   =  $this->logged_user->id;
        $filters['is_admin']   =  $this->logged_user->is_admin;
        if((isset($post_data['start_date']))){
            $filters['start_date'] =   $post_data['start_date'];
        } else {
          $filters['start_date'] = '';
        }
        if((isset($post_data['end_date']))){
            $filters['end_date'] =   $post_data['end_date'];
        } else {
          $filters['end_date'] = '';
        }
        $my_transactions =  $this->jobpostServiceProvider->userTransactions($filters,$order_by,$paging);

        return view ('frontend.job.user_transactions',array('my_transactions'=>$my_transactions));
    }
}



