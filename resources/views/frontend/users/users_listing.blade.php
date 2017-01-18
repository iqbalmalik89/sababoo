@extends('frontend.layouts.master')

@section('title', 'Users')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing')


@section('content')

<?php
    $isAdminUser = false;
    $adminUser = NULL;
    $roleOperations = [];
    if (Auth::user() != NULL) {
        $adminUser = Auth::user();
        if ($adminUser->is_admin == 1) {
            $isAdminUser = true;
        
            $roleRepo = app()->make('RoleRepository');
            $roleOperations = $roleRepo->getRoleOperations($adminUser->role_id);
        }
        
    }
?>

        <!-- start Main Wrapper -->
<div class="main-wrapper">

    <!-- start breadcrumb -->
    <div class="breadcrumb-wrapper">

        <div class="container">

            <ol class="breadcrumb-list booking-step">
                
                <li><a href="/home">Home</a></li>
                <li><a href="/user/list_users">Users</a></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">
        <div class="second-search-result-wrapper">

            <div class="container">

                <form action="/user/list_users" method="post">

                    <div class="second-search-result-inner">
                        <span class="labeling">Search a user</span>
                        <div class="row">

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="name" name="name" type="text" class="form-control" placeholder="User Name. Ex: Med Bangs">
                                </div>
                            </div>

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">
                                    <input id="email" name="email" type="text" class="form-control" placeholder="Email. Ex: med@outlook.com">
                                </div>
                            </div>

                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                                <div class="form-group form-lg">


                                        <select name="role" id="role"class=" form-control">
                                            <option value="">Select Role</option>
                                            <option value="employee">{{env('EMPLOYEE_TITLE')}}</option>
                                            <option value="employer">{{env('EMPLOYER_TITLE')}}</option>
                                            <option value="tradesman">{{env('TRADESMAN_TITLE')}}</option>
                                        </select>



                                </div>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">


                            <div class="col-xss-12 col-xs-6 col-sm-4 col-md-2">
                                <button class="btn btn-block" id="search_it">Search</button>
                            </div>

                        </div>
                    </div>

                </form>



            </div>

        </div>
        <div class="bg-light pt-80 pb-80">


            <div class="container">


                <div class="row">

                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

                        <div class="section-title">

                            <h2>Users</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="recent-job-wrapper alt-stripe mr-0">


                            <?php

                                if(count($users)<=0){
                                    echo "<div class='content' align='center'>Record Not Found</div>";

                                }else{
                                foreach($users as $user){
                            ?>

                            <a href="#_" class="recent-job-item clearfix" id="row_<?php echo $user->id;?>">

                                <div class="GridLex-grid-middle">

                                    <div class="col-24">

                                                <h4> <?php echo $user->first_name.' '.$user->last_name;?></h4>
                                    </div>
                                    <div class="col-24"> <?php echo $user->email;?>
                                    </div>

                                    <div class="col-24"> <?php 
                                            if ($user->role == 'employee') {
                                                echo ucfirst(env('EMPLOYEE_TITLE'));
                                            } else if ($user->role == 'employer') {
                                                echo ucfirst(env('EMPLOYER_TITLE'));
                                            } else if ($user->role == 'tradesman') {
                                                echo ucfirst(env('TRADESMAN_TITLE'));
                                            } else {
                                                echo ucfirst($user->role);
                                            }


                                    ?>
                                    </div>

                                    <div class="" >
                                    

                                    <span onclick="viewUser(<?php echo $user->id;?>)">View Profile</span>
                                    </div>


                                </div>
                            </a>
                            <?php }}?>


                               <div style="float:right"> @include('pagination.limit_links', ['paginator' => $users])</div>



                        </div>

                    </div>

                </div>

            </div>

        </div>

</div>

<script>

    var pageURI = '';
    var request_data = '';
    var isScrLock = false;
    var html = '';

    function viewUser (userId){
        window.location = "/user/view-profile/"+userId;
    }

    $(document).ready(function () {

    });

</script>
@endsection

