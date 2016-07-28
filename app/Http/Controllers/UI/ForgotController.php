<?php

namespace App\Http\Controllers;

use BusinessLogic\ForgotPasswordServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests;

class ForgotPasswordController extends Controller
{
    private $forgotPasswordServiceProvider;

    public function __construct()
    {
        $this->forgotPasswordServiceProvider = new ForgotPasswordServiceProvider();
    }

    public function index(Request $request)
    {
        return $this->forgotPasswordServiceProvider->sendPassword($request->input('email', ''));

    }

}
