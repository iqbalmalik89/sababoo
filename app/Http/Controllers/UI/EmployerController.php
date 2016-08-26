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
use BusinessLogic\EmployerServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;



class EmployerController extends Controller
{
    private $userServiceProvider;
    private $employerServiceProvider;
    public function __construct()
    {
        $this->userServiceProvider = new UserServiceProvider();
        $this->employerServiceProvider = new EmployerServiceProvider();
    }

    public function updateEmployer(Request $request){
        $post_data = $request->all();
        $this->logged_user = Auth::user();
        $validate_array = array(
            'company_name'         => "required",
            'industry'          => "required",
            'address'          => "required",
            'country'          => "required",
            'phone'          => "required",
        );


        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        return $this->employerServiceProvider->updateEmployer($post_data,$this->logged_user->id);

    }



}
