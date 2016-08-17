@extends('frontend.layouts.master')

@section('title', 'Employer')

@section('content')
	<!-- start breadcrumb -->
	<div class="breadcrumb-wrapper">

		<div class="container">

			<ol class="breadcrumb-list booking-step">
			<li><a href="">All Employers</a></li>
			<li><span>Expedia</span></li>
			</ol>

		</div>

	</div>
	<!-- end breadcrumb -->     
   <!-- start Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- start breadcrumb -->
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="">All Employers</a></li>
						<li><span>Expedia</span></li>
					</ol>
					
				</div>
				
			</div>
			<!-- end breadcrumb -->
			
			<div class="admin-container-wrapper">

				<div class="container">
				
					<div class="GridLex-gap-15-wrappper">
					
						<div class="GridLex-grid-noGutter-equalHeight">
						
							<div class="GridLex-col-3_sm-4_xs-12">
							
								   @include('frontend.employer.side_bar')


							</div>
							
							<div class="GridLex-col-9_sm-8_xs-12">
							
								<div class="admin-content-wrapper">

									<div class="admin-section-title">
									
										<h2>Profile</h2>
										<p>Enquire explain another he in brandon enjoyed be service.</p>
										
									</div>
									
									<form class="post-form-wrapper">
								
											<div class="row gap-20">
										
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group bootstrap-fileinput-style-01">
														<label for="form-register-photo-2">Photo</label>
														<input type="file" name="form-register-photo-2" id="form-register-photo-2">
														<span class="font12 font-italic">** photo must not bigger than 250kb</span>
													</div>
													
													
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-8">
												
													<div class="form-group">
														<label>Company Name:</label>
														<input type="text" class="form-control" value="Expedia">
													</div>
													
												</div>
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Established In:</label>
														<select class="selectpicker form-control" data-live-search="false">
															<option value="0">Year</option>
															<option value="1">1985</option>
															<option value="2" selected>1986</option>
															<option value="3">1987</option>
														</select>
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Type:</label>
														<select class="selectpicker form-control" data-live-search="false">
															<option value="0">Select</option>
															<option value="1">Finance</option>
															<option value="2" selected>Travel</option>
															<option value="3">Banking</option>
														</select>
													</div>
													
												</div>
												
												<div class="clear"></div>

												<div class="form-group">
													
													<div class="col-sm-6 col-md-4">
														<label>People:</label>
														<select class="selectpicker show-tick form-control mb-15" data-live-search="false">
															<option value="0">1-10</option>
															<option value="1">11-100</option>
															<option value="2" selected>200+</option>
															<option value="3">300+</option>
															<option value="4">1000+ </option>
														</select>
													</div>

													<div class="col-sm-6 col-md-4">
														<label>Website:</label>
														<input type="text" class="form-control" value="https://www.expedia.com/">
													</div>
														
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Address</label>
														<input type="text" class="form-control" value="254">
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>City/town</label>
														<input type="text" class="form-control" value="Somewhere ">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Province/State</label>
														<input type="text" class="form-control" value="Paris">
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Street</label>
														<input type="text" class="form-control" value="Somewhere ">
													</div>
													
												</div>

												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Zip Code</label>
														<input type="text" class="form-control" value="35214">
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Country</label>
														<select class="selectpicker show-tick form-control" data-live-search="false">
															<option value="0">Select</option>
															<option value="1">Thailand</option>
															<option value="2" selected>France</option>
															<option value="3">China</option>
															<option value="4">Malaysia </option>
															<option value="5">Italy</option>
														</select>
													</div>
													
												</div>

												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Phone Number</label>
														<input type="text" class="form-control" value="+66-85-221-5489">
													</div>
													
												</div>

												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Company background</label>
														<textarea class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Services</label>
														<textarea class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Expertise</label>
														<textarea class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>

												<div class="col-sm-12 mt-10">
													<a href="#" class="btn btn-primary">Save</a>
													<a href="#" class="btn btn-warning">Cancel</a>
												</div>

											</div>
											
										</form>
									
								</div>

							</div>
							
						</div>

					</div>

				</div>
			
			</div>

@endsection

