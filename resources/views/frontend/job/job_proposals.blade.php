@extends('frontend.layouts.master')

@section('title', 'Job Proposals')
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
                <li><span>Job Proposals</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form action="/job/user_applied_jobs" method="post">

                    <div class="second-search-result-inner">
                        <span class="labeling" style="width: 195px; margin-top: -12px;">Search job proposals</span>
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

                            <h2>Job Proposals</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="recent-job-wrapper alt-stripe mr-0">


                            <?php

                                if(count($job_proposals)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                }else{
                                foreach($job_proposals as $job_proposal){
                            ?>

                            <a href="#_" class="recent-job-item clearfix" id="row_<?php echo $job_proposal->id;?>">

                                <div class="GridLex-grid-middle">




                                    <div class="GridLex-col-6_xs-12">

                                        <div class="job-position">

                                            <div class="content">

                                                <h4> <?php echo ucwords($job_proposal->name);?></h4>
                                                <p><?php echo 'Message: '. $job_proposal->aj_message;?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="GridLex-col-4_xs-8_xss-12 mt-10-xss">
                                        <div class="job-location">
                                            <i class="fa fa-map-marker text-primary"></i> <?php echo ucwords($job_proposal->location);?>
                                        </div>
                                        <div class=""> Cost: ${{$job_proposal->aj_cost}}
                                        </div>
                                    </div>

                                    <div class="GridLex-col-2_xs-4_xss-12">
                                        <?php
                                        $cls_labl = 'label-warning';
                                         if($job_proposal->type=="full_time"){
                                             $cls_labl = 'label-success';

                                         }?>
                                        <div class="job-label label <?php echo $cls_labl;?>">
                                           <?php echo ucfirst($job_proposal->type);?>
                                        </div>
                                        <span class="font12 block spacing1 font400 text-center"><?php
                                            if($job_proposal->aj_created_at){
                                                echo "Applied On ".date('Y-m-d',strtotime($job_proposal->aj_created_at));
                                            }?></span>


                                    </div>
                                    <div class="GridLex-col-2_xs-4_xss-12" >
                                  
                                    <?php

                                        if ($job_proposal->is_awarded == 1 && $job_proposal->job_status == 'completed') {

                                    ?>
                                        <span >Completed</span>
                                    <?php
                                        } else if ($job_proposal->is_awarded == 1 && $job_proposal->job_status == 'in-progress') {
                                    ?>
                                        <span onclick="askRefund(<?php echo $job_proposal->aj_id;?>)">Ask Refund</span>
                                    <?php
                                        } else if ($job_proposal->is_awarded == 0){
                                    ?>

                                        <!-- <form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="upload" value="1">
                                            <input type="hidden" name="business" value="nazbushi@gmail.com">
                                            <input type="hidden" name="quantity_1" value="1">
                                            <input type="hidden" name="item_name_1" value="{{$job_proposal->name}}">
                                            <input type="hidden" name="item_number_1" value="{{$job_proposal->aj_id}}">
                                            <input type="hidden" name="amount_1" value="{{$job_proposal->aj_cost}}">
                                            <input type="hidden" name="tax_1" value="0.05">
                                            <input type="hidden" name="job_id" value="{{$job_proposal->id}}">
                                            <input type="hidden" name="user_id" value="{{$job_proposal->aj_userid}}">
                                            <input type="hidden" name="payer_id" value="{{$job_proposal->user_id}}">
                                            <input type="hidden" name="return" value="{{url('success-payment')}}" />
                                             <input type="hidden" name="notify_url" value="{{url('success-payment')}}" />
                                            <input type="hidden" name="cancel_return" value="{{url('failure-payment')}}" />
                                                    
                                            <input type="hidden" name="currency_code" value="USD">
                                            
                                            <input type="submit" name="submit" value="Make Payment"/>
                                            </form> -->
                                            <span onclick="submitPayment(<?php echo $job_proposal->aj_id;?>)">Make Payment</span>

                                    <?php
                                        }
                                    ?>
                                    
                                    </div>


                                </div>
                            </a>
                            <?php }}?>


                               <div style="float:right"> @include('pagination.limit_links', ['paginator' => $job_proposals])</div>



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

    function submitPayment(proposalId) {
        pageURI = 'paypal/payment';
        request_data = {aj_id:proposalId}
        mainAjax('', request_data, 'POST', fillForm);

        function fillForm(data){
            console.log(data);
        } 

    }

    function askRefund(proposalId) {
        pageURI = 'paypal/ask-refund';
        request_data = {aj_id:proposalId}
        mainAjax('', request_data, 'POST', fillData);

        function fillData(data){
            console.log(data);
        } 

    }
    $(document).ready(function () {

    });

    

</script>
@endsection

