<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 20/08/2016
 * Time: 1:33 PM
 */
?>
@extends('frontend.layouts.master')

@section('title', 'View Profile')

@section('content')
  <!-- start breadcrumb -->
<div class="breadcrumb-wrapper" xmlns="http://www.w3.org/1999/html">

            <div class="container">

                <ol class="breadcrumb-list booking-step">
                    <li><a href="/home">Home</a></li>
                    <li><a href="">Employee</a></li>
                    <li><span>View Profile</span></li>
                </ol>

            </div>

        </div>
        <!-- end breadcrumb -->

        <div class="section sm">

            <div class="container">

                <div class="row">

                    <div class="col-sm-5 col-md-4">

                        <div class="employee-detail-sidebar">

                            <div class="section-title mb-30">
                                <h2 class="text-left">candidate Information</h2>
                            </div>

                            <div class="image">
                                <?php
                                 //dd($basic_user_info->image);
                                //$user_image = "user_images/01.jpg";

                                if(isset($basic_user_info->image) && $basic_user_info->image!=''){
                                    $user_image = "/user_images/".$basic_user_info->image;

                                }
                                ?>
                                <?php if(empty($user_image)) {?>
                                    <img id="employee_image_1"   class="img-circle" alt="image" src="{{asset('assets/frontend/images/site/dummy-user.jpg')}}">
                                <?php
                                }else {
                                ?>
                                    <img id="employee_image_1" class="img-circle" alt="image" src="<?php echo $user_image;?>">
                                <?php
                                }
                                ?>

                            </div>

                            <h3 class="heading mb-15">
                                <?php echo ucfirst($basic_user_info->first_name);?> <?php echo ucfirst($basic_user_info->last_name);?>

                            </h3>
                            <h4 class="heading mb-15">
                                <?php echo ucfirst($basic_emp_info->professional_heading);?>

                            </h4>

                            <p class="location">
                                <?php if($basic_user_info->country){?>
                                <i class="fa fa-map-marker"></i>
                                <?php echo ucfirst($basic_user_info->address);?>&nbsp;<?php echo ucfirst($basic_user_info->postal_code);?>&nbsp;<?php echo ucfirst($basic_user_info->country);?>
                                <?php }  if($basic_user_info->phone){?>
                                    <span class="block">
                                    <i class="fa fa-phone"></i> <?php echo ucfirst($basic_user_info->phone);?>
                                </span>
                                <?php } ?>
                            </p>

                            <ul class="meta-list clearfix">
                                <li>
                                    <h4 class="heading">Email:</h4>
                                   <?php echo  $basic_user_info->email;?>
                                </li>
                                <?php
                                     if($industry){?>
                                <li>
                                    <h4 class="heading">Industry:</h4>
                                    <?php echo  $industry->name;?>
                                </li>
                                <?php }?>
                            </ul>


                            <a href="/home" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5"></i>Edit</a>

                        </div>


                    </div>

                    <div class="col-sm-7 col-md-8">

                        <div class="company-detail-wrapper">

                            <h3>Introduce my self</h3>


                            <h4><?php echo $basic_emp_info->professional_heading;?></h4>
                            <p><?php echo $basic_emp_info->summary;?></p>

                            <div class="row">

                                <div class="col-sm-6">

                                    <h3>Education</h3>

                                    <div id="education_list">
                                        <?php if(count($education)<=0){?>


                                        <div id="education_not_found" class="alert alert-info mt-30"> <strong>Education not found</strong>  </div>
                                       <?php }else{ ?>
                                            <ul class="employee-detail-list" id="education_detail">

                                           <?php

                                                foreach($education as $single_edu){


                                        ?>


                                            <li>
                                                <h5><?php echo $single_edu->degree;?> ,<?php echo $single_edu->field_study;?> &nbsp; </h5>
                                                <p class="text-muted font-italic"><?php echo $single_edu->year_from;?> – <?php echo $single_edu->year_to;?> from <span class="font600 text-primary"><?php echo $single_edu->school_name;?></span></p>
                                                <p><?php echo $single_edu->description;?></p>
                                            </li>



                                        <?php } ?>
                                        </ul>
                                            <?php } ?>

                                    </div>


                                </div>

                                <div class="col-sm-6">

                                    <h3>Skill</h3>

                                    <?php

                                    if(count($skills)<=0){?>


                                    <div id="" class="alert alert-info mt-30"> <strong>Skills not found</strong>  </div>



                                    <?php } else { ?>
                                    <ul class="employee-detail-list">
                                        <?php

                                        foreach($skills as $skill){    ?>

                                        <li>
                                            <h5><?php echo $skill['label'];?></h5>

                                        </li>

                                    <?php }?>
                                    </ul>
                                    <?php }?>
                                </div>

                            </div>

                            <h3>Work Expeince</h3>
                            <?php

                            $class = '';
                            if(count($exp) > 0){
                            $class = 'work-expereince-wrapper';
                            ?>
                            <?php } ?>
                        </div>

                        <div style="clear:both;"></div>
                        <br>
                        <div class="{{$class}}">

                            <?php
                            if(count($exp)<=0){?>

                            <div id="experience_not_found" class="alert alert-info mt-30"> <strong>Work experience not found</strong> </div>


                            <?php } else{
                            foreach($exp as $single_exp){

                            ?>

                            <div class="work-expereince-block">

                                <div class="work-expereince-content">
                                    <h5><?php echo $single_exp->job_position;?></h5>
                                    <p class="text-muted font-italic">

                                        <?php echo $single_exp->date_from;?> –
                                        <?php
                                        if($single_exp->current==1){
                                            echo "Present";
                                        }else{
                                            echo $single_exp->date_to;
                                        }
                                        ?>
                                        at <span class="font600 text-primary"><?php echo $single_exp->company_name;?></span></p>
                                    <p><?php echo $single_exp->description;?></p>

                                </div> <!-- work-expereince-content -->
                            </div> <!-- work-expereince-block -->
                            <?php } } ?>


                        </div> <!-- work-expereince -->
                        <div class="col-sm-12">

                            <h3>Languages</h3>

                            <div id="education_ist">
                                <?php if(count($language['data'])<=0){?>


                                <div id="education_not_found" class="alert alert-info mt-30"> <strong>Languages not found</strong>  </div>
                                <?php }else{ ?>
                                <ul class="employee-detail-list" id="education_detail">

                                    <?php
                                         foreach($language['data'] as $single_lan){
                                    ?>
                                   <li>
                                        <h5><?php echo $single_lan['language'];?></h5>
                                        <p><?php echo $single_lan['proficiency'];?></p>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>

                            </div>


                        </div>



                        <h3>Interests &amp; Hobby</h3>

                            <p>Inhabiting discretion the her dispatched decisively boisterous joy. So form were wish open is able of mile of. Waiting express if prevent it we an musical. Especially reasonable travelling she son. Resources resembled forfeited no to zealously. Has procured daughter how friendly followed repeated who surprise. Great asked oh under on voice downs.</p>

                           <strong><?php echo $basic_emp_info->interests;?></strong>



                            <div class="clearfix text-center mt-40">
                                <a href="#" class="btn btn-primary btn-lg">Recruite Me</a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



@endsection

