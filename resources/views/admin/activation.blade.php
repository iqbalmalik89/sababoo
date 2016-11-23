@extends('admin.layouts.outside')
@section('content')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{URL::to('pannel/assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::to('pannel/assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{URL::to('pannel/assets/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN LOGO -->
<div class="logo">
    <img src="{{URL::to('pannel/assets/pages/img/logo-big.png')}}" alt="" />
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <input type="hidden" id="activation_key" value="{{$code}}"/>

    <?php

        if ($hasError == true) {
    ?>
        <h3 class="form-title font-green">{{$errors[0]}}</h3>
    <?php
        } else {
    ?>
        <form class="login-form">
            <h3 class="form-title font-green">Account Activation</h3>
            <div class="msg_divs alert" id="msg_div"></div>
            <div class="form-group">
                <label  class="text-uppercase" for="new-pwd">New Password</label>
                <input type="password" class="form-control" id="create_password" placeholder="Enter New Password">
            </div>
            <div class="form-group">
                <label  class="text-uppercase" for="new-conf-pwd">Confirm Password</label>
                <input type="password" class="form-control" id="create_confirm_password" placeholder="Enter Confirm Password">
            </div>
            <div class="form-actions">
                <a href="javascript:;" id="user_activation_btn"><button type="button" class="btn green">Submit</button></a>
                <img class="button_spinners" src="{{URL::to('pannel/images/loader.gif')}}" id="submit_loader">
            </div>
        </form>
    <?php
        }
    ?>
    
    <!-- END LOGIN FORM -->
</div>
<div class="copyright"> 2016 © Code Kernal. Admin. </div>

@endsection
@section('scripts')

<script type="text/javascript">
$(document).ready(function() {
   
});
</script> 
@endsection








