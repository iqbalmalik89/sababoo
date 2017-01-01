@extends('admin.layouts.outside')
@section('content')

<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{URL::to('pannel/css/login.min.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN LOGO -->
<div class="logo">
    <img src="{{URL::to('pannel/images/logo.png')}}" alt="" width="100px"/>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div id="login-wrapper">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form">
        <h3 class="form-title font-green">Sign In</h3>
        <div class="msg_divs alert" id="user-login-error-msg"></div>
        <div class="form-group col-md-12">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Enter Email Address" id="user-login-email" /> </div>
        <div class="form-group col-md-12">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Enter Password" id="user-login-password" /> </div>
        <div class="form-actions col-md-12">
            <a href="javascript:;" id="sign-in-btn"><button type="button" class="btn green">Login</button></a>
            <img class="button_spinners" src="{{URL::to('pannel/images/loader.gif')}}" id="sign-in-loader">
            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" style="display: none;">
        <h3 class="font-green">Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="msg_divs alert" id="forgot-error-message"></div>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Enter Email Address" id="forgot_email" /> </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn btn-default">Back</button>
            <a href="javascript:;" id="forgot_send" class="pull-right"><button type="button" class="btn green">Submit</button></a>
            <img class="button_spinners" src="{{URL::to('pannel/images/loader.gif')}}" id="forgot-loader">

        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
</div>
<div class="copyright"> 2016 © Sababoo. Admin. </div>

@endsection
@section('scripts')

<script type="text/javascript">
$(document).ready(function() {
   
});
</script> 
@endsection