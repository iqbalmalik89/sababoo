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
                            
<!--                                 <div class="col-md-12">
                                    <button class="btn btn-facebook btn-block mb-5">Register with Facebook</button>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-google-plus btn-block">Register with Google+</button>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="login-modal-or">
                                        <div><span>or</span></div>
                                    </div>
                                </div> -->
                                
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
                                        <input class="form-control" id="email_address" name="email_address" placeholder="Enter your email address" type="text"> 
                                    </div>
                                
                                </div>
                                
                                <div class="col-sm-12 col-md-12">
                                
                                    <div class="form-group"> 
                                        <label>Password (6 or more characters)</label>
                                        <input class="form-control" id="password" name="password" placeholder="Enter password" type="text"> 
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
                                
                            </div>

                        </div>

                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-primary">Join now</button>
                        </div>
                        
                    </div>

                    
                </div>
            
            </div>
            
        </div>
        
    </div>
    
@endsection