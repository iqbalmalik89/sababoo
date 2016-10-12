<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:49 AM
 */


namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use BusinessLogic\EmployeeServiceProvider;
use BusinessLogic\SkillServiceProvider;
use BusinessLogic\LanguageServiceProvider;
use BusinessLogic\UserServiceProvider;
use BusinessLogic\JobPostServiceProvider;
use BusinessLogic\NetworkServiceProvider;
use BusinessLogic\CommentServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;
use Validator;
use  BusinessObject\User;


class CommentController extends Controller
{
    private $jobpostServiceProvider;
    public function __construct()
    {
        $this->middleware('auth');
        $this->logged_user = Auth::user();
        $this->commentServiceProvider = new CommentServiceProvider();

    }

    public function addComment(Request $request){
      $this->logged_user = Auth::user();
      $post_data= $request->all();
      $post_data['commenter_id']=$this->logged_user->id;
     return $this->commentServiceProvider->addComments($post_data);

    }
  public function updateComment(Request $request){
    $post_data= $request->all();
    return $this->commentServiceProvider->updateComments($post_data);
  }

  public function deleteComment(Request $request){
    return $this->commentServiceProvider->deleteComments($request->all());
  }



}



