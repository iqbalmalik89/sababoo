<?php
    $page = Route::getCurrentRoute()->getPath();
    $page = explode('/', $page);
    $page = array_pop($page);
?>
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"> </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="nav-item start <?php if($page=='roles' || $page=='role'){ echo "active";} ?>">
                <a href="{{URL::to('admin/roles')}}" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Roles Management</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <li class="nav-item start <?php if($page=='users' || $page=='user'){ echo "active";} ?>">
                <a href="{{URL::to('admin/users')}}" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">User Management</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <li class="nav-item start <?php if($page=='jobs' || $page=='job'){ echo "active";} ?>">
                <a href="{{URL::to('admin/jobs')}}" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Jobs Management</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <li class="nav-item start <?php if($page=='user-profile'){ echo "active";} ?>">
                <a href="{{URL::to('admin/user-profile')}}" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Profile Settings</span>
                    <span class=""></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR