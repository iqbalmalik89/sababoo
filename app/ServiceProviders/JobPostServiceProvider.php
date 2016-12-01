<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:52 AM
 */


namespace BusinessLogic;
use Helper;
use Illuminate\Support\Facades\Cache;
use  BusinessObject\User;
use  BusinessObject\Language;
use  BusinessObject\JobPost;
use  App\Models\AppliedJob;
use Validator;
use DB;


class JobPostServiceProvider
{



    public function createJob($data){
        $job_deadline = $data['job_day']."-".$data['job_month']."-".$data['job_year'];


        if($data['jobid']){
            $job = JobPost::find($data['jobid']);
            if(isset($data['userid'])){ 		        $job->userid 		            = $data['userid']; }
            if(isset($data['title'])){ 		            $job->name 		                = $data['title']; }
            if(isset($data['description'])){ 		    $job->description 		        = $data['description']; }
            if(isset($data['job_type'])){ 		        $job->type 		                = $data['job_type']; }
            if(isset($data['location'])){ 		        $job->location 		            = $data['location']; }
            if(isset($data['salary'])){ 		        $job->salary 		            = $data['salary']; }
            if(isset($data['requirement'])){ 		    $job->requirement 		        = $data['requirement']; }
            if(isset($data['responsibilites'])){ 		$job->responsibilites 		    = $data['responsibilites']; }
            if(isset($data['experience'])){ 		    $job->experience 		        = $data['experience']; }
            if(isset($data['industry_id'])){ 		    $job->industry_id 		        = $data['industry_id']; }
            if(isset($data['all_terms'])){ 		        $job->terms 		            = $data['all_terms']; }

            if ($job->is_admin_job == 1) {
                if(isset($data['is_admin'])){               $job->is_admin_job              = $data['is_admin']; }    
            }
            
            $job->job_deadline_date 		= $job_deadline;
            $job->update();
            Cache::forget('job-'.$job->id);
            return array(
                'code' => '200',
                'status' => 'ok',
                'msg' => "Job update successfully.",

            );
        }

//dd($data);
        $job = new JobPost;
        $job->userid        = $data['userid'];
        $job->name          = $data['title'];
        $job->description   = strip_tags($data['description']);
        $job->type          = $data['job_type'];
        $job->location      = $data['location'];
        $job->salary        = $data['salary'];
        $job->requirement   = strip_tags($data['requirement']);
        $job->responsibilites = strip_tags($data['responsibilites']);
        $job->experience      = $data['experience'];
        $job->industry_id     = $data['industry'];
        $job->job_deadline_date = $job_deadline;
        $job->terms 		  = $data['all_terms'];
        $job->is_admin_job    = $data['is_admin'];

        $job->save();
        return array(
            'code' => '200',
            'status' => 'ok',
            'msg' => "Job created successfully.",

        );

    }


    public function userJobList($filters, $orderby = ['order' => "", 'sort_by' => ""], $paging = ["page_num" => 1, "page_size" => 0]){

        $matchThese = ["job_post.userid"=>$filters['userid'],"job_post.is_active" =>1, "is_admin_job"=>$filters['is_admin'], "deleted_at"=>NULL];

        $name = isset($filters['name'])?$filters['name']:'';
        $loc = isset($filters['location'])?$filters['location']:'';

        /*if(isset($filters['name']) and $filters['name']!=''){
           // $matchThese['job_post.name'] = $filters['name'];
            //$matchThese['job_post.name'] = " 'job_post.name', 'LIKE', '%'".$filters['name']."'%' ";

        }*/


       /* if(isset($filters['location']) and $filters['location']!=''){
           // $matchThese['job_post.location'] = $filters['location'];
           // $matchThese['job_post.location'] = 'job_post.location', 'LIKE', '%'.$tag.'%';

        }*/
       //dd($matchThese);
      $str = '';
      foreach($matchThese as $key=>$value){

            if($key =='job_post.location'){
                $str.="job_post.location LIKE '%$value%' and ";
            }
         elseif($key =='job_post.name'){
              $str.="job_post.name LIKE '%$value%' and ";
          }else{
                $str.=" '$key'= '$value' and " ;

            }

      }


        $job = DB::table('job_post')
            ->select('job_post.id as id','job_post.name as name','job_post.type as type','job_post.location as location','job_post.job_deadline_date','job_post.created_at','industry.id as ind_id','industry.name as ind_name')
            ->join('industry', 'job_post.industry_id', '=','industry.id' )
            ->where($matchThese)
            ->Where("job_post.name", "LIKE", "%$name%")
            ->Where("job_post.location", "LIKE", "%$loc%")
            ->OrderBy('job_post.created_at', 'DESC')
        //dd( count($job) );
        ->paginate($paging['page_size']);
  //dd(DB::getQueryLog());

        return $job;
     }


    public function getJobByJobId($jobid){
        $matchThese = ['job_post.id'=>$jobid];
        $job = DB::table('job_post')
            ->select('job_post.*','industry.id as ind_id','industry.name as ind_name','users.first_name','users.last_name','users.id as userid','users.image','users.role')
            ->join('industry', 'job_post.industry_id', '=','industry.id' )
            ->join('users', 'job_post.userid', '=','users.id' )
            ->where($matchThese)
            ->first();
        return $job;
    }

    public function jobDelByJobId($jobid){
        $job = JobPost::find($jobid);
        /*$job->status      = 2;
        $job->update();*/
        if ($job != NULL) {
            $job->delete();
            return array(
                'code' => '200',
                'status' => 'ok',
                'msg' => "Job deleted successfully.",

            );
        }
        
    }

    public function allJobList($filters, $orderby = ['order' => "", 'sort_by' => ""], $paging = ["page_num" => 1, "page_size" => 0]){
        $name = null;
        $location = null;
        $type = null;
        $ind_name = null;
      //  dd($filters);
        if($filters['search_by']=='name'){
            $name = isset($filters['search'])?$filters['search']:'';
        }
        if($filters['search_by']=='location'){
            $location = isset($filters['search'])?$filters['search']:'';
        }
        if($filters['search_by']=='type'){
            $type = isset($filters['search'])?$filters['search']:'';
        }
        if($filters['search_by']=='category'){
            $ind_name = isset($filters['search'])?$filters['search']:'';
        }



        $matchThese = ["job_post.status" =>1, "job_post.is_active" =>1, "job_post.deleted_at" =>NULL];
        $job = DB::table('job_post')
            ->select('job_post.id as id','job_post.name as name','job_post.type as type','job_post.location as location','job_post.job_deadline_date','job_post.created_at','industry.id as ind_id','industry.name as ind_name')
            ->join('industry', 'job_post.industry_id', '=','industry.id' )
            ->where($matchThese)
            ->Where("job_post.userid", "!=", $filters['userid'])
            ->Where("job_post.name", "LIKE", "%$name%")
            ->Where("job_post.location", "LIKE", "%$location%")
            ->Where("job_post.type", "LIKE", "%$type%")
            ->Where("industry.name", "LIKE", "%$ind_name%")
            ->OrderBy('job_post.created_at', 'DESC')
            //dd( count($job) );
            ->paginate($paging['page_size']);
        //dd(DB::getQueryLog());
        return $job;
    }


    public function applyJob($post_data){

      $currentDate = date('Y-m-d');

       $job_post = JobPost::where(array('id'=>$post_data['job_id']))->first();
       
       $receiver_data = User::where(array('id'=>$job_post->userid))->first();
       $sender_data = User::where(array('id'=>$post_data['user_id']))->first();
       #$data['to']  = $receiver_data->email;

       $checkJob = AppliedJob::where('user_id', '=', $post_data['user_id'])->where('job_id', '=', $post_data['job_id'])->first();
       if ($checkJob == NULL) {

          if ($currentDate <= $job_post->job_deadline_date ) {

            $subject = "Sababoo's - Application on your posted job by " . $sender_data->email;
            $from = "noreply@sababoo.com";

             $data = [
                 "from"           => $from,
                 "to"             => 'nazbushi@gmail.com'/*$receiver_data->email*/,
                 "subject"        => $subject,
                 "sender_email"   => $sender_data->email,
                 "post_data"      =>$post_data,
                 "SERVER_PATH"    => env('URL'),
                 "job_id"         =>  $post_data['job_id'],
                 "user_id"         =>  $post_data['user_id']

             ];

             $mail_response = Helper::sendEmail(
                 $data,
                 ['email_templates/job_apply_html', 'email_templates/job_apply_text']
             );

             $jobApply = new AppliedJob;
             $jobApply->job_id = $data['job_id'];
             $jobApply->user_id = $data['user_id'];
             $jobApply->save();

             return array(
                  'code' => '200',
                  'status' => 'ok',
                  'msg' => "Job application has been subimtted successfully.",
              );

         } else {

            return array(
                  'code' => '406',
                  'status' => 'error',
                  'msg' => "Job has been expired, you cannot apply now.",

              );
         }  

       } else {
          return array(
                  'code' => '409',
                  'status' => 'error',
                  'msg' => "You have already applied for this job.",

              );
       }
           

   }






}
