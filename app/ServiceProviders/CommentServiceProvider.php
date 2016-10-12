<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:52 AM
 */


namespace BusinessLogic;
use BusinessObject\JobComments;
use Helper;
use  BusinessObject\User;
use  BusinessObject\UserSkill;
use  BusinessObject\Skill;
use Validator;
use DB;

class CommentServiceProvider{


    public function addComments($data){
        $com = new JobComments();
        $com->commenter_id  = $data['commenter_id'];
        $com->job_id        = $data['jobid'];
        $com->comments      = $data['comment'];
        $com->save();
        return array(
            'code' => '200',
            'status' => 'ok',
            'msg' => "Comments added successfully.",
            'data'=>$com

        );

    }

    public function updateComments($data){

        $com = JobComments::find($data['comment_id']);
        $com->comments=$data['comment'];
        $com->update();
        return array(
            'code' => '200',
            'status' => 'ok',
            'msg' => "Comment updated successfully.",
            'data'=>$com


        );

    }

    public function getJobComments($job_id){
        $matchThese = ["job_comments.status" =>1,'job_id'=>$job_id];
        $job_com = DB::table('job_comments')
            ->select('job_comments.*','users.id as userid','users.first_name','users.last_name','users.image','users.role')
            ->where($matchThese)
            ->join('users', 'job_comments.commenter_id', '=','users.id' )
            ->get();

        if(count($job_com)>0){

            foreach($job_com as $job){
               $job->name = $job->first_name . " ".$job->last_name;

                if($job->role=='employer'){
                    $td_ob = Employer::where('userid', '=' , $job->userid)->firstOrFail();
                    $job->name = $td_ob->comapny_name;
                }
            }
        }
        return $job_com;
   }

   public function deleteComments($data){
   $com = JobComments::find($data['comment_id']);
       $com->delete();
       return array(
           'code' => '200',
           'status' => 'ok',
           'msg' => "Comment updated successfully.",



       );

   }
}
