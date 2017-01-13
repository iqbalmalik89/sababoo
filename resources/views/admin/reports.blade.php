@extends('admin.layouts.inside')
@section('content')
<!-- BEGIN CONTAINER -->
<div class="page-container">
    @include('admin.common.sidebar')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Dashboard</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Reports</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div>
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
            
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet">
                
                <div id="userChart" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

            <hr/>
            <h3>Job Report</h3>

            <div class="portlet">
                
                <div id="jobChart" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    
</div>
<!-- END CONTAINER -->
<input type="hidden" id="employee_title" value="{{ucfirst(env('EMPLOYEE_TITLE'))}}">
<input type="hidden" id="employer_title" value="{{ucfirst(env('EMPLOYER_TITLE'))}}">
<input type="hidden" id="tradesman_title" value="{{ucfirst(env('TRADESMAN_TITLE'))}}">
@endsection
@section('scripts')

 <!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{url('pannel/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{url('pannel/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{url('pannel/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{url('pannel/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{url('pannel/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{url('pannel/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
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