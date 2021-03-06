<?php


namespace BusinessLogic;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use  BusinessObject\User;
use  BusinessObject\Employee;
use  BusinessObject\Employer;
use  BusinessObject\Tradesman;
use Validator;
use Helper;
use DB;



class RegisterServiceProvider 
{
    
    public function createUser($data){

       if($data['email']){
           if (User::where('email', '=', $data['email'])->exists()) {
               return array(
                   'code' => '800',
                   'status' => 'error',
                   'msg' => "Email  already exists."
               );
           }
       }
        

        // Validate the request...
           $email_verify_code = $this->utilGetVerifyString();
        try {
            $user = new User;
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->password = bcrypt($data['password']);
            $user->email = $data['email'];
            $user->role = $data['role'];
            $user->created_at = new \DateTime();
            $user->updated_at = new \DateTime();
            $user->verified_string='unverified';
            $user->status='disabled';
            $user->activation_token = $email_verify_code;
            $user->save();
           
        $response = $this->sendSignupEmail($data,$email_verify_code);
          if ($response["code"] == '200') {
              return array(
                  'code' => '200',
                  'status' => 'ok',
                  'msg' => "Please check your email to activate your profile."
              );
          }
          return $response;

       }catch (\Exception $e) {
          return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
       }
    }

   
    /**
     * @param $user_data
     * @return array
     */
    public function activateUser($user_data){

          if($user_data['e']){
            $res= User::where('activation_token', '=', $user_data['e'])->exists();
            if (!$res) {
               return array(
                   'code' => '800',
                   'status' => 'error',
                   'msg' => "Email  already exists."
               );
            }

            $matchThese = ['activation_token'=>$user_data['e']];
            $user = DB::table('users')->select('*')->where($matchThese)->first();

        
          if($user->verified_string == "verified" ){
             return
                 array(
                  'code'      => 1000,
                  'status'    => "error",
                  'msg'       => "Account Already Verified.");
          }

            $user = User::find($user->id);
            $user->updated_at = new \DateTime();
            $user->verified_string='verified';
            $user->status='enabled';
            
            $user->save();

              if($user->role=='employee'){
                  $employee = new Employee;
                  $employee->userid=$user->id;
                  $employee->save();
              }

              if($user->role=='employer'){
                  $employer = new Employer;
                  $employer->userid=$user->id;
                  $employer->save();
              }

              if($user->role=='tradesman'){
                  $tradesman = new Tradesman;
                  $tradesman->userid=$user->id;
                  $tradesman->save();
              }


            $response['code'] = 200;
            $response['msg'] = 'Account has been verified.';
            $response['status'] = 'ok';
            return $response;
        }
          $response['code'] = 400;
          $response['msg'] = 'Please re verify your account.';
          $response['status'] = 'error';
          return $response;
}

    /**
     * @param $user_data
     * @param $email_verify_code
     * @return mixed
     */
    public function sendSignupEmail($user_data,$email_verify_code ){
        $to = $user_data["email"];
        $subject = "Sababoo's - New Account Activation / " . $user_data['email'];
        $from = "noreply@sababoo.com";

        $data = [
            "from" => $from,
            "to" => $to,
            "subject" => $subject,
            "firstname" => $user_data["first_name"],
            "lastname" => $user_data["last_name"],
            "verifycode" => $email_verify_code,
            "password" => $user_data['password'],
            "email" => $user_data['email'],
            "SERVER_PATH" => env('CDN_URL')

        ];
        
        $mail_response = Helper::sendEmail(
            $data,
            ['email_templates/signup_html', 'email_templates/signup_text']
        );
        return $mail_response;

    }
  
    /**
     * Generating random verification string
     * @return string
     */
    public function utilGetVerifyString() {
        $t=time();
        $str= "v".$t."Z".rand(21,99).rand(400,999).rand(1,9).rand(11,88).rand(7000,9999).rand(41000,99999);
        return $str;
    }

   
}
