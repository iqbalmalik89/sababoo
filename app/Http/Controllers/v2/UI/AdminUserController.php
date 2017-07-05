<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 24/08/2016
 * Time: 10:32 AM
 */


namespace App\Http\Controllers\UI;
use App\Http\Controllers\Controller;
use BusinessLogic\AdminUserServiceProvider;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;



class AdminUserController extends Controller
{
    private $adminUserServiceProvider;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->adminUserServiceProvider = new AdminUserServiceProvider();
    }

    public function updateBasicInfo(Request $request){
        $post_data = $request->all();
        $this->logged_user = Auth::user();
        $validate_array = array(
            'name'         => "required|regex:/^[\pL\s.']+$/u"
        );


        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        return $this->adminUserServiceProvider->updateBasicInfo($post_data,$this->logged_user->id);
    }

    public function viewAdminUser($id){

       $this->logged_user = Auth::user();


        $basic_emp_info = $this->adminUserServiceProvider->getBasicAdminProfile($id);

        if($basic_emp_info==null){
            return view('errors.404');
        }
       return view('frontend.admin_user.view_profile',array('logged_user'=>$this->logged_user ,'basic_emp_info'=>$basic_emp_info));
    }



}
