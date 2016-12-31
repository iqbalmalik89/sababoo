@extends('frontend.layouts.master')
@section('title', 'Job View')
@section('title', 'Job Browse')@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search')

@section('content')

<meta property="og:title" content="{{$job->name}}" />
<meta property="og:description" content="{{htmlentities($job->description)}}" />
<meta property="og:url" content="{{url('job/view/'.$job->id)}}" />

<meta name="twitter:site" content="@sababoo" />
<meta name="twitter:title" content="{{$job->name}}" />
<meta name="twitter:description" content="{{htmlentities($job->description)}}" />
<meta name="twitter:url" content="{{url('job/view/'.$job->id)}}" />

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<!-- start breadcrumb -->
	<div class="breadcrumb-wrapper">
	
		<div class="container">
		
			<ol class="breadcrumb-list booking-step">
				<li><a href="/home">Home</a></li>
        		<li><a href="/job/user_job_list">Job</a></li>
				<li><span>Job Details</span></li>
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
									<?php echo $job->salary; echo env('CURRENCY', '$')?>
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
								<h4><a data-toggle="modal" href="/send_message/<?php echo $user_array['userid'];?>" class=" btn btn-primary btn-hidden btn-small">Message</a>

								</h4>
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
							
							<div class="">
	                            <h3>Share now:</h3>
	                            <ul class="share-ul" style="margin-bottom:40px;">
	                                <li><a href="javascript:;" class="btn btn-fb" title="facebook"><i class="ri ri-facebook" data-title="{{$job->name}}" data-href="{{url('job/view/'.$job->id)}}"></i></a></li>
	                                <li><a href="https://twitter.com/intent/tweet?ref_src=twsrctfw&text=<?php echo $job->name;?>&tw_p=tweetbutton&url=<?php echo URL::to('job/view/'.$job->id);?>" class="btn btn-tw" title="twitter"><i class="ri ri-twitter"></i></a></li>
	                                <li><a href="javascript:;" data-href="<?php echo URL::to('job/view/'.$job->id); ?>" class="btn btn-gpluse"><i class="ri ri-google-plus" title="google+"></i></a></li>
	                                <li><a href="javascript:;" data-title="<?php  echo $job->name;?>" data-href="<?php echo URL::to('job/view/'.$job->id); ?>" class="btn btn-pint" title="pinterest"><i class="icon-social-pinterest"></i></a></li>
	                                <li><a href="javascript:;" data-href="<?php echo URL::to('job/view/'.$job->id); ?>" class="btn btn-linke"><i class="icon-social-linkedin" title="linkedin"></i></a></li>
	                            </ul>
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
								<div style="float: right; margin-top: -55px; margin-right: 4px;"><a href="{{url('job/news/'.$job->industry_id)}}" class=" btn btn-primary btn-hidden btn-small" target="_blank">View Latest News</a></div>
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

											<div class="bg-light padding-30" >
												
												<div class="alert" style="display:none;" id="msg_frm_job_apply"></div>
												<form id="jop_apply_form">
												

													<!-- <hr class="mt-15"> -->

													<div class="row">
													
														<div class="col-sm-12 col-md-12">
															<div class="form-group">
																<label>Your covering message for <?php echo ucfirst($job->name);?></label>
																<textarea class="form-control" rows="6" name="cover_message" id="cover_message"></textarea>
															</div>
														</div>
													</div>
													<div class="row margin-left-0px">
														<div class="form-group">
															<label>Your demanding cost?</label>

															<div class="row gap-20">
																<div class="col-sm-6">
																	<div class="input-group">
																		<input type="text" class="form-control" rows="6" name="extra_cost" id="extra_cost" value="">
																		<span class="input-group-addon">{{env('CURRENCY', '$')}}</span>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="clearfix" style="margin-top: 2px;">
																	</div>
																</div>
															</div>

														</div>


														<!-- <div class="col-sm-12 col-md-12 mb-15">
															<p class="mb-5">Effects present letters inquiry no an removed or friends?</p>
															<div class="radio-block">
																<input id="q1_radio-1" name="q1_radio" type="radio" class="radio" value="First Choice" style="display:block;opacity:1;"/>
																<label class="font13" for="q1_radio-1">Yes</label>
															</div>
															<div class="radio-block">
																<input id="q1_radio-2" name="q1_radio" type="radio" class="radio" value="Second Choice" style="display:block;opacity:1;"/>
																<label class="font13" for="q1_radio-2">no</label>
															</div>
														</div>
														
														<div class="col-sm-12 col-md-12 mb-15">
															<p class="mb-5">My possible peculiar together to. Desire so better am cannot he up before points. Remember mistaken opinions it pleasure of debating?</p>
															<div class="radio-block">
																<input id="q2_radio-1" name="q2_radio" type="radio" class="radio" value="First Choice" style="display:block;opacity:1;"/>
																<label class="font13" for="q2_radio-1">Yes</label>
															</div>
															<div class="radio-block">
																<input id="q2_radio-2" name="q2_radio" type="radio" class="radio" value="Second Choice" style="display:block;opacity:1;"/>
																<label class="font13" for="q2_radio-2">no</label>
															</div>
														</div>
														
														<div class="col-sm-12 col-md-12 mb-15">
															<p class="mb-5">Bringing so sociable felicity supplied mr. September suspicion far him two acuteness perfectly?</p>
															<div class="checkbox-block">
																<input id="q3_checkbox-1" name="q3_checkbox_1" type="checkbox" class="checkbox" value="First Choice" style="display:block;opacity:1;"/>
																<label class="font13" for="q3_checkbox-1">Assurance perpetual</label>
															</div>
															<div class="checkbox-block">
																<input id="q3_checkbox-2" name="q3_checkbox_2" type="checkbox" class="checkbox" value="Second Choice" style="display:block;opacity:1;"/>
																<label class="font13" for="q3_checkbox-2">Entire its the did figure</label>
															</div>
															<div class="checkbox-block">
																<input id="q3_checkbox-3" name="q3_checkbox_3" type="checkbox" class="checkbox" value="Third Choice" style="display:block;opacity:1;"/>
																<label class="font13" for="q3_checkbox-3">Shade being under his bed</label>
															</div>
															<div class="checkbox-block">
																<input id="q3_checkbox-4" name="q3_checkbox_4" type="checkbox" class="checkbox" value="Fourth Choice" style="display:block;opacity:1;"/>
																<label class="font13" for="q3_checkbox-4">Pleasant horrible but confined</label>
															</div>
														</div> -->
														
													</div>
													
													<!-- <hr class="mt-5">
													
													<div class="checkbox-block mb-15">
														<input id="newsletter_checkbox" name="newsletter_checkbox" type="checkbox" class="checkbox" value="First Choice" />
														<label class="" for="newsletter_checkbox">Email me jobs like this one when they become available</label>
													</div>
													
													<p class="font12 line16">Manor we shall merit by chief wound no or would. Oh towards between subject passage sending mention or it. Sight happy do burst fruit to woody begin at. <a href="#">Assurance perpetual</a> he in oh determine as. The year paid met him does eyes same. Own marianne improved sociable not out. Thing do sight blush mr an. Celebrated am announcing <a href="#">delightful remarkably</a> we in literature it solicitude. Design use say <a href="#">piqued any</a> gay supply. Front sex match vexed her those great.</p> -->
													
													<div class="checkbox-block">
														<input id="t_c_checkbox" name="t_c_checkbox" type="checkbox" class="checkbox" style="display:block;opacity:1;"/>
														<label class="font13" for="t_c_checkbox">Accept terms & conditions</label>
													</div>

														<input type="button" class="btn btn-primary pull-left" id="apply_for_job" value="Send Application" ></input>
														<img class="button_spinners margin-top-5px" style="display:none" src="{{URL::to('pannel/images/loader.gif')}}" id="submit_loader">
														
												</form>
											
											</div>
											
										</div>
						
										
									</div>
								
								</div>

							</div>

							@include('frontend.mynetwork.comments',['loged_user'=>$user,'job'=>$job,'comment_user'=>'','user_array'=>$user_array,'job_comments'=>$job_comments])

							
						</div>
						
					</div>
				<?php }// End of Else Condition ?>
				</div>
				
			</div>
		
		</div>
	
	</div>

<?php
$loged_user_image='';
if(isset($user->image) && $user->image!=''){
	$loged_user_image = "/user_images/".$user->image;
}
?>

<script>
	var user_name='<?php echo $user->first_name;?>';
	var user_id='<?php echo $user->id;?>';
	var user_image='<?php echo $loged_user_image;?>';
	var job_id='<?php echo $job->id;?>';

	$(document).ready(function () {

		//Facebook Share
		  window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '1770846929798101',
		      xfbml      : true,
		      version    : 'v2.7'
		    });
		      $('.ri-facebook').on('click', function(){
		        var href=$(this).attr('data-href');
		        var title=$(this).attr('data-title');
		        FB.ui({
		       method: 'share',
		       href: href,
		       title: title
		     }, function(response){

		     });
		       FB.getLoginStatus(function(response) {
		         if (response.status === 'connected') {
		         }
		         else {
		           //FB.login();
		         }
		       });
		    });
		  };

		  (function(d, s, id){
		     var js, fjs = d.getElementsByTagName(s)[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement(s); js.id = id;
		     js.src = "//connect.facebook.net/en_US/sdk.js";
		     fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));

		  //Twitter Share
		  window.twttr = (function(d, s, id) {
		  // for twitter code
		    var js, fjs = d.getElementsByTagName(s)[0],
		      t = window.twttr || {};
		    if (d.getElementById(id)) return t;
		    js = d.createElement(s);
		    js.id = id;
		    js.src = "https://platform.twitter.com/widgets.js";
		    fjs.parentNode.insertBefore(js, fjs);

		    t._e = [];
		    t.ready = function(f) {
		      t._e.push(f);
		    };

		    return t;
		  }(document, "script", "twitter-wjs"));

		  // Google Plus Sharing
		  $('.btn-gpluse').on('click', function(){
		        var href=$(this).attr('data-href');
		        window.open('https://plus.google.com/share?url='+encodeURIComponent(href),'Google plus','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600')

		  });

		  // Linkdin Sharing
		  $('.btn-linke').on('click', function(){
		        var href=$(this).attr('data-href');
		        window.open('https://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(href),'linkedin_share','menubar=1,resizable=1,width=600,height=600');

		  });

		  // Pinterest Pin it
		  $('.btn-pint').on('click', function(){

		        var href=$(this).attr('data-href');
		        var title=$(this).attr('data-title');
		        window.open('https://www.pinterest.com/pin/create/button/?url='+encodeURIComponent(href)+'&description='+title,'pinterest','menubar=1,resizable=1,width=600,height=600');
		  });
	
	});

	$('#apply_for_job').click(function(){
		apply_job();
	});
	function apply_job(){
		var message=$.trim($('#cover_message').val());
		var extra_cost=$.trim($('#extra_cost').val());
		var q1_answer=$("input[name=q1_radio]:checked").val();
		var q2_answer=$("input[name=q2_radio]:checked").val();
		var q3_checkbox_1=$("input[name=q3_checkbox_1]").prop('checked');
		var q3_checkbox_2=$("input[name=q3_checkbox_2]").prop('checked');
		var q3_checkbox_3=$("input[name=q3_checkbox_3]").prop('checked');
		var q3_checkbox_4=$("input[name=q3_checkbox_4]").prop('checked');
		var t_c_checkbox=$("input[name=t_c_checkbox]").prop('checked');

		var errors = [];
		if (message == ''){
			errors.push('Please enter cover message.');
			$('#cover_message').parent().addClass('has-error');
		} else {
			$('#cover_message').parent().removeClass('has-error');
		}

		if (extra_cost == ''){
			errors.push('Please enter cost.');
			$('#extra_cost').parent().addClass('has-error');
		} else {
			$('#extra_cost').parent().removeClass('has-error');
		}

		if (t_c_checkbox == false){
			errors.push('Please accept terms & conditions.');
		} 

		if(errors.length < 1){
			$('#cover_message').parent().addClass('has-error');
			html = '';
			pageURI = '/job/apply';
			request_data = {job_id:job_id, cover_message:message, q1_answer:q1_answer, q2_answer:q2_answer, q3_checkbox_1:q3_checkbox_1, q3_checkbox_2:q3_checkbox_2, q3_checkbox_3:q3_checkbox_3,  q3_checkbox_4:q3_checkbox_4, extra_cost:extra_cost}

			$('#submit_loader').show();
			mainAjax('', request_data, 'POST', fillForm);
			
			function fillForm(data){
				$('#submit_loader').hide();
				if(data.status == 'ok')
				{
					$('#msg_frm_job_apply').removeClass('alert-danger').addClass('alert-success').show().html(data.msg).delay(4000).fadeOut();
					window.location = "/job/view/"+job_id;
				}else if (data.status == 'error') {
					$('#msg_frm_job_apply').addClass('alert-danger').html(data.msg).show();
				}
			} 

		} else {
			$('#msg_frm_job_apply').addClass('alert-danger').html(errors[0]).show();
		}

	}

	function status_comment(jobid){
		var comment=$.trim($('#new_comment_add'+jobid).val());
		if(comment){

			html = '';
			pageURI = '/comments/add_comment';
			request_data = {jobid:jobid,comment:comment}
			mainAjax('', request_data, 'POST',fillData);

			pageURI = '/comments/send_comment_email';
			request_data = {jobid:jobid,comment:comment}
			mainAjax('', request_data, 'POST');

		}

	}

	function edit_comment(status_id,user_id,jobid){

		$('#liedit'+status_id).remove();
		$('#comments'+status_id).append("<li id='liedit"+status_id+"'><textarea id='editcomment"+status_id+"' style='height:150px;' class='form-control'>"+$('#comment_text'+status_id).text()+"</textarea><input type=button class=post-comment value=Update  onclick='update_comment("+status_id+','+jobid+")'></li>");
	}

	function update_comment(comment_id,jobid){

		var comment=$.trim($('#editcomment'+comment_id).val());
		if(comment){
			pageURI = '/comments/update_comment';
			request_data = {comment_id:comment_id,comment:comment}
			mainAjax('', request_data, 'POST',callUpdateComment);

			pageURI = '/comments/send_comment_email';
			request_data = {jobid:jobid,comment:comment}
			mainAjax('', request_data, 'POST');
		}

	}

	function callUpdateComment(data){
		if(data.code==200){
			console.log(data.data);
			$('#liedit'+data.data['id']).html('');
			$('#comment_text'+data.data['id']).html(data.data['comments']);
		}
	}
	function fillData(data){
		if(data.code==200){
			var currentTime = new Date()
			var hours = currentTime.getHours()
			var minutes = currentTime.getMinutes()
			var format ="AM";
			if(hours>11)
			{format="PM";}
			$('#new_comment_add'+data.data['job_id']).empty('');
			$('#new_comment_add'+data.data['job_id']).val('');
			$('#ulcomment'+data.data['job_id']).append("<li id=comments"+data.data['id']+"><a href=javascript:void(0) class=feed-action></a>" +
				"<img src='<?php echo $loged_user_image;?>' style='width:50px;height:50px'><p>" +
				"<a class='commenter' href='javascript:void(0)'>"+user_name+"</a>" +
				"<br><span id='comment_text"+data.data['id']+"'>"+data.data['comments']+"</span></p>"+
				"<span class=nus-timestamp'>"+hours+":"+minutes+" "+format+"</span>" +
				"<span class=nus-timestamp><a href=javascript:void(0) onclick=edit_comment("+data.data['id']+","+data.data['commenter_id']+","+data.data['job_id']+")>Edit</a></span>" +
				"&nbsp;<span class=nus-timestamp><a href=javascript:void(0) onclick=delete_comment("+data.data['id']+","+data.data['commenter_id']+")>Delete</a></span>" +
				"" + "</li>");




		}
	}

	function delete_comment(comment_id,user_id){
			$('#comments'+comment_id).remove();
			pageURI = '/comments/delete_comment';
			request_data = {comment_id:comment_id}
			mainAjax('', request_data, 'POST');
	}
</script>

@endsection

