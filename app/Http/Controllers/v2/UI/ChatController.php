<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 24/08/2016
 * Time: 10:32 AM
 */


namespace App\Http\Controllers\UI;
use App\Http\Controllers\Controller;
use BusinessLogic\UserServiceProvider;
use BusinessLogic\ChatServiceProvider;
use BusinessObject\UserFiles;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;
use Hash;
use Validator;

use  BusinessObject\User;


class ChatController extends Controller
{
    private $userServiceProvider;
    public function __construct()
    {
        //$this->middleware('auth');
        $this->userServiceProvider = new UserServiceProvider();
        $this->chatServiceProvider = new ChatServiceProvider();
    }

    public function index($id){
        if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $send_to_user  = User::where('id', '=' , $id)->firstOrFail();
        return view('frontend.chat.sendMessage',['send_to_user'=>$send_to_user,'logged_user'=>$this->logged_user]);
    }
    public function SendMessage(Request $request){
        if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $post_data = $request->all();
        $post_data['userid']=$this->logged_user->id;
        return  $this->chatServiceProvider->SaveMessage($post_data);
    }

    public function viewMessages(Request$request){
        if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $all_messages =   $this->chatServiceProvider->getMessage($this->logged_user->id);
        $update_count_message = $this->chatServiceProvider->countUnreadMessage($this->logged_user->id);
        $user_rec   =  $this->chatServiceProvider->getUserList($this->logged_user->id);
        $user_send  =  $this->chatServiceProvider->getUserListSender($this->logged_user->id);

        //dd('sender',$user_rec,'rec',$user_send);
        $user_list  = array();
        if($user_rec){
            foreach($user_rec as $key =>$val){
                $user_list[$val->email]=$val;
            }
        }

        if($user_send){
            foreach($user_send as $key =>$val){
                $user_list[$val->email]=$val;
            }
        }

        return view('frontend.chat.viewMessage',['all_messages'=>$all_messages,'update_count_message'=>$update_count_message,'userinfo'=>$this->logged_user,'sender_data'=> $user_list]);
     }
    public function viewMessagesJason(Request $request){
        if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $get_unread_message = $this->chatServiceProvider->countUnreadMessage($this->logged_user->id);
        return json_encode($get_unread_message);
    }
    public function getUserMessageById(Request $request){
        if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $post_data = $request->all();
        $post_data['userid']=$this->logged_user->id;
        return array('code'=>200, 'status'=>'ok','data'=>$this->chatServiceProvider->getUserMessageById($post_data));
    }

    public function saveUserMessage(Request $request){
        if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $post_data = $request->all();
        return $this->chatServiceProvider->SaveMessage($post_data);
    }
    public function getLoggedUserMessage(Request $request){
        if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $post_data = $request->all();
        return $this->chatServiceProvider->getLoggedUserMessage($post_data);

    }

    public function checkRequest(Request $request){
      if (Auth::user() != NULL) {
        $this->logged_user = Auth::user();
      }
      $post_data= $request->all();
      $post_data['user_id']=$this->logged_user->id;
     return $this->chatServiceProvider->checkRequest($post_data);

    }

    public function sendRequest(Request $request){
      if (Auth::user() != NULL) {
        $this->logged_user = Auth::user();
      }
      $post_data= $request->all();
      $post_data['user_id']=$this->logged_user->id;
     return $this->chatServiceProvider->sendRequest($post_data);

    }

    public function actionRequest(Request $request){
      if (Auth::user() != NULL) {
        $this->logged_user = Auth::user();
      }
      $post_data= $request->all();
      $post_data['user_id']=$this->logged_user->id;
     return $this->chatServiceProvider->actionRequest($post_data);

    }

    public function allRequests(Request $request){
        if (Auth::user() != NULL) {
          $this->logged_user = Auth::user();
        } else {
          return redirect('login');
        }
        
        $post_data = $request->all();

        $paging['page_num']  = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order']   = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('orderby', '0');
        $filters['userid']   =  $this->logged_user->id;
        
        $requests=  $this->chatServiceProvider->allRequests($filters,$order_by,$paging);

        return view ('frontend.chat.message_requests',array('requests'=>$requests));
    }
}
