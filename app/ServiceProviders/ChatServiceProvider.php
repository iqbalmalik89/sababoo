<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 24/08/2016
 * Time: 10:34 AM
 */

namespace BusinessLogic;
use BusinessObject\Certification;
use Helper;
use  BusinessObject\User;
use  BusinessObject\UserMessages;
use Validator;
use DB;

class ChatServiceProvider
{

    public function SaveMessage($data){
        try {

            $user_msg = new UserMessages();
            $user_msg->userid=$data['userid'];
            $user_msg->receiver_id=$data['send_to_user_id'];
            if(isset($data['subject'])){
                $user_msg->subject=$data['subject'];
            }
            $user_msg->message=$data['message'];
            $user_msg->save();
            return array('code'=>200,'status'=>'ok','msg'=>'success');


        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }
    }

    public function getMessage($recv_id){
        try {

            $matchThese = ['user_messages.status'=>1,'receiver_id'=>$recv_id];

            $usr_message = DB::table('user_messages')
                ->select('user_messages.id as id','user_messages.subject as subject','user_messages.message as message','user_messages.read_status as read_status','users.id as userid','users.email as email','users.first_name as first_name','users.last_name as last_name')
                ->join('users', 'user_messages.userid', '=','users.id' )
                ->where($matchThese)
                ->OrderBy('user_messages.created_at', 'DESC')
                ->limit(20)->get();
            return $usr_message;
        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }
    }
    public function getUserList($recv_id){

        $matchThese = ['user_messages.status'=>1,'receiver_id'=>$recv_id];
        //$matchThese1 = ['user_messages.userid'=>$recv_id];

        $usr_message = DB::table('user_messages')
            ->select('users.first_name','users.last_name','users.email','users.id as userid','users.image','user_messages.id as msg_id')
            ->rightjoin('users', 'user_messages.userid', '=','users.id' )
            ->where($matchThese)
            ->groupBy('users.id')
            ->OrderBy('user_messages.created_at', 'DESC')
            ->get();
            return $usr_message;
    }
    public function getUserListSender($recv_id){

/*
       $res =  DB::select(DB::raw("SELECT  senders.first_name 'From',recievers.first_name 'To', recievers.email,m.id,m.message
                                    FROM user_messages m
                                    INNER JOIN users senders ON m.userid = senders.id
                                    INNER JOIN users recievers ON m.receiver_id = recievers.id
                                    WHERE m.userid = 1 OR m.receiver_id = 1
                                    group by (senders.email)"));

        dd( $res );*/

        $matchThese = ['user_messages.status'=>1,'userid'=>$recv_id];
        //$matchThese1 = ['user_messages.userid'=>$recv_id];

        $usr_message = DB::table('user_messages')
            ->select('users.first_name','users.last_name','users.email','users.id as userid','users.image','user_messages.id as msg_id')
            ->rightjoin('users', 'user_messages.receiver_id', '=','users.id' )
            ->where($matchThese)
            ->groupBy('users.id')
            ->OrderBy('user_messages.created_at', 'DESC')
            ->get();
        return $usr_message;
    }

    public function countUnreadMessage($recv_id){

        try {

            $matchThese = ['user_messages.status'=>1,'receiver_id'=>$recv_id,'user_messages.read_status'=>1];

            $usr_message = DB::table('user_messages')
                ->select('user_messages.id as id','user_messages.subject as subject','user_messages.message as message','user_messages.read_status as read_status','users.id as userid','users.email as email','users.first_name as first_name','users.last_name as last_name')
                ->join('users', 'user_messages.userid', '=','users.id' )
                ->where($matchThese)
                ->OrderBy('user_messages.created_at', 'ASC')
                ->get()->count();
            return $usr_message;
        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }

    }
    public function getUnreadMessage($recv_id){

        try {

            $matchThese = ['user_messages.status'=>1,'receiver_id'=>$recv_id,'user_messages.read_status'=>1];

            $usr_message = DB::table('user_messages')
                ->select('user_messages.id as id','user_messages.subject as subject','user_messages.message as message','user_messages.read_status as read_status','users.id as userid','users.email as email','users.first_name as first_name','users.last_name as last_name')
                ->join('users', 'user_messages.userid', '=','users.id' )
                ->where($matchThese)
                ->OrderBy('user_messages.created_at', 'ASC')
                ->get();
            return $usr_message;
        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }
    }

    public function getUserMessageById($post_data){

        $matchThese = ['user_messages.status'=>1,'user_messages.receiver_id'=>$post_data['userid'],'user_messages.userid'=>$post_data['sender_id']];
        $matchThese1 = ['user_messages.receiver_id'=>$post_data['sender_id'],'user_messages.userid'=>$post_data['userid']];
        $usr_message = DB::table('user_messages')
            ->select('user_messages.userid as userid','user_messages.id as id','user_messages.subject as subject','user_messages.message as message','user_messages.read_status as read_status')
            ->where($matchThese)
            ->orWhere($matchThese1)
            ->OrderBy('user_messages.created_at', 'ASC')
            ->get();
        return $usr_message;
    }

    public function saveUserMessage($post_data){

    }


}