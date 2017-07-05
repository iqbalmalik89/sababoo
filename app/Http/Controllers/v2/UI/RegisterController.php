<?php

namespace App\Http\Controllers;

use BusinessLogic\RegisterServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;


class RegisterController extends Controller
{
    private $registerServiceProvider;
    public function __construct()
    {
       $this->registerServiceProvider = new RegisterServiceProvider();
    }

   
    public function createUser(Request $request){
        $post_data = $request->all();
           
        $validate_array = array(
            'first_name'         => "required|regex:/^[\pL\s.']+$/u",
            'last_name'          => "required|regex:/^[\pL\s.']+$/u",
            'email'             => 'required|email',
            'password'          => 'required|min:6',
         );


        $validation_res = Validate::validateMe($post_data,$validate_array);
       if($validation_res['code'] == 401){
           return $validation_res;
        }
		return $this->registerServiceProvider->createUser($post_data);
    }

    public function activateUser(Request $request){
        $response =  $this->registerServiceProvider->activateUser($request->all());
        return view('frontend.activate.index', array('response'=>$response));
    }
   

}
