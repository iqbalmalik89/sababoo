@extends('frontend.v2.layouts.outside')

@section('title', 'Registration')
@section('content')
<!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">

            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>register</h2>
                </div>
            </div>
            <!-- End of Page Title -->

            <!-- Start of Breadcrumb -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{url('v2')}}">home</a></li>
                        <li class="active">register</li>
                    </ul>
                </div>
            </div>
            <!-- End of Breadcrumb -->

        </div>
    </section>
    <!-- =============== End of Page Header 1 Section =============== -->

    <!-- ===== Start of Login - Register Section ===== -->
    <section class="ptb80" id="register">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- Start of Tab Content -->
                    <div class="tab-content ptb60">

                        <!-- Start of Tabpanel for Personal Account -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">

                                <!-- Form Group -->
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter first name">
                                </div>

                                <!-- Form Group -->
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter last name">
                                </div>

                                <!-- Form Group -->
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter your email address">
                                </div>

                                <!-- Form Group -->
                                <div class="form-group">
                                    <label>Password (6 or more characters)</label>
                                    <input type="password" class="form-control" placeholder="Enter password">
                                </div>

                                <!-- Form Group -->
                                <div class="form-group text-center">
                                    <label>By clicking Join now, you agree to Sababoo's <a href="javascript:;">User Agreement</a>, <a href="javascript:;">Privacy Policy</a>, and <a href="javascript:;">Cookie Policy</a>.</label>
                                </div>

                                <!-- Form Group -->
                                <div class="form-group text-center">
                                    <label>Already have account? <a href="{{url('v2/login')}}">Login</a></label>
                                </div>

                                <!-- Form Group -->
                                <div class="form-group text-center nomargin">
                                    <button type="submit" class="btn btn-blue btn-effect">join now</button>
                                </div>

                            </div>
                        </div>
                        
                        <!-- End of Tabpanel for Personal Account -->

                    </div>
                    <!-- End of Tab Content -->

                </div>
            </div>
        </div>
    </section>
    <!-- ===== End of Login - Register Section ===== -->


    @endsection