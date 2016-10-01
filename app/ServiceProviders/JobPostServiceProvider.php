<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:52 AM
 */


namespace BusinessLogic;
use Helper;
use  BusinessObject\User;
use  BusinessObject\Language;
use  BusinessObject\JobPost;
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
            $job->job_deadline_date 		= $job_deadline;
            $job->update();
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

        $job->save();
        return array(
            'code' => '200',
            'status' => 'ok',
            'msg' => "Job created successfully.",

        );

    }


    public function userJobList($filters, $orderby = ['order' => "", 'sort_by' => ""], $paging = ["page_num" => 1, "page_size" => 0]){

        $matchThese = ["job_post.userid"=>$filters['userid'],"job_post.status" =>1];

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
            ->select('job_post.*','industry.id as ind_id','industry.name as ind_name')
            ->join('industry', 'job_post.industry_id', '=','industry.id' )
            ->where($matchThese)
            ->first();
        return $job;
    }

    public function jobDelByJobId($jobid){
        $job = JobPost::find($jobid);
        $job->status 	  = 2;
        $job->update();
        return array(
            'code' => '200',
            'status' => 'ok',
            'msg' => "Job deleted successfully.",

        );
    }

    public function getJobTerms($data){
        return "test";

    }








}
