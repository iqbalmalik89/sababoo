        <header id="header">
   <meta charset="utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
     
            <!-- start Navbar (Header) -->
            <nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

                <div class="container">
                    
                    <div class="logo-wrapper">
                        <div class="logo">
                            <a href="index.html"><img src="{{asset('assets/frontend/images/logo.png')}}" alt="Logo" /></a>
                        </div>
                    </div>
                    
                    <div id="navbar" class="navbar-nav-wrapper navbar-arrow">
                    
                        <ul class="nav navbar-nav" id="responsive-menu">
                        
                            <li>
                            
                                <a href="#">Home</a>
                                <ul>
                                    <li><a href="index.html">Home - Default</a></li>
                                    <li><a href="index-02.html">Home - 02</a></li>
                                    <li><a href="index-03.html">Home - 03</a></li>
                                    <li><a href="index-04.html">Home - 04</a></li>
                                    <li><a href="index-05.html">Home - 05</a></li>
                                    <li><a href="index-06.html">Home - 06</a></li>
                                    <li><a href="index-07.html">Home - 07</a></li>
                                </ul>
                                
                            </li>
                            
                            <li>
                                <a href="job-result.html">Job</a>
                                <ul>
                                    <li><a href="job-detail.html">Detail</a></li>
                                    <li><a href="job-detail-02.html">Detail 02</a></li>
                                    <li><a href="job-category.html">Category</a></li>
                                    <li><a href="job-location.html">Location</a></li>
                                    <li><a href="job-browse-job.html">Browse Job</a></li>
                                    <li><a href="job-by-keywords.html">Job By Keyword</a></li>
                                    <li><a href="job-company-list.html">Company List 01</a></li>
                                    <li><a href="job-company-list-02.html">Company List 02</a></li>
                                    <li><a href="job-company-list-03.html">Company List 03</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="employer.html">Employer</a>
                                <ul>
                                    <li><a href="employer-detail.html">Employer Detail</a></li>
                                    <li><a href="employer-detail-02.html">Employer Detail 02</a></li>
                                    <li><a href="employer-detail-03.html">Employer Detail 03</a></li>
                                    <li><a href="employer-post-job.html">Post a Job</a></li>
                                    <li><a href="employer-edit.html">Edit Profile</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="employee.html">Employee</a>
                                <ul>
                                    <li><a href="employee-detail.html">Employee Detail</a></li>
                                    <li><a href="employee-detail-02.html">Employee Detail 02</a></li>
                                    <li><a href="employee-create-resume.html">Create a resume</a></li>
                                    <li><a href="employee-edit.html">Edit Profile</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="#">Page</a>
                                <ul>
                                    <li>
                                        <a href="admin.html">Dashboard</a>
                                        <ul>
                                            <li><a href="admin-empty.html">Dashboard - Empty</a></li>
                                            <li><a href="admin-profile.html">Dashboard - Profile</a></li>
                                            <li><a href="admin-alert.html">Dashboard - Alert</a></li>
                                            <li><a href="admin-saved-job.html">Dashboard - Saved Jobs</a></li>
                                            <li><a href="admin-change-pass.html">Dashboard - Change Password</a></li>
                                            <li><a href="admin-resume-list.html">Dashboard - Resume Lists</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="about-us.html">About Us</a>
                                        <ul>
                                            <li><a href="about-us.html">About Us</a></li>
                                            <li><a href="about-us-02.html">About Us 02</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="faq.html">Faq</a>
                                        <ul>
                                            <li><a href="faq.html">Faq</a></li>
                                            <li><a href="faq-2.html">Faq 02</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact</a>
                                        <ul>
                                            <li><a href="contact.html">Contact</a></li>
                                            <li><a href="contact-02.html">Contact 02</a></li>
                                            <li><a href="contact-03.html">Contact 03</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Account</a>
                                        <ul>
                                            <li><a href="account-login-page.html">Login Page</a></li>
                                            <li><a href="account-register-page.html">Register Page</a></li>
                                            <li><a href="account-forgot-password-page.html">Forgot Password Page</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                    <li><a href="pricing.html">Pricing</a></li>
                                    <li><a href="how-it-work.html">How it Work</a></li>
                                    <li><a href="404-error-page.html">404 - Error Page</a></li>
                                    <li><a href="static-page.html">Static Page</a></li>
                                </ul>
                            </li>

                        </ul>
                
                    </div><!--/.nav-collapse -->

                    <div class="nav-mini-wrapper">
                        <ul class="nav-mini sign-in">
                            <li><a data-toggle="modal" href="#loginModal">login</a></li>
                            <li><a data-toggle="modal" href="#registerModal">register</a></li>
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
                            <p class="mb-20">Maids table how learn drift but purse stand yet set. Music me house could among oh as their. Piqued our sister shy nature almost his wicket. Hand dear so we hour to.</p>
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