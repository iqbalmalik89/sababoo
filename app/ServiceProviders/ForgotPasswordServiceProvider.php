<?php
/**
 * User: Suresh Kumar
 *
 * Forgot password page service provider
 */

namespace BusinessLogic;
use Helper;
use  BusinessObject\User;
use Validator;
use DB;

class ForgotPasswordServiceProvider
{
    /**
     * @param $username
     * @return array
     */
    public function sendPassword($email){

        if ($email == "") {
            return [
              'code' => 1000,
              'status' => 'error',
              'msg' => trans('messages.email_required'),
            ];
        }

        if (User::where('email', '=', $email)->exists()) {
               
            $matchThese = ['email'=>$email];
            $user = DB::table('users')->select('*')->where($matchThese)->first();
            $user = User::find($user->id);
            $random_password = "vZ".rand(21,99).rand(400,999).rand(1,9);
            $user->password=bcrypt($random_password);
            $user->updated_at = new \DateTime();
            $user->save();
            return $this->sendEmail($user,$random_password);
     
        }
        return [
          'code' => 1000,
          'status' => 'error',
          'msg' => 'Email address is not valid.',
        ];
    }

    /**
     * @param $user
     * @return mixed
     */
    public function sendEmail($user,$random_password)
    {
       
        $to = $user->email;
        $subject = "Forgot Your Password?";
        $from = "noreply@sababoo.com";

        $data = [
          "from" => $from,
          "to" => env('TEST_EMAIL', $to),
          "subject" => $subject,
          "email" => $user->email,
          "password" => $random_password,

        ];

        $mail_response = Helper::sendEmail(
          $data,
          ['email_templates/forget_password_html', 'email_templates/forget_password_text']
        );
        $response=$mail_response;

        if($response['code']==200){
            $response['msg']=trans('messages.forgotpw_success');
            return $response;
        }
        return $response;
    }

}
