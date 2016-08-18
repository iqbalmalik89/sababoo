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

                                @include('frontend.employee.side_bar',['userinfo'=>$userinfo,'employeeinfo'=>$employeeinfo,'industry'=>$industry])

                            </div>
                            
                            <div class="col-sm-7 col-md-8">
                            
                                <div class="company-detail-wrapper">

                                    <div class="company-detail-company-overview mt-0 clearfix">
                                        
                                        <div class="section-title-02">
                                            <h3 class="text-left">Create a resume</h3>
                                            <p>Oh to talking improve produce in limited offices fifteen an. Wicket branch to answer do we. Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
                                        </div>

                                        @include('frontend.employee.basicinfo',['userinfo'=>$userinfo,'employeeinfo'=>$employeeinfo,'industry'=>$industry])



                                
                                            <div class="row gap-20">

                                                <!-- sheepIt Form -->
                                                @include('frontend.employee.education',['employeeinfo'=>$employeeinfo,'education'=>$education])
                                                <!-- /sheepIt Form -->
                                                
                                                <div class="clear mb-30"></div>
                                                



                                                @include('frontend.employee.skills')

                                                @include('frontend.employee.languages')


                                                
                                                
                                                <div class="clear mb-30"></div>
                                                
                                                @include('frontend.employee.experience',['employeeinfo'=>$employeeinfo,'exp'=>$exp])
                                                
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
 <!--                                                
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
  -->                                               
<!--                                                 <div class="clear mb-30"></div> -->
                                                
<!--                                                 <div class="col-sm-12 col-md-12 mb-15">
                                                    <h3 class="heading mb-10">Reference</h3>
                                                    <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p>
                                                </div> -->

                                                <div id="dynamicAddForm4" class="clearfix">
         
                                                    <!-- Form template-->
<!--                                                     <div id="dynamicAddForm4_template">

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

                                                    </div> -->
                                                    <!-- /Form template-->
                                                     
                                                    <!-- No forms template -->
<!--                                                     <div id="dynamicAddForm4_noforms_template" class="dynamic-add-form-empty">
                                                        <div class="alert alert-danger mb-0">No form, please click "Add Reference</div>
                                                    </div> -->
                                                    <!-- /No forms template-->
                                                     
                                                    <!-- Controls -->
<!--                                                     <div id="dynamicAddForm4_controls" class="dynamic-add-form-action">
                                                        <div id="dynamicAddForm4_add"><button class="btn btn-primary btn-sm"><span>Add Reference</span></button></div>
                                                        <div id="dynamicAddForm4_remove_last"><button class="btn btn-danger btn-sm"><span>Remove</span></button></div>
                                                        <div id="dynamicAddForm4_remove_all"><button class="btn btn-danger btn-sm"><span>Remove all</span></button></div>
                                                        <div id="dynamicAddForm4_add_n">
                                                            <div class="form-group">
                                                                <input id="dynamicAddForm4_add_n_input" type="text" class="form-control form-control-sm" placeholder="how many to add? ex: 3" />
                                                            </div>
                                                            <div id="dynamicAddForm4_add_n_button"><button class="btn btn-primary btn-sm"><span>Add</span></button></div></div>
                                                    </div> -->
                                                    <!-- /Controls -->
                                                     
                                                </div>
                                                
                                                <div class="clear"></div>
                                                

                                            </div>
                                            

                                        
                                    </div>
                                    

                                </div>

                            </div>
                        
                        </div>
                        
                </div>
                
                </div>

@endsection

