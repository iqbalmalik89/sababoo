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
						<li><a href="">Job</a></li>
						<li><span>Browse Jobs</span></li>
					</ol>
					
				</div>
				
			</div>
			<!-- end breadcrumb -->
			
			<div class="section sm">
			
				<div class="container">
				
					<div class="row">

						<?php
							if($job==null){?>

							<div class="col-sm-5 col-md-4">Sorry. Job details not found...</div>

							<?php } else{ ?>
						
							<div class="col-sm-5 col-md-4">
							
								<div class="job-detail-sidebar">
									
									<ul class="meta-list clearfix">
										<?php if($job->location){?>
										<li>
											<h4 class="heading">Location:</h4>
											<?php echo $job->location;?>
										</li>
										<?php } ?>
										<?php if($job->salary){?>
										<li>
											<h4 class="heading">Rate/Salary:</h4>
											<?php echo $job->salary;?> $
										</li>
										<?php }?>

										<?php if($job->job_deadline_date){?>
										<li>
											<h4 class="heading">Posted:</h4>
											<?php echo $job->job_deadline_date;?>
										</li>
										<?php }?>
											<?php if($job->experience){?>
											<li>
												<h4 class="heading">Experience:</h4>
												<?php echo $job->experience;?> years
											</li>
											<?php }?>

											<?php if($job->terms){?>
											<li>
												<h4 class="heading">Expertise:</h4>
												<?php $jobs = explode(",",$job->terms);?>
												<div class="sub-category">
													<?php foreach($jobs as $job_term){

													?>

													<a href="#_"><?php echo ucfirst($job_term);?></a>

												<?php }?>
												</div>
											</li>
											<?php }?>

									</ul>
									
									<div class="job-detail-company-overview mt-15 clearfix">
									
										<h3>Employer overview</h3>
										<?php
										// dd($userinfo->image);
										//$user_image = "user_images/01.jpg";
										$user_image='';
										if(isset($user_array['image']) && $user_array['image']!=''){
											$user_image = "/user_images/".$user_array['image'];
										}
										?>
										<a href="../../<?php echo $user_array['url'];?>"> <div class="image">
											<?php if($user_image=='') {?>
											<img id="employee_image_1" class="" alt="image" src="{{asset('assets/frontend/images/site/dummy-user.jpg')}}">
											<?php
											}else {
											?>
											<img id="employee_image_1" class="" alt="image" src="<?php echo $user_image;?>">
											<?php
											}
											?>
										</div>
										
										<p><?php echo $user_array['desc'];?></p>
											</a>
									</div>
									
								</div>

							</div>
							
							<div class="col-sm-7 col-md-8">
							
								<div class="job-detail-wrapper">
								
									<div class="job-detail-header bb mb-30">
												
										<h2 class="heading mb-15"><?php echo ucfirst($job->name);?></h2>
									
										<div class="meta-div clearfix mb-25">
											<span>at <a href="#_"><?php echo $job->location;?></a> as </span>
											<span class="job-label label label-success"><?php echo $job->type;?></span>
										</div>
										
									</div>
									
									<div class="job-detail-content mt-30 clearfix">
											
										<h3>Job Description</h3>

										<p><?php echo $job->description;?></p>

										<h3>Job Responsibilies</h3>

										<p><?php echo $job->responsibilites;?></p>


										<h3>Requirements:</h3>

										<p><?php echo $job->requirement;?></p>

									</div>
									
									<div class="apply-job-wrapper">
								
										<button class="btn btn-primary btn-hidden btn-lg collapsed" data-toggle="collapse" data-target="#apply-job-toggle">Apply this job</button>
										
										<div id="apply-job-toggle" class="collapse">

											<div class="collapse-inner clearfix">
											
												<div class="apply-job-inner">
										
													<h3 class="heading mb-5">Apply for <?php echo ucfirst($job->name);?></h3>

													<div class="bg-light padding-30">
													
														<form>
														

															<hr class="mt-15">
															
															<div class="row">
															
																<div class="col-sm-12 col-md-6">
																	<div class="form-group">
																		<label>Your covering message for <?php echo ucfirst($job->name);?></label>
																		<textarea class="form-control" rows="6"></textarea>
																	</div>
																</div>
																
																<div class="col-sm-12 col-md-12 mb-15">
																	<p class="mb-5">Effects present letters inquiry no an removed or friends?</p>
																	<div class="radio-block">
																		<input id="q1_radio-1" name="q1_radio" type="radio" class="radio" value="First Choice" />
																		<label class="font13" for="q1_radio-1">Yes</label>
																	</div>
																	<div class="radio-block">
																		<input id="q1_radio-2" name="q1_radio" type="radio" class="radio" value="First Choice" />
																		<label class="font13" for="q1_radio-2">no</label>
																	</div>
																</div>
																
																<div class="col-sm-12 col-md-12 mb-15">
																	<p class="mb-5">My possible peculiar together to. Desire so better am cannot he up before points. Remember mistaken opinions it pleasure of debating?</p>
																	<div class="radio-block">
																		<input id="q2_radio-1" name="q2_radio" type="radio" class="radio" value="First Choice" />
																		<label class="font13" for="q2_radio-1">Yes</label>
																	</div>
																	<div class="radio-block">
																		<input id="q2_radio-2" name="q2_radio" type="radio" class="radio" value="First Choice" />
																		<label class="font13" for="q2_radio-2">no</label>
																	</div>
																</div>
																
																<div class="col-sm-12 col-md-12 mb-15">
																	<p class="mb-5">Bringing so sociable felicity supplied mr. September suspicion far him two acuteness perfectly?</p>
																	<div class="checkbox-block">
																		<input id="q3_checkbox-1" name="q3_checkbox" type="checkbox" class="checkbox" value="First Choice" />
																		<label class="font13" for="q3_checkbox-1">Assurance perpetual</label>
																	</div>
																	<div class="checkbox-block">
																		<input id="q3_checkbox-2" name="q3_checkbox" type="checkbox" class="checkbox" value="First Choice" />
																		<label class="font13" for="q3_checkbox-2">Entire its the did figure</label>
																	</div>
																	<div class="checkbox-block">
																		<input id="q3_checkbox-3" name="q3_checkbox" type="checkbox" class="checkbox" value="First Choice" />
																		<label class="font13" for="q3_checkbox-3">Shade being under his bed</label>
																	</div>
																	<div class="checkbox-block">
																		<input id="q3_checkbox-4" name="q3_checkbox" type="checkbox" class="checkbox" value="First Choice" />
																		<label class="font13" for="q3_checkbox-4">Pleasant horrible but confined</label>
																	</div>
																</div>
																
															</div>
															
															<hr class="mt-5">
															
															<div class="checkbox-block mb-15">
																<input id="newsletter_checkbox" name="newsletter_checkbox" type="checkbox" class="checkbox" value="First Choice" />
																<label class="" for="newsletter_checkbox">Email me jobs like this one when they become available</label>
															</div>
															
															<p class="font12 line16">Manor we shall merit by chief wound no or would. Oh towards between subject passage sending mention or it. Sight happy do burst fruit to woody begin at. <a href="#">Assurance perpetual</a> he in oh determine as. The year paid met him does eyes same. Own marianne improved sociable not out. Thing do sight blush mr an. Celebrated am announcing <a href="#">delightful remarkably</a> we in literature it solicitude. Design use say <a href="#">piqued any</a> gay supply. Front sex match vexed her those great.</p>
															
															<button class="btn btn-primary">Send Application</button>
															
														</form>
													
													</div>
													
												</div>
								
												
											</div>
										
										</div>

									</div>
									

									
								</div>
								
							</div>
						<?php }// End of Else Condition ?>
						</div>
						
					</div>
				
				</div>
			
			</div>

@endsection

