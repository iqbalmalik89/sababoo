@extends('frontend.layouts.master')

@section('title', 'Job Post')

@section('content')
                 
<!-- start Main Wrapper -->
<div class="main-wrapper">  
        
<!-- start breadcrumb -->
<div class="breadcrumb-wrapper">

	<div class="container">
	
		<ol class="breadcrumb-list booking-step">
			<li><a href="">Home</a></li>
			<li><a href="">Your Admin</a></li>
			<li><span>Post a Job</span></li>
		</ol>
		
	</div>
	
</div>
			<!-- end breadcrumb -->
			
	<div class="section sm">
			
				<div class="container">
				
					<div class="row">
						
							<div class="col-sm-5 col-md-4">
							
								<div class="company-detail-sidebar">
										
									<div class="section-title mb-30">
										<h2 class="text-left">Company Information</h2>
									</div>
									
									<div class="image">
										<img src="images/brands/06.png" alt="image" />
									</div>
									
									<h2 class="heading mb-15">Expedia</h2>
								
									<p class="location"><i class="fa fa-map-marker"></i> 3150 139th Ave. SE Bellevue, WA 98005 USA <span class="block"><i class="fa fa-phone"></i> +66-5445-5420</span></p>
									
									<ul class="meta-list clearfix">
										<li>
											<h4 class="heading">Established In:</h4>
											1999
										</li>
										<li>
											<h4 class="heading">Type:</h4>
											Booking/Travel
										</li>
										<li>
											<h4 class="heading">People:</h4>
											2000+
										</li>
										<li>
											<h4 class="heading">Website: </h4>
											https://www.expedia.com/
										</li>
										<li>
											<h4 class="heading">Company background: </h4>
											<span class="font600">Expedia</span> is repulsive questions contented him few extensive supported. Of remarkably thoroughly he appearance in. Supposing tolerably applauded or of be. Suffering unfeeling so objection agreeable allowance me of. Ask within entire season sex common far who family... <a href="employer-detail.html">read full information</a>
										</li>
									</ul>
									
									
									<a href="employer-edit.html" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5"></i>Edit</a>
									
								</div>
					
					
							</div>
							
							<div class="col-sm-7 col-md-8">
							
								<div class="company-detail-wrapper">

									<div class="company-detail-company-overview  mt-0 clearfix">
										
										<div class="section-title-02">
											<h3 class="text-left">Post a Job</h3>
											<p>Oh to talking improve produce in limited offices fifteen an. Wicket branch to answer do we. Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
										</div>

										<form class="post-form-wrapper">
								
											<div class="row gap-20">
										
												<div class="col-sm-8 col-md-8">
												
													<div class="form-group">
														<label>Job Title</label>
														<input type="text" class="form-control">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-8 col-md-5">
												
													<div class="form-group">
														<label>Location</label>
														<input type="text" class="form-control">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-8 col-md-8">
												
													<div class="form-group">
														<label>Rate/Salary</label>
														
														<div class="row gap-20">
															<div class="col-sm-6">
																<div class="input-group">
																	<input type="text" class="form-control">
																	<span class="input-group-addon">$</span>
																</div>
															</div>
															<div class="col-sm-6">
															
																<div class="clearfix" style="margin-top: 2px;">
																
																	<div class="pull-left">
																		<div class="text-primary font600" style="margin-right: 15px; margin-top: 2px;">or</div>
																	</div>
																		<div class="pull-left">
																		<div class="radio-block" style="margin-top: 2px;">
																			<input id="radio_salary-1" name="radio_salary" type="radio" class="radio" />
																			<label for="radio_salary-1">Negotiable</label>
																		</div>
																	</div>
																
																</div>
																
															</div>
														</div>
														
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
												
													<div class="form-group mb-20">
														<label>Job Type:</label>
														<select class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="0" selected>Select</option>
															<option value="1" data-content="<span class='label label-warning'>Full-time</span>">Full-time</option>
															<option value="2" data-content="<span class='label label-danger'>Part-time</span>">Part-time</option>
															<option value="3" data-content="<span class='label label-success'>Freelance</span>">Freelance</option>
														</select>
													</div>
													
												</div>
												
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
												
													<div class="form-group mb-20">
														<label>Experience:</label>
														<select class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="0" selected >Select</option>
															<option value="1">Expert</option>
															<option value="2">2 Years</option>
															<option value="3">3 Years</option>
															<option value="4">4 Years</option>
															<option value="5">5 Years</option>
														</select>
													</div>
													
													
												</div>

												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Job Description</label>
														<textarea class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Job Responsibilies</label>
														<textarea class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Requirements</label>
														<textarea class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Tags</label>
														<input type="text" class="form-control" id="autocompleteTagging" value="red,green,blue" placeholder="tag to add?" />
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-11">

													<label class="mt-10">Checkbox Option</label>
													
													<p class="mb-10">On then sake home is am leaf. Of suspicion do departure at extremely he believing.</p>
											
													<div class="checkbox-block">
														<input id="checkbox_option-1" name="checkbox_option" type="checkbox" class="checkbox" checked />
														<label class="" for="checkbox_option-1">Checkbox Option One home </label>
													</div>
													<div class="checkbox-block">
														<input id="checkbox_option-2" name="checkbox_option" type="checkbox" class="checkbox"/>
														<label class="" for="checkbox_option-2">Checkbox Option Two</label>
													</div>
													<div class="checkbox-block">
														<input id="checkbox_option-3" name="checkbox_option" type="checkbox" class="checkbox"/>
														<label class="" for="checkbox_option-3">Checkbox Option Three</label>
													</div>
													<div class="checkbox-block">
														<input id="checkbox_option-4" name="checkbox_option" type="checkbox" class="checkbox"/>
														<label class="" for="checkbox_option-4">Checkbox Option Four</label>
													</div>
													
												</div>
												
												<div class="clear mb-10"></div>
												
												<div class="col-sm-11">
												
													<label class="mt-10">Radio Option</label>
													
													<p class="mb-10">Do know said mind do rent they oh hope of. General enquire picture letters garrets on offices.</p>
											
													<div class="radio-block">
														<input id="radio_option-1" name="radio_option" type="radio" class="radio" checked />
														<label for="radio_option-1">Radio Option One</label>
													</div>
													<div class="radio-block">
														<input id="radio_option-2" name="radio_option" type="radio" class="radio"/>
														<label for="radio_option-2">Radio Option Two</label>
													</div>
													<div class="radio-block">
														<input id="radio_option-3" name="radio_option" type="radio" class="radio"/>
														<label for="radio_option-3">Radio Option Three</label>
													</div>
													<div class="radio-block">
														<input id="radio_option-4" name="radio_option" type="radio" class="radio"/>
														<label for="radio_option-4">Radio Option Four</label>
													</div>
													
												</div>
												
												<div class="clear mb-15"></div>

												<div class="col-sm-6 bootstrap-fileinput-style-01 no-remove-at-beginning">
													<div class="form-group">
														<label for="form-photos">Photos</label>
														<input type="file" name="form-photos" multiple id="form-photos">
														<span class="font12 font-italic">** only jpg, png, tiff are allowed</span> 
													</div><!-- /.form-group-->
												</div><!-- /.col-* -->
												
												<div class="clear"></div>
												
												<div class="col-sm-6 mt-30">
													<a href="#" class="btn btn-primary btn-lg">Post Your Job</a>
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

@endsection

