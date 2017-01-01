<?php
    $roleOperations = [];
    if (Auth::user() != NULL) {
        $adminUser = Auth::user();

        $roleRepo = app()->make('RoleRepository');
        $roleOperations = $roleRepo->getRoleOperations($adminUser->role_id);
        
    } 
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{url('admin/dashboard')}}">Sababoo Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle top_menu" data-toggle="dropdown"><i class="fa fa-user"></i> {{$logged_in_user->first_name}} <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{URL::to('admin/user-profile')}}"><i class="fa fa-fw fa-user"></i> My Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="javascript:;" id="user-logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

<input type="hidden" value="{{$logged_in_user->id}}" id="hidden_user_id"/>
<input type="hidden" value="{{json_encode($roleOperations)}}" id="hidden_operations"/>