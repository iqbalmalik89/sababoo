<?php

//  dd($basic_emp_info->resume_name);
if(count($user_files)>0){?>


    <div class="col-sm-12">

        <h3>User Files </h3>
        <ul class="employee-detail-list" id="education_detail">

        <?php foreach($user_files as $user_file){?>
        <div id="education_ist">


                <li>
                    <h5><a target="_blank" href="/user/download_files/<?php echo $user_file->id;?>"> <?php echo $user_file->title;?></a></h5>

                </li>

        </div>
       <?php } ?>
        </ul>
    </div>
<?php } ?>


