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
                            <a href="{{URL::to('admin/industries')}}">Industries Management</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>{{($industry_id > 0)?'Modify':'Add'}} Industry</span>
                        </li>
                    </ul>

                    <div class="form-actions pull-right margin-top-5px margin-bottom-5px">
                        <a href="{{URL::to('admin/industries')}}"><button type="button" class="btn green"><i class="fa fa-arrow-left fa-fw"></i> Go Back To Industries</button></a>
                    </div>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                
                
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row">
                    <div class="col-md-8 ">
                        
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject bold uppercase">{{($industry_id > 0)?'Modify':'Add New'}} Industry</span>
                                </div>
                            </div>
                            <div class="portlet-body form">

                                <div class="msg_divs alert" id="msg_div"></div>
                               
                                <div class="form-body">

                                    <div class="form-group">
                                        <label>Namw</label>
                                        <div class="input-group margin-top-10">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter Name" id="industry_name" value="{{($industry_id > 0)?$industry->name:''}}"> </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <a href="javascript:;" id="industry_submit_btn"><button type="button" class="btn green">Submit</button></a>
                                    <img class="button_spinners" src="{{URL::to('pannel/images/loader.gif')}}" id="submit_loader">
                                </div>
                               
                            </div>
                        </div>
                        <!-- END SAMPLE FORM PORTLET-->
                    </div>
                </div>

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        
    </div>
    <!-- END CONTAINER -->

<input type="hidden" value="{{$industry_id}}" id="updated_industry_id"/>

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
});
</script> 
@endsection