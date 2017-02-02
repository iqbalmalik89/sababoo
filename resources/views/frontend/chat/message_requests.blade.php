@extends('frontend.layouts.master')

@section('title', 'Message Requests')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing')


@section('content')

<?php
    $sticky_footer = 'sticky-footer';
?>
        <!-- start Main Wrapper -->
<div class="main-wrapper">

    <!-- start breadcrumb -->
    <div class="breadcrumb-wrapper">

        <div class="container">

            <ol class="breadcrumb-list booking-step">
                
                <li><a href="/home">Home</a></li>
                <li><a href="javascript:;">Message Requests</a></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="">
       
        <div class="bg-light pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

                        <div class="section-title">

                            <h2>Requests</h2>

                        </div>

                    </div>

                </div>

                <div class="row">
                
                    <div class="col-md-12">
                        <div id="msg_action_div" class="alert" style="display:none;"></div>
                        <div class="recent-job-wrapper alt-stripe mr-0">


                            <?php

                                if(count($requests)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                }else{
                                foreach($requests as $request){
                            ?>

                            <div class="recent-job-item clearfix">
                                <div class="GridLex-grid-middle">

                                    <div class="col-24">
                                        <h4> <?php echo $request->first_name.' '.$request->last_name;?></h4>
                                    </div>

                                    <div class="col-24"> {{$request->message}}
                                    </div>

                                    <div class="" >
                                        <input type="button" onclick="msgRequestAction(<?php echo $request->sender_id;?>, 'accepted')" value="Accept">
                                        <input type="button" onclick="msgRequestAction(<?php echo $request->sender_id;?>, 'rejected')" value="Reject">
                                    </div>


                                </div>
                            </div>
                            <!-- </a> -->
                            <?php }}?>


                               <div style="float:right"> @include('pagination.limit_links', ['paginator' => $requests])</div>



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

    function msgRequestAction(senderId, status) {
        

        pageURI = globalUrl+"message/action-request";
        request_data = {sender_id:senderId, status:status}
        mainAjax('', request_data, 'POST', fillData);

        function fillData(data){
            if(data.status == 'ok'){
                $('#msg_action_div').removeClass('alert-danger').addClass('alert-success').show().html(data.msg).delay(4000).fadeOut();
                window.location.reload();
            }else if (data.status == 'error') {
                $('#msg_action_div').addClass('alert-danger').html(data.msg).show();
            }
        } 
    }

    $(document).ready(function () {

    });

</script>
@endsection

