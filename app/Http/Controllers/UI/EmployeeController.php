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




}
