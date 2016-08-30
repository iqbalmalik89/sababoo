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
use  BusinessObject\Tradesman;
use  BusinessObject\Education;
use  BusinessObject\Experience;
use  BusinessObject\Industry;
use Validator;
use DB;

class TradesmanServiceProvider{



    public function updateBasicInfo($data,$userid){

        $this->update($data);
        $userSp = new UserServiceProvider();
        return $userSp ->update($data,$userid);

    }
    public function update($userArray){
        $tradesman = Tradesman::find($userArray['id']);
        if(isset($userArray['summary'])){ 		$tradesman->background 		= $userArray['summary']; }
        $tradesman->update();

    }





}