<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 24/08/2016
 * Time: 10:34 AM
 */

namespace BusinessLogic;
use BusinessObject\Certification;
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

    public function getBasicUserProfile($userid){
        try {
            return  User::find($userid);
        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }
    }

    public function addCertification($userArray,$userid){

        try {
           // dd($userArray);
            if (isset($userArray['cer_id']) && $userArray['cer_id'] != '') {

                $certification = Certification::find($userArray['cer_id']);
                $certification->userid = $userid;
                $certification->authority = $userArray['authority'];
                $certification->name = $userArray['name'];

                $certification->date_from = $userArray['date_from_month'] . "-" . $userArray['date_from_year'];
                $certification->date_to = $userArray['date_to_month'] . "-" . $userArray['date_to_year'];
                $certification->url = $userArray['url'];
                if (!isset($userArray['present'])) {
                    $userArray['present'] = 0;
                }
                $certification->present = $userArray['present'];
                $certification->update();
                return array('code' => 200, 'status' => 'ok', 'msg' => 'Record updated successfully.');
            }
            $certification = new Certification();
            $certification->userid = $userid;
            $certification->name = $userArray['name'];
            $certification->authority = $userArray['authority'];
            $certification->date_from = $userArray['date_from_month'] . "-" . $userArray['date_from_year'];
            $certification->date_to = $userArray['date_to_month'] . "-" . $userArray['date_to_year'];
            $certification->url = $userArray['url'];
            if (!isset($userArray['present'])) {
                $userArray['present'] = 0;
            }
            $certification->present = $userArray['present'];
            $certification->save();

            return array(
                'code' => '200',
                'status' => 'ok',
                'msg' => "Certification added successfully.",

            );
        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }

    }

    public function getCertifcation($id){
        try {
            return  Certification::where(array('userid'=> $id))->get();
        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }

    }


}