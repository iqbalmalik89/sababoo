<div class="col-sm-12 col-md-12 mb-15">
	<h3 class="heading mb-15">Work Experiences</h3>
	<p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
	<button type="button "class="btn btn-primary btn-sm" id="show_exp_pop" value="Add Work Experiences">
</div>
<form id="frm_exp">
<div id="exp_pop" class="clearfix" style="dispaly:none;" >

<!-- Form template-->
	<div id="dynamicAddForm2_template">

	<div class="col-sm-12">

	<div class="dynamic-add-form-item">

	<div class="dynamic-add-form-inner">

		<h4 class="heading font700 mb-10 text-primary">Work Experience <span id="dynamicAddForm2_label"></span></h4>

		<div class="row gap-20">

		<div class="col-sm-5">
			<div class="form-group">
				<label for="dynamicAddForm2_#index#_school">Job Position</label>
				<input id="job_position" name="job_position" type="text" class="form-control" />
			</div>
		</div>

<div class="col-sm-7">

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group mb-20">
			<label for="dynamicAddForm2_#index#_from1">From:</label>
			<div class="row gap-10">
			<div class="col-xs-6 col-sm-6">
			<select id="date_from_month" name="date_from_month" class="selectpicker form-control" data-live-search="false">
			<option value="0" selected >Select</option>
			<option value="1">Jan</option>
			<option value="2">Feb</option>
			<option value="3">Mar</option>
			<option value="4">Apr</option>
			<option value="5">May</option>
			</select>
			</div>
			<div class="col-xs-6 col-sm-6">
			<select id="date_from_year" name="date_from_year" class="selectpicker form-control" data-live-search="false">
			<option value="0" selected >Select</option>
			<option value="1">2000</option>
			<option value="2">2001</option>
			<option value="3">2002</option>
			<option value="4">2003</option>
			<option value="5">2004</option>
			</select>
			</div>
			</div>
			</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group mb-20">
		<label for="dynamicAddForm2_#index#_to1">To:</label>
		<div class="row gap-10">
			<div class="col-xs-6 col-sm-6">
				<select id="date_to_month" name="date_to_month" class="selectpicker form-control" data-live-search="false">
				<option value="0" selected >Select</option>
				<option value="1">Jan</option>
				<option value="2">Feb</option>
				<option value="3">Mar</option>
				<option value="4">Apr</option>
				<option value="5">May</option>
				</select>
			</div>
			<div class="col-xs-6 col-sm-6">
				<select id="date_to_year" name="date_to_year" class="selectpicker form-control" data-live-search="false">
				<option value="0" selected >Select</option>
				<option value="1">2000</option>
				<option value="2">2001</option>
				<option value="3">2002</option>
				<option value="4">2003</option>
				<option value="5">2004</option>
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
		<label for="dynamicAddForm2_#index#_program">Company:</label>
		<input id="company_name" name="company_name" type="text" class="form-control" />
		</div>
	</div>

	<div class="clear"></div>

	<div class="col-sm-12">
		<div class="form-group mb-20">
		<label for="dynamicAddForm2_#index#_extraInfo">Addition Info:</label>
		<textarea id="additional_info" name="additional_info" class="form-control" rows="5"></textarea>
		</div>
	</div>

</div>



</div>

<span id="dynamicAddForm2_remove_current" class="dynamic-add-form-close">
<i class="fa fa-times" aria-hidden="true"></i>
</span>

</div>

</div>

<div class="clear"></div>

</div>
<!-- /Form template-->

<!-- No forms template -->
<div id="dynamicAddForm2_noforms_template" class="dynamic-add-form-empty">
	<div class="alert alert-danger mb-0">No form, please click "Add Work Experiences</div>
</div>
<!-- /No forms template-->

<!-- Controls -->
<div id="dynamicAddForm2_controls" class="dynamic-add-form-action">

	<div id="dynamicAddForm2_add_n">
		<div id="dynamicAddForm2_add_n_button"><button class="btn btn-primary btn-sm" type="button"  id="add_exp" value="Add"></div>
	</div>
</div>
<!-- /Controls -->

</div>
 <div id="msg_frm_exp"></div>
</form>
<script>
    $(document).ready(function () {

        $('#show_exp_pop').click(function () {
			$('#exp_pop').show();
		});
		 $('#add_exp').click(function () {
			$('.loader').show();
            html = '';
            pageURI = '/employee/add_experience';
            request_data = $('#frm_exp').serializeArray();
            mainAjax('frm_exp', request_data, 'POST',fillData);
        });
		function fillData(data){
            if(data.code==200){
                location.reload();
                
            }
        }
		
		 $('.edit_exp_link').click(function () {
          //  alert($(this).attr('tab_id'));
            pageURI = '/employee/edit_experience';
            request_data = {'exp_id':$(this).attr('tab_id')}
            mainAjax('frm_exp', request_data, 'POST',fillEditExp;
        });

        function fillEditExp(data){
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
	});
</script>