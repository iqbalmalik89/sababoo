<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:49 AM
 */


namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use BusinessLogic\SkillServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;


class SkillController extends Controller
{
    private $skillServiceProvider;
    public function __construct()
    {
        $this->skillServiceProvider = new SkillServiceProvider();
    }

    // /**
    // *Update the baasic info of employee
    // */

    public function get()
    {
        $data = $this->skillServiceProvider->get(1, 0);
        $arr = array();
        foreach ($data['data'] as $key => $skill) {
            $arr[] = array('id' => $skill->id, 'skill' => $skill->skill);
        }

        return response()->json($arr);
    }

    public function updateUserSkills(Request $request)
    {
        $validate_array = array('skill'=>'required');
        $validation_res = Validate::validateMe(array('skill' => $request->input('user_skills')), $validate_array);

         //dd($validation_res);
        if ($validation_res['code'] == 401) {
            return $validation_res;
        }

       $data = $this->skillServiceProvider->updateUserSkills(Auth::user()->id, $request->input('user_skills'));
       return $data;
    }

    public function getUserSkills(Request $request)
    {
       $data = $this->skillServiceProvider->getUserSkills(Auth::user()->id);
       return $data;        
    }



    // public function updateBasicInfo(Request $request){
    //     $post_data = $request->all();
    //     $this->logged_user = Auth::user();
    //     $validate_array = array(
    //         'first_name'         => "required|regex:/^[\pL\s.']+$/u",
    //         'last_name'          => "required|regex:/^[\pL\s.']+$/u",
    //         );


    //     $validation_res = Validate::validateMe($post_data,$validate_array);
    //     if($validation_res['code'] == 401){
    //         return $validation_res;
    //     }
    //     return $this->employeeServiceProvider->updateBasicInfo($post_data,$this->logged_user->id);
    // }




}
