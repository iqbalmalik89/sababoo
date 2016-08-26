<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 24/08/2016
 * Time: 10:34 AM
 */

namespace BusinessLogic;
use Helper;
use  BusinessObject\User;
use  BusinessObject\Employee;
use  BusinessObject\Education;
use  BusinessObject\Experience;
use  BusinessObject\Industry;
use Validator;
use DB;

class UserServiceProvider
{


    public function update ($userArray,$userid){
        $user =User::find($userid);
        return $this->updateUser($user,$userArray);
    }

    public function updateUser($user,$userArray){
        if(isset($userArray['first_name'])){ 		$user->first_name 		= $userArray['first_name']; }
        if(isset($userArray['last_name'])){  		$user->last_name 		= $userArray['last_name'];  }
        if(isset($userArray['country'])){			$user->country 			= $userArray['country'];}
        if(isset($userArray['address'])){			$user->address 			= $userArray['address'];}
        if(isset($userArray['phone'])){			    $user->phone 			= $userArray['phone'];}
        if(isset($userArray['phone_type'])){		$user->phone_type 		= $userArray['phone_type'];}
        if(isset($userArray['postal_code'])){		$user->postal_code 		= $userArray['postal_code'];}
        if(isset($userArray['industry'])){		    $user->industry_id 		= $userArray['industry'];}
        if(isset($userArray['password'])){		    $user->password 		= bcrypt($userArray['password']);}

        $user->update();
        return array(
            'code' => '200',
            'status' => 'ok',
            'msg' => "Saved sucessfully !"
        );
    }

    public function passwordUpdate($userArray){
        if($userArray['new_password'] == $userArray['c_password']){

            $userArray['password'] = $userArray['new_password'];
            $user = User::find($userArray['userid']);
            return  $this->updateUser($user,$userArray);

         }
        return array(
            'code' => '400',
            'status' => 'error',
            'msg' => "Password not matching"
        );
    }



}