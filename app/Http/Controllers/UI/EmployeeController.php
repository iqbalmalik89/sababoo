<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:49 AM
 */


namespace App\Http\Controllers;

use BusinessLogic\EmployeeServiceProvider;
use BusinessLogic\SkillServiceProvider;
use BusinessLogic\LanguageServiceProvider;
use BusinessLogic\UserServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;
use Validator;
use  BusinessObject\User;
use  BusinessObject\Education;
use  BusinessObject\Experience;
use  BusinessObject\Employee;


class EmployeeController extends Controller
{
    private $employeeServiceProvider;
    public function __construct()
    {
        $this->logged_user = Auth::user();
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

    public function editEducation(Request $request){
        $post_data = $request->all();
        $education = Education::where(array('id'=>$post_data['edu_id']))->get();
        return response()->json(array("code"=>200,'status'=>'ok','msg'=>'','data'=> $education));

	}

    public function updateUserInterest(Request $request){
        $interests = $request->get('interests');
        return $this->employeeServiceProvider->updateInterest(Auth::user()->id, $interests);
    }




	public function addExperience(Request $request){
        $post_data = $request->all();

       // dd($post_data);
        $this->logged_user = Auth::user();
        $validate_array = array(
            'job_position'         => "required",
            'company_name'          => "required",
            'date_from_month'          => "required",
            'date_from_year'          => "required",
        );
        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        return $this->employeeServiceProvider->addExperience($post_data,$this->logged_user->id);
     }
	 
	 public function editExperience(Request $request){
        $post_data = $request->all();
        $experience = Experience::where(array('id'=>$post_data['exp_id']))->get();
        return response()->json(array("code"=>200,'status'=>'ok','msg'=>'','data'=> $experience));

	}

     public function viewEmployee($id){


        $basic_emp_info = $this->employeeServiceProvider->getBasicEmpProfile($id);


        if($basic_emp_info==null){
            return view('errors.404');
        }
         $basic_user_info = $this->employeeServiceProvider->getBasicUserProfile($basic_emp_info->userid);


         $this->skillServiceProvider = new SkillServiceProvider();
         $this->languageServiceProvider = new LanguageServiceProvider();
         $this->UserServiceProvider = new UserServiceProvider();
         $education = $this->employeeServiceProvider->getEducation($basic_emp_info->userid);
         $exp = Experience::where(array('employee_id'=> $id))->get();

         $industry = $this->employeeServiceProvider->getIndustry($basic_user_info->industry_id);
         $skills = $this->skillServiceProvider->getUserSkills($basic_emp_info->userid);
         $language = $this->languageServiceProvider->getUserLanguages($basic_emp_info->userid);
         $certification =  $this->UserServiceProvider->getCertifcation($basic_emp_info->userid);

         return view('frontend.employee.view_profile',array('basic_user_info'=>$basic_user_info,'basic_emp_info'=>$basic_emp_info,'education'=>$education,'skills'=>$skills,'exp'=>$exp,'industry'=>$industry,'language'=>$language,'certification'=>$certification ));
    }

    public function resumeUpload(Request $request){
        $post_data = $request->all();


        $file = array('file' => $request->file('resume'));
        $rules = array('file' => 'required|mimes:doc,docx,pdf'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
        if($file==null){
            return array('code'=>401,'status'=>'error','msg'=>'File not found.');

        }

        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);

        if ($validator->fails()) {
            return array('code'=>401,'status'=>'error','msg'=>'Invalid format found.');
        }

        $validate_array = array(
            'resume_name'         => "required",
        );
        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        if ($request->file('resume')->isValid()) {
            $destinationPath = env('CV_UPLOAD_PATH');
            $extension = $request->file('resume')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'.'.$extension; // renameing image
            $request->file('resume')->move($destinationPath, $fileName); // uploading file to given path
            $this->logged_user = Auth::user();
            $employee = Employee::find(array('userid'=> $this->logged_user->id))->first();

            $employee->resume_name = $fileName;
            $employee->resume_title = $post_data['resume_name'];
            $employee->update();
            return response()->json(array("code"=>200,'status'=>'ok','msg'=>'CV successfully uploaded','file_path'=>"/Docs/".$fileName));

        }
        return response()->json(array("code"=>400,'status'=>'error','msg'=>'Failed .Please try again','file_path'=>""));

    }

    public function downloadResume($name){
      try{
          if($name){
           $employee = Employee::find($name);
           $pathToFile = env('CV_UPLOAD_PATH').'/'.$employee->resume_name;
           header("Content-type:application/pdf");
           header("Content-Disposition:attachment;filename='$employee->resume_title'");
           readfile($pathToFile);

       }

    }
        catch (\Exception $e) {
            return view('errors.404');
            }
    }



}



