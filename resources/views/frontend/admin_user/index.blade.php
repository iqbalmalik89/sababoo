@extends('frontend.layouts.master')

@section('title', 'Admin')

@section('content')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ')


        <!-- start Main Wrapper -->
<div class="main-wrapper">

    <!-- start breadcrumb -->
    <div class="breadcrumb-wrapper">

        <div class="container">

            <ol class="breadcrumb-list booking-step">
                <li><a href="">Home</a></li>
                <li><span>Admin</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">

        <div class="container">

            <div class="row">

                <div class="col-sm-5 col-md-4">

                    <?php
                       // dd($tradesman->background);
                    ?>

                    @include('frontend.admin_user.side_bar',['userinfo'=>$adminUser])

                </div>

                <div class="col-sm-7 col-md-8">

                    <div class="company-detail-wrapper">

                        <div class="company-detail-company-overview mt-0 clearfix">

                            <div class="section-title-02">
                                <h3 class="text-left">Update Profile(Admin)</h3>
                                <!--                                             <p>Oh to talking improve produce in limited offices fifteen an. Wicket branch to answer do we. Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p> -->
                            </div>

                            @include('frontend.admin_user.basicinfo',['userinfo'=>$adminUser])
                                <div class="clear"></div>
                            </div>



                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

