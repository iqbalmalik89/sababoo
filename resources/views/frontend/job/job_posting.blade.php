@extends('frontend.layouts.master')

@section('title', 'Job Post')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job')


@section('content')
<?php
    $isAdminUser = false;
    $adminUser = NULL;
    if (Auth::guard('admin_users')->user() != NULL) {
        $isAdminUser = true;
        $adminUser = Auth::guard('admin_users')->user();
    }
?>
		<!-- start Main Wrapper -->
<div class="main-wrapper">

	<!-- start breadcrumb -->
	<div class="breadcrumb-wrapper">

		<div class="container">

			<ol class="breadcrumb-list booking-step">
				<?php
                    if ($isAdminUser == false) {
                ?>
					<li><a href="/home">Home</a></li>
				<?php
					}
				?>
				<li><a href="/job">Job</a></li>
				<li><span>Post a Job</span></li>
			</ol>

		</div>

	</div>
	<!-- end breadcrumb -->

	<div class="section sm">

		<div class="container">

			<div class="row">



				<div class="col-sm-7 col-md-8">

					<div class="company-detail-wrapper">

						<div class="company-detail-company-overview  mt-0 clearfix">

							<div class="section-title-02">
								<h3 class="text-left">Post a Job</h3>
								<p>Oh to talking improve produce in limited offices fifteen an. Wicket branch to answer do we. Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
							</div>

							<form id="frm_job_post" class="post-form-wrapper">
								<input type="hidden" id="jobid" name="jobid" value="<?php if(isset($job_data->id)){echo $job_data->id;}?>">
								<div class="row gap-20">

									<div class="col-sm-8 col-md-8">

										<div class="form-group">
											<label>Job Title</label>
											<input id="title" name="title" type="text" class="form-control" value="<?php if(isset($job_data->name)){ echo $job_data->name;}?>">
										</div>

									</div>

									<div class="clear"></div>

									<div class="col-sm-8 col-md-5">

										<div class="form-group">
											<label>Location</label>
											<input id="location" name="location" type="text" class="form-control" value="<?php if(isset($job_data->location)){ echo $job_data->location;}?>">
										</div>

									</div>

									<div class="clear"></div>

									<div class="col-sm-8 col-md-8">

										<div class="form-group">
											<label>Rate/Salary</label>

											<div class="row gap-20">
												<div class="col-sm-6">
													<div class="input-group">
														<input id="salary" name="salary" type="text" class="form-control" value="<?php if(isset($job_data->salary)){ echo $job_data->salary;}?>">
														<span class="input-group-addon">$</span>
													</div>
												</div>
												<div class="col-sm-6">

													<div class="clearfix" style="margin-top: 2px;">



													</div>

												</div>
											</div>

										</div>

									</div>

									<div class="clear"></div>

									<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">

										<div class="form-group mb-20">
											<label>Job Type:</label>
											<select id="job_type" name="job_type"class="selectpicker show-tick form-control" data-live-search="false"  data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
												<option value="" selected>Select</option>
												<option value="full_time" data-content="<span class='label label-warning'>Full-time</span>">Full-time</option>
												<option value="part_time" data-content="<span class='label label-danger'>Part-time</span>">Part-time</option>
											</select>
										</div>

									</div>

									<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">

										<div class="form-group mb-20">
											<label>Experience:</label>
											<select name="experience" id="experience"class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
												<option value="0" selected >Select</option>
												<option value="1">1 Year</option>
												<option value="2">2 Years</option>
												<option value="3">3 Years</option>
												<option value="4">4 Years</option>
												<option value="5">5 Years</option>
												<option value="6">6 Years</option>
												<option value="7">7 Years</option>
												<option value="8">8 Years</option>
												<option value="9">9 Years</option>
												<option value="10">10 Years</option>

											</select>
										</div>


									</div>
									<div class="clear"></div>

									<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
										<label>Industry</label>
											<select id="industry" name="industry" class="selectpicker form-control" data-live-search="false" tabindex="-98">
												<option value="">Select</option>
												<?php foreach($industry as $key=>$value){?>
												<option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
												<?php }?>
											</select>

									</div>
									<div class="clear"></div>


									<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
										<label>Job Deadline</label>
										<div class="row gap-5">
											<div class="col-xs-3 col-sm-3">
												<div class="btn-group bootstrap-select form-control dropup">
													<select id="job_day" name="job_day" class="selectpicker form-control" data-live-search="false" tabindex="-98">
														<option value="" selected >Select</option>
														<?php
														foreach(range(1, 31) as $year)
														{
															echo '<option value="'.$year.'">'.$year.'</option>';
														}
														?>
													</select></div>
											</div>
											<div class="col-xs-5 col-sm-5">
												<div class="btn-group bootstrap-select form-control">
													<select name="job_month" id="job_month"class="selectpicker form-control" data-live-search="false" tabindex="-98">
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
													</select></div>
											</div>
											<div class="col-xs-4 col-sm-4">
												<div class="btn-group bootstrap-select form-control">
													<select id="job_year" name="job_year" class="selectpicker form-control" data-live-search="false" tabindex="-98">
														<option value="" selected >Select</option>
														<?php
														foreach(range(2000, 2042) as $year)
														{
															echo '<option value="'.$year.'">'.$year.'</option>';
														}
														?>
													</select></div>
											</div>
										</div>
									</div>

									<br>


									<div class="clear"></div>

									<div class="col-sm-12 col-md-12">

										<div class="form-group bootstrap3-wysihtml5-wrapper">
											<label>Job Description</label>
											<textarea name="description" id="description"class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"><?php if(isset($job_data->description)){ echo $job_data->description;}?></textarea>
										</div>

									</div>

									<div class="clear"></div>

									<div class="col-sm-12 col-md-12">

										<div class="form-group bootstrap3-wysihtml5-wrapper">
											<label>Job Responsibilies</label>
											<textarea name="responsibilites" id="responsibilites"class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"><?php if(isset($job_data->responsibilites)){ echo $job_data->responsibilites;}?></textarea>
										</div>

									</div>

									<div class="clear"></div>

									<div class="col-sm-12 col-md-12">

										<div class="form-group bootstrap3-wysihtml5-wrapper">
											<label>Requirements</label>
											<textarea name="requirement" id="requirement"class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"><?php if(isset($job_data->requirement)){ echo $job_data->requirement;}?></textarea>
										</div>

									</div>



									<div class="dynamic-add-form-inner">

										<h4 class="heading font700 mb-10 text-primary">Job Terms <span id="dynamicAddForm3_label"></span></h4>

										<div class="row gap-20">

											<div class="col-sm-6">
												<div class="form-group">
													<label for="all_skills">Type Terms</label>
													<input class="form-control" data-role="tagsinput" id="all_terms" name="all_terms" type="text" class="form-control" value="<?php if(isset($job_data->terms)){ echo $job_data->terms;}?>"/>
												</div>
											</div>


											<div class="clear"></div>
										</div>

									</div>


									<div class="clear"></div>



									<div id="msg_frm_job_post"></div>

									<div class="clear"></div>

									<div class="col-sm-6 mt-30">
										<?php
											$content = "Post Your Job";
											if(isset($job_data->id)){
												if ($isAdminUser == 1) {
													if($job_data->is_admin_job == 0){
														$content = "Update User Job";	
													} else {
														$content = "Update Your Job";	
													}
												} else {
													$content = "Update Your Job";	
												}
												
											}
										?>
										<a id="post_job" href="#_" class="btn btn-primary btn-lg"><?php echo $content;?></a>
									</div>

								</div>

							</form>

						</div>

						<div class="mt-50 mb-30 bb"></div>

						<div class="section-title-02">
							<h3 class="text-left">Terms</h3>
						</div>

						<p>Oh to talking improve produce in limited offices fifteen an. Wicket branch to answer do we. Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>

						<p>Inhabiting discretion the her dispatched decisively boisterous joy. So form were wish open is able of mile of. Waiting express if prevent it we an musical. Especially reasonable travelling she son. Resources resembled forfeited no to zealously. Has procured daughter how friendly followed repeated who surprise. Great asked oh under on voice downs. Law together prospect kindness securing six. Learning why get hastened smallest cheerful.</p>

						<div class="section-title-02">
							<h3 class="text-left">Conditions</h3>
						</div>

						<p>Is he staying arrival address earnest. To preference considered it themselves inquietude collecting estimating. View park for why gay knew face. Next than near to four so hand. Times so do he downs me would. Witty abode party her found quiet law. They door four bed fail now have.</p>

						<ul class="list-with-icon">

							<li><i class="text-primary ion-android-arrow-forward"></i> Inhabiting discretion the her dispatched decisively boisterous joy.</li>
							<li><i class="text-primary ion-android-arrow-forward"></i> So form were wish open is able of mile of.</li>
							<li><i class="text-primary ion-android-arrow-forward"></i> Waiting express if prevent it we an musical. Especially reasonable travelling she son.</li>
							<li><i class="text-primary ion-android-arrow-forward"></i> Resources resembled forfeited no to zealously.</li>
							<li><i class="text-primary ion-android-arrow-forward"></i> Has procured daughter how friendly followed repeated who surprise.</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<link href="{{asset('assets/frontend/css/bootstrap-tagsinput.css')}}" rel="stylesheet">


<script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap-tagsinput.js')}}"></script>

<script>

	var pageURI = '';
	var request_data = '';
	var isScrLock = false;
	var html = '';

	var job_type = '<?php echo isset($job_data->type)?$job_data->type:'';?>';
	var exp = '<?php echo isset($job_data->experience)?$job_data->experience:'';?>';
	var ind_id = '<?php echo isset($job_data->industry_id)?$job_data->industry_id:'';?>';

	<?php if(isset($job_data->job_deadline_date)){?>
	var daead_line_date = '<?php echo isset($job_data->job_deadline_date)?$job_data->job_deadline_date:'';?>';
	var dead_line_arr = daead_line_date.split('-');
	$('#job_day option[value="' + dead_line_arr[0] + '"]').prop('selected', true);
	$('#job_month option[value="' + dead_line_arr[1] + '"]').prop('selected', true);
	$('#job_year option[value="' + dead_line_arr[2] + '"]').prop('selected', true);


	<?php }?>
	$(document).ready(function () {
		$('#job_type option[value="' + job_type + '"]').prop('selected', true);
		$('#experience option[value="' + exp + '"]').prop('selected', true);
		$('#industry option[value="' + ind_id + '"]').prop('selected', true);

		$('#post_job').click(function () {
			$('.loader').show();
			html = '';
			pageURI = '/job/job_create';
			request_data = $('#frm_job_post').serializeArray();
			mainAjax('frm_job_post', request_data, 'POST', fillData);
		});
		function fillData(data){
			if(data.status == 'ok')
			{
				$('msg_frm_job_post').hide();
				$('#global_message').show().html(data.message).delay(4000).fadeOut();
				window.location = "/job/user_job_list";
			}
		}

			/*********Autocomplete***********/

			$("#all_terms").tagsinput('items')

			});

</script>
@endsection

