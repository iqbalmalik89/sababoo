
<div class="employee-detail-sidebar">
                                        
                                    <div class="section-title mb-30">
                                        <h2 class="text-left">{{ucfirst($userinfo->first_name)}} {{ucfirst($userinfo->last_name)}}


                                        </h2>
                                        <a href="/employee/view/<?php echo $employeeinfo[0]->id;?>">View Profile</a>
                                    </div>

                                    <div class="">

                                       <div class="form-group bootstrap-fileinput-style-01">
<!--                                           <label>Photo</label>
 -->                                          <div class="file-input file-input-ajax-new"><div class="file-preview ">
                                                  <div class=" file-drop-zone">
                                                      <div>

                                                          <?php
                                                             // dd($userinfo->image);
                                                             //$user_image = "user_images/01.jpg";

                                                              if (isset($userinfo->image) && $userinfo->image != '') {
                                                                  $userinfo->image = url('user_images/'.$userinfo->image);
                                                              } else{
                                                                  $userinfo->image = url('assets/frontend/images/site/dummy-user.jpg');
                                                              }
                                                          ?>
                                                           <img id="employee_image_1" class="" alt="image" src="{{$userinfo->image}}">
                                          
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
                                    
                                    <h3 class="heading mb-15"><?php if(isset($userinfo->first_name)){ echo $userinfo->first_name;}?> <?php if(isset($userinfo->last_name)){ echo $userinfo->last_name;}?></h3>

                                    <p class="location"> <?php if(!empty($userinfo->address)){ echo '<i class="fa fa-map-marker"></i>'.$userinfo->address;}?> <?php if(isset($userinfo->country)){ echo $userinfo->country;}?>  <?php if(!empty($userinfo->phone)){ echo '<span class="block"><i class="fa fa-phone"></i>'.$userinfo->phone.'</span>';}?></p>
                                    
                                    <ul class="meta-list clearfix">
                                      <li>
                                          <h4 class="heading">Current Location:</h4>
                                          <?php echo  (isset($userinfo->current_location) && $userinfo->current_location != '')?$userinfo->current_location:'N/A';?>
                                      </li>

                                      <li>
                                          <h4 class="heading">Gender:</h4>
                                          <?php echo  (isset($userinfo->gender) && $userinfo->gender != '')?$userinfo->gender:'N/A';?>
                                      </li>
                                      <li>
                                          <h4 class="heading">Date of Birth:</h4>
                                          <?php echo  (isset($userinfo->dob) && $userinfo->dob != '')?date('d M, Y', strtotime($userinfo->dob)):'N/A';?>
                                      </li>
                                     


                                        <li>
                                            <h4 class="heading">Email:</h4>
                                            <?php if(isset($userinfo->email)){ echo $userinfo->email;}?>
                                        </li>
                                        <?php
                                        if(!empty($employeeinfo[0]->summary)){
                                        ?>
                                        <li>
                                            <h4 class="heading">Introduce myself:</h4>

                                            <?php if(isset($employeeinfo[0]->summary)){ echo $employeeinfo[0]->summary;}?>

                                        </li>

                                        <?php } ?>
                                    </ul>
                                    
                                    
<!--                                     <a href="employer-edit.html" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5"></i>Edit</a> -->
                                    
                                </div>