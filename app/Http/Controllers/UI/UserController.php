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
use Validator;

use  BusinessObject\User;
use  BusinessObject\Certification;


class UserController extends Controller
{
    private $userServiceProvider;
    public function __construct()
    {
        $this->middleware('auth');
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
    public function uploadImage(Request $request){

        $post_data = $request->all();

        $file = array('image' => $request->file('form-register-photo'));

        // setting up rules
        $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            return array('code'=>401,'status'=>'error','msg'=>'Image only.');
        }
        if ($request->file('form-register-photo')->isValid()) {
            $destinationPath = env('IMAGE_UPLOAD_PATH');
            $extension = $request->file('form-register-photo')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'.'.$extension; // renameing image
            $request->file('form-register-photo')->move($destinationPath, $fileName); // uploading file to given path
            $this->logged_user = Auth::user();
            $user = User::find($this->logged_user->id);
            $user->image =$fileName;
            $user->update();
            return response()->json(array("code"=>200,'status'=>'ok','msg'=>'Image successfully uploaded','img'=>"/user_images/".$fileName));
            //  return response()->json("image updated succesfully");
            //return ("image updated succesfully");

        }
        return response()->json(array("code"=>400,'status'=>'error','msg'=>'Error. please try again.','img'=>''));
    }

    public function addCertification(Request $request){
        $post_data = $request->all();

        // dd($post_data);
        $this->logged_user = Auth::user();
        $validate_array = array(
            'name'              => "required",
            'authority'          => "required",
        );
        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        return $this->userServiceProvider->addCertification($post_data,$this->logged_user->id);
    }

    public function editCertification(Request $request){
        $post_data = $request->all();
        $certification = Certification::where(array('id'=>$post_data['cer_id']))->get();
        return response()->json(array("code"=>200,'status'=>'ok','msg'=>'','data'=> $certification));

    }


}
