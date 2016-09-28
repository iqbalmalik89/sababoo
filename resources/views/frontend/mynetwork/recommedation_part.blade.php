
<div class="GridLex-gap-15-wrappper">

    <div class="GridLex-grid-noGutter-equalHeight">

        <?php
        if(!isset($user_suggestion['data'])){?>
        <span style="margin: 0px 0px 0px 49px;"> Data not Found..</span>
        <?php  }
        else{
            foreach($user_suggestion['data'] as $suggestion){

         ?>

        <div class="GridLex-col-3_sm-4_xs-6_xss-12" >

            <div class="employee-grid-item" style="background-color: #FFF;">

                <a href="../<?php echo $suggestion->postal_code;?>" class="clearfix">

                    <div class="image clearfix">

                        <?php
                        // dd($userinfo->image);
                        //$user_image = "user_images/01.jpg";
                       // $user_image='';
                        if(isset($suggestion->image) && $suggestion->image!=''){
                            $user_image = "/user_images/".$suggestion->image;
                        }
                        ?>

                        <?php if(empty($user_image)) {?>
                        <img id="employee_image_1" class="img-circle" alt="image" src="{{asset('assets/frontend/images/site/dummy-user.jpg')}}">
                        <?php
                        }else {
                        ?>
                        <img id="employee_image_1" class="img-circle" alt="image" src="<?php echo $user_image;?>">
                        <?php
                        }
                        ?>


                    </div>

                    <div class="content">

                        <h4><?php echo $suggestion->first_name;?> <?php echo $suggestion->last_name;?> </h4>
                        <p class="location"><?php echo ($suggestion->email);?></p>

                        <h6 class="text-primary"><?php echo ucfirst($suggestion->role);?></h6>
                        <div data-toggle="modal" href="#recModal_<?php echo $suggestion->id;?>" class=" btn-primary" onclick="">
                            Recommend
                        </div>
                    </div>

                </a>

            </div>

        </div>


            <!-- Start Rec Modal -->
            <div id="recModal_<?php echo $suggestion->id;?>" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">

                <input type="hidden" name="rec_id" id="rec_id" value="<?php echo $suggestion->id;?>">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center">Write a recommendation</h4>
                </div>
                <div id="msg_recModal_<?php echo $suggestion->id; ?>"></div>


                <div class="modal-body">
                    <div class="row gap-20">


                        <div class="col-sm-12 col-md-12">

                            <div class="form-group">
                                <label>If needed, you can make changes or delete it even after you send it.</label>
                                <textarea class="form-control" name="message" id="message"></textarea>

                            </div>

                        </div>

                        <div class="col-sm-12 col-md-12">

                            <div class="form-group">
                                <label>What's your relationship?</label>
                                <select id="relationship" name="relationship" class="selectpicker show-tick form-control">
                                    <optgroup label="Professional">
                                        <option value="You managed  directly">You managed  directly</option>
                                        <option value="You reported directly">You reported directly </option>
                                        <option value="You were senior  but didn't manage directly">You were senior  but didn't manage directly</option>
                                        <option value="He was senior to you but didn't manage directly">He was senior to you but didn't manage directly</option>
                                        <option value="You worked in the same group">You worked in the same group</option>
                                        <option value="You worked  in different groups">You worked  in different groups</option>
                                        <option value="You worked  but at different companies">You worked  but at different companies</option>
                                        <option value="He was a client of yours">He was a client of yours</option>
                                        <option value="You were a client">You were a client</option>

                                    </optgroup>
                                    <optgroup label="Education">
                                        <option value="You were teacher">You were teacher</option>
                                        <option value="You were  mentor">You were  mentor</option>
                                        <option value="You were students together">You were students together</option>
                                    </optgroup>
                                </select>
                            </div>

                        </div>



                    </div>
                </div>

                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-primary" onclick="send_rec(<?php echo $suggestion->id;?>)">Send</button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
                </div>

            </div>

            <!-- End of Rec Modal -->

        <?php }} ?>


    </div>

</div>
</div>

