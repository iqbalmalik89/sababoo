<div class="col-sm-12 col-md-12 mt-15">

    <h4 class="heading font700 mb-10 text-primary">Add Files</h4>

    <?php if(count($user_files)<=0){?>

     <div></div>
    <?php  } ?>
    <ul class="employee-detail-list" id="education_detail">
        <?php foreach($user_files as $user_file){?>


        <li id="user_file<?php echo $user_file->id;?>">
            <h5><?php echo $user_file->title;?> &nbsp;  &nbsp;<a href="#_" class="edit_education_link" tab_id="1">
                    <span onclick="removeUserFiles('<?php echo $user_file->id;?>');" class="dynamic-add-form-close add-more-cancel">
                        <i class="fa fa-times" aria-hidden="true"></i>  </span></a> </h5>

        </li>

<?php }?>
    </ul>





</div>

<form action="#_" id="user_files_form" enctype="multipart/form-data">

    <div id="user_files_container">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Title</label>
                <input name="name[]" type="text" id="name" />
            </div>

        </div>

        <div class="col-sm-4">

            <div class="form-group">
                <label>File </label>
                <input name="file[]" type="file" id="file_text" />
            </div>
        </div>

      </div>


</form>

<div style="clear:both;">

    <div id="dynamicAddForm2_noforms_template" class="dynamic-add-form-empty">
        <div id="msg_user_files_form"></div>
</div>
    <div id="" class="dynamic-add-form-action">
        <div id="dynamicAddForm4_add"><button class=" add_more btn btn-primary btn-sm"><span>Add More Files</span></button></div>
        <div id="dynamicAddForm4_add"><button id="upload"  class="btn btn-primary btn-sm"><span>Upload Files</span></button></div>
    </div>


<script>

    $(document).ready(function(){

        $('#name').val('');
        $('#file_text').val('');
        $('.add_more').click(function(e){
            e.preventDefault();
            $('#user_files_container').append('<div  style="clear:both;"></div><div class="col-sm-4"><div class="form-group"><label>Title</label><input name="name[]" type="text" id="name" /></div></div><div class="col-sm-4"><div class="form-group"><label>File </label><input name="file[]" type="file" id="file" /></div></div><span onclick="removeFile(this);" class="dynamic-add-form-close add-more-cancel"><i class="fa fa-times" aria-hidden="true"></i></span>');
        });

        $('#upload').click(function(e) {
            e.preventDefault();
            var formData = new FormData($('#user_files_form')[0]);
            $.ajax({
                url: '/user/add_files',
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    var frm_id ='user_files_form';
                    remove_msg_class = 'ok';
                    if (data.status == 'ok') remove_msg_class = 'cancel';
                    $('#' + "msg_" + frm_id).removeClass('msg_' + remove_msg_class +' ,msg_error').addClass('msg_' + data.status).css('display', 'block').html(getFormatedMessages(data.msg));
                    if(data.code==200){
                        $('#' + "msg_" + frm_id).hide();
                        $('#global_message').show().html(data.msg).delay(4000).fadeOut();
                        location.reload();
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });



        });
    });

    function removeFile(obj){
        $(obj).prev().remove();
        $(obj).prev().remove();
        $(obj).remove();
    }

    function removeUserFiles(file_id){

        var r = confirm("Are you want to delete file");
        if (r == true) {
            $('#user_file'+file_id).remove();

                html = '';
                pageURI = '/user/delete_user_file';
                request_data ={file_id:file_id};
                mainAjax('frm_password', request_data, 'POST',FileCallBack);

        }
    }
    function FileCallBack(data){
        if(data.status == 'ok'){
            $('#global_message').show().html(data.msg).delay(4000).fadeOut();
        }
    }
</script>