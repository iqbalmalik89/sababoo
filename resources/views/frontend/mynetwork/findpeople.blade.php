@extends('frontend.layouts.master')

@section('title', 'People You May Know')

@section('content')


        <!-- start Main Wrapper -->
<div class="main-wrapper">

    <!-- start breadcrumb -->
    <div class="breadcrumb-wrapper">

        <div class="container">

            <ol class="breadcrumb-list booking-step">
                <li><a href="/home">Home</a></li>
                <li><a href="#_">Network</a></li>
                <li><span>People You May Know</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form action="/job/user_job_list" method="post">

                    <div class="second-search-result-inner">
                        <span class="labeling">Search a job</span>
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

                            <h2>Connections</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="recent-job-wrapper alt-stripe mr-0">




                            <a href="#_" class="recent-job-item clearfix" id="row_">

                                <div class="GridLex-grid-middle">




                                    <div class="GridLex-col-6_xs-12">

                                        <div class="job-position">

                                            <div class="content">

                                                <h4> Smith Amrani</h4>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="GridLex-col-2_xs-4_xss-12">

                                        <div data-toggle="modal" href="#recModal_2" class="job-label label label-success" onclick="">
                                            Recommend Him
                                        </div>
                                    </div>
                                </div>



                                <!-- Start Rec Modal -->
                                <div id="recModal_2" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">

                                    <input type="hidden" name="rec_id" id="rec_id" value="2">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title text-center">Write a recommendation</h4>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row gap-20">


                                            <div class="col-sm-12 col-md-12">

                                                <div class="form-group">
                                                    <label>If needed, you can make changes or delete it even after you send it.</label>
                                                    <textarea class="form-control" name="message" id="message"></textarea>

                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">

                                                <div class="form-group">
                                                    <label>What's your relationship?</label>
                                                    <select id="relationship" name="relationship" class="selectpicker show-tick form-control">
                                                        <optgroup label="Professional">
                                                            <option value="You managed  directly">You managed  directly</option>
                                                            <option value="You reported directly">You reported directly </option>
                                                            <option value="You were senior  but didn't manage directly">You were senior  but didn't manage directly</option>
                                                            <option value="He was senior to you but didn't manage directly">He was senior to you but didn't manage directly</option>
                                                            <option value="You worked in the same group">You worked in the same group</option>
                                                            <option value="You worked  in different groups">You worked  in different groups</option>
                                                            <option value="You worked  but at different companies">You worked  but at different companies</option>
                                                            <option value="He was a client of yours">He was a client of yours</option>
                                                            <option value="You were a client">You were a client</option>

                                                        </optgroup>
                                                        <optgroup label="Education">
                                                            <option value="You were teacher">You were teacher</option>
                                                            <option value="You were  mentor">You were  mentor</option>
                                                            <option value="You were students together">You were students together</option>
                                                        </optgroup>
                                                    </select>
                                                </div>

                                            </div>



                                        </div>
                                    </div>

                                    <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-primary">Send</button>
                                        <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
                                    </div>

                                </div>

                                <!-- End of Rec Modal -->


                            </a>


                            <a href="#_" class="recent-job-item clearfix" id="row_">

                                <div class="GridLex-grid-middle">




                                    <div class="GridLex-col-6_xs-12">

                                        <div class="job-position">

                                            <div class="content">

                                                <h4> Test Amrani</h4>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="GridLex-col-2_xs-4_xss-12">

                                        <div data-toggle="modal" href="#recModal_3" class="job-label label label-success" onclick="">
                                            Recommend Him
                                        </div>
                                    </div>
                                </div>



                                <!-- Start Rec Modal -->

                                <div id="recModal_3" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
                                    <input type="hidden" name="rec_id" id="rec_id" value="3">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title text-center">Write a recommendation</h4>
                                    </div>
                                    <div id="msg_recModal_3"></div>


                                    <div class="modal-body">
                                        <div class="row gap-20">


                                            <div class="col-sm-12 col-md-12">

                                                <div class="form-group">
                                                    <label>If needed, you can make changes or delete it even after you send it.</label>
                                                    <textarea class="form-control" name="message" id="message"></textarea>

                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12">

                                                <div class="form-group">
                                                    <label>What's your relationship?</label>
                                                    <select id="relationship" name="relationship" class="selectpicker show-tick form-control">
                                                        <optgroup label="Professional">
                                                            <option value="You managed  directly">You managed  directly</option>
                                                            <option value="You reported directly">You reported directly </option>
                                                            <option value="You were senior  but didn't manage directly">You were senior  but didn't manage directly</option>
                                                            <option value="He was senior to you but didn't manage directly">He was senior to you but didn't manage directly</option>
                                                            <option value="You worked in the same group">You worked in the same group</option>
                                                            <option value="You worked  in different groups">You worked  in different groups</option>
                                                            <option value="You worked  but at different companies">You worked  but at different companies</option>
                                                            <option value="He was a client of yours">He was a client of yours</option>
                                                            <option value="You were a client">You were a client</option>

                                                        </optgroup>
                                                        <optgroup label="Education">
                                                            <option value="You were teacher">You were teacher</option>
                                                            <option value="You were  mentor">You were  mentor</option>
                                                            <option value="You were students together">You were students together</option>
                                                        </optgroup>
                                                    </select>
                                                </div>

                                            </div>



                                        </div>
                                    </div>

                                    <div class="modal-footer text-center">
                                        <button onclick="send_rec(3)" id="send_recom" type="button" class="btn btn-primary">Send</button>
                                        <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
                                    </div>

                                </div>

                                <!-- End of Rec Modal -->


                            </a>
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


        function send_rec(rec_id){

            pageURI = '/network/send_recom';
            request_data = {frm_data: $('#recModal_'+rec_id).find("select, textarea, input").serialize()};
            mainAjax('recModal_'+rec_id, request_data, 'POST',function resCall(data){
                console.log(data)
                if(data.code==200){
                    $('.btn-inverse').trigger('click');
                    $('#recModal_'+rec_id).find("select, textarea, input").html();
                    $('#msg_recModal_'+rec_id).hide();
                    $('#global_message').show().html(data.msg).delay(4000).fadeOut();

                }
            })

        }
        $(document).ready(function () {



        });





    </script>
@endsection

