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
        /*$this->middleware('auth');
        $this->logged_user = Auth::user();*/
        $this->networkServiceProvider = new NetworkServiceProvider();

    }

    public function myConnections(Request $request){

        if (Auth::guard('admin_users')->user() != NULL) {
            $this->logged_user = Auth::guard('admin_users')->user();
        } else if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $post_data = $request->all();


        $filter['id'] = $this->logged_user->id;
        $filter['name'] = isset($post_data['name'])?$post_data['name']:'';
        $filter['roll'] = isset($post_data['roll'])?$post_data['roll']:'';
        $user_suggestion =$this->networkServiceProvider->getSuggestion($filter);
        //dd($user_suggestion);
        if ($request->ajax()) {
            $view = view('frontend.mynetwork.recommedation_part')->with(
                [ 'user_suggestion' => $user_suggestion]
            );
            $response = array(
                'code' => 200,
                'status' => 'ok',
                'rows' => $view->render()
            );
            return response(json_encode($response))->header('Content-Type', 'json');
        }
        return view('frontend.mynetwork.connection',array('logged_user'=> $this->logged_user,'user_suggestion'=>$user_suggestion));
    }

    public function sendRecom(Request $request){
        $post_data = $request->all();
        if (Auth::guard('admin_users')->user() != NULL) {
            $this->logged_user = Auth::guard('admin_users')->user();
        } else if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
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
        if (Auth::guard('admin_users')->user() != NULL) {
            $this->logged_user = Auth::guard('admin_users')->user();
        } else if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $get_user_rec = $this->networkServiceProvider->getRecommendation($this->logged_user->id,$id);
        $sender_data = User::where('id', '=' , $get_user_rec->sender_id)->firstOrFail();
        return view('frontend.mynetwork.read_recommendation',array('user_recom'=>$get_user_rec ,'sender_data'=>$sender_data));
    }

    public function acceptRecom($id){

        if (Auth::guard('admin_users')->user() != NULL) {
            $this->logged_user = Auth::guard('admin_users')->user();
        } else if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $get_user_rec = $this->networkServiceProvider->acceptRecommendation($this->logged_user,$id);
        return redirect($get_user_rec);
    }
    public function rejectRecom($id){
        if (Auth::guard('admin_users')->user() != NULL) {
            $this->logged_user = Auth::guard('admin_users')->user();
        } else if (Auth::user() != NULL) {
            $this->logged_user = Auth::user();
        } else {
            return redirect('login');
        }
        $get_user_rec = $this->networkServiceProvider->rejectRecommendation($this->logged_user,$id);
        return redirect($get_user_rec);
    }

    public function getPeopleList(Request $request){
        return view('frontend.mynetwork.findpeople');

    }
}



