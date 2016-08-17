<div class="col-sm-12 col-md-12 mb-15">
    <h3 class="heading mb-10">Educations</h3>

    <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
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

                    <h4 class="heading font700 mb-15 text-primary">Education <span id="dynamicAddForm_label"></span></h4>
                    <div id="dynamicAddForm_add">
                        <input type="button" name="education_btn" id="education_btn" value="Add Education" class="btn btn-primary btn-sm">
                    </div>

                    <div id="education_list">
                        <?php if(count($education)<=0){?>

                            <ul class="employee-detail-list">

                                <li>
                                    <h5>Education not found. </h5>
                                   </li>


                            </ul>
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
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                    <option value="2031">2031</option>
                                                    <option value="2032">2032</option>
                                                    <option value="2033">2033</option>
                                                    <option value="2034">2034</option>
                                                    <option value="2035">2035</option>
                                                    <option value="2036">2036</option>
                                                    <option value="2037">2037</option>
                                                    <option value="2038">2038</option>
                                                    <option value="2039">2039</option>
                                                    <option value="2040">2040</option>
                                                    <option value="2041">2041</option>
                                                    <option value="2042">2042</option>
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
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                    <option value="2031">2031</option>
                                                    <option value="2032">2032</option>
                                                    <option value="2033">2033</option>
                                                    <option value="2034">2034</option>
                                                    <option value="2035">2035</option>
                                                    <option value="2036">2036</option>
                                                    <option value="2037">2037</option>
                                                    <option value="2038">2038</option>
                                                    <option value="2039">2039</option>
                                                    <option value="2040">2040</option>
                                                    <option value="2041">2041</option>
                                                    <option value="2042">2042</option>
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
                            <input type="button" name="update_btn" value="Add" id="update_btn" class="btn btn-primary btn-sm">
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
