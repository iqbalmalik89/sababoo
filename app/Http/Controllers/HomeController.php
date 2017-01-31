<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use BusinessLogic\EmployeeServiceProvider;
use BusinessLogic\NetworkServiceProvider;
use  BusinessObject\User;
use  BusinessObject\Employee;
use  BusinessObject\Employer;
use  BusinessObject\Tradesman;
use  BusinessObject\Education;
use  BusinessObject\Experience;
use  BusinessObject\Certification;
use  BusinessObject\UserFiles;
use  BusinessObject\JobPost;
use  App\Models\AppliedJob;
use  App\Models\Payment;
use  BusinessObject\Industry;

use Paypal as PayPal;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $employeeServiceProvider;
    private $user_repo;
    private $_apiContext;
    public function __construct()
    {
         //$this->middleware('auth');
        $this->employeeServiceProvider = new EmployeeServiceProvider();
        $this->user_repo = app()->make('UserRepository');

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHome()
    {

        if (Auth::user()==null) {
            return view('frontend.site.unauth_home');
        } else {
            $this->logged_user = Auth::user();
        } 
        
        $matchThese = ['status'=>1];
        $matchTheseFile = ['status'=>1,'userid'=>$this->logged_user->id];
        $industry = Industry::where($matchThese)->get();
        $user_files = UserFiles::where($matchTheseFile)->get();

        if($this->logged_user->role=="employee"){
            //$employee = Employee::find(array('userid'=> $this->logged_user->id));
            //$employee = Employee::find(array('userid'=> $this->logged_user->id));
            $employee[0] = Employee::where('userid', '=' , $this->logged_user->id)->firstOrFail();
            $education = Education::where(array('userid'=> $this->logged_user->id))->get();
            $certification = Certification::where(array('userid'=> $this->logged_user->id))->get();

            $exp = Experience::where(array('employee_id'=> $employee[0]->id))->get();

            return redirect("/employee/view/".$employee[0]->id);
            //return view('frontend.employee.index',array('userinfo'=>$this->logged_user,'employeeinfo'=>$employee,'industry'=>$industry,'education'=>$education,'exp'=>$exp,'certification'=>$certification,'user_files'=>$user_files));
       }
        else if($this->logged_user->role=="employer"){
            $employer = Employer::where('userid', '=' , $this->logged_user->id)->firstOrFail();
            return redirect("/employer/view/".$employer->id);
            //return view('frontend.employer.index',array('userinfo'=>$this->logged_user,'industry'=>$industry,'employer'=>$employer,'user_files'=>$user_files));

        }

        else if($this->logged_user->role=="tradesman"){

            $tradesman = Tradesman::where('userid', '=' , $this->logged_user->id)->firstOrFail();
            $education = Education::where(array('userid'=> $this->logged_user->id))->get();
            $certification = Certification::where(array('userid'=> $this->logged_user->id))->get();
            return redirect("/tradesman/view/".$tradesman->id);
            //return view('frontend.tradesman.index',array('userinfo'=>$this->logged_user,'industry'=>$industry,'tradesman'=>$tradesman,'education'=>$education,'certification'=>$certification,'user_files'=>$user_files));

        }

        else if($this->logged_user->is_admin==1){

            $adminUser = $this->user_repo->findById($this->logged_user->id);

            return view('frontend.admin_user.index',array('userinfo'=>$this->logged_user, 'adminUser'=>$adminUser));

        }
        return view('frontend.site.home');
    }

    public function showProfileUpdate()
    {

        if (Auth::user()==null) {
            return view('frontend.site.unauth_home');
        } else {
            $this->logged_user = Auth::user();
        } 
        
        $matchThese = ['status'=>1];
        $matchTheseFile = ['status'=>1,'userid'=>$this->logged_user->id];
        $industry = Industry::where($matchThese)->get();
        $user_files = UserFiles::where($matchTheseFile)->get();

        if($this->logged_user->role=="employee"){
            //$employee = Employee::find(array('userid'=> $this->logged_user->id));
            //$employee = Employee::find(array('userid'=> $this->logged_user->id));
            $employee[0] = Employee::where('userid', '=' , $this->logged_user->id)->firstOrFail();
            $education = Education::where(array('userid'=> $this->logged_user->id))->get();
            $certification = Certification::where(array('userid'=> $this->logged_user->id))->get();

            $exp = Experience::where(array('employee_id'=> $employee[0]->id))->get();

            return view('frontend.employee.index',array('userinfo'=>$this->logged_user,'employeeinfo'=>$employee,'industry'=>$industry,'education'=>$education,'exp'=>$exp,'certification'=>$certification,'user_files'=>$user_files));
       }
        else if($this->logged_user->role=="employer"){
            $employer = Employer::where('userid', '=' , $this->logged_user->id)->firstOrFail();
            return view('frontend.employer.index',array('userinfo'=>$this->logged_user,'industry'=>$industry,'employer'=>$employer,'user_files'=>$user_files));

        }

        else if($this->logged_user->role=="tradesman"){

            $tradesman = Tradesman::where('userid', '=' , $this->logged_user->id)->firstOrFail();
            $education = Education::where(array('userid'=> $this->logged_user->id))->get();
            $certification = Certification::where(array('userid'=> $this->logged_user->id))->get();
            return view('frontend.tradesman.index',array('userinfo'=>$this->logged_user,'industry'=>$industry,'tradesman'=>$tradesman,'education'=>$education,'certification'=>$certification,'user_files'=>$user_files));

        }

        else if($this->logged_user->is_admin==1){

            $adminUser = $this->user_repo->findById($this->logged_user->id);

            return view('frontend.admin_user.index',array('userinfo'=>$this->logged_user, 'adminUser'=>$adminUser));

        }
        return view('frontend.site.home');
    }

     public function index()
    {
         if(Auth::user()!=null) {
            return redirect('home');
         }
        return view('frontend.site.unauth_home');
    }

    public function showLogin()
    {
         if(Auth::user()!=null) {
            return redirect('home');
         }
        return view('frontend.auth.login');
    }

    public function showAboutUs()
    {
         if(Auth::user()!=null) {
            return view('frontend.site.aboutus');
         } else {
            return view('frontend.site.unauth_aboutus');
         }
    }

    public function showContactUs()
    {
         if(Auth::user()!=null) {
            return view('frontend.site.contactus');
         } else {
          return view('frontend.site.unauth_contactus');
         }
        
    }

    public function showSuccessPayment(Request $request)
    {
      if (Auth::user() != NULL) {
        $this->logged_user = Auth::user();
      }
      $aj_id = $request->get('aj_id');
      $id = $request->get('paymentId');
      /*$token = $request->get('token');
      $payer_id = $request->get('PayerID');

      $payment = PayPal::getById($id, $this->_apiContext);
      $paymentExecution = PayPal::PaymentExecution();

      $paymentExecution->setPayerId($payer_id);*/
      //$executePayment = $payment->execute($paymentExecution, $this->_apiContext);

      // Clear the shopping cart, write to database, send notifications, etc.
      $appliedJob = AppliedJob::find($aj_id);
      $recordPayment = new Payment;
      $recordPayment->payment_id = $id;
      //$recordPayment->payment_amount = $payment->transactions[0]->amount->total;
      $recordPayment->payment_amount = $appliedJob->cost;
      $recordPayment->payment_status = 'completed';
      $recordPayment->job_id = $appliedJob->job_id;
      //$recordPayment->payer_id = $payer_id;
      $recordPayment->user_id = $this->logged_user->id;
      $recordPayment->createdtime = date('Y-m-d H:i:s');
      if($recordPayment->save()) {
        $appliedJob->is_awarded = 1;
        $appliedJob->save();

        JobPost::where('id', '=', $appliedJob->job_id)->update(['job_status'=>'in-progress']);
        Cache::forget('job-'.$appliedJob->job_id);
      }
        return view('payments.success');
    }

    public function showFailurePayment(Request $request)
    {
        return view('payments.failure');
    }

}
