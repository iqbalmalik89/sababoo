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
                            <a href="{{URL::to('admin/newses')}}">News Management</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>{{($news_id > 0)?'Modify':'Add'}} News</span>
                        </li>
                    </ul>

                    <div class="form-actions pull-right margin-top-5px margin-bottom-5px">
                        <a href="{{URL::to('admin/newses')}}"><button type="button" class="btn green"><i class="fa fa-arrow-left fa-fw"></i> Go Back To News</button></a>
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
                                    <span class="caption-subject bold uppercase">{{($news_id > 0)?'Modify':'Add New'}} News</span>
                                </div>
                            </div>
                            <div class="portlet-body form">

                                <div class="msg_divs alert" id="msg_div"></div>
                               
                                <div class="form-body">

                                    <div class="form-group">
                                        <label>Industry</label>
                                        <div class="input-group margin-top-10 col-md-9">
                                            <select class="bs-select form-control" id="news_industry">
                                            <?php
                                                if (count($industries) > 0) {
                                            ?>
                                                <option value="0">Select Industry</option>
                                                <?php
                                                    foreach ($industries as $key => $industry) {
                                                ?>
                                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                                <?php
                                                    }
                                                ?>
                                            <?php
                                                } else {
                                            ?>
                                                <option value="0">No Industry Found</option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label>Title</label>
                                        <div class="input-group margin-top-10 col-md-9">
                                            <input type="text" class="form-control" placeholder="Enter Title" id="news_title" value="{{($news_id > 0)?$news->title:''}}"> </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <div class="input-group margin-top-10 col-md-9">
                                            <textarea class="form-control" placeholder="Enter description" id="news_description" rows="5">{{($news_id > 0)?$news->description:''}}</textarea> 
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions right">
                                    <a href="javascript:;" id="news_submit_btn"><button type="button" class="btn green">Submit</button></a>
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

<input type="hidden" value="{{$news_id}}" id="updated_news_id"/>

@endsection
@section('scripts')
<script type="text/javascript">
var news = '<?php echo json_encode($news)?>'
$(document).ready(function() {
    var newsdata = JSON.parse(news);
    $('#news_industry').val(newsdata.industry_id);
});
</script> 
@endsection