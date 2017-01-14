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
use BusinessObject\UserFiles;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use  App\Validator\Validate;
use Session;
use Hash;
use Validator;

use  BusinessObject\User;
use  BusinessObject\Certification;


class UserController extends Controller
{
    private $userServiceProvider;
    public function __construct()
    {
        $this->middleware('auth');
        $this->userServiceProvider = new UserServiceProvider();
    }

    public function passwordUpdate(Request $request){
        $post_data = $request->all();
        $validate_array = array(
            'password'         => "required",
            'new_password'         => "required|min:6|different:password",
        );
        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        $this->logged_user = Auth::user();

        if(Hash::check($post_data['password'], $this->logged_user->password)){
            return response(json_encode($this->userServiceProvider->passwordUpdate($request->all())))->header('Content-Type', 'json');

        }else{
            return array('code'=>400,'status'=>'error','msg'=>'Current password not matching.');
        }


    }
    public function uploadImage(Request $request){

        $post_data = $request->all();

        $file = array('image' => $request->file('form-register-photo'));

        // setting up rules
        $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            return array('code'=>401,'status'=>'error','msg'=>'Image only.');
        }
        if ($request->file('form-register-photo')->isValid()) {
            $destinationPath = env('IMAGE_UPLOAD_PATH');
            $extension = $request->file('form-register-photo')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'.'.$extension; // renameing image
            $request->file('form-register-photo')->move($destinationPath, $fileName); // uploading file to given path
            $this->logged_user = Auth::user();
            $user = User::find($this->logged_user->id);
            $user->image =$fileName;
            $user->update();
            return response()->json(array("code"=>200,'status'=>'ok','msg'=>'Image successfully uploaded','img'=>"/user_images/".$fileName));
            //  return response()->json("image updated succesfully");
            //return ("image updated succesfully");

        }
        return response()->json(array("code"=>400,'status'=>'error','msg'=>'Error. please try again.','img'=>''));
    }

    public function addCertification(Request $request){
        $post_data = $request->all();
       // dd($post_data);
        $this->logged_user = Auth::user();
        $validate_array = array(
            'name'              => "required",
            'authority'          => "required",
        );
        $validation_res = Validate::validateMe($post_data,$validate_array);
        if($validation_res['code'] == 401){
            return $validation_res;
        }
        return $this->userServiceProvider->addCertification($post_data,$this->logged_user->id);
    }

    public function editCertification(Request $request){
        $post_data = $request->all();
        $certification = Certification::where(array('id'=>$post_data['cer_id']))->get();
        return response()->json(array("code"=>200,'status'=>'ok','msg'=>'','data'=> $certification));

    }

    public function addFiles(Request $request){
        $post_data = $request->all();
        $resp = array('code' => 401, 'status' => 'error', 'msg' => 'Files Title is required.|');

        $errors     = array();
        $maxsize    = 2097152;
        $acceptable = array(
            'application/pdf',
            'image/jpeg',
            'image/jpg',
            'image/png',
            'application/doc',
            'application/msword',
            'application/octet-stream',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'

        );
        $file_info = array();
        $this->logged_user = Auth::user();
        $file_info['userid']=$this->logged_user->id;

        //dd($post_data);
        for($i=0; $i<count($_FILES['file']['name']); $i++){
            $target_path =   env('FILE_UPLOAD_PATH')."/user_files/";
            $ext = explode('.', basename( $_FILES['file']['name'][$i]));
            $target_name = md5(uniqid()) . "." . $ext[count($ext)-1];
            $target_path = $target_path . $target_name;
            $title_file = $post_data['name'][$i];
            if(empty($title_file)){
              return  response()->json($resp);
            }

            if(($_FILES['file']['size'][$i] >= $maxsize) || ($_FILES["file"]["size"][$i] == 0)) {
                return array('code' => 401, 'status' => 'error', 'msg' => 'File too large. File must be less than 2 megabytes.|');
            }
            #dd($_FILES['file']['type'][$i]);
            if((!in_array($_FILES['file']['type'][$i], $acceptable)) && (!empty($_FILES["file"]["type"][$i]))) {
                //$errors[] = 'Invalid file type. Only PDF, JPG, GIF and PNG types are accepted.';
                return array('code' => 401, 'status' => 'error', 'msg' => 'Invalid file type. Only PDF, JPG, GIF and PNG types are accepted.|');
            }

            if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
                $file_info['file'][$title_file]=$target_name;

             } else{
               return array('code' => 401, 'status' => 'error', 'msg' => 'File not uploaded.|');
            }
        }


       return  $this->userServiceProvider->uploadUserFiles($file_info);
    }

    public function DeleteUserFile(Request $request){
        return  $this->userServiceProvider->deleteUserFile($request->all());

    }

    public function getUserFiles($userid){
        return  $this->userServiceProvider->getUserFiles($userid);
    }

    public function DownloadFiles($file_id){
       try{
            if($file_id){
                $useFile = UserFiles::find($file_id);
                $pathToFile = env('FILE_UPLOAD_PATH').'/user_files/'.$useFile->name;
               // dd($pathToFile);
                chmod($pathToFile,0777);
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                //We can likely use the 'application/zip' type, but the octet-stream 'catch all' works just fine.
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename='$useFile->name'");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: ".filesize($pathToFile));

                while (ob_get_level()) {
                    ob_end_clean();
                }

                @readfile($pathToFile);

                exit;





            }

        }
        catch (\Exception $e) {
            return view('errors.404');
        }
    }

    
}
