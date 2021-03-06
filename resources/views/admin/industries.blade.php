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
                        <a href="{{URL::to('admin/industries')}}">Industries Management</a>
                        <!-- <i class="fa fa-circle"></i> -->
                    </li>
                    <!-- <li>
                        <span>Dashboard</span>
                    </li> -->
                </ul>
                <?php
                    if (in_array(21, $roleOperations)) {
                ?>
                    <div class="form-actions pull-right margin-top-5px margin-bottom-5px">
                        <a href="{{URL::to('admin/industry')}}"><button type="button" class="btn green"><i class="fa fa-plus fa-fw"></i>Add Industry</button></a>
                    </div>
                <?php
                    }
                ?>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div>
                <h3 class="page-title pull-left"> Industries
                    <small>(<span id="total_industries"></span>)</small>
                </h3>
                <div class="pull-right margin-top-25px">
                    <div>
                        <label>Search: <input type="search" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="sample_2" id="industry_search_keyword"></label>

                        <div class="margin-left-10px pull-right">
                            <form>
                                <div class="">
                                    <select id="industry_filter_by_status" class="bs-select form-control">
                                        
                                        <option value="">Filter By Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">In-Active</option>
                                   
                                    </select>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet">
                
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead id="industries_list_head">
                                
                            </thead>
                            <tbody id="industries_list">
                                                                    
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="table_pagintaion clearfix">
                    <div class="pull-left ">
                        <ul class="pagintaion_btns list-unstyled general-pagination">
                            <li><a href="#" class="disable">Previous</a></li>
                            <li><a href="#">Next</a></li>
                            <li class="hidden-xs">Showing 1 - 10</li>
                        </ul>
                    </div>
                    <div class="pull-right general-limit-div">
                        <form>
                            <div class="">
                                <select class="bs-select form-control" id="industry-list-limit">
                                    <option value="5">Show 5 industries per page</option>
                                    <option value="10" selected="selected">Show 10 industries per page</option>
                                    <option value="15">Show 15 industries per page</option>
                                    <option value="20">Show 20 industries per page</option>
                                </select>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    
</div>
<!-- END CONTAINER -->

<div id="removeConfirmation" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation!</h4>
      </div>
      
      <div class="modal-body">
        <div class="msg_divs alert" id="remove_msg_div"></div>
        <p>Are you sure you want to remove this industry?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <a href="javascript:;" id="industry_remove_btn"><button type="button" class="btn green">Yes</button></a>
        <img class="button_spinners" src="{{URL::to('pannel/images/loader.gif')}}" id="remove_submit_loader">
      </div>
    </div>

  </div>
</div>

<div id="updateStatusConfirmation" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation!</h4>
      </div>
      
      <div class="modal-body">
        <div class="msg_divs alert" id="status_msg_div"></div>
        <p>Are you sure you want to <span id="update_status_text"></span> this industry?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <a href="javascript:;" id="industry_status_btn"><button type="button" class="btn green">Yes</button></a>
        <img class="button_spinners" src="{{URL::to('pannel/images/loader.gif')}}" id="status_submit_loader">
      </div>
    </div>

  </div>
</div>

<input type="hidden" value="0" id="hidden_action_industry_id"/>
<input type="hidden" value="0" id="hidden_action_industry_status"/>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    Sababoo.App.Industry.list();
});
</script> 
@endsection