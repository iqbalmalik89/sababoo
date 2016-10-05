<div class="row">


    <div class="col-md-12">

        <div class="recent-job-wrapper alt-stripe mr-0">

            <?php

            if(count($all_jobs)<=0){
                echo "<div class='content' align='center'>Record Not Found</div>";

            }else{
            foreach($all_jobs as $my_job){
            ?>

            <a href="/job/view/<?php echo $my_job->id;?>" class="recent-job-item clearfix" id="row_<?php echo $my_job->id;?>" style="background-color: #FFF;">

                <div class="GridLex-grid-middle" >

                    <div class="GridLex-col-6_xs-12">

                        <div class="job-position">

                            <div class="content">

                                <h4> <?php echo ucwords($my_job->name);?></h4>
                                <p><?php echo $my_job->ind_name;?></p>
                            </div>
                        </div>
                    </div>
                    <div class="GridLex-col-4_xs-8_xss-12 mt-10-xss">
                        <div class="job-location">
                            <i class="fa fa-map-marker text-primary"></i> <?php echo ucwords($my_job->location);?>
                        </div>
                    </div>

                    <div class="GridLex-col-2_xs-4_xss-12">
                        <?php
                        $cls_labl = 'label-warning';
                        if($my_job->type=="full_time"){
                            $cls_labl = 'label-success';

                        }?>
                        <div class="job-label label <?php echo $cls_labl;?>">
                            <?php echo ucfirst($my_job->type);?>
                        </div>
                                        <span class="font12 block spacing1 font400 text-center"><?php
                                            if($my_job->created_at){
                                                echo "Posted at ".date('Y-m-d',strtotime($my_job->created_at));
                                            }?></span>

                    </div>

                </div>
            </a>
            <?php }}?>


            <div style="float:right"> @include('pagination.limit_links', ['paginator' => $all_jobs])</div>



        </div>

    </div>

</div>
