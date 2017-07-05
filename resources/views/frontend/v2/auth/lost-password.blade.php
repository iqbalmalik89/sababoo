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
                    <form action="#">
                        <!-- Form Group -->
                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="email" class="form-control" placeholder="Email">
                        </div>

                        <!-- Form Group -->
                        <div class="form-group text-center">
                            <button class="btn btn-blue btn-effect">send email</button>
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