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
                    <form action="#">
                        <!-- Form Group -->
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter Your Email Address">
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter Your Password">
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">

                                    <input type="checkbox" id="remember-me2">
                                    <label for="remember-me2">Remember me?</label>

                                </div>

                                <div class="col-xs-6 text-right">
                                    <a href="{{url('v2/lost-password')}}">Forgot password?</a>
                                </div>
                            </div>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group text-center">
                            <button class="btn btn-blue btn-effect">Login</button>
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