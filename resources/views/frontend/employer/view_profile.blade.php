<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 20/08/2016
 * Time: 1:33 PM
 */
?>
@extends('frontend.layouts.master')

@section('title', 'View Tradesman')

@section('content')
        <!-- start breadcrumb -->
<div class="breadcrumb-wrapper" xmlns="http://www.w3.org/1999/html">

    <div class="container">

        <ol class="breadcrumb-list booking-step">
            <li><a href="/home">Home</a></li>
            <li><a href="">Employer</a></li>
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
                        <h2 class="text-left">Company Information</h2>
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
                        <?php echo ucfirst($basic_emp_info->company_name);?>

                    </h3>

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



                </div>


            </div>

            <div class="col-sm-7 col-md-8">

                <div class="company-detail-wrapper">

                    <h3>Introduce Comapny</h3>


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




                    </div>


                </div>

            </div>

        </div>

    </div>

</div>



@endsection

