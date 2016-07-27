@extends('frontend.layouts.master')

@section('title', 'Signup')

@section('content')
                                
    <div class="row">
    
        <div class="col-md-10 col-md-offset-1">
        
            <div class="row">

                <div class="col-sm-6 col-sm-offset-3">
                
                    <div class="login-box-wrapper">
            
                        <div class="modal-header">
                            <h4 class="modal-title text-center">Create your account for free</h4>
                        </div>

                        <div class="modal-body">
                                                
                            <div class="row gap-20">
								<div id="loader" class="loader"></div>
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
                                    <div class="checkbox-block"> 
<!--                                         <input id="register_accept_checkbox" name="register_accept_checkbox" class="checkbox" value="First Choice" type="checkbox">  -->
                                        <label class="" for="register_accept_checkbox">By clicking Join now, you agree to Sababoo's <a href="#">User Agreement</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookie Policy</a>.</label>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-md-12">
                                    <div class="login-box-box-action">
                                        Already have account? <a href="account-login-page.html">Log-in</a>
                                    </div>
                                </div>
							</form>
                            </div>

                        </div>

                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-primary" id="join_now">Join now</button>
                        </div>
                        
                    </div>

                    
                </div>
            
            </div>
            
        </div>
        
    </div>
<style>
.loader{
    background: rgba(0, 0, 0, 0.1) url("../images/loader.gif") no-repeat scroll center center !important;
    height: 99.5%;
    position: absolute;
    width: 99.5%;}
	
	.msg_cancel, .msg_ok, .msg_error {
    background-color: #f2dede;
    border-radius: 5px;
    border: 1px solid #eed3d7;
    clear: both;
    color: #b94a48;
    display: inline-block;
    font: 700 12px/14px arial;
    margin: -3px 0 10px;
    padding: 6px 0.5%;
    text-align: center;
    width: 99%;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    float: left;
}
</style>	
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
        var frm = $(this).attr("tab_sec_id");
        var button = $(this);
        html = $(this).val();

        if (button.val() != 'Signup') {
            alert("Please wait. Request is already processing.");
            return false;
        }
        button.val('Creating, please wait ...');
        request_data = $('#frm_join').serializeArray();
        mainAjax('frm_join', request_data, 'POST',fillData);
        goToByScroll('signup_top');

    });
    
   
    // Press with enter key.
    submit_key('frm_join input', 'btnsignup');
   
});
function fillData(data){
    $('.loader').hide();
    if (data.code != '200') {
        $('#btnsignup').val(html);
        $('#password1').val('');
        $('#password2').val('');
        $('#captcha').val('');
        return;
    }
    $('#frm_join :input').val('');
    $('#agree').attr('checked', false);
    $('#agree').val('yes');
    $('#country option[value="US"]').attr("selected", true);
     $('#msg_frm_join').addClass('msg_full');
    $('#btnsignup').val(html);

}

</script>
@endsection