<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use BusinessLogic\EmployeeServiceProvider;
use  BusinessObject\User;
use  BusinessObject\Employee;

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
         $this->middleware('auth');
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
        $matchThese = ['status'=>1];
        $industry = Industry::where($matchThese)->get();


        if($this->logged_user->role=="employee"){
            $employee = Employee::find(array('userid'=> $this->logged_user->id));
            return view('frontend.employee.index',array('userinfo'=>$this->logged_user,'employeeinfo'=>$employee,'industry'=>$industry));
       }
        return view('frontend.site.home');
    }

     public function index()
    {
      return view('frontend.site.home');
    }

}
