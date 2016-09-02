<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:52 AM
 */


namespace BusinessLogic;
use BusinessObject\UserSkill;
use Helper;
use  BusinessObject\User;
use  BusinessObject\Employer;
use  BusinessObject\Education;
use  BusinessObject\Experience;
use  BusinessObject\Industry;
use Validator;
use DB;

class EmployerServiceProvider{

    public function updateEmployer($data,$userid){
        $this->update($data);
        $userSp = new UserServiceProvider();
        return $userSp ->update($data,$userid);

    }


    public function update($userArray){

        $employer = Employer::find($userArray['id']);
        if(isset($userArray['company_name'])){ 		$employer->company_name 		= $userArray['company_name']; }
        if(isset($userArray['people'])){ 		    $employer->people 		        = $userArray['people']; }
        if(isset($userArray['website'])){ 		    $employer->website 		        = $userArray['website']; }
        if(isset($userArray['description'])){ 		$employer->description 		    = $userArray['description']; }
        if(isset($userArray['services'])){ 		    $employer->services 		    = $userArray['services']; }
        if(isset($userArray['expertise'])){ 		$employer->expertise 		    = $userArray['expertise']; }
        if(isset($userArray['esablish_in'])){ 	    $employer->eastablish_in 		= $userArray['esablish_in']; }
        $employer->update();
      // return array('code'=>200,'status'=>'ok','msg'=>'Record updated successfully.');
    }

    public function getBasicEmpProfile($id){


        try {
            return  Employer::find($id);
        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }
    }

}