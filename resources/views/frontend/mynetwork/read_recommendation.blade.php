@extends('frontend.layouts.master')

@section('title', 'Read Recommendation')

@section('content')


        <!-- start Main Wrapper -->
<div class="main-wrapper">

    <!-- start breadcrumb -->
    <div class="breadcrumb-wrapper">

        <div class="container">

            <ol class="breadcrumb-list booking-step">
                <li><a href="/home">Home</a></li>
                <li><a href="#_">Network</a></li>
                <li><span>Recommendation</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">

        <div class="container">

            <div class="row">

                <div class="col-md-3">



                </div>

                <div class="col-md-9">

                    <div class="static-wrapper">

                        <h3>You receive recommendation from  <?php echo ucfirst($sender_data->first_name);?> <?php echo ucfirst($sender_data->last_name);?></h3>
                        <p>Email: <?php echo $sender_data->email;?></p>

                        <p>Currently working as a <?php echo ucfirst($sender_data->role);?></p>

                        <p>Your relationship is <?php echo $user_recom->relationship;?></p>

                        <p><?php echo $user_recom->message;?></p>
                        <hr>


                       <a href="/network/accept_recommendation/<?php echo $user_recom->id;?>" class="btn btn-primary mt-15">Accept</a>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="/network/reject_recommendation/<?php echo $user_recom->id;?>" class="btn btn-primary mt-15">Decline</a>
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


        function send_rec(rec_id){
            alert(rec_id);

            pageURI = '/network/send_recom';
            request_data = {frm_data: $('#recModal_'+rec_id).find("select, textarea, input").serialize()};
            mainAjax('recModal_'+rec_id, request_data, 'POST',function resCall(data){
                console.log(data)
                if(data.code==200){
                    //$('#row_'+jobid).hide();
                    $('#global_message').show().html(data.msg).delay(4000).fadeOut();

                }
            })

        }
        $(document).ready(function () {



        });





    </script>
@endsection

