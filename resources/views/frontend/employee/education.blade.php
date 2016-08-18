<div class="clear mb-30"></div>

<div class="col-sm-12 col-md-12 mb-15">
    <h3 class="heading mb-10">Educations</h3>

<!--     <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p> -->
</div>



<div class="clear"></div>
<div id="dynamicAddForm" class="clearfix">
    <!-- Form template-->
    <div id="dynamicAddForm_template">
        <form id="frm_education">
        <div class="col-sm-12">
            <input type="hidden" id="employee_id" name="employee_id" value="<?php echo $employeeinfo[0]->id;?>">

            <div class="">

                <div class="dynamic-add-form-inner">
<!-- 
                    <h4 class="heading font700 mb-15 text-primary">Education <span id="dynamicAddForm_label"></span></h4> -->
                    <?php if(count($education) > 0){?>

                    <div id="dynamicAddForm_add">
                        <input type="button" name="education_btn" id="education_btn" value="Add Education" class="btn btn-primary btn-sm">
                    </div>

                    <?php } ?>
                    <div id="education_list">
                        <?php if(count($education)<=0){?>


                                <div id="education_not_found" class="alert alert-info mt-30"> <strong>Education not found</strong> - <a href="javascript:void(0)" name="education_btn" id="education_btn" >Add education</a> </div>


                            <?php }else{

                                foreach($education as $single_edu){

                           ?>
                        <ul class="employee-detail-list" id="education_detail">

                            <li>
                                <h5><?php echo $single_edu->degree;?> ,<?php echo $single_edu->field_study;?> &nbsp;  &nbsp;<a href="#_" class="edit_education_link" tab_id="<?php echo $single_edu->id;?>">Edit</a> </h5>
                                <p class="text-muted font-italic"><?php echo $single_edu->year_from;?> – <?php echo $single_edu->year_to;?> from <span class="font600 text-primary"><?php echo $single_edu->school_name;?></span></p>
                                <p><?php echo $single_edu->description;?></p>
                            </li>


                        </ul>
                        <?php }}?>

                        </div>

                    </div>


                    <div id="education_pop" class="row gap-20" style="display: none;">
                         <input type="hidden" name="edu_id" id="edu_id">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="dynamicAddForm_#index#_school">University/College </label>
                                <input id="school_name" name="school_name" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="col-sm-7">

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group mb-20">
                                        <label for="dynamicAddForm_#index#_from1">From:</label>
                                        <div class="row gap-10">

                                            <div class="col-xs-6 col-sm-6">
                                                <select id="date_from" name="date_from" class=" form-control" data-live-search="false">
                                                    <option value="0" selected >Select</option>
                                                    <?php
                                                    foreach(range(2000, 2042) as $year)
                                                    {
                                                        echo '<option value="'.$year.'">'.$year.'</option>';
                                                    }
                                                    ?>                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-20">
                                        <label for="dynamicAddForm_#index#_to1">To:</label>
                                        <div class="row gap-10">

                                            <div class="col-xs-6 col-sm-6">
                                                <select id="date_to" name="date_to" class=" form-control" data-live-search="false">
                                                    <option value="0" selected >Select</option>
                                                    <?php
                                                    foreach(range(2000, 2042) as $year)
                                                    {
                                                        echo '<option value="'.$year.'">'.$year.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="col-sm-6">

                            <div class="form-group mb-20">
                                <label for="dynamicAddForm_#index#_level">Degree:</label>
                                <input id="degree" name="degree" type="text" class="form-control" />
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group mb-20">
                                <label for="dynamicAddForm_#index#_program">Field Of Study:</label>
                                <input id="field_study" name="field_study" type="text" class="form-control" />
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group mb-20">
                                <label for="dynamicAddForm_#index#_program">Grade:</label>
                                <input id="grade" name="grade" type="text" class="form-control" />
                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="col-sm-12">

                            <div class="form-group mb-20 bootstrap3-wysihtml5-wrapper">
                                <label for="dynamicAddForm_#index#_extraInfo">Addition Info:</label>
                                <textarea id="description" name="description" class="form-control" rows="5"></textarea>

                            </div>

                        </div>
                        <div id="dynamicAddForm_add">
                            <input type="button" name="update_btn" value="Save" id="update_btn" class="btn btn-primary btn-sm">
                        </div>


                    </div>

                </div>



            </div>

        </div>
            <div id="msg_frm_education"></div>
        </form>

        <div class="clear"></div>

    </div>
    <!-- /Form template-->

    <!-- /Controls -->

</div>
<script>
    $(document).ready(function () {

        $('#education_btn').click(function () {
            $('#education_not_found').hide();
            $('#education_pop').show();
        });

        $('.edit_education_link').click(function () {
          //  alert($(this).attr('tab_id'));
            pageURI = '/employee/edit_education';
            request_data = {'edu_id':$(this).attr('tab_id')}
            mainAjax('frm_education', request_data, 'POST',fillEditEducation);
        });

        function fillEditEducation(data){
           if(data.code=200){
               var date_from =data.data[0].year_from;
               $('#school_name').val(data.data[0].school_name);
               $('#date_from option[value="' + data.data[0].year_from + '"]').prop('selected', true);
               $('#date_to option[value="' + data.data[0].year_to + '"]').prop('selected', true);
               $('#degree').val(data.data[0].degree);
               $('#field_study').val(data.data[0].field_study);
               $('#grade').val(data.data[0].grade);
               $('#description').val(data.data[0].description);
               $('#edu_id').val(data.data[0].id);
               $('#update_btn').val('Update');
               $('#education_pop').show();

           }
        }

        $('#update_btn').click(function () {
			$('.loader').show();
            html = '';
            pageURI = '/employee/add_education';

            request_data = $('#frm_education').serializeArray();
            mainAjax('frm_education', request_data, 'POST',fillData);
        });
        function fillData(data){
            if(data.code==200){
                location.reload();
                $('#school_name').val('');
                $('#date_from option[value="0"]').prop('selected', true);
                $('#date_to option[value="0"]').prop('selected', true);
                $('#degree').val('');
                $('#field_study').val('');
                $('#grade').val('');
                $('#description').val('');
                $('#edu_id').val('');
                $('#update_btn').val('Add');
                $('#education_pop').hide();
            }
        }
    });
</script>
