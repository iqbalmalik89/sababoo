<?php
namespace App\Helpers;

use Mail;

class Helper
{
    /*Suresh Kumar
    * General Send email method 
    */
   public static function sendEmail($mail_data = [], $template = [])
    {
        try {
           
            $mail_status = Mail::send($template, $mail_data, function ($message) use ($mail_data) {

                $message->from($mail_data['from']);
                if (env('TEST_EMAIL', false)) {
                    $message->to(env('TEST_EMAIL', false))->subject($mail_data['subject']);
                    if(isset($mail_data['bcc'])) {
                        $message->bcc(env('TEST_EMAIL', false));
                    }
                } else {
                    $message->to($mail_data['to'])->subject($mail_data['subject']);
                    if(isset($mail_data['bcc'])) {
                        $message->bcc($mail_data['bcc']);
                    }
                }

                if(isset($mail_data['attachments'])){
                    foreach($mail_data['attachments'] as $attachment){
                        $message->attach($attachment);
                    }
                }

            });

            $response['code'] = 200;
            $response['status'] = 'ok';
            $response['msg'] = $mail_status;
            return $response;

        } catch (\Exception $e) {
            return [
              'code' => 1000,
              'status' => 'error',
              'msg' => $e->getMessage()
            ];
        }
    }

   
}
