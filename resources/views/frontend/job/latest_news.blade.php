@extends('frontend.layouts.master')

@section('title', 'Latest News')
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
                <li><span>Latest News</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form action="/job/news/{{$id}}" method="post">

                    <div class="second-search-result-inner">
                        <span class="labeling">Search news</span>
                        <div class="row">

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="title" name="title" type="text" class="form-control" placeholder="News title">
                                </div>
                            </div>

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="description" name="description" type="text" class="form-control" placeholder="News description">
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

                            <h2>Latest News</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="recent-job-wrapper alt-stripe mr-0">


                            <?php

                                if(count($latest_newses)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                }else{
                                foreach($latest_newses as $latest_news){
                            ?>

                            <a href="#_" class="recent-job-item clearfix" id="row_<?php echo $latest_news->id;?>">

                                <div class="GridLex-grid-middle">




                                    <div class="GridLex-col-6_xs-12">

                                        <div class="job-position">

                                            <div class="content">

                                                <h4> <?php echo ucwords($latest_news->title);?></h4>
                                                <p><?php echo $latest_news->industry_name;?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="GridLex-col-4_xs-8_xss-12 mt-10-xss">
                                            <?php echo ucwords($latest_news->description);?>
                                    </div>

                                    <div class="GridLex-col-2_xs-4_xss-12">
                                        
                                        <span class="font12 block spacing1 font400 text-center"><?php
                                            if($latest_news->created_at){
                                                echo "Posted at ".date('Y-m-d',strtotime($latest_news->created_at));
                                            }?>  
                                        </span>

                                    </div>

                                </div>
                            </a>
                            <?php }}?>


                               <div style="float:right"> @include('pagination.limit_links', ['paginator' => $latest_newses])</div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

</div>

<script>

    $(document).ready(function () {

    });
</script>
@endsection

