<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 20/08/2016
 * Time: 1:33 PM
 */
?>
@extends('frontend.layouts.master')

@section('title', 'View '.ucfirst(env('EMPLOYER_TITLE')))
@section('description', 'Share your jobs with sababo,Sababoo is a job portal')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ')


@section('content')
        <!-- start breadcrumb -->
<div class="breadcrumb-wrapper" xmlns="http://www.w3.org/1999/html">

    <div class="container">

        <ol class="breadcrumb-list booking-step">
            <li><a href="/home">Home</a></li>
            <li><a href="">{{ucfirst(env('EMPLOYER_TITLE'))}}</a></li>
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
                        <h2 class="text-left">Company Name</h2>
                    </div>

                    <div class="image">
                        <?php
                        //dd($basic_user_info->image);
                        //$user_image = "user_images/01.jpg";

                        if (isset($basic_user_info->image) && $basic_user_info->image != '') {
                              $basic_user_info->image = url('user_images/'.$basic_user_info->image);
                          } else{
                              $basic_user_info->image = url('assets/frontend/images/site/dummy-user.jpg');
                          }

                        ?>
                        <img id="employee_image_1"   class="img-circle" alt="image" src="{{$basic_user_info->image}}">

                    </div>

                    <h3 class="heading mb-15">
                        <?php echo ucfirst($basic_emp_info->company_name);?>

                    </h3>

                    <p class="location">
                        <?php if($basic_user_info->country && $from == 'view'){?>
                        <i class="fa fa-map-marker"></i>
                        <?php echo ucfirst($basic_user_info->address);?>&nbsp;<?php echo ucfirst($basic_user_info->postal_code);?>&nbsp;<?php echo ucfirst($basic_user_info->country);?>
                        <?php }  if($basic_user_info->phone && $from == 'view'){?>
                        <span class="block">
                                    <i class="fa fa-phone"></i> <?php echo ucfirst($basic_user_info->phone);?>
                                </span>
                        <?php } ?>
                    </p>

                    <ul class="meta-list clearfix">
                        <?php 
                            if (isset($basic_user_info->email) && $from == 'view') {
                        ?>
                            <li>
                                <h4 class="heading">Email:</h4>
                               <?php echo  $basic_user_info->email;?>
                            </li>
                        <?php
                            }
                        ?>
                        <?php
                        if($industry){?>
                        <li>
                            <h4 class="heading">Industry:</h4>
                            <?php echo  $industry->name;?>
                        </li>
                        <?php }?>
                        <li>
                            <?php  if($logged_user->id != $basic_user_info->id){?>
                            <a data-toggle="modal" href="/send_message/<?php echo $basic_user_info->id;?>" class=" btn btn-primary btn-hidden btn-small">Message</a>
                            <?php }?>

                        </li>



                    </ul>



                </div>


            </div>

            <div class="col-sm-7 col-md-8">

                <div class="company-detail-wrapper">

                    <h3>Introduce Comapny</h3>


                    <?php
                        if ($basic_user_info->id == $logged_user->id) {
                    ?>
                        <div style="float: right; margin-top: -55px; margin-right: 4px;"><a href="{{url('home')}}" class=" btn btn-primary btn-hidden btn-small" target="_blank">Update Profile</a></div>
                    <?php
                        }
                    ?>
                    
                    <h4><?php echo $basic_emp_info->company_name;?> </h4>
                    <p><?php echo $basic_emp_info->description;?></p>

                    <div class="row">

                        <div class="col-sm-10">
                            <?php if($basic_emp_info->services){?>

                            <h3>Services</h3>


                            <strong><?php echo $basic_emp_info->services;?></strong>
                            <?php }?>

                        </div>

                        <div class="col-sm-10">
                            <?php if($basic_emp_info->expertise){?>

                            <h3>Expertise</h3>


                            <strong><?php echo $basic_emp_info->expertise;?></strong>
                            <?php }?>

                        </div>

                        <div class="col-sm-10">
                            <?php if($basic_emp_info->poeple){?>

                            <h3>Peoples</h3>


                            <strong><?php echo $basic_emp_info->poeple;?></strong>
                            <?php }?>

                        </div>
                        <div class="col-sm-10">
                            <?php if($basic_emp_info->website){?>

                            <h3>Website</h3>


                            <strong><?php echo $basic_emp_info->website;?></strong>
                            <?php }?>

                        </div>
                        <div class="col-sm-10">
                            <?php if($basic_emp_info->eastablish_in){?>

                            <h3>Establish In</h3>


                            <strong><?php echo $basic_emp_info->eastablish_in;?>+</strong>
                            <?php }?>

                        </div>



                        @include('frontend.employee.view_files',['user_files'=>$user_files])

                        <?php  if(count($recoms)>0){?>

                        <div class="col-sm-12">

                            <h3>Recommendations</h3>

                            <div id="education_ist">


                                <ul class="employee-detail-list" id="education_detail">

                                    <?php
                                    foreach($recoms as $recom){

                                    ?>
                                    <li>
                                        <h5> <?php echo ucfirst($recom->sender_id->first_name);?> <?php echo ucfirst($recom->sender_id->last_name);?></h5>
                                        <p class="text-muted font-italic"><?php echo ucfirst($recom->sender_id->role);?><br>
                                            &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $recom->message;?></p>
                                        <p> <?php echo date('M-d-Y',strtotime($recom->created_at)); ?> &nbsp; &nbsp;<?php echo ucfirst($recom->sender_id->first_name);?> <?php echo ucfirst($recom->sender_id->last_name);?> is <?php echo $recom->relationship;?></p>

                                    </li>
                                    <?php } ?>
                                </ul>

                            </div>


                        </div>
                        <?php } ?>




                    </div>


                </div>

            </div>

        </div>

    </div>

</div>



@endsection

