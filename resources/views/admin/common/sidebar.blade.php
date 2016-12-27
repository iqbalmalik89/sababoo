<?php
    $page = Route::getCurrentRoute()->getPath();
    $page = explode('/', $page);
    $page = array_pop($page);

    $roleOperations = [];
    if (Auth::user() != NULL) {
        $adminUser = Auth::user();

        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $roleRepo->getRoleOperations($adminUser->role_id);
        
    } 

    // apply permission wise view
    $role_view = '';
    $users_view = '';
    $admin_user_view = '';
    $site_user_view = '';
    $job_view = '';
    $skills_view = '';
    $industry_view = '';
    $transaction_view = '';
    $refund_view = '';
    $reporting_view = '';

    // for role view permission                         permission id = 4
    if (!in_array(4, $roleOperations)) {
        $role_view = 'hide';
    }

    // for admin user view permission                         permission id = 8
    if (!in_array(8, $roleOperations)) {
        $admin_user_view = 'hide';
    }

    // for site user view permission                         permission id = 12
    if (!in_array(12, $roleOperations)) {
        $site_user_view = 'hide';
    }

    if (!in_array(8, $roleOperations) && !in_array(12, $roleOperations)) {
        $users_view = 'hide';
    }

    // for job view permission                         permission id = 16
    if (!in_array(16, $roleOperations)) {
        $job_view = 'hide';
    }

    // for skills view permission                         permission id = 20
    if (!in_array(20, $roleOperations)) {
        $skills_view = 'hide';
    }

    // for industry view permission                         permission id = 24
    if (!in_array(24, $roleOperations)) {
        $industry_view = 'hide';
    }
    
    // for transaction view permission                         permission id = 28
    if (!in_array(28, $roleOperations)) {
        $transaction_view = 'hide';
    }

    // for refunds view permission                         permission id = 32
    if (!in_array(32, $roleOperations)) {
        $refund_view = 'hide';
    }

    // for reporting view permission                         permission id = 36
    if (!in_array(36, $roleOperations)) {
        $reporting_view = 'hide';
    }
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
            <li class="nav-item start <?php if($page=='roles' || $page=='role'){ echo "active";} ?> {{$role_view}}">
                <a href="{{URL::to('admin/roles')}}" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Roles Management</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <li class="nav-item start <?php if($page=='users' || $page=='user' || $page=='site-users' || $page=='site-user'){ echo "active";} ?> {{$users_view}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">User Management</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                    <ul class="sub-menu">
                        <li class="nav-item  <?php if($page=='users' || $page=='user'){ echo "active open";} ?> {{$admin_user_view}}">
                            <a href="{{URL::to('admin/users')}}" class="nav-link ">
                                <span class="title">Admin Users</span>
                            </a>
                        </li>
                        <li class="nav-item  <?php if($page=='site-users' || $page=='site-user'){ echo "active open";} ?> {{$site_user_view}}">
                            <a href="{{URL::to('admin/site-users')}}" class="nav-link ">
                                <span class="title">Site Users</span>
                            </a>
                        </li>
                        
                    </ul>
                </a>
            </li>
            <li class="nav-item start <?php if($page=='jobs' || $page=='job'){ echo "active";} ?> {{$job_view}}">
                <a href="{{URL::to('admin/jobs')}}" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Jobs Management</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <li class="nav-item start <?php if($page=='skills' || $page=='skill'){ echo "active";} ?> {{$skills_view}}">
                <a href="{{URL::to('admin/skills')}}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Skills Management</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <li class="nav-item start <?php if($page=='industries' || $page=='industry'){ echo "active";} ?> {{$industry_view}}">
                <a href="{{URL::to('admin/industries')}}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Industries Management</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <li class="nav-item start <?php if($page=='transactions'){ echo "active";} ?> {{$transaction_view}}">
                <a href="{{URL::to('admin/transactions')}}" class="nav-link nav-toggle">
                    <i class="icon-calendar"></i>
                    <span class="title">Transaction History</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <li class="nav-item start <?php if($page=='refunds'){ echo "active";} ?> {{$refund_view}}">
                <a href="{{URL::to('admin/refunds')}}" class="nav-link nav-toggle">
                    <i class="icon-wrench"></i>
                    <span class="title">Refund Requests</span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
            </li>
             <li class="nav-item start <?php if($page=='reports'){ echo "active";} ?> {{$reporting_view}}">
                <a href="{{URL::to('admin/reports')}}" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Reports</span>
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