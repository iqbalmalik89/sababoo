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
    $news_view = '';
    $log_view = '';

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

    // for log view permission                         permission id = 36
    if (!in_array(36, $roleOperations)) {
        $log_view = 'hide';
    }

    // for news view permission                         permission id = 4o
    if (!in_array(40, $roleOperations)) {
        $news_view = 'hide';
    }
?>

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="<?php if($page=='dashboard'){ echo "active";} ?>">
                <a href="{{url('admin/dashboard')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="<?php if($page=='roles' || $page=='role'){ echo "active";} ?> {{$role_view}}">
                <a href="{{URL::to('admin/roles')}}"><i class="fa fa-fw fa-briefcase"></i> Roles Management</a>
            </li>


            <li class="<?php if($page=='users' || $page=='user' || $page=='site-users' || $page=='site-user'){ echo "active";} ?> {{$users_view}}">
                <a href="javascript:;" data-toggle="collapse" data-target="#user-inner"><i class="fa fa-fw fa-user"></i> User Management <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="user-inner" class="collapse">
                    <li class="<?php if($page=='users' || $page=='user'){ echo "active open";} ?> {{$admin_user_view}}">
                        <a href="{{URL::to('admin/users')}}">Admin Users</a>
                    </li>
                    <li class="<?php if($page=='site-users' || $page=='site-user'){ echo "active open";} ?> {{$site_user_view}}">
                        <a href="{{URL::to('admin/site-users')}}">Site Users</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($page=='jobs' || $page=='job'){ echo "active";} ?> {{$job_view}}">
                <a href="{{URL::to('admin/jobs')}}">
                    <i class="fa fa-fw fa-briefcase"></i>Jobs Management
                </a>
            </li>
            <li class="<?php if($page=='skills' || $page=='skill'){ echo "active";} ?> {{$skills_view}}">
                <a href="{{URL::to('admin/skills')}}">
                    <i class="fa fa-fw fa-lightbulb-o"></i>Skills Management
                </a>
            </li>
            <li class="<?php if($page=='industries' || $page=='industry'){ echo "active";} ?> {{$industry_view}}">
                <a href="{{URL::to('admin/industries')}}">
                    <i class="fa fa-fw fa-table"></i>Industries Management
                </a>
            </li>
            <li class="<?php if($page=='newses' || $page=='news'){ echo "active";} ?> {{$news_view}}">
                <a href="{{URL::to('admin/newses')}}">
                    <i class="fa fa-fw fa-file"></i>News Management
                </a>
            </li>
            <li class="<?php if($page=='transactions'){ echo "active";} ?> {{$transaction_view}}">
                <a href="{{URL::to('admin/transactions')}}">
                    <i class="fa fa-fw fa-stack-exchange"></i>Transaction History
                </a>
            </li>
            <li class="<?php if($page=='refunds'){ echo "active";} ?> {{$refund_view}}">
                <a href="{{URL::to('admin/refunds')}}">
                    <i class="fa fa-fw fa-wrench"></i>Refund Requests
                </a>
            </li>
            <li class="<?php if($page=='logs'){ echo "active";} ?> {{$log_view}}">
                <a href="{{URL::to('admin/logs')}}">
                    <i class="fa fa-fw fa-calendar"></i>Activity Logs
                </a>
            </li>
            <li class="<?php if($page=='user-profile'){ echo "active";} ?>">
                <a href="{{URL::to('admin/user-profile')}}">
                    <i class="fa fa-fw fa-users"></i>Profile Settings
                </a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
