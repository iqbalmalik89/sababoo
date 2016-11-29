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
            <li class="nav-item start <?php if($page=='users' || $page=='user' || $page=='site-users' || $page=='site-user'){ echo "active";} ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">User Management</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                    <ul class="sub-menu">
                        <li class="nav-item  <?php if($page=='users' || $page=='user'){ echo "active open";} ?>">
                            <a href="{{URL::to('admin/users')}}" class="nav-link ">
                                <span class="title">Admin Users</span>
                            </a>
                        </li>
                        <li class="nav-item  <?php if($page=='site-users' || $page=='site-user'){ echo "active open";} ?> ">
                            <a href="{{URL::to('admin/site-users')}}" class="nav-link ">
                                <span class="title">Site Users</span>
                            </a>
                        </li>
                        
                    </ul>
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
            <li class="nav-item start <?php if($page=='skills' || $page=='skill'){ echo "active";} ?>">
                <a href="{{URL::to('admin/skills')}}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Skills Management</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <li class="nav-item start <?php if($page=='industries' || $page=='industry'){ echo "active";} ?>">
                <a href="{{URL::to('admin/industries')}}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Industries Management</span>
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