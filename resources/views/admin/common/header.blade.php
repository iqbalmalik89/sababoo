<?php
    $roleOperations = [];
    if (Auth::user() != NULL) {
        $adminUser = Auth::user();

        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $roleRepo->getRoleOperations($adminUser->role_id);
        
    } 
?>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{URL::to('admin/users')}}">
                <img src="{{URL::to('pannel/images/logo.png')}}" alt="logo" class="logo-default" width="90px" /> </a>
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                    <a href="{{url('admin/logs')}}" class="dropdown-toggle" data-close-others="true">
                        <i class="icon-calendar"></i>
                    </a>
                </li>
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="{{URL::to('pannel/assets/layouts/layout/img/avatar.png')}}" />
                        <span class="username username-hide-on-mobile"> {{$logged_in_user->first_name}} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{URL::to('admin/user-profile')}}">
                                <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li>
                            <a href="javascript:;" id="user-logout">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->

<input type="hidden" value="{{$logged_in_user->id}}" id="hidden_user_id"/>
<input type="hidden" value="{{json_encode($roleOperations)}}" id="hidden_operations"/>