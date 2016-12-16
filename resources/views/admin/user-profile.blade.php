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
                        <a href="{{URL::to('user-profile')}}">Profile Settings</a>
                        <!-- <i class="fa fa-circle"></i> -->
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-8">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#personal_info_tab" data-toggle="tab">Personal Info</a>
                                    </li>
                                    <li>
                                        <a href="#change_password_tab" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="personal_info_tab">
                                        <form role="form" action="#">
                                            <div class="msg_divs alert" id="profile_msg"></div>
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <div class="input-group margin-top-10">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Enter Full Name" id="profile_name" value="{{$logged_in_user->first_name}}"> 
                                                </div> 
                                            </div>
                                            <div class="margiv-top-10">
                                                <a href="javascript:;" id="profile_submit_btn"><button type="button" class="btn green">Save Changes</button></a>
                                                <img class="button_spinners" src="{{URL::to('pannel/images/loader.gif')}}" id="profile_submit_loader">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="change_password_tab">
                                        <form action="#">
                                            <div class="msg_divs alert" id="save_account_password_msg"></div>
                                            <div class="form-group">
                                                <label class="control-label">Current Password</label>
                                                <input type="password" class="form-control" placeholder="Enter Current Password" id="old_password"/> </div>
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" class="form-control" placeholder="Enter New Password" id="new_password"/> </div>
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Password</label>
                                                <input type="password" class="form-control" placeholder="Re-Type New Password" id="confirm_password"/> </div>
                                            <div class="margiv-top-10">
                                                <a href="javascript:;" id="profile_password_submit_btn"><button type="button" class="btn green">Change Password</button></a>
                                                <img class="button_spinners" src="{{URL::to('pannel/images/loader.gif')}}" id="profile_password_submit_loader">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
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