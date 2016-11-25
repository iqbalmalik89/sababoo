@extends('frontend.layouts.master')

@section('title', 'Job Browse')@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search')


@section('content')

<?php
    $isAdminUser = false;
    $adminUser = NULL;
    if (Auth::guard('admin_users')->user() != NULL) {
        $isAdminUser = true;
        $adminUser = Auth::guard('admin_users')->user();
    }
?>
        <!-- start Main Wrapper -->
<div class="main-wrapper">

    <!-- start breadcrumb -->
    <div class="breadcrumb-wrapper">

        <div class="container">

            <ol class="breadcrumb-list booking-step">
                
                <li><a href="/home">Home</a></li>
                <li><a href="/job/user_job_list">Job</a></li>
                <li><span>Browse Jobs</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form  id="search_from" action="#_" method="post">


                    <div class="second-search-result-inner">

                        <span class="labeling">Search a job</span>
                        <div class="row">

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="search" name="search" type="text" class="form-control" placeholder="Job title. Ex: Engineering">
                                </div>
                            </div>

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">


                                        <select name="search_by" id="search_by"class=" form-control">
                                            <option value="">Select </option>
                                            <option value="location">Location</option>
                                            <option value="name">Job Title</option>
                                            <option value="type">Job Type</option>
                                            <option value="category">Job Category</option>
                                        </select>



                                </div>
                            </div>

                            <div class="col-xss-12 col-xs-6 col-sm-4 col-md-2">
                                <input type="button" class="btn btn-block" value="Search" id="search_it">
                            </div>

                        </div>
                    </div>

                </form>

            </div>

        </div>

        <div class="bg-light pt-80 pb-80">


            <div class="container">

                <div class="loader" style="display: none;"></div>

                <div class="row">

                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

                        <div class="section-title">

                            <h2>Browse Jobs</h2>

                        </div>

                    </div>

                </div>

                <div id="main_div">
                @include('frontend.job.job_search_part',['all_jobs'=>$all_jobs])
                </div>

            </div>

        </div>

    </div>


    <script>

        $(document).ready(function () {

            $('#search_it').click(function () {
                // if($.trim($('#name').val())!='') {
                $('.loader').show();
                html = '';
                pageURI = '/job/search_jobs';
                request_data = $('#search_from').serializeArray();
                mainAjax('search_from', request_data, 'POST', callBackSearch);
                $('.loader').hide();
                //}

            });


            function callBackSearch(data){
                console.log(data);
                if(data.code==200){
                    $('#main_div').html('');
                    $('#main_div').html(data.rows);
                }
            }

        });

    </script>
@endsection

