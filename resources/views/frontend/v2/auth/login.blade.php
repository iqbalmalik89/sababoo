@extends('frontend.v2.layouts.outside')

@section('title', 'Login')
@section('content')
<!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">

            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>login</h2>
                </div>
            </div>
            <!-- End of Page Title -->

            <!-- Start of Breadcrumb -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{url('v2')}}">home</a></li>
                        <li class="active">login</li>
                    </ul>
                </div>
            </div>
            <!-- End of Breadcrumb -->

        </div>
    </section>
    <!-- =============== End of Page Header 1 Section =============== -->





    <!-- ===== Start of Login - Register Section ===== -->
    <section class="ptb80" id="login">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 col-xs-12">

                <!-- Start of Login Box -->
                <div class="login-box">

                    <div class="login-title">
                        <h4>login to sababoo</h4>
                    </div>

                    

                    <!-- Start of Login Form -->
                    <form action="" >
                        <div id="msg_div" class="alert" style="display: none;"></div>
                        <!-- Form Group -->
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">

                                    <input type="checkbox" id="remember" name="remember" value="remember">
                                    <label for="remember">Remember me?</label>

                                </div>

                                <div class="col-xs-6 text-right">
                                    <a href="{{url('v2/lost-password')}}">Forgot password?</a>
                                </div>
                            </div>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group text-center">
                            <a class="btn btn-blue btn-effect" id="login_btn" href="javascript:;">Login<i id="spinner" style="display: none;float: right;margin-left: 2px;margin-top: 10px;" class="fa fa-spinner fa-spin" aria-hidden="true"></i></a>
                            <a href="{{url('v2/signup')}}" class="btn btn-blue btn-effect">register</a>
                        </div>

                    </form>
                    <!-- End of Login Form -->
                </div>
                <!-- End of Login Box -->

            </div>
        </div>
    </section>

    @include('frontend.v2.common.get-started')
    <!-- ===== End of Login - Register Section ===== -->
    @endsection

@section('scripts')
    <script type="text/javascript">    
    var pageURI = '';
    var request_data = '';
    var isScrLock = false;
    var html = '';
    $(document).ready(function () {
        //Sign up
        $('#login_btn').click(function () {
            login();       
        });
        
        // Press with enter key.
        //submit_key('frm_join input', 'btnsignup');

       
    });

    $("#email, #password").keypress(function (e) {
        if (e.which == 13) {
            login();
        }
    });
    // submit_key('frm_login input', 'login');

    </script>
@endsection