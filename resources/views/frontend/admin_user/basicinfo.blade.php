
<form class="post-form-wrapper" id="frm_basic_info">

    <div class="row gap-20">
        <div class="col-sm-12 col-md-12 mb-15">
            <!--               <h3 class="heading mb-10">Profile</h3>
                          <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p> -->
        </div>
        <div class="clear"></div>
        <!-- sheepIt Form -->
        <div id="dynamicAddForm" class="clearfix">

            <!-- Form template-->
            <div id="dynamicAddForm_template">

                <div class="col-sm-12">

                    <div class="">

                        <div class="dynamic-add-form-inner">

                            <!--                               <h4 class="heading font700 mb-15 text-primary">Profile  <span id="dynamicAddForm_label"></span></h4>
                             -->
                            <div class="row gap-20">
                                <div class="col-sm-6 col-md-4">

                                </div>

                                <div class="clear"></div>


                                <input id="id" name="id" type="hidden" class="form-control" value="<?php echo $userinfo->id;?>"/>



                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="dynamicAddForm">Full Name </label>
                                        <input id="name" name="name" type="text" class="form-control" value="<?php if(isset($userinfo->name)){ echo $userinfo->name;}?>"/>
                                    </div>
                                </div>

                                <div class="clear"></div>

                            
                            </div>



                        </div>



                    </div>

                </div>



            </div>
            <!-- /Form template-->
            <div class="clear"></div>
            <!-- No forms template -->
            <!--               <div id="msg_frm_basic_info" class="dynamic-add-form-empty clearfix"> -->

        </div>
        <!-- /No forms template-->
        <div id="msg_frm_basic_info"></div>
        <!-- Controls -->
        <div id="dynamicAddForm_controls" class="dynamic-add-form-action">
            <div id="dynamicAddForm_add">
                <input class="btn btn-primary btn-sm" type="button" name="update" id="update_basic_info" value="Update ">
            </div>
        </div>
        <!-- /Controls -->

    </div>
    </div>

</form>
<div class="clear"></div>
<style>

    .file-thumb-progress .progress, .file-thumb-progress .progress-bar{
        height: 0px;;
    }
</style>

<script>
    var pageURI = '';
    var request_data = '';
    var isScrLock = false;
    var html = '';

    $(document).ready(function () {

        $('#update_basic_info').click(function () {
            $('.loader').show();
            html = '';
            pageURI = '/admin_user/update_basic_info';
            request_data = $('#frm_basic_info').serializeArray();
            mainAjax('frm_basic_info', request_data, 'POST',fillData);

        });

        function fillData(data)
        {
            if(data.status == 'ok')
            {
               $('#msg_frm_basic_info').hide();
                $('#global_message').show().html(data.message).delay(3000).fadeOut();
            }
        }

        $("#form-register-photo").fileinput({
            dropZoneTitle: '<i class="fa fa-photo"></i><span>Upload Photo</span>',
            uploadUrl: '/user/imageUpload?_token=' + $('meta[name="csrf-token"]').attr('content'),
            maxFileCount: 1,
            minFileCount: 1,
            uploadAsync: true,
            showUpload: true,
            showRemove: false,
            browseLabel: 'Browse',
            browseIcon: '',
            //removeLabel: 'Remove',
            removeLabel: false,
            removeIcon: '',
            uploadLabel: 'Upload',
            uploadIcon: '',
            autoReplace: true,
            showCaption: false,
            allowedFileTypes: ['image' ],
            allowedFileExtensions: ['jpg', 'gif', 'png', 'tiff'],
            initialPreview: [
                '<img src="{{asset('assets/frontend/images/man/01.jpg')}}" class="file-preview-image" alt="The Moon" title="The Moon">',
            ],
            overwriteInitial: true,
            msgFilesTooLess:true,
            showPreview: false,
            //initialPreviewAsData: true
            elErrorContainer: '#kv-error-1'
        }).on('filebatchuploadsuccess', function(event, data, id, index) {

            console.log(data.jqXHR.responseJSON.code);
            if(data.jqXHR.responseJSON.code==200){
                $('#employee_image_1').attr('src',data.jqXHR.responseJSON.img);
                $('#employee_image_2').attr('src',data.jqXHR.responseJSON.img);
                $('#img_upload').addClass('msg_ok');
                $('#img_upload').show();
                $('#img_upload').html('Image uploaded successfully');
                $('#img_upload').fadeIn('slow');
                $('#img_upload').delay(2000).fadeOut();
            }else {
                $('#img_upload').addClass('msg_cancel');
                $('#img_upload').show();
                $('#img_upload').html('Invalid format please try again.');
                $('#img_upload').fadeIn('slow');
                $('#img_upload').delay(2000).fadeOut();
            }


        });


        /*var $input = $("#form-register-photo");
         $input.fileinput({
         uploadUrl: '/employee/imageUpload?_token=' + $('meta[name="csrf-token"]').attr('content'), // server upload action
         uploadAsync: false,
         showUpload: false, // hide upload button
         showRemove: false, // hide remove button
         minFileCount: 1,
         maxFileCount: 1
         }).on("filebatchselected", function(event, files) {
         // trigger upload method immediately after files are selected
         $input.fileinput("upload");
         });*/

    });

</script>