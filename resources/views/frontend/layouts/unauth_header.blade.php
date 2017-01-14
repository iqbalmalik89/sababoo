        <header id="header">
   <meta charset="utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
     
            <!-- start Navbar (Header) -->
            <nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

                <div class="container">
                    
                    <div class="logo-wrapper">
                        <div class="logo">
                            <a href="{{url('/')}}"><img src="{{asset('assets/frontend/images/logo.png')}}" alt="Logo" /></a>
                        </div>
                    </div>
                    
                    <div id="navbar" class="navbar-nav-wrapper navbar-arrow">
                    
                        <ul class="nav navbar-nav" id="responsive-menu">
                        
                            <li> <a href="{{url('/')}}">Home</a></li>
                            <li> <a href="javascript:;">About Us</a></li>
                            <li> <a href="javascript:;">Contact Us</a></li>
                            
                        </ul>
                
                    </div><!--/.nav-collapse -->

                    <div class="nav-mini-wrapper">
                        <ul class="nav-mini sign-in">
                            <li><a data-toggle="modal" href="/login">login</a></li>
                            <li><a data-toggle="modal" href="/signup">register</a></li>
                        </ul>
                    </div>
                
                </div>
                
                <div id="slicknav-mobile"></div>
                
            </nav>
            <!-- end Navbar (Header) -->

            <!-- start Sign-in Modal -->
            <div id="loginModal" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center">Sign-in into your account</h4>
                </div>
                
                <div class="modal-body">
                    <div class="row gap-20">
                    
                        <div class="col-sm-6 col-md-6">
                            <button class="btn btn-facebook btn-block mb-5-xs">Log-in with Facebook</button>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <button class="btn btn-google-plus btn-block">Log-in with Google+</button>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="login-modal-or">
                                <div><span>or</span></div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                
                            <div class="form-group"> 
                                <label>Username</label>
                                <input class="form-control" placeholder="Min 4 and Max 10 characters" type="text"> 
                            </div>
                        
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                        
                            <div class="form-group"> 
                                <label>Password</label>
                                <input class="form-control" placeholder="Min 4 and Max 10 characters" type="text"> 
                            </div>
                        
                        </div>
                        
                        <div class="col-sm-6 col-md-6">
                            <div class="checkbox-block"> 
                                <input id="remember_me_checkbox" name="remember_me_checkbox" class="checkbox" value="First Choice" type="checkbox"> 
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
                                No account? <a data-toggle="modal" href="#registerModal">Register</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-primary">Log-in</button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
                </div>
                
            </div>
            <!-- end Sign-in Modal -->
            
            <!-- start Register Modal -->
            <div id="registerModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center">Create your account for free</h4>
                </div>
                
                <div class="modal-body">
                
                    <div class="row gap-20">
                    
                        <div class="col-sm-6 col-md-6">
                            <button class="btn btn-facebook btn-block mb-5-xs">Register with Facebook</button>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <button class="btn btn-google-plus btn-block">Register with Google+</button>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="login-modal-or">
                                <div><span>or</span></div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                
                            <div class="form-group"> 
                                <label>Username</label>
                                <input class="form-control" placeholder="Min 4 and Max 10 characters" type="text"> 
                            </div>
                        
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                
                            <div class="form-group"> 
                                <label>Email Address</label>
                                <input class="form-control" placeholder="Enter your email address" type="text"> 
                            </div>
                        
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                        
                            <div class="form-group"> 
                                <label>Password</label>
                                <input class="form-control" placeholder="Min 8 and Max 20 characters" type="text"> 
                            </div>
                        
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                        
                            <div class="form-group"> 
                                <label>Password Confirmation</label>
                                <input class="form-control" placeholder="Re-type password again" type="text"> 
                            </div>
                        
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                            <div class="checkbox-block"> 
                                <input id="register_accept_checkbox-2" name="register_accept_checkbox-2" class="checkbox" value="First Choice" type="checkbox"> 
                                <label class="" for="register_accept_checkbox-2">By register, I read &amp; accept <a href="#">the terms</a></label>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                            <div class="login-box-box-action">
                                Already have account? <a data-toggle="modal" href="#loginModal">Log-in</a>
                            </div>
                        </div>
                        
                    </div>
                
                </div>
                
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-primary">Register</button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
                </div>
                
            </div>
            <!-- end Register Modal -->

            <!-- start Forget Password Modal -->
            <div id="forgotPasswordModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center">Restore your forgotten password</h4>
                </div>
                
                <div class="modal-body">
                    <div class="row gap-20">
                        <div id="msg_frm_forgot_pass"></div>
                        <div id="loader_forgot" class="loader" style="display:none;"></div>
                        
                        <div class="col-sm-12 col-md-12">
                            <p class="mb-20">To reset your password, enter the email address you use to sign in to Sababoo.</p>
                        </div>
                        
                        <div class="col-sm-12 col-md-12">
                
                            <div class="form-group"> 
                                <label>Email Address</label>
                                <input id="forgot_email" name="forgot_email" class="form-control" placeholder="Enter your email address" type="text"> 
                            </div>
                        
                        </div>

                       <!-- <div class="col-sm-12 col-md-12">
                            <div class="checkbox-block"> 
                                <input id="forgot_password_checkbox" name="forgot_password_checkbox" class="checkbox" value="First Choice" type="checkbox"> 
                                <label class="" for="forgot_password_checkbox">Generate new password</label>
                            </div>
                        </div>!-->
                        
                        <div class="col-sm-12 col-md-12">
                            <div class="login-box-box-action">
                                Return to <a data-toggle="modal" href="/login">Log-in</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="modal-footer text-center">
                    <button id="forgot_password" type="button" class="btn btn-primary">Restore</button>
                    <button id="forgot_close" type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
                </div>
                
            </div>
            <!-- end Forget Password Modal -->
            
        </header>