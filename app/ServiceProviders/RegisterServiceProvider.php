<?php


namespace BusinessLogic;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class RegisterServiceProvider extends BaseServiceProvider
{
    /**
     * @param $data
     * @return array
     */
    public function createUser($data){

        /* Captcha matching*/
        $captcha = Session::get('captcha_stringy');

        if(strtolower($captcha) != strtolower($data['captcha'])){

            return array(
                'code' => 401,
                'status' => 'error',
                'msg' => trans('messages.invalid_captcha')
            );
        }
        /*Password Matching*/
        if($data['password1']!= $data['password2']){
            return array(
                'code' => 401,
                'status' => 'error',
                'msg' => trans('messages.password_match')
            );
        }
        /* Check user exits or not*/
        $is_user =  $this->chkUser($data['email']);
        if($is_user['code'] == 200){
            return $this->saveUser($data);
        }
        return $is_user;
    }

    /**
     * @param $user_data
     * @return array
     */
    public function saveUser($user_data){

        $user =  new \BusinessObject\AdcenterProfiles();

        $staff = $this->getStaffRandomId();

        if($staff['code'] == 401){
            return $staff;
        }
        // Get random string

        $email_verify_code = $this->utilGetVerifyString();
        $phone_num = $user_data['telephone'];
        $phone_truncate_num = intval(preg_replace('/[^0-9]+/', '', $phone_num), 10);

        try {
           $user->setUserName($user_data['email']);
           $user->setFirstName($user_data['firstname']);
           $user->setLastName($user_data['lastname']);
           $user->setCompanyName($user_data['company_name']);
           $user->setEmail($user_data['email']);
           $user->setPassword($user_data['password1']);
           //$user->setTelephone($user_data['telephone']);
           $user->setTelephone($phone_truncate_num);
           $user->setTelephoneExt($user_data['telephone_ext']);
           $user->setAddress1($user_data['address1']);
           $user->setAddress2($user_data['address2']);
           $user->setCity($user_data['city']);
           $user->setState($user_data['state']);
           $user->setZipcode($user_data['zipcode']);
           $user->setCountry($user_data['country']);
           $user->setAdcenterStaff($this->db->getConnection()->getReference('BusinessObject\\AdcenterStaff',$staff[0]['staffid']));
           $user->setRefillGeneralStatus('disabled');
           $user->setEmailVerifyStatus('unverified');
           $user->setEmailVerifyString($email_verify_code);
           $user->setStatus('disabled');
           $user->setPublishStatus('disabled');
           $user->setPacingStatus('enabled');
           $user->setVerificationStatus('unverified');
           $user->setVerificationAttempts('0');
           $user->setMaximumCampaigns('0');
           $user->setMaximumAdgroups('0');
           $user->setMaximumKeywords('0');
           $user->setCampaigns('0');
           $user->setAdgroups('0');
           $user->setListings('0');
           $user->setKeywords('0');
           $user->setCampaignsActive('0');
           $user->setCampaignsInactive('0');
          $user->setAdgroupsActive('0');
          $user->setAdgroupsInactive('0');
          $user->setListingsActive('0');
          $user->setListingsInactive('0');
          $user->setKeywordsActive('0');
          $user->setKeywordsInactive('0');
          $user->setRefillFixedCycle('0');
          $user->setRefillLastTransid('0');
          $user->setFilterTrafficBuckets0('0');
          $user->setAccountBalanceLastTransid('0');

           $user->setAccountTrafficBuckets('<scoremethod>ytq</scoremethod><ppc>0,0,0,1,1,1,1,1,1</ppc><ctx>0,0,0,0,0,0,0,0,0</ctx><bnr>0,0,0,0,0,0,0,0,0</bnr><cpv>0,0,0,0,0,0,0,0,0</cpv>');
           $user->setCreateTimestamp(new \DateTime());
           $user->setUpdateTimestamp(new \DateTime());
           $user->setCreateBrowser($_SERVER['HTTP_USER_AGENT']);
           $user->setCreateUserip($_SERVER["REMOTE_ADDR"]);
           EntityManager::persist($user);
           EntityManager::flush();
          $response = $this->sendSignupEmail($user_data,$email_verify_code);
          if ($response["code"] == '200') {
              return array(
                  'code' => '200',
                  'status' => 'ok',
                  'msg' => "Congratulations!
User Account has been successfully created. Please activate your account through, clicking on the activation link provided in an email just sent to your registered email address. Simply click the link contained in the email and your account will become fully activated.
Thanks for Registering."
              );
          }
          return $response;

       }catch (\Exception $e) {
           Log::error('getRegisterFields - '.$e->getMessage());
          return ['code' => 1000, 'status' => 'error', 'msg' => $e->getMessage()];
       }

    }

    /**
     * @param $user_data
     * @return array
     */
    public function activateUser($user_data){


      try {
          $sql_obj['dql'] = "SELECT user FROM BusinessObject\\AdcenterProfiles user WHERE user.email_verify_string=:email_verify_string ";
          $sql_obj['values'] = ["email_verify_string" => $user_data['e']];
          $check_user = $this->getRows($sql_obj);

            if(count($check_user['rows']) == 0){
            return
                array(
                'code'      => 1000,
                'status'    => "error",
                'msg'       => "Invalid activation Code.");

        }
        if($check_user['rows'][0]->getEmailVerifyStatus() == "verified" ){
           return
               array(
                'code'      => 1000,
                'status'    => "error",
                'msg'       => "Account Already Verified.");
        }
        $update_data = array();
        $update_data["email_verify_status"]         = "verified";
        $update_data["verification_status"]         = "verified";
        $update_data["status"]                      = "enabled";
        $update_data["create_timestamp"]            = new \DateTime();
        $update_data["update_timestamp"]            = new \DateTime();
        $update_data["email_verify_timestamp"]      = new \DateTime();
        $update_data["email_verify_userip"]         = $_SERVER["REMOTE_ADDR"];
        $update_data["update_browser"]              = $_SERVER['HTTP_USER_AGENT'];
        $update_data["publish_status"]               = 'enabled';
          $sql_obj['values'] = '';
        foreach ($update_data as $key => $value) {
            $sql_obj['values'][$key] = $value;
            $field_set[] = 'user.' . $key . ' = :' . $key;
        }
        $field_set = implode(",", $field_set);

        $sql_obj['dql'] = "UPDATE BusinessObject\\AdcenterProfiles user set $field_set where user.userid=:userid";
        $sql_obj['values']['userid'] = $check_user['rows'][0]->getUserId();

        $response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);


        //Creating traffic and UA filter account level data
        $filter=new \BusinessLogic\FiltersServiceProvider();
        $header['op']='FILTER_DATA';
        $query['userid']=$check_user['rows'][0]->getUserId();
        $query['action']='reset';
        $query['campaignid']='';
        $query['selected_list']= 'Whitelist';
        $query['source']='';
        $query['applyacfilter']=0;
        $query['applycpfilter']=0;
        $query['search_source']='';
        $filter->addfilter($header,$query);

        $header['op']='adduafilter';
        $query['userid']=$check_user['rows'][0]->getUserId();
        $query['action']='reset';
        $query['campaignid']='';
        $query['selected_list']= 'Whitelist';
        $query['source']='';
        $query['applyacfilter']=0;
        $query['applycpfilter']=0;
        $query['search_source']='';
        $filter->addfilter($header,$query);

        //  $headers = "From:noreply@ezanga.com";
          $staff_emails = explode(",",config('app.STAFF_EMAILS')['global_sales_email']);
          $staff_emails[] = 'dgail@ezanga.com';
          //$imp_staff_email = implode(",",$staff_emails);
          $data = [
              "from"            => "noreply@ezanga.com",
              "to"              => env('TEST_EMAIL',$staff_emails),
              "subject"         => "AdPad Account Signup -",
              "userid"          => $check_user['rows'][0]->getUserid(),
              "firstname"       => $check_user['rows'][0]->getFirstname(),
              "lastname"        =>  $check_user['rows'][0]->getLastname(),
              "username"        =>  $check_user['rows'][0]->getEmail(),
              "email"           =>  $check_user['rows'][0]->getEmail(),
              "company"         =>  $check_user['rows'][0]->getCompanyName(),
              "address1"        =>  $check_user['rows'][0]->getAddress1(),
              "address2"        =>  $check_user['rows'][0]->getAddress2(),
              "city"            =>  $check_user['rows'][0]->getCity(),
              "state"           =>  $check_user['rows'][0]->getState(),
              "zipcode"         =>  $check_user['rows'][0]->getZipcode(),
              "telephone"       =>  $check_user['rows'][0]->getTelephone(),
              "telephone_ext"   =>  $check_user['rows'][0]->getTelephoneExt(),
              "create_userip"   =>  $check_user['rows'][0]->getCreateUserip(),
              "create_browser"   =>  $check_user['rows'][0]->getCreateBrowser(),
              "create_timestamp"   =>  $check_user['rows'][0]->getCreateTimestamp()->format(),
              "SERVER_PATH" => env('UI_CDN_URL'),
              "location" =>  '',
           ];

          $mail_response = Helper::sendEmail(
              $data,
              ['email_templates/after_activate_signup_html', 'email_templates/after_activate_signup_text']
          );

        if($mail_response['code']==200){
            $response['code'] = 200;
            $response['msg'] = 'Account has been verified.';
            $response['status'] = 'ok';
            return $response;
        }
          $response['code'] = 400;
          $response['msg'] = 'Please re verify your account.';
          $response['status'] = 'error';
          return $response;

   } catch (\Exception $e) {
         Log::error('updateProfileFields - '.$e->getMessage());
        return array(
            'code' => 1000,
            'status' => 'error',
            'msg' => $e->getMessage()
        );
    }
}

    /**
     * @param $user_data
     * @param $email_verify_code
     * @return mixed
     */
    public function sendSignupEmail($user_data,$email_verify_code ){
        $to = $user_data["email"];
        $subject = "eZanga's AdPad - New Account Activation / " . $user_data['email'];
        $from = "noreply@ezanga.com";

        $data = [
            "from" => $from,
            "to" => env('TEST_EMAIL',$to),
            "subject" => $subject,
            "firstname" => $user_data["firstname"],
            "lastname" => $user_data["lastname"],
            "verifycode" => $email_verify_code,
            "password" => $user_data['password1'],
            "username" => $user_data['email'],
            "SERVER_PATH" => env('UI_CDN_URL')

        ];

        $mail_response = Helper::sendEmail(
            $data,
            ['email_templates/signup_html', 'email_templates/signup_text']
        );
        return $mail_response;

    }

    /**
     * @param $email
     * @return array
     */
    public function chkUser($email){
            $sql_obj['dql'] = "SELECT user FROM BusinessObject\\AdcenterProfiles user WHERE user.username=:username ";
            $sql_obj['values'] = ["username" => $email];
            $check_user = $this->getRows($sql_obj);
            if(empty($check_user['rows'])){
                return array(
                    'code'      => '200',
                    'status'    => 'ok',
                );
            }
        return array(
            'code'      => '401',
            'status'    => 'error',
            'msg'       => "User already exits."
        );
    }

    /**
     * @return array
     */
    public function getStaffRandomId(){

       /* $query  = $this->adpad_db->createQuery("SELECT PARTIAL staff.{staffid} FROM  BusinessObject\\AdcenterStaff staff ORDER BY RAND()");//->setMaxResults(1);
         try {
            return $query->getSingleResult(Query::HYDRATE_OBJECT);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }*/

        //$sql_obj['dql'] = ("SELECT PARTIAL staff.{staffid} FROM  BusinessObject\\AdcenterStaff staff ORDER BY RAND()  ")->setMaxResults(1);
        //$rows = $this->getRows($sql_obj);
        //return $rows ;
        try {
            if(env('APP_ENV')=='production') {
                $sql_obj = "SELECT staffid FROM adcenter_staff inner join adcenter_profiles
                       on adcenter_staff.email=adcenter_profiles.username
                       where adcenter_profiles.staff_account_flag=1 and adcenter_staff.email='mdonahue@ezanga.com'
                       LIMIT 1 ";
                $result = $this->db->executeNative($sql_obj);
                $resultSet = $result->fetchAll();
            }else {
                $sql_obj = "SELECT staffid FROM adcenter_staff inner join adcenter_profiles
                       on adcenter_staff.email=adcenter_profiles.username
                       where adcenter_profiles.staff_account_flag=1 and adcenter_staff.email not like '%@centricsource.com%'
                       ORDER BY rand() LIMIT 1 ";
                $result = $this->db->executeNative($sql_obj);
                $resultSet = $result->fetchAll();
            }


            if(count($resultSet[0])==0){
                return array(
                    'code'      => 401,
                    'status'    => "error",
                    'msg'       => "User Adgroup Details Not Found"
                );
            }
             $resultSet['code'] = 200;
             $resultSet['msg']  = 'ok';
            return $resultSet;

        }
         catch (\Exception $e) {
            Log::error($e->getMessage());
             return array(
                 'code'      => 401,
                 'status'    => "error",
                 'msg'       => "Database error"
             );
        }
 }

    /**
     * Generating random verification string
     * @return string
     */
    public function utilGetVerifyString() {
        $t=time();
        $str= "v".$t."Z".rand(21,99).rand(400,999).rand(1,9).rand(11,88).rand(7000,9999).rand(41000,99999);
        return $str;
    }

   
}
