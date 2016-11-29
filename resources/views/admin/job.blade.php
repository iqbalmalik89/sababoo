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
                        <a href="{{URL::to('admin/jobs')}}">Jobs Management</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Job Details</span>
                    </li>
                </ul>

                <!-- <div class="form-actions pull-right margin-top-5px margin-bottom-5px">
                    <a href="{{URL::to('admin/user')}}"><button type="button" class="btn green"><i class="fa fa-plus fa-fw"></i>Add User</button></a>
                </div> -->
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div>
                <h3 class="page-title pull-left"> Job Details
                </h3>
                    <div class="form-actions pull-right margin-top-20px">
                        <a href="{{URL::to('admin/jobs')}}"><button type="button" class="btn green"><i class="fa fa-arrow-left fa-fw"></i> Go Back To Jobs</button></a>
                    </div>
            </div>
            
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet">
                
                <div class="portlet-body">
                        
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-dark hide"></i>
                                <span class="caption-subject font-dark bold uppercase">{{$job->name}}</span>
                                <span class="label label-sm label-{{($job->is_active == 1)?'success':'default'}}">{{($job->is_active == 1)?'Active':'In-Active'}}</span>
                            </div>
                            <span class="font-dark bold pull-right">{{$job->created_at}}</span>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="job_details_area">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <div class="mt-comment">
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Job Title</span>
                                                    <span class="mt-comment-text"> {{(isset($job->name) && $job->name != '')?$job->name:'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">User</span>
                                                    <span class="mt-comment-text"> {{(isset($job->user_name) && $job->user_name != '')?$job->user_name:'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Industry</span>
                                                    <span class="mt-comment-text"> {{(isset($job->industry_name) && $job->industry_name != '')?$job->industry_name:'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Description</span>
                                                    <span class="mt-comment-text"> {{(isset($job->description) && $job->description != '')?strip_tags($job->description):'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Type</span>
                                                    <span class="mt-comment-text"> {{(isset($job->type) && $job->type == 'full_time')?'Full Time':'Part Time'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Location</span>
                                                    <span class="mt-comment-text"> {{(isset($job->location) && $job->location != '')?$job->location:'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Salary</span>
                                                    <span class="mt-comment-text"> {{(isset($job->salary) && $job->salary != '')?$job->salary:'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Deadline Date</span>
                                                    <span class="mt-comment-text"> {{(isset($job->job_deadline_date) && $job->job_deadline_date != '')?$job->job_deadline_date:'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Requirement</span>
                                                    <span class="mt-comment-text"> {{(isset($job->requirement) && $job->requirement != '')?strip_tags($job->requirement):'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Responsibilities</span>
                                                    <span class="mt-comment-text"> {{(isset($job->responsibilities) && $job->responsibilities != '')?$job->responsibilities:'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Experience</span>
                                                    <span class="mt-comment-text"> {{(isset($job->experience) && $job->experience != '')?$job->experience:'N/A'}} </span>
                                                </div>
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author" style="width:25%">Terms</span>
                                                    <span class="mt-comment-text"> {{(isset($job->terms) && $job->terms != '')?$job->terms:'N/A'}} </span>
                                                </div>

                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Comments -->
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>

            </div>
            <!-- END SAMPLE TABLE PORTLET-->

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
});
</script> 
@endsection