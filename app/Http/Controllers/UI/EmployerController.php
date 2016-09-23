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
use BusinessLogic\EmployeeServiceProvider;
use BusinessLogic\NetworkServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use  BusinessObject\Employer;



class EmployerController extends Controller
{
    private $userServiceProvider;
    private $employerServiceProvider;
    public function __construct()
    {
        $this->middleware('auth');
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
    public function password(){
        $this->logged_user = Auth::user();
        $employer = Employer::where('userid', '=' , $this->logged_user->id)->firstOrFail();
        return  view('frontend.employer.password',array('userinfo'=>$this->logged_user,'employer'=>$employer));
    }

    public function viewEmployer($id){
        $basic_emp_info = $this->employerServiceProvider->getBasicEmpProfile($id);
        $basic_user_info = $this->userServiceProvider->getBasicUserProfile($basic_emp_info->userid);
        $this->networkServiceProvider = new NetworkServiceProvider();
        $recoms = $this->networkServiceProvider->getUsersAllRecommendation($basic_emp_info->userid);


        if($basic_emp_info==null){
            return view('errors.404');
        }
        $this->employeeServiceProvider = new EmployeeServiceProvider();
        $industry = $this->employeeServiceProvider->getIndustry($basic_user_info->industry_id);
        return view('frontend.employer.view_profile',array('basic_user_info'=>$basic_user_info,'basic_emp_info'=>$basic_emp_info,'industry'=>$industry,'recoms'=>$recoms));

    }


}
