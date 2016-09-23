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
use BusinessLogic\TradesmanServiceProvider;
use BusinessLogic\NetworkServiceProvider;
use BusinessLogic\SkillServiceProvider;
use BusinessLogic\LanguageServiceProvider;
use BusinessLogic\EmployeeServiceProvider;
use BusinessObject\Employee;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use  BusinessObject\Employer;



class TradesmanController extends Controller
{
    private $userServiceProvider;
    private $tradesmanServiceProvider;

    public function __construct()
    {
        $this->middleware('auth');
        $this->userServiceProvider = new UserServiceProvider();
        $this->tradesmanServiceProvider = new TradesmanServiceProvider();
    }

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
        return $this->tradesmanServiceProvider->updateBasicInfo($post_data,$this->logged_user->id);
    }

    public function viewTradesman($id){

        $basic_emp_info = $this->tradesmanServiceProvider->getBasicTradesmanProfile($id);

        if($basic_emp_info==null){
            return view('errors.404');
        }
        $basic_user_info = $this->userServiceProvider->getBasicUserProfile($basic_emp_info->userid);

        $this->skillServiceProvider = new SkillServiceProvider();
        $this->languageServiceProvider = new LanguageServiceProvider();
        $this->employeeServiceProvider = new EmployeeServiceProvider();
        $education = $this->employeeServiceProvider->getEducation($basic_emp_info->userid);
        $industry = $this->employeeServiceProvider->getIndustry($basic_user_info->industry_id);
        $skills = $this->skillServiceProvider->getUserSkills($basic_emp_info->userid);
        $language = $this->languageServiceProvider->getUserLanguages($basic_emp_info->userid);
        $certification =  $this->userServiceProvider->getCertifcation($basic_emp_info->userid);
        $this->networkServiceProvider = new NetworkServiceProvider();
        $recoms = $this->networkServiceProvider->getUsersAllRecommendation($basic_emp_info->userid);

        return view('frontend.tradesman.view_profile',array('basic_user_info'=>$basic_user_info,'basic_emp_info'=>$basic_emp_info,'education'=>$education,'skills'=>$skills,'industry'=>$industry,'language'=>$language,'certification'=>$certification,'recoms'=>$recoms));
    }



}
