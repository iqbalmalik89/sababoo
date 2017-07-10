@extends('frontend.v2.layouts.outside')

@section('title', 'Forgot Password')
@section('content')
<!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">

            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>lost password</h2>
                </div>
            </div>
            <!-- End of Page Title -->

            <!-- Start of Breadcrumb -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{url('v2')}}">home</a></li>
                        <li class="active">forgot password</li>
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
                        <h4>lost password</h4>
                    </div>

                    <!-- Start of Login Form -->
                    <form action="">
                        <div id="msg_div" class="alert" style="display: none;"></div>
                        <p>To reset your password, enter the email address you use to sign in to Sababoo.</p>
                        <br>
                        <!-- Form Group -->
                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="email" class="form-control" id="forgot_email" placeholder="Enter your email address">
                        </div>

                        <!-- Form Group -->
                        <div class="form-group text-center">
                            <a class="btn btn-blue btn-effect" href="javascript:;" id="forgot_password">send email<i id="spinner" style="display: none;float: right;margin-left: 2px;margin-top: 10px;" class="fa fa-spinner fa-spin" aria-hidden="true"></i></a>
                            <a href="{{url('v2/login')}}" class="btn btn-blue btn-effect">login</a>
                        </div>

                    </form>
                    <!-- End of Login Form -->
                </div>
                <!-- End of Login Box -->

            </div>
        </div>
    </section>

    <!-- ===== End of Login - Register Section ===== -->
    @endsection
    @section('scripts')
    <script type="text/javascript">    
    var pageURI = '';
    var request_data = '';
    var isScrLock = false;
    var html = '';
    $(document).ready(function () {
        
        // Press with enter key.
        //submit_key('frm_join input', 'btnsignup');

        /*FORGOT PASSWORD*/

        $('#forgot_password').click(function(){
            forgotPassword();           
        });
       
    });
    
    // submit_key('frm_login input', 'login');

    </script>
@endsection