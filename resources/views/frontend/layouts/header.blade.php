
<?php
    $isAdminUser = false;
    $adminUser = NULL;
    $socketEmail = '';
    $roleOperations = [];
    if (Auth::user() != NULL){
        $adminUser = Auth::user();
        $socketEmail = $adminUser->email;

        if ($adminUser->is_admin == 1) {
            $isAdminUser = true;
        
            $roleRepo = app()->make('RoleRepository');
            $roleOperations = $roleRepo->getRoleOperations($adminUser->role_id);
        }
    }

    // apply permission wise view for admin users
    $job_create = '';
    $job_view = '';
    $job_search = '';
    $job_all = '';

    if ($isAdminUser == true) {
        // for job create permission                         permission id = 13
        if (!in_array(13, $roleOperations)) {
            $job_create = 'hide';
        }

        // for job view permission                         permission id = 16
        if (!in_array(16, $roleOperations)) {
            $job_view = 'hide';
        }

        // for job search permission                         permission id = 16
        if (!in_array(16, $roleOperations)) {
            $job_search = 'hide';
        }

        if (!in_array(13, $roleOperations) && !in_array(16, $roleOperations)) {
            $job_all = 'hide';
        }
    }
    
    
?>

<header id="header">
   <meta charset="utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
     
            <!-- start Navbar (Header) -->
            <nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

                <div class="container">
                    
                    <div class="logo-wrapper">
                        <div class="logo">
                            <a href="/"><img src="{{asset('assets/frontend/images/logo.png')}}" alt="Logo" /></a>
                        </div>
                    </div>
                    
                    <div id="navbar" class="navbar-nav-wrapper navbar-arrow">
                    
                        <ul class="nav navbar-nav" id="responsive-menu">
                            
                            <li>
                        
                                <a href="/home">Home</a>
                                <!-- <ul>
                                    <li><a href="index.html">Home - Default</a></li>
                                    <li><a href="index-02.html">Home - 02</a></li>
                                    <li><a href="index-03.html">Home - 03</a></li>
                                    <li><a href="index-04.html">Home - 04</a></li>
                                    <li><a href="index-05.html">Home - 05</a></li>
                                    <li><a href="index-06.html">Home - 06</a></li>
                                    <li><a href="index-07.html">Home - 07</a></li>
                                </ul> -->
                                
                            </li>
                            
                            
                            
                            <li class="{{$job_all}}">
                                <a href="#_">Job</a>

                                <ul>
                                    <li class="{{$job_create}}"><a href="/job/post">Job Post</a></li>
                                    <li class="{{$job_view}}"><a href="/job/user_job_list"> Job Lists</a></li>
                                    <li class="{{$job_search}}"><a href="/job/search_jobs"> Browse Jobs</a></li>

                                    <?php
                                        if ($isAdminUser == false) {
                                    ?>
                                        <li class="{{$job_search}}"><a href="/job/user_applied_jobs"> Applied Jobs</a></li>
                                    <?php
                                        }
                                    ?>
                                    
                                </ul>
<!--                                 <ul>
                                    <li><a href="job-detail.html">Detail</a></li>
                                    <li><a href="job-detail-02.html">Detail 02</a></li>
                                    <li><a href="job-category.html">Category</a></li>
                                    <li><a href="job-location.html">Location</a></li>
                                    <li><a href="job-browse-job.html">Browse Job</a></li>
                                    <li><a href="job-by-keywords.html">Job By Keyword</a></li>
                                    <li><a href="job-company-list.html">Company List 01</a></li>
                                    <li><a href="job-company-list-02.html">Company List 02</a></li>
                                    <li><a href="job-company-list-03.html">Company List 03</a></li>
                                </ul> -->
                            </li>

                            


                            <li class="">
                                <a href="#_">My Network</a>

                                <ul>
                                    <?php //if(Auth::user()->role!='employer'){?>

                                    <li><a href="/network/connection">Recomendation</a></li>
                                        <?php //}?>
                                    <!--<li><a href="/network/people_find">People You May Know</a></li>-->

                                </ul>

                            </li>

                            <li class="">
                                <a href="/user_view_message">Messages<span id="msg_notification"></span></a>


                            </li>
                            




                        </ul>
                
                    </div><!--/.nav-collapse -->

                    <?php
                        //if ($isAdminUser == false) {
                    ?>
                        <div class="nav-mini-wrapper">
                            <ul class="nav-mini sign-in">
                                <li><a data-toggle="modal" href="/auth/logout">Logout</a></li>
                                
                            </ul>
                        </div>
                    <?php
                        //}
                    ?>

                    
                
                </div>
                
                <div id="slicknav-mobile"></div>

                <center>
                    <div id="global_message" style="background-color:#33B6CB;color:#000;font-size:16px; display:none;">Information updated successfully</div>
                <center>
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
        <audio id="notif_audio">
            <source src="{{asset('assets/frontend/sounds/notify.ogg')}}" type="audio/ogg">
            <source src="{{asset('assets/frontend/sounds/notify.mp3')}}" type="audio/mpeg">
            <source src="{{asset('assets/frontend/sounds/notify.wav')}}" type="audio/wav">
        </audio>


        <script type="text/javascript" src="{{asset('assets/frontend/node_modules/socket.io/node_modules/socket.io-client/socket.io.js')}}"></script>
        <script>
            var email = '<?php echo $socketEmail;?>'
            // var socket = io.connect( );
            var url = '<?php echo env('URL');?>:3000'
            //alert(url);

            var socket = new io.connect(url, {
                'reconnection': true,
                'reconnectionDelay': 1000,
                'reconnectionDelayMax' : 5000,
                'reconnectionAttempts': 5
            });
            socket.emit('new user',email ,function(data){

                // $('.send_user_list').trigger('click');
               // $( ".send_user_list" ).first().trigger('click');
            });




        </script>