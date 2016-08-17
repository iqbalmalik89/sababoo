<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:49 AM
 */


namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use BusinessLogic\LanguageServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;


class LanguageController extends Controller
{
    private $languageServiceProvider;
    public function __construct()
    {
        $this->languageServiceProvider = new LanguageServiceProvider();
    }

    // /**
    // *Update the baasic info of employee
    // */

    public function get()
    {
        $data = $this->skillServiceProvider->get(1, 0);
        $arr = array();
        foreach ($data['data'] as $key => $skill) {
            $arr[] = array('id' => $skill->id, 'skill' => $skill->skill);
        }

        return response()->json($arr);
    }

    public function updateUserLanguages(Request $request)
    {
       $data = $this->languageServiceProvider->updateUserLanguages(Auth::user()->id, $request->all());
       return $data;
    }

    public function getUserLanguages(Request $request)
    {
       $data = $this->languageServiceProvider->getUserLanguages(Auth::user()->id);
       return $data;        
    }

}
