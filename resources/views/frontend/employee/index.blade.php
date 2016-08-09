@extends('frontend.layouts.master')

@section('title', 'Employee')

@section('content')
                 
<!-- start Main Wrapper -->
        <div class="main-wrapper">
        
            <!-- start breadcrumb -->
            <div class="breadcrumb-wrapper">
            
                <div class="container">
                
                    <ol class="breadcrumb-list booking-step">
                        <li><a href="">Home</a></li>
                        <li><a href="">Your Admin</a></li>
                        <li><span>Post a Job</span></li>
                    </ol>
                    
                </div>
                
            </div>
            <!-- end breadcrumb -->
            
            <div class="section sm">
            
                <div class="container">
                
                    <div class="row">
                        
                            <div class="col-sm-5 col-md-4">
                            
                                @include('frontend.employee.side_bar')

                    
                            </div>
                            
                             @include('frontend.employee.basicinfo')
                             @include('frontend.employee.education')
                        
                        </div>
                        
                </div>
                
                </div>

@endsection

