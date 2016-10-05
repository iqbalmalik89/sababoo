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

use  BusinessObject\Industry;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $employeeServiceProvider;

    public function __construct()
    {
         //$this->middleware('auth');
        $this->employeeServiceProvider = new EmployeeServiceProvider();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHome()
    {

        $this->logged_user = Auth::user();

        if(Auth::user()==null) {
            return view('frontend.site.unauth_home');
        }

        $matchThese = ['status'=>1];
        $industry = Industry::where($matchThese)->get();

        if($this->logged_user->role=="employee"){


            //$employee = Employee::find(array('userid'=> $this->logged_user->id));
            //$employee = Employee::find(array('userid'=> $this->logged_user->id));
            $employee[0] = Employee::where('userid', '=' , $this->logged_user->id)->firstOrFail();
            $education = Education::where(array('userid'=> $this->logged_user->id))->get();
            $certification = Certification::where(array('userid'=> $this->logged_user->id))->get();

            $exp = Experience::where(array('employee_id'=> $employee[0]->id))->get();


             return view('frontend.employee.index',array('userinfo'=>$this->logged_user,'employeeinfo'=>$employee,'industry'=>$industry,'education'=>$education,'exp'=>$exp,'certification'=>$certification));
       }
        else if($this->logged_user->role=="employer"){
            $employer = Employer::where('userid', '=' , $this->logged_user->id)->firstOrFail();
            return view('frontend.employer.index',array('userinfo'=>$this->logged_user,'industry'=>$industry,'employer'=>$employer));

        }

        else if($this->logged_user->role=="tradesman"){

            $tradesman = Tradesman::where('userid', '=' , $this->logged_user->id)->firstOrFail();
            $education = Education::where(array('userid'=> $this->logged_user->id))->get();
            $certification = Certification::where(array('userid'=> $this->logged_user->id))->get();



            return view('frontend.tradesman.index',array('userinfo'=>$this->logged_user,'industry'=>$industry,'tradesman'=>$tradesman,'education'=>$education,'certification'=>$certification));

        }
        return view('frontend.site.home');
    }

     public function index()
    {
         if(Auth::user()!=null) {
             return view('frontend.site.home');
         }
        return view('frontend.site.unauth_home');
    }

}
