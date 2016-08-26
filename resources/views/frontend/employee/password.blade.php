<div class="col-sm-12 col-md-12 mb-15">
    <h3 class="heading mb-10">Password</h3>

    <!--     <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p> -->
</div>



<form class="post-form-wrapper" id="frm_password">

      <div class="row gap-20">
          <div class="col-sm-12 col-md-12 mb-15">
<!--               <h3 class="heading mb-10">Profile</h3>
              <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p> -->
          </div>
           <div class="clear"></div>
          <!-- sheepIt Form -->
          <div id="dynamicAddForm" class="clearfix">

              <!-- Form template-->
              <div id="dynamicAddForm_template">

                  <div class="col-sm-12">

                      <div class="">

                          <div class="dynamic-add-form-inner">

                              <div class="row gap-20">
                                  <div class="col-sm-6 col-md-4">
                                  </div>

                                  <div class="clear"></div>

								<input type="hidden" name="userid" id="userid" value="<?php echo $userinfo->id;?>">

                              <div class="col-sm-5">
                                      <div class="form-group">
                                          <label for="dynamicAddForm">Current Password </label>
                                          <input id="password" name="password" type="password" class="form-control" />
                                      </div>
                                  </div>
                                  <div class="col-sm-5">
                                      <div class="form-group">
                                          <label for="dynamicAddForm">New Password </label>
                                          <input id="new_password" name="new_password" type="password" class="form-control"  />
                                      </div>
                                  </div>
								  
								  <div class="col-sm-5">
                                      <div class="form-group">
                                          <label for="dynamicAddForm">Confrim Password </label>
                                          <input id="c_password" name="c_password" type="password" class="form-control"  />
                                      </div>
                                  </div>

                                
                                
                                  <div class="clear"></div>
      
                              </div>

                          </div>

                      </div>

                  </div>

              </div>
              <!-- /Form template-->
              <div class="clear"></div>
              <!-- No forms template -->
<!--               <div id="msg_frm_basic_info" class="dynamic-add-form-empty clearfix"> -->

              </div>
              <!-- /No forms template-->
                <div id="msg_frm_password"></div>
              <!-- Controls -->
              <div id="dynamicAddForm_controls" class="dynamic-add-form-action">
                  <div id="dynamicAddForm_add">
                      <input class="btn btn-primary btn-sm" type="button" name="update" id="update_password" value="Update ">
                     </div>
              </div>
              <!-- /Controls -->

          </div>
      </div>

  </form>
  <div class="clear"></div>


  <script>
      var pageURI = '';
      var request_data = '';
      var isScrLock = false;
      var html = '';

    
	$(document).ready(function () {

		$('#update_password').click(function () {
			$('.loader').show();
			html = '';
			pageURI = '/user/password_update';
			request_data = $('#frm_password').serializeArray();
			mainAjax('frm_password', request_data, 'POST',fillData);
		});

		function fillData(data){
			if(data.status == 'ok'){
                $('#password').val('');
                $('#new_password').val('');
                $('#c_password').val('');
                $('#msg_frm_password').hide();
				$('#global_message').show().html(data.message).delay(4000).fadeOut();
			}            
		}

	});
         

  </script>