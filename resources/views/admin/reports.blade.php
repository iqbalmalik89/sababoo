@extends('admin.layouts.inside')
@section('content')
<!-- BEGIN CONTAINER -->
<div id="page-wrapper">

    <!-- BEGIN CONTENT -->
    <div class="container-fluid">
        <!-- BEGIN CONTENT BODY -->
        
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Dashboard <small>Statistics Overview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-title pull-left"> User Report
                </h3>
                <div class="pull-right margin-top-25px">
                    <div>
                        <!-- <label>Search: <input type="search" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="sample_2" id="refund_search_keyword"></label> -->

                        <div class="form-actions margin-left-10px pull-right">
                            <a href="javascript:;" id="report_filter_date_btn"><button class="btn green" type="button">Go<i class="fa fa-arrow-right fa-fw"></i> </button></a>
                        </div> 

                        <div class="margin-left-10px pull-right">
                        
                            <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" id="end_date" name="end_date" placeholder="Select end date">
                        </div>

                        <div class="margin-left-10px pull-right">
                            <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" id="start_date" name="start_date" placeholder="Select start date">
                        </div>
                        
                    </div>
                </div>
                </div>
                

            </div>
            
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="row">
                
                <div id="userChart" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

            <hr/>
            <h3>Job Report</h3>

            <div class="portlet">
                
                <div id="jobChart" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
            </div>
        
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    
</div>
<!-- END CONTAINER -->

@endsection
@section('scripts')

<script type="text/javascript">
$(document).ready(function() {
    Sababoo.App.Reports.userReport();
    Sababoo.App.Reports.jobReport();
    $('#start_date').datepicker();
    $('#end_date').datepicker();

    $('.date-picker').on('changeDate', function(ev){
        $(this).datepicker('hide');
    });

});
</script> 
@endsection