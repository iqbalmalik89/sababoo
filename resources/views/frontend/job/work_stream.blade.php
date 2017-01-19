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
                    <div id="main_div">
                        <div class="GridLex-gap-15-wrappper">

                            <div class="GridLex-grid-noGutter-equalHeight">

                                <?php
                                if(count($work_streams)<=0){?>
                                <span style="margin: 0px 0px 0px 49px;"> Record not Found</span>
                                <?php  }
                                else{

                                    foreach($work_streams as $work_stream){

                                 ?>

                                <div class="margin-bottom-15px" style="width: 100%;">

                                    <div class="" style="background-color: #FFF;">
                                            <div class="clearfix">

                                                <div class="GridLex-grid-middle-head">
                                                    <div class="col-32">
                                                        <p><strong>Title:</strong> {{$work_stream['job_details']->name}}</p>
                                                        <p><strong>Posted By:</strong> {{$work_stream['job_details']->posted_by}}</p>
                                                        <p><strong>Salary:</strong> {{env('CURRENCY', '$').$work_stream['job_details']->salary}}</p>
                                                        <p><strong>Type:</strong> {{ucfirst($work_stream['job_details']->type)}}</p>

                                                    </div>
                                                    <div class="col-32">
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
                                                    <div class="col-32">
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
                                                
                                                </div>
                                                
                                            </div>

                                            <div class="employee-grid-item content">
                                                <h6 class="text-primary"><?php echo ucfirst($work_stream['job_details']->job_status);?></h6>
                                                <div data-toggle="modal" href="#jobMessageModal" class=" btn-primary" style="margin-left: 35%; width: 30%;">
                                                    Send Message
                                                </div>


                                            </div>
                                    </div>

                                </div>

                                <?php }} ?>


                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

</div>


<!-- Start message Modal -->
<div id="jobMessageModal" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">

    <input type="hidden" name="user_id" id="user_id" value="0">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">Write a message</h4>
    </div>
    <div id="msg_jobMessageModal"></div>


    <div class="modal-body">
        <div class="row gap-20">


            <div class="col-sm-12 col-md-12">

                <div class="form-group">
                    <textarea class="form-control" name="message" id="message"></textarea>

                </div>

            </div>
        </div>
    </div>

    <div class="modal-footer text-center">
        <button type="button" class="btn btn-primary" onclick="sendMessage()">Send</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
    </div>

</div>

<!-- End of message Modal -->

<script>

    var pageURI = '';
    var request_data = '';
    var isScrLock = false;
    var html = '';

    $(document).ready(function () {

    });

</script>
@endsection

