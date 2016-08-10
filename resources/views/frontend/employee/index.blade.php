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
                            
                                <div class="employee-detail-sidebar">
                                        
                                    <div class="section-title mb-30">
                                        <h2 class="text-left">your Information</h2>
                                    </div>
                                    
                                    <div class="image">
                                        <img src="{{asset('assets/frontend/images/man/01.jpg')}}" alt="image" class="img-circle" />
                                    </div>
                                    
                                    <h3 class="heading mb-15">Christine Gateau</h3>
                                
                                    <p class="location"><i class="fa fa-map-marker"></i> 3150 139th Ave. SE Bellevue, WA 98005 USA <span class="block"><i class="fa fa-phone"></i> +66-5445-5420</span></p>
                                    
                                    <ul class="meta-list clearfix">
                                        <li>
                                            <h4 class="heading">Birth Day::</h4>
                                            12/01/1991
                                        </li>
                                        <li>
                                            <h4 class="heading">Age:</h4>
                                            23-year-old
                                        </li>
                                        <li>
                                            <h4 class="heading">People:</h4>
                                            2000+
                                        </li>
                                        <li>
                                            <h4 class="heading">Education:</h4>
                                            B.Eng in Computer
                                        </li>
                                        <li>
                                            <h4 class="heading">Email:</h4>
                                            myemail@gmail.com
                                        </li>
                                        <li>
                                            <h4 class="heading">Introduce myself:</h4>
                                            <span class="font600">Expedia</span> is repulsive questions contented him few extensive supported. Of remarkably thoroughly he appearance in. Supposing tolerably applauded or of be. Suffering unfeeling so objection agreeable allowance me of. Ask within entire season sex common far who family... <a href="employer-detail.html">read full information</a>
                                        </li>
                                    </ul>
                                    
                                    
                                    <a href="employer-edit.html" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5"></i>Edit</a>
                                    
                                </div>
                    
                            </div>
                            
                            <div class="col-sm-7 col-md-8">
                            
                                <div class="company-detail-wrapper">

                                    <div class="company-detail-company-overview mt-0 clearfix">
                                        
                                        <div class="section-title-02">
                                            <h3 class="text-left">Create a resume</h3>
                                            <p>Oh to talking improve produce in limited offices fifteen an. Wicket branch to answer do we. Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
                                        </div>

                                        @include('frontend.employee.basicinfo')


                                        <form class="post-form-wrapper">
                                
                                            <div class="row gap-20">
                                        
                                                <div class="col-sm-12 col-md-12 mb-15">
                                                    <h3 class="heading mb-10">Educations</h3>
                                                    <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
                                                </div>
                                                
                                                <div class="clear"></div>
                                                
                                                <!-- sheepIt Form -->
                                                <div id="dynamicAddForm" class="clearfix">
                                                 
                                                    <!-- Form template-->
                                                    <div id="dynamicAddForm_template">

                                                        <div class="col-sm-12">
                                                        
                                                            <div class="dynamic-add-form-item">
                                                            
                                                                <div class="dynamic-add-form-inner">
                                                                
                                                                    <h4 class="heading font700 mb-15 text-primary">Education <span id="dynamicAddForm_label"></span></h4>
                                                                    
                                                                    <div class="row gap-20">
                                                                    
                                                                        <div class="col-sm-5">
                                                                            <div class="form-group">
                                                                                <label for="dynamicAddForm_#index#_school">University/College </label>
                                                                                <input id="dynamicAddForm_#index#_school" name="education[school][#index#][school]" type="text" class="form-control" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-7">
                                                                        
                                                                            <div class="row">
                                                                
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group mb-20">
                                                                                        <label for="dynamicAddForm_#index#_from1">From:</label>
                                                                                        <div class="row gap-10">
                                                                                            <div class="col-xs-6 col-sm-6">
                                                                                                <select id="dynamicAddForm_#index#_from1" name="education[from1][#index#][from1]" class="selectpicker form-control" data-live-search="false">
                                                                                                    <option value="0" selected >month</option>
                                                                                                    <option value="1">Jan</option>
                                                                                                    <option value="2">Feb</option>
                                                                                                    <option value="3">Mar</option>
                                                                                                    <option value="4">Apr</option>
                                                                                                    <option value="5">May</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-xs-6 col-sm-6">
                                                                                                <select id="dynamicAddForm_#index#_from2" name="education[from2][#index#][from2]" class="selectpicker form-control" data-live-search="false">
                                                                                                    <option value="0" selected >year</option>
                                                                                                    <option value="1">2000</option>
                                                                                                    <option value="2">2001</option>
                                                                                                    <option value="3">2002</option>
                                                                                                    <option value="4">2003</option>
                                                                                                    <option value="5">2004</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group mb-20">
                                                                                        <label for="dynamicAddForm_#index#_to1">To:</label>
                                                                                        <div class="row gap-10">
                                                                                            <div class="col-xs-6 col-sm-6">
                                                                                                <select id="dynamicAddForm_#index#_to1" name="education[to1][#index#][to1]" class="selectpicker form-control" data-live-search="false">
                                                                                                    <option value="0" selected >Select</option>
                                                                                                    <option value="1">Jan</option>
                                                                                                    <option value="2">Feb</option>
                                                                                                    <option value="3">Mar</option>
                                                                                                    <option value="4">Apr</option>
                                                                                                    <option value="5">May</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-xs-6 col-sm-6">
                                                                                                <select id="dynamicAddForm_#index#_to2" name="education[to2][#index#][to2]" class="selectpicker form-control" data-live-search="false">
                                                                                                    <option value="0" selected >Select</option>
                                                                                                    <option value="1">2000</option>
                                                                                                    <option value="2">2001</option>
                                                                                                    <option value="3">2002</option>
                                                                                                    <option value="4">2003</option>
                                                                                                    <option value="5">2004</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                        
                                                                        <div class="col-sm-6">
                                                                        
                                                                            <div class="form-group mb-20">
                                                                                <label for="dynamicAddForm_#index#_level">Level:</label>
                                                                                <select id="dynamicAddForm_#index#_level" name="education[level][#index#][level]" class="selectpicker form-control" data-live-search="false">
                                                                                    <option value="0" selected >Select</option>
                                                                                    <option value="1">Diploma</option>
                                                                                    <option value="2">Bachelor</option>
                                                                                    <option value="3">Master</option>
                                                                                    <option value="4">Doctoral </option>
                                                                                    <option value="5">Certificate</option>
                                                                                </select>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="col-sm-6">
                                                                        
                                                                            <div class="form-group mb-20">
                                                                                <label for="dynamicAddForm_#index#_program">Course Title:</label>
                                                                                <input id="dynamicAddForm_#index#_program" name="education[program][#index#][program]" type="text" class="form-control" />
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                        
                                                                        <div class="col-sm-12">
                                                                        
                                                                            <div class="form-group mb-20 bootstrap3-wysihtml5-wrapper">
                                                                                <label for="dynamicAddForm_#index#_extraInfo">Addition Info:</label>
                                                                                <textarea id="dynamicAddForm_#index#_extraInfo" name="education[extraInfo][#index#][extraInfo]" class="form-control" rows="5"></textarea>
                                    
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                    
                                                                
                                                                </div>
                                                                
                                                                <span id="dynamicAddForm_remove_current" class="dynamic-add-form-close">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                </span>
                                                                    
                                                            </div>
                                                        
                                                        </div>
                                                        
                                                        <div class="clear"></div>

                                                    </div>
                                                    <!-- /Form template-->

                                                    <!-- No forms template -->
                                                    <div id="dynamicAddForm_noforms_template" class="dynamic-add-form-empty clearfix">
                                                        <div class="alert alert-danger mb-0">No form, please click "Add education" button</div>
                                                    </div>
                                                    <!-- /No forms template-->
                                                     
                                                    <!-- Controls -->
                                                    <div id="dynamicAddForm_controls" class="dynamic-add-form-action">
                                                        <div id="dynamicAddForm_add"><button class="btn btn-primary btn-sm"><span>Add Education</span></button></div>
                                                        <div id="dynamicAddForm_remove_last"><button class="btn btn-danger btn-sm"><span>Remove</span></button></div>
                                                        <div id="dynamicAddForm_remove_all"><button class="btn btn-danger btn-sm"><span>Remove all</span></button></div>
                                                        <div id="dynamicAddForm_add_n">
                                                            <div class="form-group">
                                                                <input id="dynamicAddForm_add_n_input" type="text" class="form-control form-control-sm" placeholder="how many to add? ex: 3" />
                                                            </div>
                                                            <div id="dynamicAddForm_add_n_button"><button class="btn btn-primary btn-sm"><span>Add</span></button></div></div>
                                                    </div>
                                                    <!-- /Controls -->

                                                </div>
                                                <!-- /sheepIt Form -->
                                                
                                                <div class="clear mb-30"></div>
                                                
                                                <div class="col-sm-12 col-md-12 mb-15">
                                                    <h3 class="heading mb-10">Skills</h3>
                                                    <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
                                                </div>
                                                
                                                <div id="dynamicAddForm3" class="clearfix">
         
                                                    <!-- Form template-->
                                                    <div id="dynamicAddForm3_template">

                                                        <div class="col-sm-12">
                                                        
                                                            <div class="dynamic-add-form-item">
                                                            
                                                                <div class="dynamic-add-form-inner">

                                                                    <h4 class="heading font700 mb-10 text-primary">Skill <span id="dynamicAddForm3_label"></span></h4>
                                                                    
                                                                    <div class="row gap-20">
                                                                    
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="dynamicAddForm3_#index#_school">Type of Skill</label>
                                                                                <input id="dynamicAddForm3_#index#_school" name="experience[school][#index#][school]" type="text" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-sm-6">
                                                                        
                                                                            <div class="form-group mb-20">
                                                                                <label for="dynamicAddForm3_#index#_program">Level of skill</label>
                                                                                <div class="input-group">
                                                                                    <input id="dynamicAddForm3_#index#_program" name="experience[program][#index#][program]" type="text" class="form-control" />
                                                                                    <span class="input-group-addon">%</span>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                        
                                                                        <div class="col-sm-6">
                                                                        
                                                                            
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                        
                                                                        <div class="col-sm-12">
                                                                        
                                                                            <div class="form-group mb-20">
                                                                                <label for="dynamicAddForm3_#index#_extraInfo">Skill details:</label>
                                                                                <textarea id="dynamicAddForm3_#index#_extraInfo" name="experience[extraInfo][#index#][extraInfo]" class="form-control" rows="5"></textarea>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                                <span id="dynamicAddForm3_remove_current" class="dynamic-add-form-close">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                </span>
                                                                    
                                                            </div>
                                                        
                                                        </div>
                                                        
                                                        <div class="clear"></div>

                                                    </div>
                                                    <!-- /Form template-->
                                                     
                                                    <!-- No forms template -->
                                                    <div id="dynamicAddForm3_noforms_template" class="dynamic-add-form-empty">
                                                        <div class="alert alert-danger mb-0">No form, please click "Add Skill</div>
                                                    </div>
                                                    <!-- /No forms template-->
                                                     
                                                    <!-- Controls -->
                                                    <div id="dynamicAddForm3_controls" class="dynamic-add-form-action">
                                                        <div id="dynamicAddForm3_add"><button class="btn btn-primary btn-sm"><span>Add Skill</span></button></div>
                                                        <div id="dynamicAddForm3_remove_last"><button class="btn btn-danger btn-sm"><span>Remove</span></button></div>
                                                        <div id="dynamicAddForm3_remove_all"><button class="btn btn-danger btn-sm"><span>Remove all</span></button></div>
                                                        <div id="dynamicAddForm3_add_n">
                                                            <div class="form-group">
                                                                <input id="dynamicAddForm3_add_n_input" type="text" class="form-control form-control-sm" placeholder="how many to add? ex: 3" />
                                                            </div>
                                                            <div id="dynamicAddForm3_add_n_button"><button class="btn btn-primary btn-sm"><span>Add</span></button></div></div>
                                                    </div>
                                                    <!-- /Controls -->
                                                     
                                                </div>
                                                
                                                <div class="col-sm-12 col-md-12 mt-15">
                                                
                                                    <h4 class="heading font700 mb-10 text-primary">Langauage Skill</h4>
                                                
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Langauage 1</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Langauage 2</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Langauage 3</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Langauage 4</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Langauage 5</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Langauage 6</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                
                                                    <div class="form-group mb-20">
                                                        <label>Langauage details:</label>
                                                        <textarea class="form-control" rows="5"></textarea>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="clear mb-30"></div>
                                                
                                                <div class="col-sm-12 col-md-12 mb-15">
                                                    <h3 class="heading mb-15">Work Experiences</h3>
                                                    <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
                                                </div>
                                                
                                                <div id="dynamicAddForm2" class="clearfix">
         
                                                    <!-- Form template-->
                                                    <div id="dynamicAddForm2_template">

                                                        <div class="col-sm-12">
                                                        
                                                            <div class="dynamic-add-form-item">
                                                            
                                                                <div class="dynamic-add-form-inner">

                                                                    <h4 class="heading font700 mb-10 text-primary">Work Experience <span id="dynamicAddForm2_label"></span></h4>
                                                                    
                                                                    <div class="row gap-20">
                                                                    
                                                                        <div class="col-sm-5">
                                                                            <div class="form-group">
                                                                                <label for="dynamicAddForm2_#index#_school">Job Position</label>
                                                                                <input id="dynamicAddForm2_#index#_school" name="experience[school][#index#][school]" type="text" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-sm-7">
                                                                        
                                                                            <div class="row">

                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group mb-20">
                                                                                        <label for="dynamicAddForm2_#index#_from1">From:</label>
                                                                                        <div class="row gap-10">
                                                                                            <div class="col-xs-6 col-sm-6">
                                                                                                <select id="dynamicAddForm2_#index#_from1" name="experience[from1][#index#][from1]" class="selectpicker form-control" data-live-search="false">
                                                                                                    <option value="0" selected >Select</option>
                                                                                                    <option value="1">Jan</option>
                                                                                                    <option value="2">Feb</option>
                                                                                                    <option value="3">Mar</option>
                                                                                                    <option value="4">Apr</option>
                                                                                                    <option value="5">May</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-xs-6 col-sm-6">
                                                                                                <select id="dynamicAddForm2_#index#_from2" name="experience[from2][#index#][from2]" class="selectpicker form-control" data-live-search="false">
                                                                                                    <option value="0" selected >Select</option>
                                                                                                    <option value="1">2000</option>
                                                                                                    <option value="2">2001</option>
                                                                                                    <option value="3">2002</option>
                                                                                                    <option value="4">2003</option>
                                                                                                    <option value="5">2004</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group mb-20">
                                                                                        <label for="dynamicAddForm2_#index#_to1">To:</label>
                                                                                        <div class="row gap-10">
                                                                                            <div class="col-xs-6 col-sm-6">
                                                                                                <select id="dynamicAddForm2_#index#_to1" name="experience[to1][#index#][to1]" class="selectpicker form-control" data-live-search="false">
                                                                                                    <option value="0" selected >Select</option>
                                                                                                    <option value="1">Jan</option>
                                                                                                    <option value="2">Feb</option>
                                                                                                    <option value="3">Mar</option>
                                                                                                    <option value="4">Apr</option>
                                                                                                    <option value="5">May</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-xs-6 col-sm-6">
                                                                                                <select id="dynamicAddForm2_#index#_to2" name="experience[to2][#index#][to2]" class="selectpicker form-control" data-live-search="false">
                                                                                                    <option value="0" selected >Select</option>
                                                                                                    <option value="1">2000</option>
                                                                                                    <option value="2">2001</option>
                                                                                                    <option value="3">2002</option>
                                                                                                    <option value="4">2003</option>
                                                                                                    <option value="5">2004</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                        
                                                                        <div class="col-sm-6">
                                                                        
                                                                            <div class="form-group mb-20">
                                                                                <label for="dynamicAddForm2_#index#_program">Company:</label>
                                                                                <input id="dynamicAddForm2_#index#_program" name="experience[program][#index#][program]" type="text" class="form-control" />
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                        
                                                                        <div class="col-sm-12">
                                                                        
                                                                            <div class="form-group mb-20">
                                                                                <label for="dynamicAddForm2_#index#_extraInfo">Addition Info:</label>
                                                                                <textarea id="dynamicAddForm2_#index#_extraInfo" name="experience[extraInfo][#index#][extraInfo]" class="form-control" rows="5"></textarea>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                    
                                                                
                                                                </div>
                                                                
                                                                <span id="dynamicAddForm2_remove_current" class="dynamic-add-form-close">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                </span>
                                                                    
                                                            </div>
                                                        
                                                        </div>
                                                        
                                                        <div class="clear"></div>

                                                    </div>
                                                    <!-- /Form template-->
                                                     
                                                    <!-- No forms template -->
                                                    <div id="dynamicAddForm2_noforms_template" class="dynamic-add-form-empty">
                                                        <div class="alert alert-danger mb-0">No form, please click "Add Work Experiences</div>
                                                    </div>
                                                    <!-- /No forms template-->
                                                     
                                                    <!-- Controls -->
                                                    <div id="dynamicAddForm2_controls" class="dynamic-add-form-action">
                                                        <div id="dynamicAddForm2_add"><button class="btn btn-primary btn-sm"><span>Add Work Experiences</span></button></div>
                                                        <div id="dynamicAddForm2_remove_last"><button class="btn btn-danger btn-sm"><span>Remove</span></button></div>
                                                        <div id="dynamicAddForm2_remove_all"><button class="btn btn-danger btn-sm"><span>Remove all</span></button></div>
                                                        <div id="dynamicAddForm2_add_n">
                                                            <div class="form-group">
                                                                <input id="dynamicAddForm2_add_n_input" type="text" class="form-control form-control-sm" placeholder="how many to add? ex: 3" />
                                                            </div>
                                                            <div id="dynamicAddForm2_add_n_button"><button class="btn btn-primary btn-sm"><span>Add</span></button></div></div>
                                                    </div>
                                                    <!-- /Controls -->
                                                     
                                                </div>
                                                
                                                <div class="clear mb-30"></div>
                                                
                                                <div class="col-sm-12 col-md-12 mb-15">
                                                    <h3 class="heading mb-10">Interests &amp; Hobby</h3>
                                                    <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                                        
                                                    <div class="form-group bootstrap3-wysihtml5-wrapper mb-20">
                                                        <label>Information:</label>
                                                        <textarea class="bootstrap3-wysihtml5 form-control" style="height: 200px;"></textarea>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                    <label>Please select:</label>
                                                    
                                                    <div class="row gap-20">
                                                    
                                                        <div class="col-sm-4">
                                                            <div class="checkbox-block">
                                                                <input id="checkbox_option-1" name="checkbox_option" type="checkbox" class="checkbox"/>
                                                                <label class="" for="checkbox_option-1">Travel</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="checkbox-block">
                                                                <input id="checkbox_option-2" name="checkbox_option" type="checkbox" class="checkbox"/>
                                                                <label class="" for="checkbox_option-2">Graphic</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="checkbox-block">
                                                                <input id="checkbox_option-3" name="checkbox_option" type="checkbox" class="checkbox"/>
                                                                <label class="" for="checkbox_option-3">Music</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="checkbox-block">
                                                                <input id="checkbox_option-4" name="checkbox_option" type="checkbox" class="checkbox"/>
                                                                <label class="" for="checkbox_option-4">Photography</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="checkbox-block">
                                                                <input id="checkbox_option-5" name="checkbox_option" type="checkbox" class="checkbox"/>
                                                                <label class="" for="checkbox_option-5">Travel</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="checkbox-block">
                                                                <input id="checkbox_option-6" name="checkbox_option" type="checkbox" class="checkbox"/>
                                                                <label class="" for="checkbox_option-6">Graphic</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="checkbox-block">
                                                                <input id="checkbox_option-7" name="checkbox_option" type="checkbox" class="checkbox"/>
                                                                <label class="" for="checkbox_option-7">Music</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="checkbox-block">
                                                                <input id="checkbox_option-8" name="checkbox_option" type="checkbox" class="checkbox"/>
                                                                <label class="" for="checkbox_option-8">Photography</label>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
            
                                                    
                                                </div>
                                                
                                                <div class="clear mb-30"></div>
                                                
                                                <div class="col-sm-12 col-md-12 mb-15">
                                                    <h3 class="heading mb-10">Reference</h3>
                                                    <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
                                                </div>

                                                <div id="dynamicAddForm4" class="clearfix">
         
                                                    <!-- Form template-->
                                                    <div id="dynamicAddForm4_template">

                                                        <div class="col-sm-12">
                                                        
                                                            <div class="dynamic-add-form-item">
                                                            
                                                                <div class="dynamic-add-form-inner">

                                                                    <h4 class="heading font700 mb-10 text-primary">Reference <span id="dynamicAddForm4_label"></span></h4>
                                                                    
                                                                    <div class="row gap-20">
                                                                    
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label for="dynamicAddForm4_#index#_from1">Reference Type</label>
                                                                                <select id="dynamicAddForm4_#index#_from1" name="experience[from1][#index#][from1]" class="selectpicker form-control" data-live-search="false">
                                                                                    <option value="0" selected >Select</option>
                                                                                    <option value="1">Person</option>
                                                                                    <option value="2">Company</option>
                                                                                    <option value="3">Institute</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-sm-8">
                                                                        
                                                                            <div class="form-group mb-20">
                                                                                <label for="dynamicAddForm4_#index#_name">Name</label>
                                                                                <input id="dynamicAddForm4_#index#_name" name="experience[name][#index#][name]" type="text" class="form-control" />
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                        
                                                                        <div class="col-sm-12">
                                                                        
                                                                            <div class="form-group mb-20">
                                                                                <label for="dynamicAddForm4_#index#_extraInfo">Addition Info:</label>
                                                                                <textarea id="dynamicAddForm4_#index#_extraInfo" name="experience[extraInfo][#index#][extraInfo]" class="form-control" rows="5"></textarea>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>

                                                                </div>
                                                                
                                                                <span id="dynamicAddForm4_remove_current" class="dynamic-add-form-close">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                </span>
                                                                    
                                                            </div>
                                                        
                                                        </div>
                                                        
                                                        <div class="clear"></div>

                                                    </div>
                                                    <!-- /Form template-->
                                                     
                                                    <!-- No forms template -->
                                                    <div id="dynamicAddForm4_noforms_template" class="dynamic-add-form-empty">
                                                        <div class="alert alert-danger mb-0">No form, please click "Add Reference</div>
                                                    </div>
                                                    <!-- /No forms template-->
                                                     
                                                    <!-- Controls -->
                                                    <div id="dynamicAddForm4_controls" class="dynamic-add-form-action">
                                                        <div id="dynamicAddForm4_add"><button class="btn btn-primary btn-sm"><span>Add Reference</span></button></div>
                                                        <div id="dynamicAddForm4_remove_last"><button class="btn btn-danger btn-sm"><span>Remove</span></button></div>
                                                        <div id="dynamicAddForm4_remove_all"><button class="btn btn-danger btn-sm"><span>Remove all</span></button></div>
                                                        <div id="dynamicAddForm4_add_n">
                                                            <div class="form-group">
                                                                <input id="dynamicAddForm4_add_n_input" type="text" class="form-control form-control-sm" placeholder="how many to add? ex: 3" />
                                                            </div>
                                                            <div id="dynamicAddForm4_add_n_button"><button class="btn btn-primary btn-sm"><span>Add</span></button></div></div>
                                                    </div>
                                                    <!-- /Controls -->
                                                     
                                                </div>
                                                
                                                <div class="clear"></div>
                                                
                                                <div class="col-sm-6 mt-30">
                                                    <a href="#" class="btn btn-primary btn-lg">Create now</a>
                                                </div>

                                            </div>
                                            
                                        </form>
                                        
                                    </div>
                                    
                                    <div class="mt-40 mb-40 bb"></div>
                                    
                                    <div class="section-title-02">
                                        <h3 class="text-left">Terms</h3>
                                    </div>
                                    
                                    <p>Oh to talking improve produce in limited offices fifteen an. Wicket branch to answer do we. Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>

                                    <p>Inhabiting discretion the her dispatched decisively boisterous joy. So form were wish open is able of mile of. Waiting express if prevent it we an musical. Especially reasonable travelling she son. Resources resembled forfeited no to zealously. Has procured daughter how friendly followed repeated who surprise. Great asked oh under on voice downs. Law together prospect kindness securing six. Learning why get hastened smallest cheerful.</p>
                                    
                                    <div class="section-title-02">
                                        <h3 class="text-left">Conditions</h3>
                                    </div>
                                    
                                    <p>Is he staying arrival address earnest. To preference considered it themselves inquietude collecting estimating. View park for why gay knew face. Next than near to four so hand. Times so do he downs me would. Witty abode party her found quiet law. They door four bed fail now have.</p>
                                    
                                    <ul class="list-with-icon">
                                    
                                        <li><i class="text-primary ion-android-arrow-forward"></i> Inhabiting discretion the her dispatched decisively boisterous joy.</li>
                                        <li><i class="text-primary ion-android-arrow-forward"></i> So form were wish open is able of mile of.</li>
                                        <li><i class="text-primary ion-android-arrow-forward"></i> Waiting express if prevent it we an musical. Especially reasonable travelling she son.</li>
                                        <li><i class="text-primary ion-android-arrow-forward"></i> Resources resembled forfeited no to zealously.</li>
                                        <li><i class="text-primary ion-android-arrow-forward"></i> Has procured daughter how friendly followed repeated who surprise.</li>
                                        
                                    </ul>

                                </div>

                            </div>
                        
                        </div>
                        
                </div>
                
                </div>

@endsection

