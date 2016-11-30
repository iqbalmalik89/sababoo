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
                                        if ($user->role == 'employee' || $user->role == 'tradesman') {
                                    ?>
                                        <li>
                                            <a href="#user_education" data-toggle="tab">Education</a>
                                        </li>
                                        <li>
                                            <a href="#user_skills" data-toggle="tab">Skills</a>
                                        </li>

                                        <?php
                                            if ($user->role == 'employee') {
                                        ?>
                                            <li>
                                                <a href="#user_experience" data-toggle="tab">Experience</a>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                        
                                        <li>
                                            <a href="#user_certifications" data-toggle="tab">Certifications</a>
                                        </li>
                                        <li>
                                            <a href="#user_languages" data-toggle="tab">Languages</a>
                                        </li>
                                        
                                    <?php
                                        } else if ($user->role == 'employer') {
                                    ?>
                                        <li>
                                            <a href="#user_company" data-toggle="tab">Company Details</a>
                                        </li>
                                        
                                    <?php
                                        }
                                    ?>

                                    <li>
                                        <a href="#user_files" data-toggle="tab">Files</a>
                                    </li>
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
                                                        <span class="mt-comment-text"> {{(isset($user->email) && $user->email != '')?$user->email:'N/A'}} </span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Industry</span>
                                                        <span class="mt-comment-text"> {{(isset($user->industry_name) && $user->industry_name != '')?$user->industry_name:'N/A'}} </span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Role</span>
                                                        <span class="mt-comment-text"> {{(isset($user->role) && $user->role != '')?$user->role:'N/A'}} </span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Location</span>
                                                        <span class="mt-comment-text"> {{(isset($user->address) && $user->address != '')?$user->address.', ':''}} {{($user->country != '')?$user->country.', ':''}} {{($user->postal_code != '')?$user->postal_code:''}}</span>
                                                    </div>
                                                    <div class="mt-comment-info">
                                                        <span class="mt-comment-author" style="width:25%">Contact</span>
                                                        <span class="mt-comment-text"> {{(isset($user->phone_type) && $user->phone_type != '')?$user->phone_type.', ':''}} {{($user->phone != '')?$user->phone:'N/A'}} </span>
                                                    </div>

                                                    <?php
                                                        if ($user->role == 'employee') {
                                                    ?>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Professional Heading</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->professional_heading) && $user->user->professional_heading != '')?$user->user->professional_heading:'N/A'}} </span>
                                                        </div>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Summary</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->summary) && $user->user->summary != '')?$user->user->summary:'N/A'}} </span>
                                                        </div>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Interests & Hobbies</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->interests) && $user->user->interests != '')?$user->user->interests:'N/A'}} </span>
                                                        </div>

                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Resume</span>
                                                            <span class="mt-comment-text"> 
                                                            <?php
                                                                if (isset($user->user->resume_name) && $user->user->resume_name != '') {
                                                            ?>
                                                                <a href="{{env('CV_UPLOAD_PATH').'/'.$user->user->resume_name}}" target="_blank">{{$user->user->resume_title}}</a>
                                                            <?php
                                                                } else {
                                                            ?>
                                                                No Resume Found
                                                            <?php
                                                                }
                                                            ?>
                                                             </span>
                                                        </div>
                                                    <?php
                                                        } else if ($user->role == 'employer'){
                                                    ?>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Company Name</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->company_name) && $user->user->company_name != '')?$user->user->company_name:'N/A'}} </span>
                                                        </div>

                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Background</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->description) && $user->user->description != '')?$user->user->description:'N/A'}} </span>
                                                        </div>
                                                        
                                                    <?php
                                                        } else if ($user->role == 'tradesman'){
                                                    ?>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Background</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->background) && $user->user->background != '')?$user->user->background:'N/A'}} </span>
                                                        </div>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Interests & Hobbies</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->interests) && $user->user->interests != '')?$user->user->interests:'N/A'}} </span>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                    
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
 
                                    <?php
                                        if ($user->role == 'employee' || $user->role == 'tradesman') {
                                    ?>
                                        <!-- Education TAB -->
                                        <div class="tab-pane" id="user_education">
                                            <div class="mt-comments">
                                                <div class="mt-comment">
                                                    <div class="mt-comment-body">
                                                        
                                                        <?php
                                                            if (count($user->user->educations) > 0) {
                                                                foreach ($user->user->educations as $key => $education) {
                                                            ?>
                                                                <div class="mt-comment-info">
                                                                    <span class="mt-comment-author" style="width:25%">{{$education->degree.', '}} {{$education->field_study}}</span>
                                                                    <span class="mt-comment-text"> {{($education->year_from != '')?$education->year_from:''}} - {{($education->year_to != '')?$education->year_to:''}} from <span class="caption-subject font-blue-madison bold">{{($education->school_name != '')?$education->school_name:''}}</span></span>

                                                                    <br/><span class="mt-comment-text"> {{($education->description != '')?$education->description:''}} </span>
                                                                </div>
                                                                <hr/>
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
                                        <div class="tab-pane" id="user_skills">
                                            <div class="mt-comments">
                                                <div class="mt-comment">
                                                    <div class="mt-comment-body">
                                                        
                                                        <?php
                                                            if (count($user->user->skills) > 0) {
                                                                foreach ($user->user->skills as $key => $skills) {
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

                                        <!-- Certification TAB -->
                                        <div class="tab-pane" id="user_certifications">
                                            <div class="mt-comments">
                                                <div class="mt-comment">
                                                    <div class="mt-comment-body">
                                                        
                                                        <?php
                                                            if (count($user->user->certifications) > 0) {
                                                                foreach ($user->user->certifications as $key => $certification) {
                                                            ?>
                                                                <div class="mt-comment-info">
                                                                    <span class="mt-comment-author" style="width:25%"> {{($certification->name != '')?$certification->name:'N/A'}}</span>
                                                                    <span class="mt-comment-text"> {{($certification->date_from != '')?$certification->date_from:''}} - {{($certification->present == '1')?'Present':$certification->date_to}} at <span class="caption-subject font-blue-madison bold">{{($certification->authority != '')?$certification->authority:'N/A'}}</span></span>
                                                                    <br/>

                                                                    <span class="mt-comment-text">
                                                                        <?php
                                                                            if ($certification->url != '') {
                                                                        ?>
                                                                            <a href="{{$certification->url}}" target="_blank">{{$certification->url}}</a>
                                                                        <?php
                                                                            } else {
                                                                        ?>
                                                                            N/A
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                                <hr/>

                                                            <?php
                                                                }
                                                            } else {
                                                        ?>
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author" style="text-align: center;">No Certifications Found</span>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Education INFO TAB -->

                                        <!-- Experience TAB -->
                                        <div class="tab-pane" id="user_experience">
                                            <div class="mt-comments">
                                                <div class="mt-comment">
                                                    <div class="mt-comment-body">
                                                        
                                                        <?php
                                                            if (count($user->user->experiences) > 0) {
                                                                foreach ($user->user->experiences as $key => $experience) {
                                                            ?>
                                                                <div class="mt-comment-info">
                                                                    <span class="mt-comment-author" style="width:25%">{{$experience->job_position}} </span>
                                                                    <span class="mt-comment-text"> {{($experience->date_from != '')?$experience->date_from:''}} - {{($experience->current == '1')?'Present':$experience->date_to}} at <span class="caption-subject font-blue-madison bold">{{($experience->company_name != '')?$experience->company_name:''}}</span></span>

                                                                    <br/>

                                                                    <span class="mt-comment-text" style="text-align: center;">{{($experience->description != '')?'"'.$experience->description.'"':''}}</span>
                                                                    <br/>
                                                                </div>
                                                                <hr/>
                                                            <?php
                                                                }
                                                            } else {
                                                        ?>
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author" style="text-align: center;">No Experience Found</span>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Experience INFO TAB -->

                                        <!-- Language TAB -->
                                        <div class="tab-pane" id="user_languages">
                                            <div class="mt-comments">
                                                <div class="mt-comment">
                                                    <div class="mt-comment-body">
                                                        
                                                        <?php
                                                            if (count($user->user->languages) > 0) {
                                                                foreach ($user->user->languages as $key => $language) {
                                                            ?>
                                                                <div class="mt-comment-info">
                                                                    <span class="mt-comment-author" style="width:25%">{{$language->language}} </span>
                                                                    <span class="mt-comment-text"> {{($language->proficiency != '')?$language->proficiency:''}}</span>

                                                                </div>
                                                            <?php
                                                                }
                                                            } else {
                                                        ?>
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author" style="text-align: center;">No Language Found</span>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Experience INFO TAB -->
                                    <?php
                                        }
                                    ?>
                                        
                                    <?php
                                        if ($user->role == 'employer') {
                                    ?>
                                        <!-- Company TAB -->
                                        <div class="tab-pane" id="user_company">
                                            <div class="mt-comments">
                                                <div class="mt-comment">
                                                    <div class="mt-comment-body">
                                                        
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Name</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->company_name) && $user->user->company_name != '')?$user->user->company_name:'N/A'}}</span>
                                                        </div>

                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Background</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->description) && $user->user->description != '')?strip_tags($user->user->description):'N/A'}}</span>
                                                        </div>

                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Services</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->services) && $user->user->services != '')?strip_tags($user->user->services):'N/A'}}</span>
                                                        </div>

                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Expertise</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->expertise) && $user->user->expertise != '')?strip_tags($user->user->expertise):'N/A'}}</span>
                                                        </div>

                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">People</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->people) && $user->user->people != '')?$user->user->people:'N/A'}}</span>
                                                        </div>

                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Website</span>
                                                            <span class="mt-comment-text">
                                                                <?php
                                                                    if (isset($user->user->website) && $user->user->website != '') {
                                                                ?>
                                                                    <a href="{{'http://'.$user->user->website}}" target="_blank">{{$user->user->website}}</a>
                                                                <?php
                                                                    } else {
                                                                ?>
                                                                    N/A
                                                                <?php
                                                                    }
                                                                ?>
                                                            </span>
                                                        </div>

                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="width:25%">Established In</span>
                                                            <span class="mt-comment-text"> {{(isset($user->user->establish_in) && $user->user->establish_in != '')?$user->user->establish_in:'N/A'}}</span>
                                                        </div>
                                                          
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Education INFO TAB -->

                                    <?php
                                        }
                                    ?>

                                    <!-- Files TAB -->
                                    <div class="tab-pane" id="user_files">
                                        <div class="mt-comments">
                                            <div class="mt-comment">
                                                <div class="mt-comment-body">
                                                    
                                                    <?php
                                                        if (count($user->user->files) > 0) {
                                                            foreach ($user->user->files as $key => $file) {
                                                        ?>
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author" style="width:25%">{{$file->title}} </span>
                                                                <?php
                                                                    if ($file->name != '') {
                                                                ?>
                                                                    <a href="{{env('FILE_UPLOAD_PATH').'/user_files/'.$file->name}}" target="_blank">{{$file->title}}</a>
                                                                <?php
                                                                    } else {
                                                                ?>
                                                                    No File Found
                                                                <?php
                                                                    }
                                                                ?>

                                                            </div>
                                                        <?php
                                                            }
                                                        } else {
                                                    ?>
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author" style="text-align: center;">No Files Found</span>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Files TAB -->
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