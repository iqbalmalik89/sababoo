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
//$mail_data['from']
                $message->from('jasonbourne501@gmail.com');
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

    /**
    * Paginate records
    *
    * @param $data array to display pagination block
    * @param $paginate obj on which paginate method is called
    *
    * @author By : Bushra Naz
    */
    public static function paginator($data, $paginate) {

        $data['pagination'] = [];
        $data['pagination']['to'] = $paginate->firstItem();
        $data['pagination']['from'] = $paginate->lastItem();
        $data['pagination']['total'] = $paginate->total();
        $data['pagination']['current'] = $paginate->currentPage();
        $data['pagination']['first'] = 1;
        $data['pagination']['last'] = $paginate->lastPage();

        if($paginate->hasMorePages()) {
            if ( $paginate->currentPage() == 1) {
                $data['pagination']['previous'] = 0;
                $data['pagination']['prev'] = 0;
            } else {
                $data['pagination']['previous'] = $paginate->currentPage()-1;
                $data['pagination']['prev'] = $paginate->currentPage()-1;
            }
            $data['pagination']['next'] = $paginate->currentPage()+1;
        } else {
            $data['pagination']['previous'] = $paginate->currentPage()-1;
            $data['pagination']['prev'] = $paginate->currentPage()-1;

            $data['pagination']['next'] =  -1;
        }
        if ($paginate->lastPage() > 1) {
            $data['pagination']['pages'] = range(1,$paginate->lastPage());
        } else {
            $data['pagination']['pages'] = [1];
        }

        // return data
        return $data;
    }
}
