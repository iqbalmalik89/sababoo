@extends('frontend.layouts.master')

@section('title', 'My Connections')

@section('content')


        <!-- start Main Wrapper -->
<div class="main-wrapper">

    <!-- start breadcrumb -->
    <div class="breadcrumb-wrapper">

        <div class="container">

            <ol class="breadcrumb-list booking-step">
                <li><a href="/home">Home</a></li>
                <li><a href="#_">Network</a></li>
                <li><span>My Connections</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form class="post-form-wrapper"action="#_" method="post" id="search_from">

                    <div class="second-search-result-inner">
                        <span class="labeling">Search User</span>
                        <div class="row">

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="name" name="name" type="text" class="form-control" placeholder="User Name, Email ">
                                </div>
                            </div>

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <select name="roll" id="roll"class=" form-control">
                                        <option id="" value="">Select Role</option>
                                        <option value="employee">Employee</option>
                                        <option value="tradesman">Tradesman</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">


                            <div class="col-xss-12 col-xs-6 col-sm-4 col-md-2">

                               <input type="button" class="btn btn-block" value="Search" id="search_it">
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

                            <h2>Recommendation</h2>

                        </div>

                    </div>
                    <div class="loader" style="display: none;"></div>

                </div>
                <div id="main_div">

                    @include('frontend.mynetwork.recommedation_part',['user_suggestion'=>$user_suggestion])

                </div>




            </div>


    <script>

        var pageURI = '';
        var request_data = '';
        var isScrLock = false;
        var html = '';

        function send_rec(rec_id){
            $('.loader').show();
            pageURI = '/network/send_recom';
            request_data = {frm_data: $('#recModal_'+rec_id).find("select, textarea, input").serialize()};
            mainAjax('recModal_'+rec_id, request_data, 'POST',function resCall(data){
                $('.loader').hide();
                if(data.code==200){
                    $('.btn-inverse').trigger('click');
                    $('#recModal_'+rec_id).find("textarea").val('');
                    $('#msg_recModal_'+rec_id).hide();
                    $('#global_message').show().html(data.msg).delay(4000).fadeOut();

                }
            })

        }


        $(document).ready(function () {

            $('#search_it').click(function () {
                if($.trim($('#name').val())!='') {
                    $('.loader').show();
                    html = '';
                    pageURI = '/network/connection';
                    request_data = $('#search_from').serializeArray();
                    mainAjax('search_from', request_data, 'POST', callBackSearch);
                    $('.loader').hide();
                }

            });


            function callBackSearch(data){
               if(data.code==200){
                   $('#main_div').html('');
                   $('#main_div').html(data.rows);
               }
            }

        });





    </script>
@endsection

