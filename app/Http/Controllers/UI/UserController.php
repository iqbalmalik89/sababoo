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
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;
use Hash;



class UserController extends Controller
{
    private $userServiceProvider;
    public function __construct()
    {
        $this->userServiceProvider = new UserServiceProvider();
    }

    public function passwordUpdate(Request $request){
        $post_data = $request->all();
        $validate_array = array(
            'password'         => "required",
            'new_password'         => "required|min:6|different:password",
        );
        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        $this->logged_user = Auth::user();

        if(Hash::check($post_data['password'], $this->logged_user->password)){
            return response(json_encode($this->userServiceProvider->passwordUpdate($request->all())))->header('Content-Type', 'json');

        }else{
            return array('code'=>400,'status'=>'error','msg'=>'Current password not matching.');
        }


    }

}
