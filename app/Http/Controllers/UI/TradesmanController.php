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




}
