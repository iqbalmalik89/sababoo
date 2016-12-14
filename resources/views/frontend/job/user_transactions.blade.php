@extends('frontend.layouts.master')

@section('title', 'Transactions')
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
                <li><a href="/transactions">Transaction History</a></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form action="/transactions" method="post">

                    <div class="second-search-result-inner">
                        <span class="labeling" style="width: 195px; margin-top: -12px;">Search your transactions</span>
                        <div class="row">

                                <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5 input-append date date-picker"  data-date-format="dd-mm-yyyy">
                                    <div class="form-group form-lg">
                                        <label>Start Date</label>
                                        <input class="span2" size="16" type="text" id="start_date" name="start_date">
                                    </div>
                                </div>


                                <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5 input-append date date-picker" data-date-format="dd-mm-yyyy">
                                 <div class="form-group form-lg">
                                        <label>End Date</label>
                                        <input class="span2" size="16" type="text" id="end_date" name="end_date">
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

                            <h2>Transaction History</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="recent-job-wrapper alt-stripe mr-0">


                            <?php

                                if(count($my_transactions)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                }else{
                                foreach($my_transactions as $my_transaction){
                            ?>

                            <a href="#_" class="recent-job-item clearfix" id="row_<?php echo $my_transaction->id;?>">

                                <div class="GridLex-grid-middle">




                                    <div class="GridLex-col-6_xs-12">

                                        <div class="job-position">

                                            <div class="content">

                                                <h4> <?php echo ucwords($my_transaction->job_name);?></h4>
                                                <p><?php echo 'Transaction  Id: '. $my_transaction->payment_id;?></p>
                                                <p><?php echo 'Payer Id: '. $my_transaction->payer_id;?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="GridLex-col-4_xs-8_xss-12 mt-10-xss">
                                        <div class="job-location"> <?php echo '$'.$my_transaction->payment_amount;?>
                                        </div>
                                    </div>

                                    <div class="GridLex-col-2_xs-4_xss-12">
                                        <div class="job-location"> <?php echo date('d M, Y', strtotime($my_transaction->created_at));?>
                                        </div>
                                    </div>

                                </div>
                            </a>
                            <?php }}?>


                               <div style="float:right"> @include('pagination.limit_links', ['paginator' => $my_transactions])</div>



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
        $('#start_date').datepicker();
        $('#end_date').datepicker();

        $('.date-picker').on('changeDate', function(ev){
            $(this).datepicker('hide');
        });
    });

    

</script>
@endsection

