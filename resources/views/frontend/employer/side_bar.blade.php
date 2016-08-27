<div class="admin-sidebar">

	<?php

		?>
									<div class="admin-user-item for-employer">
										
										<div class="image" style="width: 239px;">
											<div class="">

												<div class="form-group bootstrap-fileinput-style-01">
													<!--                                           <label>Photo</label>
                                                     -->                                          <div class="file-input file-input-ajax-new"><div class="file-preview ">
															<div class=" file-drop-zone">
																<div>

																	<?php
																	// dd($userinfo->image);
																	//$user_image = "user_images/01.jpg";

																	if(isset($userinfo->image) && $userinfo->image!=''){
																		$user_image = "/user_images/".$userinfo->image;
																	}
																	?>

																	<?php if(empty($user_image)) {?>
																	<img id="employee_image_1" class="" alt="image" src="{{asset('assets/frontend/images/site/dummy-user.jpg')}}">
																	<?php
																	}else {
																	?>
																	<img id="employee_image_1" class="" alt="image" src="<?php echo $user_image;?>">
																	<?php
																	}
																	?>

																</div>

															</div>

															<div class="file-preview-status text-center text-success"></div>

														</div>
													</div>
													<div class="kv-upload-progress hide"></div>
													<div tabindex="500" class="btn btn-primary btn-file">
														<input type="file" name="form-register-photo" id="form-register-photo"></div>




												</div>

												<div id="img_upload" class="" style="display: none;"></div>
												<span class="font12 font-italic">** photo must not bigger than 250kb</span>


												<!--                                         <?php
												$user_image = "user_images/01.jpg";
												if(isset($userinfo->image) && $userinfo->image!=''){
													$user_image = "user_images/".$userinfo->image;
												}
												?>
														<img id="employee_image_2" src="<?php echo $user_image;?>" alt="image" class="" style="width:150px; height:150px;" /> -->

											</div>

										</div>
										
										<h4>Expedia</h4>
										
									</div>
									

									<ul class="admin-user-menu clearfix">
										<?php

											$home = '';
											$emp_active = '';
										if(Route::getCurrentRoute()->getPath()=='home'){
											$home= 'active';
										}
										if(Route::getCurrentRoute()->getPath()=='employer/password')
										{
											$emp_active = 'active';
										}
										?>
										<li class="<?php echo $home;?>">
											<a href="/home"><i class="fa fa-user"></i> Profile</a>
										</li>
										<li class="<?php echo $emp_active;?>">
											<a href="/employer/password"><i class="fa fa-key"></i> Change Password</a>
										</li>

									</ul>
									
								</div>
<style>

	.admin-sidebar{
		margin-bottom:1px;
	}
</style>

<script>

	$(document).ready(function () {

		$("#form-register-photo").fileinput({
			dropZoneTitle: '<i class="fa fa-photo"></i><span>Upload Photo</span>',
			uploadUrl: '/user/imageUpload?_token=' + $('meta[name="csrf-token"]').attr('content'),
			maxFileCount: 1,
			minFileCount: 1,
			uploadAsync: true,
			showUpload: true,
			showRemove: false,
			browseLabel: 'Browse',
			browseIcon: '',
			//removeLabel: 'Remove',
			removeLabel: false,
			removeIcon: '',
			uploadLabel: 'Upload',
			uploadIcon: '',
			autoReplace: true,
			showCaption: false,
			allowedFileTypes: ['image' ],
			allowedFileExtensions: ['jpg', 'gif', 'png', 'tiff'],
			initialPreview: [
				'<img src="{{asset('assets/frontend/images/man/01.jpg')}}" class="file-preview-image" alt="The Moon" title="The Moon">',
			],
			overwriteInitial: true,
			msgFilesTooLess:true,
			showPreview: false,
			//initialPreviewAsData: true
			elErrorContainer: '#kv-error-1'
		}).on('filebatchuploadsuccess', function(event, data, id, index) {

			console.log(data.jqXHR.responseJSON.code);
			if(data.jqXHR.responseJSON.code==200){
				$('#employee_image_1').attr('src',data.jqXHR.responseJSON.img);
				$('#employee_image_2').attr('src',data.jqXHR.responseJSON.img);
				$('#img_upload').addClass('msg_ok');
				$('#img_upload').show();
				$('#img_upload').html('Image uploaded successfully');
				$('#img_upload').fadeIn('slow');
				$('#img_upload').delay(2000).fadeOut();
			}else {
				$('#img_upload').addClass('msg_cancel');
				$('#img_upload').show();
				$('#img_upload').html('Invalid format please try again.');
				$('#img_upload').fadeIn('slow');
				$('#img_upload').delay(2000).fadeOut();
			}


		});


	});



</script>