<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:49 AM
 */



namespace App\Http\Controllers\UI;
use App\Http\Controllers\Controller;

use BusinessLogic\UserServiceProvider;
use BusinessLogic\NetworkServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;
use Validator;
use  BusinessObject\User;

class NetworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->logged_user = Auth::user();
        $this->networkServiceProvider = new NetworkServiceProvider();

    }

    public function myConnections(Request $request){
        $this->logged_user = Auth::user();

        return view('frontend.mynetwork.connection',array('logged_user'=> $this->logged_user));

    }

    public function sendRecom(Request $request){
        $post_data = $request->all();
        $this->logged_user = Auth::user();
        parse_str($post_data['frm_data'],$form_data);
        $validate_array = array(
            'message'         => "required",
             );
        $validation_res = Validate::validateMe($form_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        $form_data['sender_id'] =$this->logged_user->id;
        return  $this->networkServiceProvider->sendRecommendation($form_data);
     }

    public function getRecom($id){
        $this->logged_user = Auth::user();
        $get_user_rec = $this->networkServiceProvider->getRecommendation($this->logged_user->id,$id);
        $sender_data = User::where('id', '=' , $get_user_rec->sender_id)->firstOrFail();
        return view('frontend.mynetwork.read_recommendation',array('user_recom'=>$get_user_rec ,'sender_data'=>$sender_data));
    }

    public function acceptRecom($id){

        $this->logged_user = Auth::user();
        $get_user_rec = $this->networkServiceProvider->acceptRecommendation($this->logged_user,$id);
        return redirect($get_user_rec);
    }
    public function rejectRecom($id){
        $this->logged_user = Auth::user();
        $get_user_rec = $this->networkServiceProvider->rejectRecommendation($this->logged_user,$id);
        return redirect($get_user_rec);
    }

    public function getPeopleList(Request $request){
        return view('frontend.mynetwork.findpeople');

    }
}



