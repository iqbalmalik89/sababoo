@extends('frontend.layouts.master')

@section('title', 'Tradesman')

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
                <li><span>Tradesman</span></li>
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

                    @include('frontend.tradesman.side_bar',['userinfo'=>$userinfo,'tradesman'=>$tradesman,'industry'=>$industry])

                </div>

                <div class="col-sm-7 col-md-8">

                    <div class="company-detail-wrapper">

                        <div class="company-detail-company-overview mt-0 clearfix">

                            <div class="section-title-02">
                                <h3 class="text-left">Update Profile(Tradesman)</h3>
                                <!--                                             <p>Oh to talking improve produce in limited offices fifteen an. Wicket branch to answer do we. Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p> -->
                            </div>

                            @include('frontend.tradesman.basicinfo',['userinfo'=>$userinfo,'tradesman'=>$tradesman,'industry'=>$industry])
                            @include('frontend.tradesman.password',['userinfo'=>$userinfo])


                            <div class="row gap-20">

                                @include('frontend.tradesman.education',['userinfo'=>$userinfo,'tradesman'=>$tradesman,'education'=>$education])
                                @include('frontend.employee.certification',['userinfo'=>$userinfo,'certification'=>$certification])


                                <div class="clear mb-30"></div>


                                @include('frontend.employee.skills')


                                <div class="clear mb-30"></div>


                                @include('frontend.employee.languages')

                                <div class="clear mb-30"></div>

                                @include('frontend.employee.add_files',['user_files'=>$user_files])
                                <div class="clear mb-30"></div>


                            </div>
                                <div class="clear"></div>
                            </div>



                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

