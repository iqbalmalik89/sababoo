<div class="col-sm-12 col-md-12 mb-15">
	<h3 class="heading mb-15">Work Experiences</h3>
<!-- 	<p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p> -->
<?php 		
$class = '';
if(count($exp) > 0){
	$class = 'work-expereince-wrapper';
	?> 
	<input type="button "class="btn btn-primary btn-sm" id="show_exp_pop" value="Add Experiences">
<?php } ?>
</div>

<div style="clear:both;"></div>
<br>
<div class="{{$class}}">

	<?php
		if(count($exp)<=0){?>

			<div id="experience_not_found" class="alert alert-info mt-30"> <strong>Work experience not found</strong> - <a href="javascript:void(0)" name="show_exp_pop" id="show_exp_pop" >Add Experience</a> </div>


	<?php } else{
		foreach($exp as $single_exp){
	?>

	<div class="work-expereince-block">

		<div class="work-expereince-content">
			<h5><?php echo $single_exp->job_position;?>&nbsp;&nbsp; <a href="#_" class="edit_exp_link" tab_id="<?php echo $single_exp->id;?>">Edit</a></h5>
			<p class="text-muted font-italic">

				<?php echo $single_exp->date_from;?> –
					<?php
						if($single_exp->current==1){
							echo "Present";
						}else{
							echo $single_exp->date_to;
						}
					?>
					at <span class="font600 text-primary"><?php echo $single_exp->company_name;?></span></p>
			<p><?php echo $single_exp->description;?></p>

		</div> <!-- work-expereince-content -->
	</div> <!-- work-expereince-block -->
	<?php } } ?>


</div>


<form id="frm_exp">


<div id="exp_pop" class="clearfix" style="display:none;" >
	<input type="hidden" id="employee_id" name="employee_id" value="<?php echo $employeeinfo[0]->id;?>">
	<input type="hidden" name="exp_id" id="exp_id">


	<!-- Form template-->
	<div id="">

	<div class="col-sm-12">

	<div class="dynamic-add-form-item">

	<div class="dynamic-add-form-inner">

<!-- 		<h4 class="heading font700 mb-10 text-primary">Work Experience <span id="dynamicAddForm2_label"></span></h4> -->

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

	<div class="col-sm-6" id="date_to_div">
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
		<label for="dynamicAddForm2_#index#_program">Company:</label>
		<input id="company_name" name="company_name" type="text" class="form-control" />
		</div>

	</div>


	<div class="col-sm-5">

			<div class="checkbox-block">
				<input  style="display:block;opacity:1;margin:5px 0px 0px 0px;" type="checkbox" name="current" id="current" value="1">

				<label class="" for="register_accept_checkbox">I currently working here</label>
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
			<input type="button" class="btn btn-primary btn-sm" id="add_exp" value="Save">

		</div>
	</div>
</div>
<!-- /Controls -->

</div>
 </form>

<style>

	input[type='radio'] + label:hover::before, input[type='checkbox'] + label:hover::before, input[type='radio']:checked + label:before, input[type='checkbox']:checked + label:before {
		color: #ffffff !important;
	}
</style>
<script>
    $(document).ready(function () {

        $('#show_exp_pop').click(function () {
			$('#exp_pop').show();
			$('#experience_not_found').hide();
		});

		$('#current').click(function () {
			if($('#current').is(':checked')){
				$('#date_to_div').hide();


			}else{
				$('#date_to_div').show();

			}
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
            mainAjax('frm_exp', request_data, 'POST',fillEditExp);
        });

        function fillEditExp(data){
			console.log(data);
           if(data.code=200){
               var date_from =data.data[0].year_from;
               $('#job_position').val(data.data[0].job_position);
				var date_from = data.data[0].date_from;
				var date_from_arr =  date_from.split("-");
			   $('#date_from_month option[value="' + date_from_arr[0] + '"]').prop('selected', true);
			   $('#date_from_year option[value="' + date_from_arr[1] + '"]').prop('selected', true);
			   if(data.data[0].current==1){
				   $('#current').prop('checked',true);
				   $('#date_to_div').hide();
			   }

			   var date_from = data.data[0].date_to;
			   var date_from_arr =  date_from.split("-");
			   $('#date_to_month option[value="' + date_from_arr[0] + '"]').prop('selected', true);
			   $('#date_to_year option[value="' + date_from_arr[1] + '"]').prop('selected', true);

			   $('#company_name').val(data.data[0].company_name);
               $('#additional_info').val(data.data[0].description);
               $('#exp_id').val(data.data[0].id);
               $('#add_exp').val('Update');
               $('#exp_pop').show();

           }
        }
	});
</script>