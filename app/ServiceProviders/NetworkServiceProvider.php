<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:52 AM
 */


namespace BusinessLogic;
use BusinessObject\UserSkill;
use Helper;
use  BusinessObject\User;
use  BusinessObject\Employee;
use  BusinessObject\Employer;
use  BusinessObject\Tradesman;
use  BusinessObject\Education;
use  BusinessObject\Experience;
use  BusinessObject\Recommendation;
use Validator;
use DB;

class NetworkServiceProvider
{
    public function sendRecommendation($data){
        $rec = new Recommendation();
        $rec->sender_id = $data['sender_id'];
        $rec->reciever_id = $data['rec_id'];
        $rec->message = $data['message'];
        $rec->relationship = $data['relationship'];
        $rec->status = 'pending';
        $rec->save();

        //Receiver Data
        $receiver_data = User::where('id', '=' , $data['rec_id'])->firstOrFail();
        $data['reciever_email']=$receiver_data->email;
        // Sender Email
        $sender_data = User::where('id', '=' , $data['sender_id'])->firstOrFail();
        $data['sender_email']=$sender_data->email;
        $data['sender_first_name']=$sender_data->first_name;
        $data['sender_last_name']=$sender_data->last_name;
        $data['rec_id']=$rec->id;

        $response = $this->sendRecommendationEmail($data);
        if ($response["code"] == '200') {
            return array(
                'code' => '200',
                'status' => 'ok',
                'msg' => "Email of recommendation has been sent successfully."
            );
        }
    }

    public function getRecommendation($userid,$rec_id){

        $matchThese = ["id"=>$rec_id,"status" =>'pending','reciever_id'=>$userid];
        return   Recommendation::where($matchThese)->firstOrFail();
    }

    public function acceptRecommendation($user,$rec_id){
        $matchThese = ["id"=>$rec_id,"status" =>'pending','reciever_id'=>$user->id];
       // $matchThese = ["id"=>$rec_id,'reciever_id'=>$user->id];
        $rec = Recommendation::where($matchThese)->firstOrFail();
        $rec->status='accept';
        $rec->update();

        return $this->getViewUrl($user);
    }

    public function rejectRecommendation($user,$rec_id){
        $matchThese = ["id"=>$rec_id,"status" =>'pending','reciever_id'=>$user->id];
        // $matchThese = ["id"=>$rec_id,'reciever_id'=>$user->id];
        $rec = Recommendation::where($matchThese)->firstOrFail();
        $rec->status='reject';
        $rec->update();
      return $this->getViewUrl($user);

    }
    public function getViewUrl($user){

       // print_r($user->id);

        if($user->role=='employee'){
           $employee = Employee::where('userid', '=' , $user->id)->firstOrFail();

            return "employee/view/".$employee->id;
        }

        if($user->role=='employer'){
            $employer = Employer::where('userid', '=' , $user->id)->firstOrFail();
            return "employer/view/".$employer->id;
        }
        if($user->role=='tradesman'){

            $tradesman = Tradesman::where('userid', '=' , $user->id)->firstOrFail();
            return "tradesman/view/".$tradesman->id;
        }
    }

    public function sendRecommendationEmail($data){
        $to = $data["reciever_email"];
        $subject = "Sababoo's - Recommendation Email";
        $from = $data['sender_email'];
        $data = [
            "from" => $from,
            "to" => $to,
            "subject" => $subject,
            "SERVER_PATH" => env('CDN_URL'),
            "rec_id" => $data['rec_id'],
            'sender_first_name'=>$data['sender_first_name'],
            'sender_last_name'=>$data['sender_last_name'],

        ];
//dd($data);
        $mail_response = Helper::sendEmail(
            $data,
            ['email_templates/recommendation_html', 'email_templates/recommendation_text']
        );
        return $mail_response;

    }

    public function getUsersAllRecommendation($userid){

      //  dd($userid);
        $matchThese=['recommendation.reciever_id'=>$userid,'recommendation.status'=>'accept'];
        $jobs = DB::table('recommendation')
            ->select('recommendation.sender_id','recommendation.reciever_id','recommendation.message','recommendation.relationship','recommendation.status','recommendation.created_at')
            ->join('users', 'recommendation.reciever_id', '=','users.id' )
            ->where($matchThese)
            ->get();

      if(count($jobs)>0){

          foreach($jobs as $job){

              $matchThese=['recommendation.sender_id'=>$job->sender_id];
              $sender_info = DB::table('recommendation')
                  ->select('users.*')
                  ->join('users', 'recommendation.sender_id', '=','users.id' )
                  ->where($matchThese)
                  ->first();
              $job->sender_id=$sender_info;


          }

      }
        return $jobs;
    }

    public function getSuggestion($filter){


        $suggest_array=array();
        if(!empty($filter['name'])){

        $name = $filter['name'];
        $role = $filter['roll'];

        $data = User::where('id','!=',$filter['id'])
            ->where('role','!=','employer')
            ->where('status','=', 'enabled')
            ->Where("email", "LIKE", "%".$name."%")
            ->orWhere("first_name","LIKE", "%".$name."%")
            ->orWhere("last_name","LIKE", "%".$name."%")

            ->Where("role","=", $role)
            ->OrderBy('created_at', 'DESC')
            ->get();

        }else{

            $data = User::where('id', '!=', $filter['id'])
                ->where('status', '=', 'enabled')
                ->where('role', '!=', 'employer')
                ->OrderBy('created_at', 'DESC')
                ->get();
        }
dd($data);

        foreach($data as $single_data){
            if($single_data->role=='employer'){
                continue;
            }
            $single_data->postal_code =$this->getViewUrl($single_data);
             $suggest_array['data'][]=$single_data;
        }


        return  $suggest_array;


/*       if(count($data)>0){
           foreach($data as $single_data){

               if($single_data->role=='employer'){
                   $emp= $this->getEmployerNameByUSerId($single_data->id);

                   if(isset($emp->company_name)){
                       $single_data->first_name=$emp->company_name;
                   }

                  // dd($single_data->first_name);
                   $suggest_array['employer'][]=$single_data;

               }
               if($single_data->role=='employee'){

                   $suggest_array['employee'][]=$single_data;
               }
               if($single_data->role=='tradesman'){

                   $suggest_array['tradesman'][]=$single_data;
               }
         }

       }
        //dd($suggest_array);
        return $suggest_array;*/
     }

    /*Get Company Name*/
    public function getEmployerNameByUSerId($userid){
        $data = Employer::where('userid', '=', $userid) ->first();
        return $data;

    }
}
