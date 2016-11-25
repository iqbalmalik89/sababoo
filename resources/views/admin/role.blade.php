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
                            <a href="{{URL::to('admin/roles')}}">Role Management</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Add Role</span>
                        </li>
                    </ul>

                    <div class="form-actions pull-right margin-top-5px margin-bottom-5px">
                        <a href="{{URL::to('admin/roles')}}"><button type="button" class="btn green"><i class="fa fa-arrow-left fa-fw"></i> Go Back To Roles</button></a>
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
                                    <span class="caption-subject bold uppercase">{{($role_id > 0)?'Modify':'Add New'}} Role</span>
                                </div>
                            </div>
                            <div class="portlet-body form">

                                <div class="msg_divs alert" id="msg_div"></div>
                               
                                <div class="form-body">

                                    <div class="form-group">
                                        <label>Title</label>
                                        <div class="input-group margin-top-10">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter Title" id="role_title" value="{{($role_id > 0)?$role->title:''}}"> </div>
                                    </div>

                                    <div class="table-fixed-bg margin-bottom-20px table_head_role">
                                        <table class="table table-condensed margin-none">
                                            <tr class="active">
                                                <th width="30%">Permissions</th>
                                                <th width="70%"> <div class="row text-center">
                                                        <div class="auto-grid role-checkbox">Create</div>
                                                        <div class="auto-grid role-checkbox">Update</div>
                                                        <div class="auto-grid role-checkbox">Delete</div>
                                                        <div class="auto-grid role-checkbox">Listing</div>
                                                        <div class="auto-grid role-checkbox">Search</div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </table>
                                        <div class="table-body-popup custom-scrollbar scrobla_table">
                                            <table class="table table-condensed table-hover margin-none">
                                                <tbody id="modules_list">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <a href="javascript:;" id="role_submit_btn"><button type="button" class="btn green">Submit</button></a>
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

<input type="hidden" value="{{$role_id}}" id="updated_role_id"/>

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    Sababoo.App.Role.fetchModules();
});
</script> 
@endsection