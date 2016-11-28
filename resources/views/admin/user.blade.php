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
                            <span>{{($user_id > 0)?'Modify':'Add'}} User</span>
                        </li>
                    </ul>

                    <div class="form-actions pull-right margin-top-5px margin-bottom-5px">
                        <a href="{{URL::to('admin/users')}}"><button type="button" class="btn green"><i class="fa fa-arrow-left fa-fw"></i> Go Back To Users</button></a>
                    </div>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                
                
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row">
                    <div class="col-md-8 ">
                        
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject bold uppercase">{{($user_id > 0)?'Modify':'Add New'}} User</span>
                                </div>
                            </div>
                            <div class="portlet-body form">

                                <div class="msg_divs alert" id="msg_div"></div>
                               
                                <div class="form-body">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <div class="input-group margin-top-10">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter Full Name" id="user_name" value="{{($user_id > 0)?$user->name:''}}"> </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group margin-top-10">
                                            <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control" placeholder="Enter Email Address" id="user_email" value="{{($user_id > 0)?$user->email:''}}"> </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Role</label>
                                        <div class="margin-top-10">
                                            <select class="bs-select form-control" id="user_role">
                                            <?php
                                                if (count($roles) > 0) {
                                            ?>
                                                <option value="0">Select Role</option>
                                                <?php
                                                    foreach ($roles as $key => $role) {
                                                ?>
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                <?php
                                                    }
                                                ?>
                                            <?php
                                                } else {
                                            ?>
                                                <option value="0">No Role Found</option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="form-actions right">
                                    <a href="javascript:;" id="user_submit_btn"><button type="button" class="btn green">Submit</button></a>
                                    <img class="button_spinners" src="{{URL::to('pannel/images/loader.gif')}}" id="submit_loader">
                                </div>
                               
                            </div>
                        </div>
                        <!-- END SAMPLE FORM PORTLET-->
                    </div>
                </div>

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        
    </div>
    <!-- END CONTAINER -->

<input type="hidden" value="{{$user_id}}" id="updated_user_id"/>

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
});
</script> 
@endsection