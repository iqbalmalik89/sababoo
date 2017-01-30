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
                            <a href="{{URL::to('admin/companies')}}">Companies Management</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>{{($company_id > 0)?'Modify':'Add'}} Company</span>
                        </li>
                    </ul>

                    <div class="form-actions pull-right margin-top-5px margin-bottom-5px">
                        <a href="{{URL::to('admin/companies')}}"><button type="button" class="btn green"><i class="fa fa-arrow-left fa-fw"></i> Go Back To Companies</button></a>
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
                                    <span class="caption-subject bold uppercase">{{($company_id > 0)?'Modify':'Add New'}} Company</span>
                                </div>
                            </div>
                            <div class="portlet-body form">

                                <div class="msg_divs alert" id="msg_div"></div>
                               
                                <div class="form-body">

                                    <div class="form-group">
                                        <label>Name</label>
                                        <div class="input-group margin-top-10 col-md-8">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Enter Name" id="company_name" value="{{($company_id > 0)?$company->name:''}}"> </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <label>Link</label>
                                        <div class="input-group margin-top-10 col-md-8">
                                            <input type="text" class="form-control" placeholder="Enter Link" id="company_url" value="{{($company_id > 0)?$company->url:''}}"> </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="form-group fg-file-upload-detail">
                                        <label for="company-image" class="control-label">Image:</label>
                                        <p class="image-error company-upload-error"></p>
                                        <input type="text" class="form-control input-lg input-file-path pull-left" placeholder="Select file to upload" id="file-span-msg-company">
                                        <input type="file" class="custom_input_file" id="companyImage"  multiple="true">
                                         <span class="input_label" style="margin-bottom: -46px;margin-right: -229px;">Browse</span>
                                        <input type="hidden" value="{{($company_id > 0)?$company->image:''}}" id="hidden-company-image">
                                        <?php
                                            if (isset($company->image) && $company->image != '') {
                                        ?>
                                            <img class="image_preview" id="company_preview" src="{{url('files/company/'.$company->image)}}"/>
                                        <?php
                                            }  else {
                                        ?>
                                            <img class="image_preview" id="company_preview" src="{{url('pannel/images/image-not-found.png')}}"/>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-actions right">
                                    <a href="javascript:;" id="company_submit_btn"><button type="button" class="btn green">Submit</button></a>
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

<input type="hidden" value="{{$company_id}}" id="updated_company_id"/>

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('#companyImage').fileupload({
        dataType: 'json',
        paramName:'file',
        formData:{'from':'company'},
        limitMultiFileUploads:1,
        acceptFileTypes:/(\.|\/)(png|jpg|jpeg)$/i,
        url:Sababoo.Config.getApiUrl()+'image/upload',
        add: function (e, data) {
            
            $('.company-upload-error').html('');
            
            // for file format validation
            if (!Sababoo.App.isAcceptFileTypes(data.files[0]['type'])) {
                $('.company-upload-error').removeClass('success');
                $('.company-upload-error').addClass('error');
                $('.company-upload-error').html('Invalid File Format.').delay(2000).fadeIn();
                return false;
            }

            // for file size validation
            var maxFileSize = 10000000; // 10MB
            if (data.files[0]['size'] > maxFileSize) {
                $('.company-upload-error').removeClass('success');
                $('.company-upload-error').addClass('error');
                $('.company-upload-error').html('Limit exceeds, maximium file size can be 10MB.').delay(2000).fadeIn();
                return false;
            }

            var jqXHR = data.submit()
                .success(function (result, textStatus, jqXHR) {
                    if (result.status) {

                        $('#hidden-company-image').val(result.file);
                        var html = 'Image has been uploaded successfully.';
                        if (jqXHR.responseJSON.messages){
                            var messages = jqXHR.responseJSON.messages;
                            var html =  messages;
                        }
                        //$('.company-upload-error').removeClass('error');
                        //$('.company-upload-error').addClass('success');
                        //$('.company-upload-error').html(html).delay(2000).fadeIn();
                        $('#file-span-msg-company').attr('placeholder',html);
                        $('#file-browse').addClass('new_label').text('Uploaded');
                        $('#hidden-company-image').parent().removeClass('has-error');
                        $('#company_preview').attr('src', Sababoo.Config.getSiteUrl()+'/files/company/'+result.file);
                    } else if(result.error) {
                        var html = 'An error occurred.';
                        if (result.error.messages && result.error.messages.length > 0){
                            var messages = jqXHR.responseJSON.error.messages;
                            var html =  messages[0];
                        }

                        $('.company-upload-error').removeClass('success');
                        $('.company-upload-error').addClass('error');
                        $('.company-upload-error').html(html).delay(2000).fadeIn();
                    }
                })
                .error(function (jqXHR, textStatus, errorThrown) {
                    var html = 'An error occurred.';
                    if (jqXHR.responseJSON.error.messages && jqXHR.responseJSON.error.messages.length > 0){
                        var messages = jqXHR.responseJSON.error.messages;
                        var html =  messages[0];
                    }
                    $('.company-upload-error').removeClass('success');
                    $('.company-upload-error').addClass('error');
                    $('.company-upload-error').html(html).delay(2000).fadeIn();
 
                })
                .complete(function (result, textStatus, jqXHR) {
                    $('#hidden-company-image').parent().removeClass('has-error');
                });
        },
        progressall: function (e, data) {
           
            var progress = parseInt(data.loaded / data.total * 100, 10);
            if (progress > 99) {
                progress = 99;
            };              
            $('#file-span-msg-company').attr('placeholder','Upload '+progress+'% Complete');
        },
        done: function (e, data) {
            $('#hidden-company-image').parent().removeClass('has-error');
        }
    });
});
</script> 
@endsection