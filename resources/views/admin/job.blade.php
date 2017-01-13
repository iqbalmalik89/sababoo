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

             <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">{{$job->name}}</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#job_details_tab" data-toggle="tab">Job Details</a>
                                    </li>

                                    <li class="">
                                        <a href="#job_applications_tab" data-toggle="tab">Job Applications</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- Job details TAB -->
                                    <div class="tab-pane active" id="job_details_tab">
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
                                                        <span class="mt-comment-text"> {{(isset($job->salary) && $job->salary != '')?$job->salary.env('CURRENCY', '$'):'N/A'}} </span>
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
                                    </div>
                                    <!-- END Job details TAB -->
 
                                    <!-- Applications TAB -->
                                    <div class="tab-pane" id="job_applications_tab">
                                        <div class="mt-comments">
                                            <div class="mt-comment">
                                                <div class="mt-comment-body">
                                                    
                                                    <?php
                                                        if (count($applied_jobs) > 0) {
                                                            foreach ($applied_jobs as $key => $applied_job) {
                                                        ?>
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author" style="width:25%">{{$applied_job['user_name']}}</span>
                                                                <span class="mt-comment-text"> {{($applied_job['message'] != '')?'"'.$applied_job['message'].'"':''}} Applied on <span class="caption-subject font-blue-madison bold">{{($applied_job['applied_on'] != '')?$applied_job['applied_on']:''}}</span></span>
                                                            </div>
                                                            <hr/>
                                                        <?php
                                                            }
                                                        } else {
                                                    ?>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="text-align: center;">No Applications Found</span>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Applications TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->

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