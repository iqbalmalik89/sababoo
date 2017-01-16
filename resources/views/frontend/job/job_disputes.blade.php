@extends('frontend.layouts.master')

@section('title', 'Job Disputes')
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
                <li><span>Job Disputes</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form action="/job/job-disputes/{{$job_id}}" method="post">

                    <div class="second-search-result-inner">
                        <span class="labeling" style="width: 195px; margin-top: -12px;">Search job disputes</span>
                        <div class="row">

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="amount" name="amount" type="text" class="form-control" placeholder="Amount. Ex: 100">
                                </div>
                            </div>

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="description" name="description" type="text" class="form-control" placeholder="Description. Ex: minor bug">
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

                            <h2>Job Disputes</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="recent-job-wrapper alt-stripe mr-0">


                            <?php

                                if(count($job_disputes)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                }else{
                                foreach($job_disputes as $job_dispute){
                            ?>

                            <a href="#_" class="recent-job-item clearfix" id="row_<?php echo $job_dispute->id;?>">

                                <div class="GridLex-grid-middle">




                                    <div class="GridLex-col-6_xs-12">

                                        <div class="job-position">

                                            <div class="content">

                                                <h4> <?php echo ucwords($job_dispute->description);?></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="GridLex-col-4_xs-8_xss-12 mt-10-xss"> 
                                        <div class=""> Amount: {{env('CURRENCY', '$').$job_dispute->amount}}
                                        </div>
                                    </div>

                                    <div class="GridLex-col-2_xs-4_xss-12">
                                        <?php
                                        $cls_labl = 'label-warning';
                                         if($job_dispute->status=="approved"){
                                             $cls_labl = 'label-success';

                                         } else if ($job_dispute->status=="rejected") {
                                        $cls_labl = 'label-danger';
                                        }else if ($job_dispute->status=="pending") {
                                        $cls_labl = 'label-warning';
                                        }?>
                                        <div class="job-label label <?php echo $cls_labl;?>">
                                           <?php echo ucfirst($job_dispute->status);?>
                                        </div>
                                        <span class="font12 block spacing1 font400 text-center"><?php
                                            if($job_dispute->created_at){
                                                echo "Created On ".date('Y-m-d',strtotime($job_dispute->created_at));
                                            }?></span>


                                    </div>
                                


                                </div>
                            </a>
                            <?php }}?>


                               <div style="float:right"> @include('pagination.limit_links', ['paginator' => $job_disputes])</div>



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

