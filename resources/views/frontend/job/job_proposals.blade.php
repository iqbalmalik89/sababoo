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
                                        <div class=""> Cost: {{env('CURRENCY', '$').$job_proposal->aj_cost}}
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

                                        if ($job_proposal->refund_requested == 1) {

                                    ?>
                                        <span >Refund Requested</span>
                                    <?php

                                        } else if ($job_proposal->job_status == 'completed') {

                                    ?>
                                        <span >Completed</span>
                                    <?php
                                        } else if ($job_proposal->job_status == 'in-progress') {
                                    ?>
                                        <span onclick="showAskRefund(<?php echo $job_proposal->aj_id;?>)">Ask Refund</span>
                                    <?php
                                        } else if ($job_proposal->job_status == 'pending'){
                                    ?>

                                        <form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="upload" value="1">
                                            <input type="hidden" name="business" value="{{env('PAYPAL_ACCOUNT')}}">
                                            <input type="hidden" name="quantity_1" value="1">
                                            <input type="hidden" name="item_name_1" value="{{$job_proposal->name}}">
                                            <input type="hidden" name="item_number_1" value="{{$job_proposal->aj_id}}">
                                            <input type="hidden" name="amount_1" value="{{$job_proposal->aj_cost}}">
                                            <input type="hidden" name="tax_1" value="0.05">
                                            <input type="hidden" name="job_id" value="{{$job_proposal->id}}">
                                            <input type="hidden" name="user_id" value="{{$job_proposal->aj_userid}}">
                                            <input type="hidden" name="payer_id" value="{{$job_proposal->user_id}}">
                                            <input type="hidden" name="return" value="{{url('success-payment?aj_id=.$job_proposal->aj_id')}}" />
                                             <input type="hidden" name="notify_url" value="{{url('success-payment?aj_id=.$job_proposal->aj_id')}}" />
                                            <input type="hidden" name="cancel_return" value="{{url('failure-payment?aj_id=.$job_proposal->aj_id')}}" />
                                                    
                                            <input type="hidden" name="currency_code" value="USD">
                                            
                                            <input type="submit" name="submit" value="Make Payment"/>
                                        </form>
                                            <!-- <span onclick="submitPayment(<?php echo $job_proposal->aj_id;?>)">Make Payment</span> -->

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

<!-- Start Rec Modal -->
<div id="refund_modal" class="modal fade in login-box-wrapper" tabindex="-1" data-width="550" style="display:none; margin-top:-28%;" data-backdrop="static" data-keyboard="false" data-replace="true">

    <input type="hidden" name="hidden_proposal_id" id="hidden_proposal_id" value="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="dismissModal($('#refund_modal'));">&times;</button>
        <h4 class="modal-title text-center">Ask Refund</h4>
    </div>

    <div id="msg_refund" class="alert" style="display:none;"></div>

    <div class="modal-body">
        <div class="row gap-20">


            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="refund_amount" id="refund_amount"/>

                </div>

                <div class="form-group">
                    <label>Reason</label>
                    <textarea class="form-control" name="refund_reason" id="refund_reason"></textarea>

                </div>

            </div>

        </div>
    </div>

    <div class="modal-footer text-center">
        <img class="button_spinners" style="display:none; margin-left: 166px; margin-bottom: -30px;" src="{{URL::to('pannel/images/loader.gif')}}" id="submit_loader">
        <button type="button" class="btn btn-primary" onclick="askRefund()">Submit</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse" onclick="dismissModal($('#refund_modal'));">Close</button>
    </div>

</div>

<!-- End of Rec Modal -->

<script>

    var pageURI = '';
    var request_data = '';
    var isScrLock = false;
    var html = '';

    function dismissModal(modal){
        modal.hide();
    }
    function submitPayment(proposalId) {
        pageURI = 'paypal/payment';
        request_data = {aj_id:proposalId}
        mainAjax('', request_data, 'POST', fillForm);

        function fillForm(data){
            console.log(data);
        } 

    }

    function showAskRefund(proposalId) {
        $('#hidden_proposal_id').val(proposalId);
        $('#refund_amount').val('');
        $('#refund_amount').parent().removeClass('has-error');
        $('#refund_reason').val('');
        $('#refund_reason').parent().removeClass('has-error');
        $('#submit_loader').hide();
        $('#msg_refund').removeClass('alert-danger, alert-success').html('').hide();
        $('#refund_modal').show();
    }

    function askRefund() {
        var proposalId = $('#hidden_proposal_id').val();
        var refund_amount = $('#refund_amount').val();
        var refund_reason = $('#refund_reason').val();

        var errors = [];
        if (refund_amount == ''){
            errors.push('Please enter amount.');
            $('#refund_amount').parent().addClass('has-error');
        } else {
            $('#refund_amount').parent().removeClass('has-error');
        }

        if (refund_reason == ''){
            errors.push('Please enter reason.');
            $('#refund_reason').parent().addClass('has-error');
        } else {
            $('#refund_reason').parent().removeClass('has-error');
        }

        if(errors.length < 1) { 
            $('#submit_loader').show();

            pageURI = 'paypal/ask-refund';
            request_data = {aj_id:proposalId, amount:refund_amount, reason:refund_reason}
            mainAjax('', request_data, 'POST', fillData);

            function fillData(data){
                $('#submit_loader').hide();
                if(data.status == 'ok')
                {
                    $('#msg_refund').removeClass('alert-danger').addClass('alert-success').show().html(data.msg).delay(4000).fadeOut();
                    window.location.reload();
                }else if (data.status == 'error') {
                    $('#msg_refund').addClass('alert-danger').html(data.msg).show();
                }
            } 

        } else {
            $('#msg_refund').addClass('alert-danger').html(errors[0]).show();
        }

    }

    $(document).ready(function () {
    });

    

</script>
@endsection

