@extends('frontend.layouts.unathenticate')

@section('title', 'Signup')
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
                            <h4 class="modal-title text-center">Create your account for free</h4>
                        </div>

                        <div class="modal-body">
                                                
                            <div class="row gap-20">
								    <div id="msg_frm_join" class=""></div>
                                	<form action="" method="post" name="frm_join" id="frm_join">

                                
                                <div class="col-sm-12 col-md-12">
								
                                    <div class="form-group"> 
                                        <label>First Name</label>
                                        <input class="form-control" id="first_name" name="first_name" placeholder="Enter first name" type="text"> 
                                    </div>
                                
                                </div>
 
                                 <div class="col-sm-12 col-md-12">

                                    <div class="form-group"> 
                                        <label>Last Name</label>
                                        <input class="form-control" id="last_name" name="last_name" placeholder="Enter last name" type="text"> 
                                    </div>
                                
                                </div>
                               
                                <div class="col-sm-12 col-md-12">

                                    <div class="form-group"> 
                                        <label>Email Address</label>
                                        <input class="form-control" id="email" name="email" placeholder="Enter your email address" type="text"> 
                                    </div>
                                
                                </div>
                                
                                <div class="col-sm-12 col-md-12">
                                
                                    <div class="form-group"> 
                                        <label>Password (6 or more characters)</label>
                                        <input class="form-control" id="password" name="password" placeholder="Enter password" type="password"> 
                                    </div>
									
                                
                                </div>

                                 <div class="col-sm-12 col-md-12">
                                
                                    <div class="form-group"> 
                                        <label>Role</label>

                                        <input  style="display:block;opacity:1;margin:5px 0px 0px 0px;" type="radio" name="role" id="role" value="employee" checked="checked">

                                        <label class="" for="register_accept_checkbox">Emplyee</label>
                                        <input  style="display:block;opacity:1;margin:5px 0px 0px 0px;" type="radio" name="role" id="role" value="employer">
                                        <label class="" for="register_accept_checkbox">Emplyer</label>
                                        <input  style="display:block;opacity:1;margin:5px 0px 0px 0px;" type="radio" name="role" id="role" value="tradesman">
                                        <label class="" for="register_accept_checkbox">Tradesman</label>

                                    </div>
                                </div>

                                                                
                                <div class="col-sm-12 col-md-12">
                                    <div class="checkbox-block"> 
<!--                                         <input id="register_accept_checkbox" name="register_accept_checkbox" class="checkbox" value="First Choice" type="checkbox">  -->
                                        <label class="" for="register_accept_checkbox">By clicking Join now, you agree to Sababoo's <a href="#">User Agreement</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookie Policy</a>.</label>
                                    </div>
                                </div>
                                
                               
                                

                                <div class="col-sm-12 col-md-12">
                                    <div class="login-box-box-action">
                                        Already have account? <a href="/login">Log-in</a>
                                    </div>
                                </div>
							</form>
                            </div>

                        </div>

                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-primary" id="join_now" >Join now</button>
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
    $('#join_now').click(function () {
        $('.loader').show();
        html = '';
        pageURI = '/ui/createuser';
        
        request_data = $('#frm_join').serializeArray();
        mainAjax('frm_join', request_data, 'POST',fillData);
   
    });
    
   
    // Press with enter key.
    submit_key('frm_join input', 'btnsignup');
   
});
function fillData(data){
    $('.loader').hide();
    if (data.code != '200') {
        $('#password').val('');
        return;
    }
    $('#first_name').val('');
	$('#last_name').val('');
	$('#email').val('');
    $('#password').val('');
   
   
}

</script>
@endsection