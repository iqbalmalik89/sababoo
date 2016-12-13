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
                        <a href="{{URL::to('admin/transaction')}}">Transactions History</a>
                        <!-- <i class="fa fa-circle"></i> -->
                    </li>
                    <!-- <li>
                        <span>Dashboard</span>
                    </li> -->
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <div>
                <h3 class="page-title pull-left"> Transactions
                    <small>(<span id="total_transactions"></span>)</small>
                </h3>
                <div class="pull-right margin-top-25px">
                    <div>
                        <label>Search: <input type="search" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="sample_2" id="transaction_search_keyword"></label>

                        <!-- <div class="margin-left-10px pull-right">
                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5 date">
                                <div class="form-group form-lg">
                                    <label>End Date</label>
                                    <input class="span2" size="16" type="text" id="end_date" name="end_date">
                                </div>
                            </div>
                        </div>
                        <div class="margin-left-10px pull-right">
                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5 date">
                                <div class="form-group form-lg">
                                    <label>Start Date</label>
                                    <input class="span2" size="16" type="text" id="start_date" name="start_date">
                                </div>
                            </div>
                        </div> -->

                        
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
                            <thead id="transactions_list_head">
                                
                            </thead>
                            <tbody id="transactions_list">
                                                                    
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
                                <select class="bs-select form-control" id="transaction-list-limit">
                                    <option value="5">Show 5 transactions per page</option>
                                    <option value="10" selected="selected">Show 10 transactions per page</option>
                                    <option value="15">Show 15 transactions per page</option>
                                    <option value="20">Show 20 transactions per page</option>
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

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    Sababoo.App.Transaction.list();
    //$('#start_date').datepicker();
    //$('#end_date').datepicker();
});
</script> 
@endsection