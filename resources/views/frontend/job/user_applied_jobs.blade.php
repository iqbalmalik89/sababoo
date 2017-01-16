@extends('frontend.layouts.master')

@section('title', 'Applied Jobs')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing')


@section('content')

<?php
    $isAdminUser = false;
    $adminUser = NULL;
    $roleOperations = [];
    if (Auth::user() != NULL) {
        $adminUser = Auth::user();
        if ($adminUser->is_admin == 1) {
            $isAdminUser = true;
        
            $roleRepo = app()->make('RoleRepository');
            $roleOperations = $roleRepo->getRoleOperations($adminUser->role_id);
        }
        
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
                <li><span>My Applied Jobs</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form action="/job/user_applied_jobs" method="post">

                    <div class="second-search-result-inner">
                        <span class="labeling" style="width: 195px; margin-top: -12px;">Search your applied jobs</span>
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

                            <!-- <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="message" name="message" type="text" class="form-control" placeholder="Message. Ex: job application">
                                </div>
                            </div>

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="type" name="type" type="text" class="form-control" placeholder="Type. Ex: Full_time">
                                </div>
                            </div> -->
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

                            <h2>Applied Jobs</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="recent-job-wrapper alt-stripe mr-0">


                            <?php

                                if(count($my_applied_jobs)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                }else{
                                foreach($my_applied_jobs as $my_applied_job){
                            ?>

                            <a href="#_" class="recent-job-item clearfix" id="row_<?php echo $my_applied_job->id;?>">

                                <div class="GridLex-grid-middle">
                                    <div class="GridLex-col-6_xs-12">

                                        <div class="job-position">

                                            <div class="content">

                                                <h4> <?php echo ucwords($my_applied_job->name);?></h4>
                                                <p><?php echo 'Message: '. $my_applied_job->aj_message;?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="GridLex-col-2_xs-4_xss-12">
                                        <div class="job-location">
                                            <i class="fa fa-map-marker text-primary"></i> <?php echo ucwords($my_applied_job->location);?>
                                        </div>
                                        <div class="job-location">
                                            <?php echo 'Cost: '.env('CURRENCY', '$'). $my_applied_job->cost;?>
                                        </div>
                                    </div>

                                    <div class="GridLex-col-2_xs-4_xss-12">
                                            <?php echo ($my_applied_job->is_awarded == 1)?'Awarded':'Not Awarded';?>
                                        <div class="job-location">
                                            <?php
                                                if ($my_applied_job->is_awarded == 1) {
                                                    if ($my_applied_job->dispute_created == 0) {
                                            ?>
                                                <span onclick="showCreateDispute(<?php echo $my_applied_job->id;?>)">Create Dispute </span> <!-- | <span onclick="viewDisputes(<?php echo $my_applied_job->id;?>)">View Disputes </span> -->
                                            <?php
                                                    }
                                                } else {
                                            ?>
                                                <span >- </span>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="GridLex-col-2_xs-4_xss-12">
                                        <?php
                                        $cls_labl = 'label-warning';
                                         if($my_applied_job->type=="full_time"){
                                             $cls_labl = 'label-success';

                                         }?>
                                        <div class="job-label label <?php echo $cls_labl;?>">
                                           <?php echo ucfirst($my_applied_job->type);?>
                                        </div>
                                        <span class="font12 block spacing1 font400 text-center"><?php
                                            if($my_applied_job->aj_created_at){
                                                echo "Applied On ".date('Y-m-d',strtotime($my_applied_job->aj_created_at));
                                            }?></span>




                                    </div>
                                    <div class="GridLex-col-2_xs-4_xss-12" >
                                    <?php
                                        $showUpdate = 'inline-block';
                                        $showDelete = 'inline-block';
                                        //for job update permission
                                        if ($isAdminUser == true) {
                                            if (!in_array(14, $roleOperations)) {
                                                $showUpdate = 'none';
                                            }

                                            if (!in_array(15, $roleOperations)) {
                                                $showDelete = 'none';
                                            }
                                        }
                                    ?>

                                    <!-- <span style="display:{{$showUpdate}};" onclick="editJob(<?php echo $my_applied_job->id;?>)">Edit | </span>
                                    <span style="display:{{$showDelete}};" onclick="delJob(<?php echo $my_applied_job->id;?>)">Delete</span> -->
                                    </div>


                                </div>
                            </a>
                            <?php }}?>


                               <div style="float:right"> @include('pagination.limit_links', ['paginator' => $my_applied_jobs])</div>



                        </div>

                    </div>

                </div>

            </div>

        </div>

</div>


<!-- Start Rec Modal -->
<div id="dispute_modal" class="modal fade in login-box-wrapper" tabindex="-1" data-width="550" style="display:none; margin-top:-28%;" data-backdrop="static" data-keyboard="false" data-replace="true">

    <input type="hidden" name="hidden_job_id" id="hidden_job_id" value="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="dismissModal($('#dispute_modal'));">&times;</button>
        <h4 class="modal-title text-center">Create Dispute</h4>
    </div>

    <div id="msg_dispute" class="alert" style="display:none;"></div>

    <div class="modal-body">
        <div class="row gap-20">


            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="dispute_amount" id="dispute_amount"/>

                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="dispute_description" id="dispute_description"></textarea>

                </div>

            </div>

        </div>
    </div>

    <div class="modal-footer text-center">
        <img class="button_spinners" style="display:none; margin-left: 166px; margin-bottom: -30px;" src="{{URL::to('pannel/images/loader.gif')}}" id="submit_loader">
        <button type="button" class="btn btn-primary" onclick="createDispute()">Submit</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse" onclick="dismissModal($('#dispute_modal'));">Close</button>
    </div>

</div>

<!-- End of Rec Modal -->


<script>

    var pageURI = '';
    var request_data = '';
    var isScrLock = false;
    var html = '';

    function viewDisputes (jobid){
        window.location = "/job/job-disputes/"+jobid;
    }

    function dismissModal(modal){
        modal.hide();
    }

    function showCreateDispute(jobId) {
        $('#hidden_job_id').val(jobId);
        $('#dispute_amount').val('');
        $('#dispute_amount').parent().removeClass('has-error');
        $('#dispute_description').val('');
        $('#dispute_description').parent().removeClass('has-error');
        $('#submit_loader').hide();
        $('#msg_dispute').removeClass('alert-danger, alert-success').html('').hide();
        $('#dispute_modal').show();
    }

    function createDispute() {
        var jobId = $('#hidden_job_id').val();
        var dispute_amount = $('#dispute_amount').val();
        var dispute_description = $('#dispute_description').val();

        var errors = [];
        if (dispute_amount == ''){
            errors.push('Please enter amount.');
            $('#dispute_amount').parent().addClass('has-error');
        } else {
            $('#dispute_amount').parent().removeClass('has-error');
        }

        if (dispute_description == ''){
            errors.push('Please enter description.');
            $('#dispute_description').parent().addClass('has-error');
        } else {
            $('#dispute_description').parent().removeClass('has-error');
        }

        if(errors.length < 1) { 
            $('#submit_loader').show();

            pageURI = 'create-dispute';
            request_data = {job_id:jobId, amount:dispute_amount, description:dispute_description}
            mainAjax('', request_data, 'POST', fillData);

            function fillData(data){
                $('#submit_loader').hide();
                if(data.status == 'ok')
                {
                    $('#msg_dispute').removeClass('alert-danger').addClass('alert-success').show().html(data.msg).delay(4000).fadeOut();
                    window.location.reload();
                }else if (data.status == 'error') {
                    $('#msg_dispute').addClass('alert-danger').html(data.msg).show();
                }
            } 

        } else {
            $('#msg_dispute').addClass('alert-danger').html(errors[0]).show();
        }

    }

    $(document).ready(function () {

    });

    

</script>
@endsection

