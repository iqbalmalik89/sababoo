
<div class="employee-detail-sidebar">
                                        
                                    <div class="section-title mb-30">
                                        <h2 class="text-left">your Information</h2>
                                    </div>

                                    <div class="">

                                        <?php
                                        $user_image = "user_images/01.jpg";
                                        if(isset($userinfo->image) && $userinfo->image!=''){
                                            $user_image = "user_images/".$userinfo->image;
                                        }
                                        ?>
                                        <img id="employee_image_2" src="<?php echo $user_image;?>" alt="image" class="" style="width:150px; height:150px;" />

                                    </div>
                                    
                                    <h3 class="heading mb-15"><?php if(isset($userinfo->first_name)){ echo $userinfo->first_name;}?> <?php if(isset($userinfo->last_name)){ echo $userinfo->last_name;}?></h3>
                                
                                    <p class="location"><i class="fa fa-map-marker"></i> <?php if(isset($userinfo->address)){ echo $userinfo->address;}?> <?php if(isset($userinfo->country)){ echo $userinfo->country;}?> <span class="block"><i class="fa fa-phone"></i> <?php if(isset($userinfo->phone)){ echo $userinfo->phone;}?></span></p>
                                    
                                    <ul class="meta-list clearfix">
                                        <li>
                                            <h4 class="heading">Birth Day::</h4>
                                            12/01/1991
                                        </li>

                                        <li>
                                            <h4 class="heading">People:</h4>
                                            00+
                                        </li>

                                        <li>
                                            <h4 class="heading">Email:</h4>
                                            <?php if(isset($userinfo->email)){ echo $userinfo->email;}?>
                                        </li>
                                        <li>
                                            <h4 class="heading">Introduce myself:</h4>

                                            <?php if(isset($employeeinfo[0]->summary)){ echo $employeeinfo[0]->summary;}?>

                                        </li>
                                    </ul>
                                    
                                    
                                    <a href="employer-edit.html" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5"></i>Edit</a>
                                    
                                </div>