
<div class="comments" >


    <ul id="ulcomment<?php echo $job->id;?>" class="">

        <?php
            if(!empty($job_comments)){
            foreach($job_comments as $job_comment){
        ?>

        <li id="comments<?php echo $job_comment->id;?>">
            <a href="javascript:void(0)" class="feed-action"></a>
            <?php
            $commenter_image='';
            if(isset($job_comment->image) && $job_comment->image!=''){
                $commenter_image = "/user_images/".$job_comment->image;
            }
            ?>
            <?php if($commenter_image=='') {?>
            <img id="" class="" alt="image" src="{{asset('assets/frontend/images/site/dummy-user.jpg')}}" style="width:50px;height: 50px;">
            <?php
            }else {
            ?>
            <img id="" class="" alt="image" src="<?php echo $commenter_image;?>" style="width:50px;height: 50px;">
            <?php
            }
            ?>
            <p>
                <a class="commenter" href="javascript:void(0)"><?php echo $job_comment->name;;?></a>

            <br>
                <span id="comment_text<?php echo $job_comment->id;?>"><?php echo $job_comment->comments;?></span>
                <br>
                <span class="nus-timestamp">
                     <span class="nus-timestamp"><?php echo $job_comment->updated_at;?></span>
                        <?php if($loged_user->id==$job_comment->commenter_id){?>
                        <a href="javascript:void(0)" onclick=edit_comment("<?php echo $job_comment->id;?>","<?php echo $job_comment->userid;?>","<?php echo $job->id;?>")>Edit</a></span>
                        <a href="javascript:void(0)" onclick=delete_comment("<?php echo $job_comment->id;?>","<?php echo $job_comment->userid;?>")>Delete</a></span>
                    <?php }?>
            </p>

        </li>

        <?php
            }}
        ?>
    </ul>

    <ul>

        <li id="user_add_comment" style="" >
            <textarea    style="height: 200px; " class="form-control" placeholder="Add Comment ......." id="new_comment_add<?php echo $job->id;?>" ></textarea>
            <input type="button" class="post-comment" value="Submit" onclick="status_comment('<?php echo $job->id;?>')">

        </li>
    </ul>
</div>