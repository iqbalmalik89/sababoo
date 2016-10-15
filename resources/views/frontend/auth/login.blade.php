@extends('frontend.layouts.unathenticate')

@section('title', 'Login')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing')


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


    /*FORGOT PASSWORD*/

    $('#forgot_password').click(function(){
        $('#loader_forgot').show();
        pageURI = '/ui/forgotpw';
        $("#forgot_password").prop('disabled',true);
        $('#msg_frm_forgot_pass').removeClass('msg_ok msg_cancel');
        $('#msg_frm_forgot_pass').html('');
        $('#msg_frm_forgot_pass').html('');
        if ($('#forgot_email').val() == '') {
            $('#msg_frm_forgot_pass').addClass('msg_error');
            $('#msg_frm_forgot_pass').html('<ul><li>Email is required.</li></ul>').slideDown('fast');
            $("#forgot_password").prop('disabled',false);
            $('#loader_forgot').hide();
            return false;
        }
        request_data = {'email':$('#forgot_email').val()};
        mainAjax('frm_forgot_pass', request_data, 'POST',forgot_response);
        $('#loader_forgot').hide();
       
    });
   
});

function forgot_response(data){
     $('#loader_forgot').hide();
        if(data.code==200){
            $('#msg_frm_forgot_pass').addClass('msg_ok');
            $('#msg_frm_forgot_pass').html(data.msg).slideDown('fast');
            $("#forgot_password").prop('disabled',false);
            setTimeout(function() { $('#forgot_close').trigger('click'); },2000);
            

            return false;
        }else{
            $('#msg_frm_forgot_pass').addClass('msg_error');
            $('#msg_frm_forgot_pass').html('<ul class="msg_full"><li>'+data.msg+'</li></ul>').slideDown('fast');
            $("#forgot_password").prop('disabled',false);
            return false;
        }
    }
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