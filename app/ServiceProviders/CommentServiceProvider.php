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
use  BusinessObject\Employer;
use  BusinessObject\JobPost;
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

    public function sendCommentEmail($data){
        $this->sendNotificationEmail($data);
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

   public function sendNotificationEmail($data){

       $receiver_job = JobPost::where(array('id'=>$data['jobid']))->first();
       $receiver_data = User::where(array('id'=>$receiver_job->userid))->first();
       $sender_data = User::where(array('id'=>$data['commenter_id']))->first();
       #$data['to']  = $receiver_data->email;

       $subject = "Sababoo's - Comment on your job by " . $sender_data->email;
       $from = "noreply@sababoo.com";

       $data = [
           "from"           => $from,
           "to"             => $receiver_data->email,
           "subject"        => $subject,
           "sender_email"   => $sender_data->email,
           "comments"       =>$data['comment'],
           "SERVER_PATH"    => env('URL'),
           "jobid"          =>  $data['jobid']

       ];

       $mail_response = Helper::sendEmail(
           $data,
           ['email_templates/jobcomment_html', 'email_templates/jobcomment_text']
       );



   }
}
