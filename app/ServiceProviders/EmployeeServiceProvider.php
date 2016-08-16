<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:52 AM
 */


namespace BusinessLogic;
use Helper;
use  BusinessObject\User;
use  BusinessObject\Employee;
use  BusinessObject\Education;
use Validator;
use DB;

class EmployeeServiceProvider
{

    public function updateBasicInfo($user_data,$user_id){

        $user = User::find($user_id);
        $res = $this->updateUser($user,$user_data);
        if($res['code']==200){
            $employee = Employee::find(array('userid'=>$user_id));
            return $this->updateEmployee($employee,$user_data);

        }
        return $res;

     }

    /**
     * @param $user
     * @param $userArray
     * @return array
     */
    public function updateUser($user,$userArray){


        if(isset($userArray['first_name'])){ 		$user->first_name 		= $userArray['first_name']; }
        if(isset($userArray['last_name'])){  		$user->last_name 		= $userArray['last_name'];  }
        if(isset($userArray['country'])){			$user->country 			= $userArray['country'];}
        if(isset($userArray['address'])){			$user->address 			= $userArray['address'];}
        if(isset($userArray['phone'])){			    $user->phone 			= $userArray['phone'];}
        if(isset($userArray['phone_type'])){		$user->phone_type 		= $userArray['phone_type'];}
        if(isset($userArray['postal_code'])){		$user->postal_code 		= $userArray['postal_code'];}
        if(isset($userArray['industry'])){		    $user->industry_id 		= $userArray['industry'];}

        $user->update();
            return array(
                'code' => '200',
                'status' => 'ok',
                'msg' => "Saved sucessfully !"
            );


    }

    public function updateEmployee($employee,$userArray){

        $employee = Employee::find($employee[0]->id);
        if(isset($userArray['industry_id'])){ 		$employee->industry_id 		= $userArray['industry_id']; }
        if(isset($userArray['summary'])){  		    $employee->summary 		= $userArray['summary'];  }
        if(isset($userArray['professional_heading'])){$employee->professional_heading 			= $userArray['professional_heading'];}
        $employee->update();
        //return response()->json("Recored updated successfully.");
        return array('code'=>200,'status'=>'ok','msg'=>'Record updated successfully.');

    }

    public function addEducation($data,$user_id){


        //Update
       if(isset($data['edu_id']) && $data['edu_id'] !=''){

           $education = Education::find($data['edu_id']);
           $education->employee_id = $data['employee_id'];
           $education->school_name = $data['school_name'];
           $education->year_from = $data['date_from'];
           $education->year_to = $data['date_to'];
           $education->degree = $data['degree'];
           $education->field_study = $data['field_study'];
           $education->grade = $data['grade'];
           $education->description = $data['description'];
           $education->update();
           //return response()->json("Recored updated successfully.");
           return array('code'=>200,'status'=>'ok','msg'=>'Record updated successfully.');
       }
        try {
            $education = new Education;
            $education->employee_id = $data['employee_id'];
            $education->school_name = $data['school_name'];
            $education->year_from = $data['date_from'];
            $education->year_to = $data['date_to'];
            $education->degree = $data['degree'];
            $education->field_study = $data['field_study'];
            $education->grade = $data['grade'];
            $education->description = $data['description'];
            $education->save();

                return array(
                    'code' => '200',
                    'status' => 'ok',
                    'msg' => "Education added successfully.",
                    'data'=>$education,

                );


        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }



    }



}
