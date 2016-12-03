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
use Illuminate\Support\Facades\Cache;
use Validator;
use DB;

class AdminUserServiceProvider{

    public function updateBasicInfo($data,$userid){
       
        $this->update($data);

        return array(
            'code' => '200',
            'status' => 'ok',
            'msg' => "Saved sucessfully !"
        );

    }
    public function update($userArray){
        $adminUser = User::find($userArray['id']);
        if(isset($userArray['name'])){       $adminUser->first_name      = $userArray['name']; }
        $adminUser->update();
        Cache::forget('user-'.$userArray['id']);
    }

    public function getBasicAdminProfile($id){

        try {
            return  AdminUser::find($id);
        }catch (\Exception $e) {
            return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
        }
    }





}