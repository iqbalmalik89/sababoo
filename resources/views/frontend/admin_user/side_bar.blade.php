
<div class="employee-detail-sidebar">

    <div class="section-title mb-30">
        <h2 class="text-left">{{ucfirst($userinfo->name)}} 


        </h2>
    </div>

    <div class="">

        <div class="form-group bootstrap-fileinput-style-01">
           <div class="file-input file-input-ajax-new"><div class="file-preview ">
                    <div class=" file-drop-zone">
                        <div>
                            <img id="employee_image_1" class="" alt="image" src="{{asset('assets/frontend/images/site/dummy-user.jpg')}}">
                           

                        </div>

                    </div>

                </div>
            </div>




        </div>



    </div>

    <h3 class="heading mb-15"><?php if(isset($userinfo->name)){ echo $userinfo->name;}?></h3>

    <ul class="meta-list clearfix">

        <li>
            <h4 class="heading">Email:</h4>
            <?php if(isset($userinfo->email)){ echo $userinfo->email;}?>
        </li>
        <li>
            <h4 class="heading">Role:</h4>
            <?php if(isset($userinfo->role_title)){ echo $userinfo->role_title;}?>
        </li>
    

    </ul>


    <!--                                     <a href="employer-edit.html" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5"></i>Edit</a> -->

</div>