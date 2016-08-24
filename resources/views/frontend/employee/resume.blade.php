<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 21/08/2016
 * Time: 2:30 PM
 */
?>

<form id="resume_form" enctype="multipart/form-data">
   <div class="col-sm-12 col-md-12 mb-15">
        <h3 class="heading mb-10">Resume</h3>

    </div>

    <div id="dynamicAddForm3" class="clearfix">
        <?php

        if($employeeinfo['0']['resume_name']==''){?>

        <div id="resume_not_found" class="alert alert-info mt-30"> <strong>Resume not found</strong> - <a href="javascript:void(0)" name="resume_btn" id="resume_btn" >Add Resume</a> </div>


        <?php } else{ ?>
        <ul class="employee-detail-list" id="education_detail">

            <li>
                <h5><?php echo $employeeinfo['0']['resume_title'];?>  &nbsp;  &nbsp;
                    <a href="#_" class="" id="resume_edit" >Edit</a>
                    <input type="hidden" name="hide_resume_title" id="hide_resume_title" value="<?php echo $employeeinfo['0']['resume_title'];?> ">

                </h5>
            </li>
            <?php }?>
         </ul>
        <!-- Form template-->
        <div id="dynamicAddForm3_template">



            <div class="col-sm-12" style="display:none" id="resume_pop">

                <div class="dynamic-add-form-item">

                    <div class="dynamic-add-form-inner">


                        <div class="row gap-20">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="all_skills">Resume Name:</label>
                                    <input id="resume_name" name="resume_name" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="all_skills">Upload :</label>
                                    <input id="resume" name="resume" type="file" class="form-control" />
                                </div>
                            </div>
                            <div class="clear"></div>

                        </div>


                    </div>


                </div>
                <div id="msg_resume_form"></div>


                <div id="dynamicAddForm3_controls" class="dynamic-add-form-action">
                    <div id="dynamicAddForm3_add"><a id="resume_upload" class="btn btn-primary btn-sm"><span>Upload Resume</span></a></div>

                </div>

            </div>

            <div class="clear"></div>


        </div>



        </div>
</form>
<script>

    $(document).ready(function () {
        $('#resume_btn').click(function(){
               $('#resume_pop').show();
         });

        $('#resume_edit').click(function(){
            $('#resume_pop').show();
            $('#resume_name').val($('#hide_resume_title').val());
        });

    });


    $("#resume_upload").click(function(){

       // var formData = new FormData($(this)[0]);
        var formData = new FormData($('#resume_form')[0]);
       formData.append('resume_name',$('#resume_name').val()) ;

        $.ajax({
            url: '/employee/upload_resume',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                var frm_id ='resume_form';
                remove_msg_class = 'ok';
                if (data.status == 'ok') remove_msg_class = 'cancel';
                    $('#' + "msg_" + frm_id).removeClass('msg_' + remove_msg_class +' ,msg_error').addClass('msg_' + data.status).css('display', 'block').html(getFormatedMessages(data.msg));
                if(data.code==200){
                    location.reload();
                }

            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });

</script>