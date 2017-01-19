@extends('frontend.layouts.master')

@section('title', 'Job Work Stream')
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
                <li><a href="/job/user_job_list">Job</a></li>
                <li><span>Work Stream</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">

        <div class="second-search-result-wrapper" style="height: 90px;">
            <div class="container">
                <div class="second-search-result-inner" >
                    <span class="labeling" style="margin-left: 40%;">Work Stream</span>
                </div>
            </div>
        </div>

        <div class="bg-light pt-80 pb-80">
            <div class="container">
                <!-- <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                        <div class="section-title">
                            <h2>Work Stream</h2>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="recent-job-wrapper alt-stripe mr-0">
                            <div class="recent-job-item clearfix">
                            <?php

                                if(count($work_streams)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                } else {
                                ?>
                                    <div class="GridLex-grid-middle-head">
                                        <div class="col-20">Job</div>
                                        <div class="col-20">Refund Request</div>
                                        <div class="col-20">Dispute</div>
                                        <div class="col-10">Status</div>
                                        <div class="col-25">Messages</div>
                                    </div>
                                    <hr/>
                                <?php
                                foreach($work_streams as $work_stream){
                                    if (isset($work_stream['job_details'])) {
                                    ?>
                                        <div class="GridLex-grid-middle-head">
                                            <div class="col-20">
                                                <p><strong>Title:</strong> {{$work_stream['job_details']->name}}</p>
                                                <p><strong>Posted By:</strong> {{$work_stream['job_details']->posted_by}}</p>
                                                <p><strong>Salary:</strong> {{env('CURRENCY', '$').$work_stream['job_details']->salary}}</p>
                                                <p><strong>Type:</strong> {{ucfirst($work_stream['job_details']->type)}}</p>

                                            </div>
                                            <div class="col-20">
                                                <?php
                                                    if (count($work_stream['refunds']) > 0) {
                                                        foreach ($work_stream['refunds'] as $key => $refund) {
                                                    ?>
                                                        <p><strong>Amount:</strong> {{env('CURRENCY', '$').$refund->amount}}</p>
                                                        <p><strong>Reason:</strong> {{$refund->reason}}</p>
                                                        <p><strong>Status:</strong> {{ucfirst($refund->status)}}</p>
                                                        <p><strong>Requested At:</strong> {{date('Y-m-d',strtotime($refund->created_at))}}</p>
                                                    <?php
                                                        }
                                                    } else {
                                                    ?>
                                                        Not Requested
                                                    <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-20">
                                                <?php
                                                    if (count($work_stream['disputes']) > 0) {
                                                        foreach ($work_stream['disputes'] as $key => $dispute) {
                                                    ?>
                                                        <p><strong>Amount:</strong> {{env('CURRENCY', '$').$dispute->amount}}</p>
                                                        <p><strong>Description:</strong> {{$dispute->description}}</p>
                                                        <p><strong>Status:</strong> {{ucfirst($dispute->status)}}</p>
                                                        <p><strong>Created At:</strong> {{date('Y-m-d',strtotime($dispute->created_at))}}</p>
                                                    <?php
                                                        }
                                                    } else {
                                                    ?>
                                                        Not Created
                                                    <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-10">{{ucfirst($work_stream['job_details']->job_status)}}</div>
                                            <div class="col-25">
                                                <textarea rows="2" placeholder="Write message"></textarea>
                                                <input type="button" name="" value="Send Message">
                                            </div>
                                        </div>
                                        <hr/>
                                    <?php
                                    }
                             }}?>
                             </div>
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

    $(document).ready(function () {

    });

</script>
@endsection

