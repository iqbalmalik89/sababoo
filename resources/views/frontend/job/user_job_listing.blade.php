@extends('frontend.layouts.master')

@section('title', 'Job Listing')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing')


@section('content')


        <!-- start Main Wrapper -->
<div class="main-wrapper">

    <!-- start breadcrumb -->
    <div class="breadcrumb-wrapper">

        <div class="container">

            <ol class="breadcrumb-list booking-step">
                <li><a href="/home">Home</a></li>
                <li><a href="/job">Job</a></li>
                <li><span>My jobs</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form action="/job/user_job_list" method="post">

                    <div class="second-search-result-inner">
                        <span class="labeling">Search a job</span>
                        <div class="row">

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Job title. Ex: Engineering">
                                </div>
                            </div>

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="location" name="location" type="text" class="form-control" placeholder="Location. Ex: London">
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">


                            <div class="col-xss-12 col-xs-6 col-sm-4 col-md-2">
                                <button class="btn btn-block" id="search_it">Search</button>
                            </div>

                        </div>
                    </div>

                </form>



            </div>

        </div>
        <div class="bg-light pt-80 pb-80">


            <div class="container">


                <div class="row">

                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

                        <div class="section-title">

                            <h2>Jobs List</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="recent-job-wrapper alt-stripe mr-0">


                            <?php

                                if(count($my_jobs)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                }else{
                                foreach($my_jobs as $my_job){
                            ?>

                            <a href="#_" class="recent-job-item clearfix" id="row_<?php echo $my_job->id;?>">

                                <div class="GridLex-grid-middle">




                                    <div class="GridLex-col-6_xs-12">

                                        <div class="job-position">

                                            <div class="content">

                                                <h4> <?php echo ucwords($my_job->name);?></h4>
                                                <p><?php echo $my_job->ind_name;?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="GridLex-col-4_xs-8_xss-12 mt-10-xss">
                                        <div class="job-location">
                                            <i class="fa fa-map-marker text-primary"></i> <?php echo ucwords($my_job->location);?>
                                        </div>
                                    </div>

                                    <div class="GridLex-col-2_xs-4_xss-12">
                                        <?php
                                        $cls_labl = 'label-warning';
                                         if($my_job->type=="full_time"){
                                             $cls_labl = 'label-success';

                                         }?>
                                        <div class="job-label label <?php echo $cls_labl;?>">
                                           <?php echo ucfirst($my_job->type);?>
                                        </div>
                                        <span class="font12 block spacing1 font400 text-center"><?php
                                            if($my_job->created_at){
                                                echo "Posted at ".date('Y-m-d',strtotime($my_job->created_at));
                                            }?></span>




                                    </div>
                                    <div class="GridLex-col-2_xs-4_xss-12" >
                                        <span onclick="editJob(<?php echo $my_job->id;?>)">Edit</span>
                                    |<span onclick="delJob(<?php echo $my_job->id;?>)">Delete</span>
                                    </div>


                                </div>
                            </a>
                            <?php }}?>


                               <div style="float:right"> @include('pagination.limit_links', ['paginator' => $my_jobs])</div>



                        </div>

                    </div>

                </div>

            </div>

        </div>

</div>

<script>

    var pageURI = '';
    var request_data = '';
    var isScrLock = false;
    var html = '';

    var country = '<?php //echo isset($userinfo->country)?$userinfo->country:'';?>';

    $(document).ready(function () {
        //	$('#country option[value="' + country + '"]').prop('selected', true);

    });

    function delJob(jobid){

        var r = confirm("Confirm you want to delete!");
        if (r == true) {

            pageURI = '/job/job_delete';
            request_data = {job_id:jobid};
            mainAjax('frm_job_post', request_data, 'POST',function delCall(data){
                if(data.code==200){
                    $('#row_'+jobid).hide();
                    $('#global_message').show().html(data.msg).delay(4000).fadeOut();

                }
            })
        }

    }
    function editJob(jobid){
        window.location = "/job/post?id="+jobid;

    }



</script>
@endsection

