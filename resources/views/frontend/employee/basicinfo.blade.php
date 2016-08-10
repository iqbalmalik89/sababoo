  <form class="post-form-wrapper">
      <div class="row gap-20">
          <div class="col-sm-12 col-md-12 mb-15">
              <h3 class="heading mb-10">Profile</h3>
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

                              <h4 class="heading font700 mb-15 text-primary">Profile  <span id="dynamicAddForm_label"></span></h4>

                              <div class="row gap-20">

                                  <div class="col-sm-5">
                                      <div class="form-group">
                                          <label for="dynamicAddForm">First Name </label>
                                          <input id="dynamicAddForm_#index#_school" name="first_name" type="text" class="form-control" />
                                      </div>
                                  </div>
                                  <div class="col-sm-5">
                                      <div class="form-group">
                                          <label for="dynamicAddForm">Last Name </label>
                                          <input id="dynamicAddForm_#index#_school" name="last_name" type="text" class="form-control" />
                                      </div>
                                  </div>

                                  <div class="clear"></div>

                                  <div class="col-sm-6">

                                      <div class="form-group mb-20">
                                          <label for="dynamicAddForm_#index#_program">Professional Heading(eg: Artist):</label>
                                          <input id="dynamicAddForm_#index#_program"  id="professional_heading" name="professional_heading" type="text" class="form-control" />
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
      </div>
  </form>
