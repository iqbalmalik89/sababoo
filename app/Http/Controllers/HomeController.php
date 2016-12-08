<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
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

    public function showSuccessPayment(Request $request)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        $payment = PayPal::getById($id, $this->_apiContext);
        dd($payment);
        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);
        return view('payments.success');
    }

    public function showFailurePayment(Request $request)
    {
        return view('payments.failure');
    }

}
