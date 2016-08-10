<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHome()
    {
       
       $this->logged_user = Auth::user();
       
       if($this->logged_user->role=="employee"){
        return view('frontend.employee.index');

        }
        return view('frontend.site.home');
    }

     public function index()
    {
     
        return view('frontend.site.home');
    }

}
