<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:49 AM
 */


namespace App\Http\Controllers;

use BusinessLogic\EmployeeServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;
use Validator;
use  BusinessObject\User;
use  BusinessObject\Education;


class EmployeeController extends Controller
{
    private $employeeServiceProvider;
    public function __construct()
    {
        $this->employeeServiceProvider = new EmployeeServiceProvider();
    }

    /**
    *Update the baasic info of employee
    */

    public function updateBasicInfo(Request $request){
        $post_data = $request->all();
        $this->logged_user = Auth::user();
        $validate_array = array(
            'first_name'         => "required|regex:/^[\pL\s.']+$/u",
            'last_name'          => "required|regex:/^[\pL\s.']+$/u",
            );


        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        return $this->employeeServiceProvider->updateBasicInfo($post_data,$this->logged_user->id);
    }

    public function addEducation(Request $request){
        $post_data = $request->all();
        $this->logged_user = Auth::user();
        $validate_array = array(
            'school_name'         => "required",
            'degree'          => "required",
            'field_study'          => "required",
        );


        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        return $this->employeeServiceProvider->addEducation($post_data,$this->logged_user->id);
     }

    public function EditEducation(Request $request){
        $post_data = $request->all();
        $education = Education::where(array('id'=>$post_data['edu_id']))->get();
        return response()->json(array("code"=>200,'status'=>'ok','msg'=>'','data'=> $education));


     }

    public function uploadImage(Request $request){

        $post_data = $request->all();

        $file = array('image' => $request->file('form-register-photo'));
        // setting up rules
         $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
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




}
