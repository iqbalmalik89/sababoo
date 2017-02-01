@extends('frontend.layouts.master')

@section('title', 'Users')
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
                <li><a href="/user/list_users">Users</a></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form action="/user/list_users" method="post">

                    <div class="user-search-result-inner">
                        <div class="row">

                            <div class="col-xss-6 col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group form-lg">
                                    <input id="name" name="name" type="text" class="form-control" placeholder="User Name. Ex: Med Bangs">
                                </div>
                            </div>

                            <div class="col-xss-6 col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group form-lg">
                                    <input id="email" name="email" type="text" class="form-control" placeholder="Email. Ex: med@outlook.com">
                                </div>
                            </div>

                            <div class="col-xss-6 col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group form-lg">


                                        <select name="role" id="role"class=" form-control">
                                            <option value="">Select Role</option>
                                            <option value="employee">{{env('EMPLOYEE_TITLE')}}</option>
                                            <option value="employer">{{env('EMPLOYER_TITLE')}}</option>
                                            <option value="tradesman">{{env('TRADESMAN_TITLE')}}</option>
                                        </select>



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

                            <h2>Users</h2>

                        </div>

                    </div>

                </div>

                <div class="row">
                
                    <div class="col-md-12">
                        <div id="check_msg_request_div" class="alert" style="display:none;"></div>
                        <div class="recent-job-wrapper alt-stripe mr-0">


                            <?php

                                if(count($users)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                }else{
                                foreach($users as $user){
                            ?>

                            <!-- <a href="#_" class="recent-job-item clearfix" id="row_<?php echo $user->id;?>"> -->
                            <div class="recent-job-item clearfix">
                                <div class="GridLex-grid-middle">

                                    <div class="col-24">
                                        <h4> <?php echo $user->first_name.' '.$user->last_name;?></h4>
                                    </div>
                                    <!-- <div class="col-24"> <?php echo $user->email;?>
                                    </div> -->

                                    <div class="col-24"> <?php 
                                            if ($user->role == 'employee') {
                                                echo ucfirst(env('EMPLOYEE_TITLE'));
                                            } else if ($user->role == 'employer') {
                                                echo ucfirst(env('EMPLOYER_TITLE'));
                                            } else if ($user->role == 'tradesman') {
                                                echo ucfirst(env('TRADESMAN_TITLE'));
                                            } else {
                                                echo ucfirst($user->role);
                                            }


                                    ?>
                                    </div>

                                    <div class="" >
                                    <input type="button" onclick="viewUser(<?php echo $user->id;?>)" value="View Profile">
                                    <input type="button" onclick="checkMessageRequest(<?php echo $user->id;?>)" value="Send Message">
                                    </div>


                                </div>
                            </div>
                            <!-- </a> -->
                            <?php }}?>


                               <div style="float:right"> @include('pagination.limit_links', ['paginator' => $users])</div>



                        </div>

                    </div>

                </div>

            </div>

        </div>

</div>

<div id="msg_request_modal" class="modal fade in login-box-wrapper" tabindex="-1" data-width="550" style="display:none; margin-top:-28%;" data-backdrop="static" data-keyboard="false" data-replace="true">
    <input type="hidden" name="hidden_reciever_id" id="hidden_reciever_id" value="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="dismissModal($('#msg_request_modal'));">&times;</button>
        <h4 class="modal-title text-center">Message Request</h4>
    </div>

    <div id="msg_request_div" class="alert" style="display:none;"></div>

    <div class="modal-body">
        <div class="row gap-20">


            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="request_message" id="request_message"></textarea>

                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer text-center">
        <img class="button_spinners" style="display:none; margin-left: 137px; margin-bottom: -30px;" src="{{URL::to('pannel/images/loader.gif')}}" id="submit_loader">
        <button type="button" class="btn btn-primary" onclick="sendRequest()">Send Request</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse" onclick="dismissModal($('#msg_request_modal'));">Cancel</button>
    </div>

</div>


<script>

    var pageURI = '';
    var request_data = '';
    var isScrLock = false;
    var html = '';

    function viewUser (userId){
        window.location = "/user/view-profile/"+userId+"?from=list";
    }

    function viewMessage (userId){
        window.location = "/send_message/"+userId;
    }

    function dismissModal(modal){
        modal.hide();
    }

    function checkMessageRequest(userId) {
         $('#hidden_reciever_id').val(userId);
        pageURI = globalUrl+"message/check-request";
        request_data = {reciever_id:userId}
        mainAjax('', request_data, 'GET', fillData);

        function fillData(data){
            if(data.status == 'not_found'){
                $('#check_msg_request_div').removeClass('alert-danger').html('').hide();
                $('#msg_request_div').removeClass('alert-danger').addClass('alert-success').html('').hide();
                $('#request_message').parent().removeClass('has-error');
                $('#request_message').val('');
                $('#msg_request_modal').show();
            } else if (data.status == 'found') {
                if (data.request_status == 'accepted') {
                    viewMessage(userId);
                } else {
                    var msg = '';
                    if (data.request_status == 'pending') {
                        msg = 'Sorry! Your request is still pending.';
                    } else if (data.request_status == 'rejected') {
                        msg = 'Sorry! Your request has been rejected by this user.';
                    }
                    $('#check_msg_request_div').addClass('alert-danger').html(msg).show();
                }
            }
        } 

    }

    function sendRequest() {
        var reciever_id = $('#hidden_reciever_id').val();
        var request_message = $('#request_message').val();

        var errors = [];
        if (request_message == ''){
            errors.push('Please enter message.');
            $('#request_message').parent().addClass('has-error');
        } else {
            $('#request_message').parent().removeClass('has-error');
        }

        if(errors.length < 1) { 
            $('#submit_loader').show();

            pageURI = globalUrl+"message/send-request";
            request_data = {reciever_id:reciever_id, message:request_message}
            mainAjax('', request_data, 'POST', fillSendData);

            function fillSendData(data){
                $('#submit_loader').hide();
                if(data.status == 'ok'){
                    $('#msg_request_div').removeClass('alert-danger').addClass('alert-success').show().html(data.msg).delay(4000).fadeOut();
                    window.location.reload();
                }else if (data.status == 'error') {
                    $('#msg_request_div').addClass('alert-danger').html(data.msg).show();
                }
            } 

        } else {
            $('#msg_request_div').addClass('alert-danger').html(errors[0]).show();
        }

    }

    $(document).ready(function () {

    });

</script>
@endsection

