<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:52 AM
 */


namespace BusinessLogic;
use Helper;
use Illuminate\Support\Facades\Cache;
use  BusinessObject\User;
use  BusinessObject\Language;
use  BusinessObject\JobPost;
use  App\Models\AppliedJob;
use  App\Models\Refund;
use  App\Models\Payment;
use Validator;
use DB;
use Paypal as PayPal;

class JobPostServiceProvider
{


    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => env('PAYPAL_MODE'),
            'service.EndPoint' => env('PAYPAL_SERVICE_ENDPOINT'),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function createJob($data, $loggedUser){
        $job_deadline = $data['job_day']."-".$data['job_month']."-".$data['job_year'];


        if($data['jobid']){
            $job = JobPost::find($data['jobid']);
            if(isset($data['userid'])){ 		        $job->userid 		            = $data['userid']; }
            if(isset($data['title'])){ 		            $job->name 		                = $data['title']; }
            if(isset($data['description'])){ 		    $job->description 		        = $data['description']; }
            if(isset($data['job_type'])){ 		        $job->type 		                = $data['job_type']; }
            if(isset($data['location'])){ 		        $job->location 		            = $data['location']; }
            if(isset($data['salary'])){ 		        $job->salary 		            = $data['salary']; }
            if(isset($data['requirement'])){ 		    $job->requirement 		        = $data['requirement']; }
            if(isset($data['responsibilites'])){ 		$job->responsibilites 		    = $data['responsibilites']; }
            if(isset($data['experience'])){ 		    $job->experience 		        = $data['experience']; }
            if(isset($data['industry_id'])){ 		    $job->industry_id 		        = $data['industry_id']; }
            if(isset($data['all_terms'])){ 		        $job->terms 		            = $data['all_terms']; }
            
            $job->job_deadline_date 		= $job_deadline;

            if ($loggedUser->is_admin == 1) {
              $job->moderated = 1;

              // send an email to user
              $receiver_data = User::where(array('id'=>$job->userid))->first();
               $sender_data = User::where(array('id'=>$loggedUser->id))->first();
               #$data['to']  = $receiver_data->email;
               if ($receiver_data != NULL) {

                  $subject = "Sababoo's - Job updated by " . $sender_data->email;
                  $from = "noreply@sababoo.com";

                    $data = [
                       "from"           => $from,
                       "to"             => $receiver_data->email,
                       "subject"        => $subject,
                       "sender_email"   => $sender_data->email,
                       "SERVER_PATH"    => env('URL'),
                       "job_id"         =>  $job->job_id,
                       "job_name"       =>  $job->name

                   ];

                   $mail_response = Helper::sendEmail(
                       $data,
                       ['email_templates/job_update_html', 'email_templates/job_update_text']
                   );
                  
                   
               }
            }
            $job->update();
            Cache::forget('job-'.$job->id);
            return array(
                'code' => '200',
                'status' => 'ok',
                'msg' => "Job update successfully.",

            );
        }

//dd($data);
        $job = new JobPost;
        $job->userid        = $data['userid'];
        $job->name          = $data['title'];
        $job->description   = strip_tags($data['description']);
        $job->type          = $data['job_type'];
        $job->location      = $data['location'];
        $job->salary        = $data['salary'];
        $job->requirement   = strip_tags($data['requirement']);
        $job->responsibilites = strip_tags($data['responsibilites']);
        $job->experience      = $data['experience'];
        $job->industry_id     = $data['industry'];
        $job->job_deadline_date = $job_deadline;
        $job->terms 		    = $data['all_terms'];
        $job->job_status    = 'pending';

        $job->save();
        return array(
            'code' => '200',
            'status' => 'ok',
            'msg' => "Job created successfully.",

        );

    }


    public function userJobList($filters, $orderby = ['order' => "", 'sort_by' => ""], $paging = ["page_num" => 1, "page_size" => 0]){

        $matchThese = ["job_post.userid"=>$filters['userid'],"job_post.is_active" =>1, "deleted_at"=>NULL];

        $name = isset($filters['name'])?$filters['name']:'';
        $loc = isset($filters['location'])?$filters['location']:'';
        $category = isset($filters['category'])?$filters['category']:'';
        $type = isset($filters['type'])?$filters['type']:'';
        /*if(isset($filters['name']) and $filters['name']!=''){
           // $matchThese['job_post.name'] = $filters['name'];
            //$matchThese['job_post.name'] = " 'job_post.name', 'LIKE', '%'".$filters['name']."'%' ";

        }*/


       /* if(isset($filters['location']) and $filters['location']!=''){
           // $matchThese['job_post.location'] = $filters['location'];
           // $matchThese['job_post.location'] = 'job_post.location', 'LIKE', '%'.$tag.'%';

        }*/
       //dd($matchThese);
      $str = '';
      foreach($matchThese as $key=>$value){

            if($key =='job_post.location'){
                $str.="job_post.location LIKE '%$value%' and ";
            }
         elseif($key =='job_post.name'){
              $str.="job_post.name LIKE '%$value%' and ";
          }elseif($key =='job_post.type'){
              $str.="job_post.type LIKE '%$type%' and ";
          }elseif($key =='industry.name'){
              $str.="industry.name LIKE '%$category%' and ";
          }else{
                $str.=" '$key'= '$value' and " ;

            }

      }


        $job = DB::table('job_post')
            ->select('job_post.id as id','job_post.name as name','job_post.type as type','job_post.location as location','job_post.job_deadline_date','job_post.created_at','industry.id as ind_id','industry.name as ind_name')
            ->join('industry', 'job_post.industry_id', '=','industry.id' )
            ->where($matchThese)
            ->Where("job_post.name", "LIKE", "%$name%")
            ->Where("job_post.location", "LIKE", "%$loc%")
            ->Where("job_post.type", "LIKE", "%$type%")
            ->Where("industry.name", "LIKE", "%$category%")
            ->OrderBy('job_post.created_at', 'DESC')
        //dd( count($job) );
        ->paginate($paging['page_size']);
  //dd(DB::getQueryLog());

        return $job;
     }

     public function userAppliedJobs($filters, $orderby = ['order' => "", 'sort_by' => ""], $paging = ["page_num" => 1, "page_size" => 0]){

        $matchThese = [];

        $name = isset($filters['name'])?$filters['name']:'';
        $loc = isset($filters['location'])?$filters['location']:'';
        $message = isset($filters['message'])?$filters['message']:'';
        $type = isset($filters['type'])?$filters['type']:'';

        $userID = $filters['userid'];
        $str = '';
        foreach($matchThese as $key=>$value){

              if($key =='job_post.location'){
                  $str.="job_post.location LIKE '%$value%' and ";
              }
           elseif($key =='job_post.name'){
                $str.="job_post.name LIKE '%$value%' and ";
            }elseif($key =='job_post.type'){
                $str.="job_post.type LIKE '%$type%' and ";
            }elseif($key =='appliead_jobs.message'){
                $str.="appliead_jobs.message LIKE '%$message%' and ";
            }else{
                  $str.=" '$key'= '$value' and " ;

              }

        }


        $job = DB::table('job_post')
            ->select('job_post.id as id','job_post.name as name','job_post.type as type','job_post.location as location','job_post.job_deadline_date','applied_jobs.id as aj_id','applied_jobs.cost','applied_jobs.created_at as aj_created_at','applied_jobs.message as aj_message')
            ->join('applied_jobs', 'job_post.id', '=','applied_jobs.job_id' )
            ->where($matchThese)
            ->Where("applied_jobs.user_id", "=", "$userID")
            ->Where("job_post.name", "LIKE", "%$name%")
            ->Where("job_post.location", "LIKE", "%$loc%")
            ->Where("job_post.type", "LIKE", "%$type%")
            ->Where("applied_jobs.message", "LIKE", "%$message%")
            ->OrderBy('applied_jobs.created_at', 'DESC')
        //dd( count($job) );
        ->paginate($paging['page_size']);
        //dd(DB::getQueryLog());
        
        return $job;
     }

     public function jobProposalsList($filters, $orderby = ['order' => "", 'sort_by' => ""], $paging = ["page_num" => 1, "page_size" => 0]){

        $matchThese = [];

        $name = isset($filters['name'])?$filters['name']:'';
        $loc = isset($filters['location'])?$filters['location']:'';

        $job_id = $filters['job_id'];
        $str = '';
        foreach($matchThese as $key=>$value){

              if($key =='job_post.location'){
                  $str.="job_post.location LIKE '%$value%' and ";
              }
           elseif($key =='job_post.name'){
                $str.="job_post.name LIKE '%$value%' and ";
            }else{
                  $str.=" '$key'= '$value' and " ;

              }

        }


        $job = DB::table('job_post')
            ->select('job_post.id as id','job_post.userid as user_id','job_post.name as name','job_post.type as type','job_post.location as location','job_post.job_deadline_date','job_post.refund_requested','job_post.job_status as job_status','applied_jobs.id as aj_id','applied_jobs.created_at as aj_created_at','applied_jobs.message as aj_message','applied_jobs.cost as aj_cost','applied_jobs.user_id as aj_userid','applied_jobs.is_awarded as is_awarded')
            ->join('applied_jobs', 'job_post.id', '=','applied_jobs.job_id' )
            ->where($matchThese)
            ->Where("job_post.id", "=", "$job_id")
            ->Where("job_post.name", "LIKE", "%$name%")
            ->Where("job_post.location", "LIKE", "%$loc%")
            ->OrderBy('applied_jobs.created_at', 'DESC')
        //dd( count($job) );
        ->paginate($paging['page_size']);
        //dd(DB::getQueryLog());
        
        return $job;
     }

    public function getJobByJobId($jobid){
        $matchThese = ['job_post.id'=>$jobid];
        $job = DB::table('job_post')
            ->select('job_post.*','industry.id as ind_id','industry.name as ind_name','users.first_name','users.last_name','users.id as userid','users.image','users.role')
            ->join('industry', 'job_post.industry_id', '=','industry.id' )
            ->join('users', 'job_post.userid', '=','users.id' )
            ->where($matchThese)
            ->first();
        return $job;
    }

    public function jobDelByJobId($jobid){
        $job = JobPost::find($jobid);
        /*$job->status      = 2;
        $job->update();*/
        if ($job != NULL) {
            $job->delete();
            return array(
                'code' => '200',
                'status' => 'ok',
                'msg' => "Job deleted successfully.",

            );
        }
        
    }

    public function allJobList($filters, $orderby = ['order' => "", 'sort_by' => ""], $paging = ["page_num" => 1, "page_size" => 0]){
        $name = null;
        $location = null;
        $type = null;
        $ind_name = null;
      //  dd($filters);
        if($filters['search_by']=='name'){
            $name = isset($filters['search'])?$filters['search']:'';
        }
        if($filters['search_by']=='location'){
            $location = isset($filters['search'])?$filters['search']:'';
        }
        if($filters['search_by']=='type'){
            $type = isset($filters['search'])?$filters['search']:'';
        }
        if($filters['search_by']=='category'){
            $ind_name = isset($filters['search'])?$filters['search']:'';
        }



        $matchThese = ["job_post.status" =>1, "job_post.is_active" =>1, "job_post.deleted_at" =>NULL];
        $job = DB::table('job_post')
            ->select('job_post.id as id','job_post.name as name','job_post.type as type','job_post.location as location','job_post.job_deadline_date','job_post.created_at','industry.id as ind_id','industry.name as ind_name')
            ->join('industry', 'job_post.industry_id', '=','industry.id' )
            ->where($matchThese)
            ->Where("job_post.userid", "!=", $filters['userid'])
            ->Where("job_post.name", "LIKE", "%$name%")
            ->Where("job_post.location", "LIKE", "%$location%")
            ->Where("job_post.type", "LIKE", "%$type%")
            ->Where("industry.name", "LIKE", "%$ind_name%")
            ->OrderBy('job_post.created_at', 'DESC')
            //dd( count($job) );
            ->paginate($paging['page_size']);
        //dd(DB::getQueryLog());
        return $job;
    }


    public function applyJob($post_data){

      $currentDate = date('Y-m-d');

       $job_post = JobPost::where(array('id'=>$post_data['job_id']))->first();
       
       $receiver_data = User::where(array('id'=>$job_post->userid))->first();
       $sender_data = User::where(array('id'=>$post_data['user_id']))->first();
       #$data['to']  = $receiver_data->email;

       $checkJob = AppliedJob::where('user_id', '=', $post_data['user_id'])->where('job_id', '=', $post_data['job_id'])->first();
       if ($checkJob == NULL) {

          $job_post->job_deadline_date = date('Y-m-d', strtotime($job_post->job_deadline_date));
            
          if ($currentDate <= $job_post->job_deadline_date ) {

            $subject = "Sababoo's - Application on your posted job by " . $sender_data->email;
            $from = "noreply@sababoo.com";

             $data = [
                 "from"           => $from,
                 "to"             => $receiver_data->email,
                 "subject"        => $subject,
                 "sender_email"   => $sender_data->email,
                 "SERVER_PATH"    => env('URL'),
                 "job_id"         =>  $post_data['job_id'],
                 "user_id"         =>  $post_data['user_id'],
                 "job_name"       =>  $job_post->name,
                 "cover_message"       =>  $post_data['cover_message']

             ];

             $mail_response = Helper::sendEmail(
                 $data,
                 ['email_templates/job_apply_html', 'email_templates/job_apply_text']
             );

             $jobApply = new AppliedJob;
             $jobApply->job_id = $data['job_id'];
             $jobApply->user_id = $data['user_id'];
             $jobApply->message = $post_data['cover_message'];
             $jobApply->cost = $post_data['extra_cost'];
             $jobApply->save();

             return array(
                  'code' => '200',
                  'status' => 'ok',
                  'msg' => "Job application has been subimtted successfully.",
              );

         } else {

            return array(
                  'code' => '406',
                  'status' => 'error',
                  'msg' => "Job has been expired, you cannot apply now.",

              );
         }  

       } else {
          return array(
                  'code' => '409',
                  'status' => 'error',
                  'msg' => "You have already applied for this job.",

              );
       }
           

   }

   public function askRefund($post_data){

      $currentDate = date('Y-m-d');

       $applied_job = AppliedJob::where(array('id'=>$post_data['aj_id']))->first();
       $paymentInfo = Payment::where('job_id', '=', $applied_job->job_id)->where('user_id', '=', $post_data['user_id'])->first();

       if ($paymentInfo != NULL) {
          if ($post_data['amount'] > $paymentInfo->payment_amount ) {
              return array(
                  'code' => '406',
                  'status' => 'error',
                  'msg' => "Sorry! You have asked for the amount greater then you have paid.",

              );
          } else {
              $jobRefund = new Refund;
               $jobRefund->payment_id = $paymentInfo->id;
               $jobRefund->job_id = $paymentInfo->job_id;
               $jobRefund->amount = $post_data['amount'];
               $jobRefund->reason = $post_data['reason'];
               $jobRefund->requested_by = $post_data['user_id'];
               $jobRefund->created_at = $currentDate;
               if ($jobRefund->save()){

                $receivers_data = User::where(array('is_admin'=>1))->get();
                 $sender_data = User::where(array('id'=>$post_data['user_id']))->first();
                 #$data['to']  = $receiver_data->email;
                 if (count($receivers_data) > 0) {
                    $job_post = JobPost::where(array('id'=>$applied_job->job_id))->first();

                    $subject = "Sababoo's - Refund request by " . $sender_data->email;
                    $from = "noreply@sababoo.com";

                    foreach ($receivers_data as $key => $receiver_data) {
                      $data = [
                         "from"           => $from,
                         "to"             => $receiver_data->email,
                         "subject"        => $subject,
                         "sender_email"   => $sender_data->email,
                         "SERVER_PATH"    => env('URL'),
                         "job_id"         =>  $applied_job->job_id,
                         "user_id"        =>  $post_data['user_id'],
                         "job_name"       =>  $job_post->name

                     ];

                     $mail_response = Helper::sendEmail(
                         $data,
                         ['email_templates/job_refund_html', 'email_templates/job_refund_text']
                     );
                    }
                     
                 }

                 $job_post->refund_requested = 1;
                 $job_post->save();
                 Cache::forget('job-'.$job_post->id);
                 return array(
                    'code' => '200',
                    'status' => 'ok',
                    'msg' => "Refund request has been subimtted successfully.",
                );
               } else {
                    return array(
                      'code' => '406',
                      'status' => 'error',
                      'msg' => "An error occured.",

                  );
               } 
          }
          
       } else {
          return array(
                  'code' => '404',
                  'status' => 'error',
                  'msg' => "Payment not found.",

              );
       }
       
              
   }

   public function payment($input)
  {
      $appliedJob = AppliedJob::find($input['aj_id']);
      if($appliedJob != NULL) {
        $getJob = JobPost::find($appliedJob->job_id);
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal:: Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($appliedJob->cost); // This is the simple way,
        // you can alternatively describe everything in the order separately;
        // Reference the PayPal PHP REST SDK for details.

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($getJob->name);

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(url('success-payment?aj_id='.$input['aj_id']));
        $redirectUrls->setCancelUrl(url('failure-payment?aj_id='.$input['aj_id']));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return redirect( $redirectUrl);  
      } else {
        abort(404);
      }

  }

  
  public function userTransactions($filters, $orderby = ['order' => "", 'sort_by' => ""], $paging = ["page_num" => 1, "page_size" => 0]){

        $matchThese = [];

        $start_date = ($filters['start_date'] != '')?date('Y-m-d', strtotime($filters['start_date'])):'';
        $end_date = ($filters['end_date'] != '')?date('Y-m-d', strtotime($filters['end_date'])):date('Y-m-d');

        $userID = $filters['userid'];
        $str = '';

        if ($start_date != '') {
            $transactions = DB::table('payments')
                ->select('payments.id as id','payments.payment_id as payment_id','payments.payment_amount as payment_amount','payments.job_id as job_id','payments.payer_id as payer_id','payments.createdtime as created_at','job_post.name as job_name')
                ->join('job_post', 'payments.job_id', '=','job_post.id' )
                //->where($matchThese)
                ->Where("payments.user_id", "=", "$userID")
                ->WhereBetween(\DB::raw("date(payments.createdtime)"), [$start_date, $end_date])
                ->OrderBy('payments.createdtime', 'DESC')
            //dd( count($job) );
            ->paginate($paging['page_size']);
        } else {
            $transactions = DB::table('payments')
              ->select('payments.id as id','payments.payment_id as payment_id','payments.payment_amount as payment_amount','payments.job_id as job_id','payments.payer_id as payer_id','payments.createdtime as created_at','job_post.name as job_name')
              ->join('job_post', 'payments.job_id', '=','job_post.id' )
              //->where($matchThese)
              ->Where("payments.user_id", "=", "$userID")
              ->OrderBy('payments.createdtime', 'DESC')
          //dd( count($job) );
          ->paginate($paging['page_size']);
        }
        
        //dd(DB::getQueryLog());
        return $transactions;
     }

  public function getNewsByIndustry($filters, $orderby = ['order' => "", 'sort_by' => ""], $paging = ["page_num" => 1, "page_size" => 0]){

        $userID = $filters['userid'];
        $industry_id = $filters['industry_id'];

        if ($industry_id > 0) {
          $matchThese = ["news.is_active" =>1, "news.deleted_at"=>NULL, "news.industry_id"=>$industry_id];
        } else {
          $matchThese = ["news.is_active" =>1, "news.deleted_at"=>NULL];
        }
      
        $title = isset($filters['title'])?$filters['title']:'';
        $description = isset($filters['description'])?$filters['description']:'';
        
        $str = '';
        foreach($matchThese as $key=>$value){

              if($key =='news.title'){
                  $str.="news.title LIKE '%$title%' and ";
              }
              elseif($key =='news.description'){
                $str.="news.description LIKE '%$description%' and ";
            }else{
                  $str.=" '$key'= '$value' and " ;
              }
        }

        $news = DB::table('news')
          ->select('news.id as id','news.title','news.description','news.industry_id','news.created_at','industry.name as industry_name')
          ->join('industry', 'news.industry_id', '=','industry.id' )
          ->where($matchThese)
          ->Where("news.title", "LIKE", "%$title%")
          ->Where("news.description", "LIKE", "%$description%")
          ->OrderBy('news.created_at', 'DESC')
      //dd( count($job) );
      ->paginate($paging['page_size']);
      
        //dd(DB::getQueryLog());
        return $news;
     }

}
