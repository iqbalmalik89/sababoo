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
use Validator;
use DB;

class EmployeeServiceProvider
{

    public function updateBasicInfo($user_data,$user_id){

        $user = User::find($user_id);
        $res = $this->saveUser($user,$user_data);
        if($res['code']==200){
            $employee = Employee::find(array('userid'=>$user_id));
            return $this->saveEmployee($employee,$user_data);

        }
        return $res;

     }

    /**
     * @param $user
     * @param $userArray
     * @return array
     */
    public function saveUser($user,$userArray){

        if(isset($userArray['first_name'])){ 		$user->first_name 		= $userArray['first_name']; }
        if(isset($userArray['last_name'])){  		$user->last_name 		= $userArray['last_name'];  }
        if(isset($userArray['country'])){			$user->country 			= $userArray['country'];}
        if(isset($userArray['address'])){			$user->address 			= $userArray['address'];}
        if(isset($userArray['phone'])){			    $user->phone 			= $userArray['phone'];}
        if(isset($userArray['phone_type'])){		$user->phone_type 		= $userArray['phone_type'];}
        if(isset($userArray['postal_code'])){		$user->postal_code 		= $userArray['postal_code'];}

        $user->updated_at 		= new \DateTime();
        if($user->save()) {
            return array(
                'code' => '200',
                'status' => 'ok',
                'msg' => "Saved sucessfully !"
            );
        }
        return array(
            'code' => '400',
            'status' => 'error',
            'msg' => "Error"
        );

    }

    public function saveEmployee($employee,$userArray){


        $employee = Employee::find($employee[0]->id);

        if(isset($userArray['industry_id'])){ 		$employee->industry_id 		= $userArray['industry_id']; }
        if(isset($userArray['summary'])){  		    $employee->summary 		= $userArray['summary'];  }
        if(isset($userArray['professional_heading'])){$employee->professional_heading 			= $userArray['professional_heading'];}

        if($employee->save()) {
            return array(
                'code' => '200',
                'status' => 'ok',
                'msg' => "Profile updated sucessfully !"
            );
        }
        return array(
            'code' => '400',
            'status' => 'error',
            'msg' => "Error"
        );


    }



}
