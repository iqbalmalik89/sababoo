@extends('frontend.layouts.master')

@section('title', 'Login')

@section('content')
                                
    <div class="row">
    
        <div class="col-md-10 col-md-offset-1">
        
            <div class="row">

                <div class="col-sm-6 col-sm-offset-3">
                
                    <div class="login-box-wrapper">
                         <div class="loader" style="display:none;"></div>
                        <div class="modal-header">
                            <h4 class="modal-title text-center">Login </h4>
                        </div>

                        <div class="modal-body">
                                                
                            <div class="row gap-20">
                                    <div id="msg_frm_login" class=""></div>
                                    <form action="" method="post" name="frm_login" id="frm_login">
 
                                <div class="col-sm-12 col-md-12">

                                    <div class="form-group"> 
                                        <label>Email Address</label>
                                        <input class="form-control" id="email" name="email" placeholder="Enter your email address" type="text"> 
                                    </div>
                                
                                </div>
                                
                                <div class="col-sm-12 col-md-12">
                                
                                    <div class="form-group"> 
                                        <label>Password </label>
                                        <input class="form-control" id="password" name="password" placeholder="Enter password" type="password"> 
                                    </div>
                                    
                                
                                </div>
                                
                                
                                <div class="col-sm-6 col-md-6">
                            <div class="checkbox-block"> 
                                <input id="remember" name="remember" class="checkbox" value="remember" type="checkbox"> 
                                <label class="" for="remember_me_checkbox">Remember me</label>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-6">
                            <div class="login-box-link-action">
                                <a data-toggle="modal" href="#forgotPasswordModal">Forgot password?</a> 
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                            <div class="login-box-box-action">
                                No account? <a href="/signup">Register</a>
                            </div>
                        </div>
                            </form>
                            </div>

                        </div>

                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-primary" id="login" >Login</button>
                        </div>
                        
                    </div>

                    
                </div>
            
            </div>
            
        </div>
        
    </div>
    
<script>    
var pageURI = '';
var request_data = '';
var isScrLock = false;
var html = '';
$(document).ready(function () {
    //Sign up
    $('#login').click(function () {
        $('.loader').show();
        html = '';
        pageURI = '/auth/login';
        request_data = $('#frm_login').serializeArray();
        mainAjax('frm_login', request_data, 'POST',fillData);
   
    });
    
   
    // Press with enter key.
    submit_key('frm_join input', 'btnsignup');
   
});
function fillData(data){
    $('.loader').hide();
   
}
 $("#frm_login input").keypress(function (e) {
        if (e.which == 13) {
            $("#login").trigger('click');
        }
    });
   // submit_key('frm_login input', 'login');

</script>
@endsection