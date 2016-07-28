<?php
/**
 * User: Suresh Kumar
 *
 * Forgot password page service provider
 */

namespace BusinessLogic;
use Helper;
class ForgotPasswordServiceProvider
{
    /**
     * @param $username
     * @return array
     */
    public function sendPassword($email)
    {

        if ($email == "") {
            return [
              'code' => 1000,
              'status' => 'error',
              'msg' => trans('messages.email_required'),
            ];
        }

        $dsql = "select user.username,user.password from BusinessObject\\AdcenterProfiles user
                where user.username=:username
        ";
        $sql_parts = ['dsql' => $dsql];
        $basic_dsql_parts = ['dsql' => "", "params" => ['username' => $username]];
        // Prepare basic valid arguments to work with
        $final_sql = array_merge($basic_dsql_parts, $sql_parts);
        $sql_obj = ["dql" => $final_sql['dsql'], "values" => $final_sql['params']];

        $rows = $this->getRows($sql_obj, ['sort_by' => "", 'order' => ""],
          ["page_num" => 1, "page_size" => 0], false);

        if ($rows["rows"]) {
            return $this->sendEmail($rows["rows"]);
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
    public function sendEmail($user)
    {
        $user = $user[0];
        $to = $user["username"];
        $subject = "Forgot Your Password?";
        $from = "noreply@sababoo.com";

        $data = [
          "from" => $from,
          "to" => env('TEST_EMAIL', $to),
          "subject" => $subject,
          "email" => $user["email"],
          "password" => $user['password'],

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
