<div class="col-sm-12 col-md-12 mb-10">
    <h3 class="heading mb-15">Certification</h3>
    <!-- 	<p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p> -->
    <?php

    if(count($certification) > 0){

    ?>
    <input type="button "class="btn btn-primary btn-sm" id="show_cer_pop" value="Add Certification">
    <?php } ?>
</div>

<div style="clear:both;"></div>
<form id="frm_cer">


    <div id="cer_pop" class="clearfix" style="display:none;" >
        <input type="hidden" id="userid" name="userid" value="<?php echo $userinfo->id;?>">
        <input type="hidden" name="cer_id" id="cer_id">


        <!-- Form template-->
        <div id="">

            <div class="col-sm-12">

                <div class="dynamic-add-form-item">

                    <div class="dynamic-add-form-inner">

                        <!-- 		<h4 class="heading font700 mb-10 text-primary">Work Experience <span id="dynamicAddForm2_label"></span></h4> -->

                        <div class="row gap-20">

                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="dynamicAddForm2_#index#_school">Certification Name</label>
                                    <input id="name" name="name" type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="col-sm-7">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-20">
                                            <label for="dynamicAddForm2_#index#_from1">From:</label>
                                            <div class="row gap-10">
                                                <div class="col-xs-6 col-sm-6">
                                                    <select id="date_from_month" name="date_from_month" class="form-control" data-live-search="false">
                                                        <option value="" selected >Select</option>
                                                        <option value="Jan">Jan</option>
                                                        <option value="Feb">Feb</option>
                                                        <option value="March">Mar</option>
                                                        <option value="April">Apr</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="july">July</option>
                                                        <option value="Aug">August</option>
                                                        <option value="Sept">Sept</option>
                                                        <option value="Oct">Oct</option>
                                                        <option value="Nov">Nov</option>
                                                        <option value="Dec">Dec</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-6 col-sm-6">
                                                    <select id="date_from_year" name="date_from_year" class=" form-control" data-live-search="false">
                                                        <option value="" selected >Select</option>
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

                                    <div class="col-sm-6" id="date_to_cer_div">
                                        <div class="form-group mb-20">
                                            <label for="dynamicAddForm2_#index#_to1" id="label_to">To:</label>
                                            <div class="row gap-10">
                                                <div class="col-xs-6 col-sm-6">
                                                    <select id="date_to_month" name="date_to_month" class=" form-control" data-live-search="false">
                                                        <option value="" selected >Select</option>
                                                        <option value="Jan">Jan</option>
                                                        <option value="Feb">Feb</option>
                                                        <option value="March">Mar</option>
                                                        <option value="April">Apr</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="july">July</option>
                                                        <option value="Aug">August</option>
                                                        <option value="Sept">Sept</option>
                                                        <option value="Oct">Oct</option>
                                                        <option value="Nov">Nov</option>
                                                        <option value="Dec">Dec</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-6 col-sm-6">
                                                    <select id="date_to_year" name="date_to_year" class=" form-control" data-live-search="false">
                                                        <option value="" selected >Select</option>
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


                                    <div class="col-sm-8">
                                        <!-- 			<div class="checkbox-block">
                                                        <input  style="display:block;opacity:1;margin:5px 0px 0px 0px;" type="checkbox" name="current" id="current" value="1">

                                                        <label class="" for="register_accept_checkbox">I currently working here</label>
                                                            </div> -->
                                    </div>

                                </div>

                            </div>

                            <div class="clear"></div>

                            <div class="col-sm-5">
                                <div class="form-group mb-20">
                                    <label for="dynamicAddForm2_#index#_program">Certification Authority:</label>
                                    <input id="authority" name="authority" type="text" class="form-control" />
                                </div>

                            </div>


                            <div class="col-sm-5">

                                <div class="checkbox-block">
                                    <input  style="display:block;opacity:1;margin:5px 0px 0px 0px;" type="checkbox" name="present" id="present" value="1">

                                    <label class="" for="register_accept_checkbox">This certificate does not expire</label>
                                </div>

                            </div>



                            <div class="clear"></div>

                            <div class="col-sm-12">
                                <div class="form-group mb-20">
                                    <label for="dynamicAddForm2_#index#_extraInfo">Certification URL:</label>
                                    <input id="url" name="url" type="text" class="form-control" placeholder="http://wwww.test.com"/>
                                </div>
                            </div>

                        </div>



                    </div>


                </div>

            </div>

            <div class="clear"></div>

        </div>
        <!-- /Form template-->

        <!-- No forms template -->
        <div id="dynamicAddForm2_noforms_template" class="dynamic-add-form-empty">
            <div id="msg_frm_exp"></div>

        </div>
        <!-- /No forms template-->

        <!-- Controls -->
        <div id="dynamicAddForm2_controls" class="dynamic-add-form-action">

            <div id="dynamicAddForm2_add_n">
                <div id="dynamicAddForm2_add_n_button">
                    <input type="button" class="btn btn-primary btn-sm" id="add_cer" value="Save">

                </div>
            </div>
        </div>
        <!-- /Controls -->

    </div>
</form>


<div >

    <?php
    if(count($certification)<=0){?>

    <div id="cer_not_found" class="alert alert-info mt-30"> <strong>Certification not found</strong> - <a href="javascript:void(0)" name="show_exp_pop" id="show_cer_pop" >Add Certification</a> </div>


    <?php } else{?>



     <div class="col-sm-6">


         <div id="education_list">
             <ul class="employee-detail-list" id="education_detail">

             <?php
                 foreach($certification as $single_exp){?>

                 <li>
                     <h5><?php echo $single_exp->name;?>&nbsp;&nbsp; <a href="#_" class="edit_cer_link" tab_id="<?php echo $single_exp->id;?>">Edit</a></h5>

                 <p class="text-muted font-italic">

                     <?php echo $single_exp->date_from;?> –
                     <?php
                     if($single_exp->present==1){
                         echo "Present";
                     }else{
                         echo $single_exp->date_to;
                     }
                     ?>
                     at <span class="font600 text-primary"><?php echo $single_exp->authority;?></span></p>
                 <p><a href="<?php echo $single_exp->url;?>"><?php echo $single_exp->url;?></a></p>
                 </li>
                 <?php }?>

             </ul>
         </div>


    </div> <!-- work-expereince-block -->
    <?php } ?>


</div>




<style>

    input[type='radio'] + label:hover::before, input[type='checkbox'] + label:hover::before, input[type='radio']:checked + label:before, input[type='checkbox']:checked + label:before {
        color: #ffffff !important;
    }
</style>
<script>
    $(document).ready(function () {

        $('#show_cer_pop').click(function () {
            $('#cer_pop').show();
            $('#cer_not_found').hide();
        });

        $('#present').click(function () {
            if($('#present').is(':checked')){
                $('#date_to_cer_div').hide();
            }else{
                $('#date_to_cer_div').show();

            }
        });


        $('#add_cer').click(function () {
            $('.loader').show();
            html = '';
            pageURI = '/user/add_certification';
            request_data = $('#frm_cer').serializeArray();
            mainAjax('frm_exp', request_data, 'POST',fillDataCer);
        });

        function fillDataCer(data){
            if(data.code==200){
                location.reload();

            }
        }

        $('.edit_cer_link').click(function () {
            //  alert($(this).attr('tab_id'));
            pageURI = '/user/edit_certification';
            request_data = {'cer_id':$(this).attr('tab_id')}
            mainAjax('frm_exp', request_data, 'POST',fillEditCer);
        });

        function fillEditCer(data){

            if(data.code=200){
                var date_from =data.data[0].year_from;
                $('#name').val(data.data[0].name);
                var date_from = data.data[0].date_from;
                var date_from_arr =  date_from.split("-");
                $('#date_from_month option[value="' + date_from_arr[0] + '"]').prop('selected', true);
                $('#date_from_year option[value="' + date_from_arr[1] + '"]').prop('selected', true);
                if(data.data[0].present==1){
                    $('#present').prop('checked',true);
                    $('#date_to_cer_div').hide();
                }

                var date_from = data.data[0].date_to;
                var date_from_arr =  date_from.split("-");
                $('#date_to_month option[value="' + date_from_arr[0] + '"]').prop('selected', true);
                $('#date_to_year option[value="' + date_from_arr[1] + '"]').prop('selected', true);

                $('#url').val(data.data[0].url);
                $('#authority').val(data.data[0].authority);
                $('#cer_id').val(data.data[0].id);
                $('#add_cer').val('Update');
                $('#cer_pop').show();

            }
        }
    });
</script>