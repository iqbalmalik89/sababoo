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
                        <a href="{{URL::to('admin/users')}}">User Management</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{URL::to('admin/site-users')}}">Site Users</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>User Details</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE HEADER-->
            
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">User Details</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#personal_info_tab" data-toggle="tab">Basic Info</a>
                                    </li>

                                    <?php
                                        if ($user->role == 'employee') {
                                    ?>
                                        <li>
                                            <a href="#employee_education" data-toggle="tab">Education</a>
                                        </li>
                                        <li>
                                            <a href="#employee_skills" data-toggle="tab">Skills</a>
                                        </li>
                                        <li>
                                            <a href="#employee_experience" data-toggle="tab">Experience</a>
                                        </li>
                                        <li>
                                            <a href="#employee_languages" data-toggle="tab">Languages</a>
                                        </li>
                                        <li>
                                            <a href="#employee_interests" data-toggle="tab">Interests</a>
                                        </li>
                                        <li>
                                            <a href="#employee_resume" data-toggle="tab">Resume</a>
                                        </li>
                                    <?php
                                        }
                                    ?>
                                    
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="personal_info_tab">
                                        <div class="mt-comments">
                                            <div class="mt-comment">
                                                <div class="mt-comment-body">
                                                    
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Email</span>
                                                        <span class="mt-comment-text"> {{($user->email != '')?$user->email:'N/A'}} </span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Industry</span>
                                                        <span class="mt-comment-text"> {{($user->industry_name != '')?$user->industry_name:'N/A'}} </span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Role</span>
                                                        <span class="mt-comment-text"> {{($user->role != '')?$user->role:'N/A'}} </span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Location</span>
                                                        <span class="mt-comment-text"> {{($user->address != '')?$user->address.', ':''}} {{($user->country != '')?$user->country.', ':''}} {{($user->postal_code != '')?$user->postal_code:''}}</span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Contact</span>
                                                        <span class="mt-comment-text"> {{($user->phone_type != '')?$user->phone_type.', ':''}} {{($user->phone != '')?$user->phone:'N/A'}} </span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Professional Heading</span>
                                                        <span class="mt-comment-text"> {{($user->employee->professional_heading != '')?$user->employee->professional_heading:'N/A'}} </span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Summary</span>
                                                        <span class="mt-comment-text"> {{($user->employee->summary != '')?$user->employee->summary:'N/A'}} </span>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->


                                    
                                    <?php
                                        if ($user->role == 'employee') {
                                    ?>
                                    <!-- Education TAB -->
                                        <div class="tab-pane" id="employee_education">
                                        <div class="mt-comments">
                                            <div class="mt-comment">
                                                <div class="mt-comment-body">
                                                    
                                                    <?php
                                                        if (count($user->employee->educations) > 0) {
                                                            foreach ($user->employee->educations as $key => $education) {
                                                        ?>
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author" style="width:25%">{{$education->degree.', '}} {{$education->field_study}}</span>
                                                                <span class="mt-comment-text"> {{($education->year_from != '')?$education->year_from:''}} - {{($education->year_to != '')?$education->year_to:''}} from {{($education->school_name != '')?$education->school_name:''}}</span>
                                                            </div>
                                                        <?php
                                                            }
                                                        } else {
                                                    ?>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="text-align: center;">No Educational Information Found</span>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Education INFO TAB -->

                                    <!-- Skills TAB -->
                                        <div class="tab-pane" id="employee_skills">
                                        <div class="mt-comments">
                                            <div class="mt-comment">
                                                <div class="mt-comment-body">
                                                    
                                                    <?php
                                                        if (count($user->employee->skills) > 0) {
                                                            foreach ($user->employee->skills as $key => $skills) {
                                                        ?>
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author" style="width:25%">Skill {{$key+1}} </span>
                                                                <span class="mt-comment-text">  {{($skills->skill != '')?$skills->skill:''}}</span>
                                                            </div>
                                                        <?php
                                                            }
                                                        } else {
                                                    ?>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="text-align: center;">No Skills Found</span>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Skills INFO TAB -->
                                    <?php
                                        }
                                    ?>
                                    
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