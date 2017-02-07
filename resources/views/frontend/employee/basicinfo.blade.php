<script type="text/javascript" src="{{asset('assets/frontend/js/fileinput.min.js')}}"></script>


<form class="post-form-wrapper" id="frm_basic_info">

      <div class="row gap-20">
          <div class="col-sm-12 col-md-12 mb-15">
<!--               <h3 class="heading mb-10">Profile</h3>
              <p>Place are decay men hours tiled. If or of ye throwing friendly required. Marianne interest in exertion as. Offering my branched confined oh dashwood.</p> -->
          </div>
           <div class="clear"></div>
          <!-- sheepIt Form -->
          <div id="dynamicAddForm" class="clearfix">

              <!-- Form template-->
              <div id="dynamicAddForm_template">

                  <div class="col-sm-12">

                      <div class="">

                          <div class="dynamic-add-form-inner">

<!--                               <h4 class="heading font700 mb-15 text-primary">Profile  <span id="dynamicAddForm_label"></span></h4>
 -->
                              <div class="row gap-20">
                                  <div class="col-sm-6 col-md-4">

<!--                                       <div class="form-group bootstrap-fileinput-style-01">
                                          <label>Photo</label>
                                          <div class="file-input file-input-ajax-new"><div class="file-preview ">
                                                  <div class=" file-drop-zone">
                                                      <div class="image">

                                                          <?php
                                                             // dd($userinfo->image);
                                                             $user_image = "user_images/01.png";
                                                              if(isset($userinfo->image) && $userinfo->image!=''){
                                                                  $user_image = "user_images/".$userinfo->image;
                                                              }
                                                          ?>
                                                          <img  style="width:229px; height: 235px;" id="employee_image_1" class="" alt="image" src="<?php echo $user_image;?>">
                                                      </div>

                                                  </div>

                                                  <div class="file-preview-status text-center text-success"></div>

                                                  </div>
                                              </div>
                                              <div class="kv-upload-progress hide"></div>
                                              <div tabindex="500" class="btn btn-primary btn-file">
                                                  <input type="file" name="form-register-photo" id="form-register-photo"></div>




                                      </div> 
                                      <div id="img_upload" class="" style="display: none;"></div>
                                          <span class="font12 font-italic">** photo must not bigger than 250kb</span>
                                      </div>
-->
                                  </div>

                                  <div class="clear"></div>





                              <div class="col-sm-5">
                                      <div class="form-group">
                                          <label for="dynamicAddForm">First Name </label>
                                          <input id="first_name" name="first_name" type="text" class="form-control" value="<?php if(isset($userinfo->first_name)){ echo $userinfo->first_name;}?>"/>
                                      </div>
                                  </div>
                                  <div class="col-sm-5">
                                      <div class="form-group">
                                          <label for="dynamicAddForm">Last Name </label>
                                          <input id="last_name" name="last_name" type="text" class="form-control"  value="<?php if(isset($userinfo->last_name)){ echo $userinfo->last_name;}?>"/>
                                      </div>
                                  </div>

                                  <div class="clear"></div>

                                  <div class="col-sm-6">

                                      <div class="form-group mb-20">
                                          <label for="dynamicAddForm_#index#_program">Professional Heading(eg: Artist):</label>
                                          <input id="professional_heading"  id="professional_heading" name="professional_heading" type="text" class="form-control"  value="<?php if(isset($employeeinfo[0]->professional_heading)){ echo $employeeinfo[0]->professional_heading;}?>"/>
                                      </div>

                                  </div>

                                  <div class="clear"></div>

                                  <div class="col-sm-5">
                                      <div class="form-group">
                                          <label for="dynamicAddForm">Phone Number </label>
                                          <input id="phone" name="phone" type="text" class="form-control"  value="<?php if(isset($userinfo->phone)){ echo $userinfo->phone;}?>"/>
                                      </div>
                                  </div>
                                  <div class="col-sm-5">
                                      <div class="form-group mb-20">
                                          <label for="dynamicAddForm_#index#_level">Phone Type:</label>
                                          <div class="btn-group bootstrap-select form-control dropup open">

                                              <select id="phone_type" name="phone_type" class="selectpicker form-control" data-live-search="false" tabindex="-98">
                                                  <option value="home">Home</option>
                                                  <option value="office">Office</option>

                                              </select>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="clear"></div>

                                  <div class="col-sm-5">
                                      <div class="form-group">
                                          <label for="dynamicAddForm">Country </label>
                                          <div class="btn-group bootstrap-select form-control dropup open">

                                              <select id="country" name="country" class="selectpicker form-control" data-live-search="false" tabindex="-98">
                                                  <option value="">Select</option>

                                                  <option value="US">US - United States</option>
                                                  <option value="CA">CA - Canada</option>
                                                  <option value="GB">GB - United Kingdom</option>
                                                  <option value="AD">AD - Andorra</option>
                                                  <option value="AE">AE - United Arab Emirates</option>
                                                  <option value="AF">AF - Afghanistan</option>
                                                  <option value="AG">AG - Antigua and Barbuda</option>
                                                  <option value="AI">AI - Anguilla</option>
                                                  <option value="AL">AL - Albania</option>
                                                  <option value="AM">AM - Armenia</option>
                                                  <option value="AN">AN - Netherlands Antilles</option>
                                                  <option value="AO">AO - Angola</option>
                                                  <option value="AP">AP - Asia/Pacific Region</option>
                                                  <option value="AQ">AQ - Antarctica</option>
                                                  <option value="AR">AR - Argentina</option>
                                                  <option value="AS">AS - American Samoa</option>
                                                  <option value="AT">AT - Austria</option>
                                                  <option value="AU">AU - Australia</option>
                                                  <option value="AW">AW - Aruba</option>
                                                  <option value="AZ">AZ - Azerbaijan</option>
                                                  <option value="BA">BA - Bosnia / Herzegovina</option>
                                                  <option value="BB">BB - Barbados</option>
                                                  <option value="BD">BD - Bangladesh</option>
                                                  <option value="BE">BE - Belgium</option>
                                                  <option value="BF">BF - Burkina Faso</option>
                                                  <option value="BG">BG - Bulgaria</option>
                                                  <option value="BH">BH - Bahrain</option>
                                                  <option value="BI">BI - Burundi</option>
                                                  <option value="BJ">BJ - Benin</option>
                                                  <option value="BM">BM - Bermuda</option>
                                                  <option value="BN">BN - Brunei Darussalam</option>
                                                  <option value="BO">BO - Bolivia</option>
                                                  <option value="BR">BR - Brazil</option>
                                                  <option value="BS">BS - Bahamas</option>
                                                  <option value="BT">BT - Bhutan</option>
                                                  <option value="BV">BV - Bouvet Island</option>
                                                  <option value="BW">BW - Botswana</option>
                                                  <option value="BY">BY - Belarus</option>
                                                  <option value="BZ">BZ - Belize</option>
                                                  <option value="CD">CD - Congo</option>
                                                  <option value="CF">CF - Central African Rep</option>
                                                  <option value="CG">CG - Congo</option>
                                                  <option value="CH">CH - Switzerland</option>
                                                  <option value="CI">CI - Cote D'Ivoire</option>
                                                  <option value="CK">CK - Cook Islands</option>
                                                  <option value="CL">CL - Chile</option>
                                                  <option value="CM">CM - Cameroon</option>
                                                  <option value="CN">CN - China</option>
                                                  <option value="CO">CO - Colombia</option>
                                                  <option value="CR">CR - Costa Rica</option>
                                                  <option value="CU">CU - Cuba</option>
                                                  <option value="CV">CV - Cape Verde</option>
                                                  <option value="CY">CY - Cyprus</option>
                                                  <option value="CZ">CZ - Czech Republic</option>
                                                  <option value="DE">DE - Germany</option>
                                                  <option value="DJ">DJ - Djibouti</option>
                                                  <option value="DK">DK - Denmark</option>
                                                  <option value="DM">DM - Dominica</option>
                                                  <option value="DO">DO - Dominican Republic</option>
                                                  <option value="DZ">DZ - Algeria</option>
                                                  <option value="EC">EC - Ecuador</option>
                                                  <option value="EE">EE - Estonia</option>
                                                  <option value="EG">EG - Egypt</option>
                                                  <option value="ER">ER - Eritrea</option>
                                                  <option value="ES">ES - Spain</option>
                                                  <option value="ET">ET - Ethiopia</option>
                                                  <option value="EU">EU - Europe</option>
                                                  <option value="FI">FI - Finland</option>
                                                  <option value="FJ">FJ - Fiji</option>
                                                  <option value="FK">FK - Falkland Islands</option>
                                                  <option value="FM">FM - Micronesia</option>
                                                  <option value="FO">FO - Faroe Islands</option>
                                                  <option value="FR">FR - France</option>
                                                  <option value="FX">FX - France</option>
                                                  <option value="GA">GA - Gabon</option>
                                                  <option value="GD">GD - Grenada</option>
                                                  <option value="GE">GE - Georgia</option>
                                                  <option value="GH">GH - Ghana</option>
                                                  <option value="GI">GI - Gibraltar</option>
                                                  <option value="GL">GL - Greenland</option>
                                                  <option value="GM">GM - Gambia</option>
                                                  <option value="GN">GN - Guinea</option>
                                                  <option value="GP">GP - Guadeloupe</option>
                                                  <option value="GQ">GQ - Equatorial Guinea</option>
                                                  <option value="GR">GR - Greece</option>
                                                  <option value="GT">GT - Guatemala</option>
                                                  <option value="GU">GU - Guam</option>
                                                  <option value="GW">GW - Guinea-Bissau</option>
                                                  <option value="GY">GY - Guyana</option>
                                                  <option value="HK">HK - Hong Kong</option>
                                                  <option value="HM">HM - Heard / McDonald Is.</option>
                                                  <option value="HN">HN - Honduras</option>
                                                  <option value="HR">HR - Croatia</option>
                                                  <option value="HT">HT - Haiti</option>
                                                  <option value="HU">HU - Hungary</option>
                                                  <option value="ID">ID - Indonesia</option>
                                                  <option value="IE">IE - Ireland</option>
                                                  <option value="IL">IL - Israel</option>
                                                  <option value="IN">IN - India</option>
                                                  <option value="IR">IR - Iran</option>
                                                  <option value="IS">IS - Iceland</option>
                                                  <option value="IT">IT - Italy</option>
                                                  <option value="JM">JM - Jamaica</option>
                                                  <option value="JO">JO - Jordan</option>
                                                  <option value="JP">JP - Japan</option>
                                                  <option value="KE">KE - Kenya</option>
                                                  <option value="KG">KG - Kyrgyzstan</option>
                                                  <option value="KH">KH - Cambodia</option>
                                                  <option value="KI">KI - Kiribati</option>
                                                  <option value="KM">KM - Comoros</option>
                                                  <option value="KN">KN - St Kitts / Nevis</option>
                                                  <option value="KP">KP - Korea</option>
                                                  <option value="KR">KR - Korea</option>
                                                  <option value="KW">KW - Kuwait</option>
                                                  <option value="KY">KY - Cayman Islands</option>
                                                  <option value="KZ">KZ - Kazakstan</option>
                                                  <option value="LA">LA - Laos</option>
                                                  <option value="LB">LB - Lebanon</option>
                                                  <option value="LC">LC - Saint Lucia</option>
                                                  <option value="LI">LI - Liechtenstein</option>
                                                  <option value="LK">LK - Sri Lanka</option>
                                                  <option value="LR">LR - Liberia</option>
                                                  <option value="LS">LS - Lesotho</option>
                                                  <option value="LT">LT - Lithuania</option>
                                                  <option value="LU">LU - Luxembourg</option>
                                                  <option value="LV">LV - Latvia</option>
                                                  <option value="LY">LY - Libya</option>
                                                  <option value="MA">MA - Morocco</option>
                                                  <option value="MC">MC - Monaco</option>
                                                  <option value="MD">MD - Moldova</option>
                                                  <option value="MG">MG - Madagascar</option>
                                                  <option value="MH">MH - Marshall Islands</option>
                                                  <option value="MK">MK - Macedonia</option>
                                                  <option value="ML">ML - Mali</option>
                                                  <option value="MM">MM - Myanmar</option>
                                                  <option value="MN">MN - Mongolia</option>
                                                  <option value="MO">MO - Macau</option>
                                                  <option value="MP">MP - Northern Mariana Is</option>
                                                  <option value="MQ">MQ - Martinique</option>
                                                  <option value="MR">MR - Mauritania</option>
                                                  <option value="MS">MS - Montserrat</option>
                                                  <option value="MT">MT - Malta</option>
                                                  <option value="MU">MU - Mauritius</option>
                                                  <option value="MV">MV - Maldives</option>
                                                  <option value="MW">MW - Malawi</option>
                                                  <option value="MX">MX - Mexico</option>
                                                  <option value="MY">MY - Malaysia</option>
                                                  <option value="MZ">MZ - Mozambique</option>
                                                  <option value="NA">NA - Namibia</option>
                                                  <option value="NC">NC - New Caledonia</option>
                                                  <option value="NE">NE - Niger</option>
                                                  <option value="NG">NG - Nigeria</option>
                                                  <option value="NI">NI - Nicaragua</option>
                                                  <option value="NL">NL - Netherlands</option>
                                                  <option value="NO">NO - Norway</option>
                                                  <option value="NP">NP - Nepal</option>
                                                  <option value="NR">NR - Nauru</option>
                                                  <option value="NZ">NZ - New Zealand</option>
                                                  <option value="OM">OM - Oman</option>
                                                  <option value="PA">PA - Panama</option>
                                                  <option value="PE">PE - Peru</option>
                                                  <option value="PF">PF - French Polynesia</option>
                                                  <option value="PG">PG - Papua New Guinea</option>
                                                  <option value="PH">PH - Philippines</option>
                                                  <option value="PK">PK - Pakistan</option>
                                                  <option value="PL">PL - Poland</option>
                                                  <option value="PR">PR - Puerto Rico</option>
                                                  <option value="PS">PS - Palestinian Terr.</option>
                                                  <option value="PT">PT - Portugal</option>
                                                  <option value="PW">PW - Palau</option>
                                                  <option value="PY">PY - Paraguay</option>
                                                  <option value="QA">QA - Qatar</option>
                                                  <option value="RE">RE - Reunion</option>
                                                  <option value="RO">RO - Romania</option>
                                                  <option value="RU">RU - Russian Federation</option>
                                                  <option value="RW">RW - Rwanda</option>
                                                  <option value="SA">SA - Saudi Arabia</option>
                                                  <option value="SB">SB - Solomon Islands</option>
                                                  <option value="SC">SC - Seychelles</option>
                                                  <option value="SD">SD - Sudan</option>
                                                  <option value="SE">SE - Sweden</option>
                                                  <option value="SG">SG - Singapore</option>
                                                  <option value="SI">SI - Slovenia</option>
                                                  <option value="SK">SK - Slovakia</option>
                                                  <option value="SL">SL - Sierra Leone</option>
                                                  <option value="SM">SM - San Marino</option>
                                                  <option value="SN">SN - Senegal</option>
                                                  <option value="SO">SO - Somalia</option>
                                                  <option value="SR">SR - Suriname</option>
                                                  <option value="ST">ST - Sao Tome</option>
                                                  <option value="SV">SV - El Salvador</option>
                                                  <option value="SY">SY - Syria</option>
                                                  <option value="SZ">SZ - Swaziland</option>
                                                  <option value="TC">TC - Turks Caicos</option>
                                                  <option value="TD">TD - Chad</option>
                                                  <option value="TG">TG - Togo</option>
                                                  <option value="TH">TH - Thailand</option>
                                                  <option value="TJ">TJ - Tajikistan</option>
                                                  <option value="TM">TM - Turkmenistan</option>
                                                  <option value="TN">TN - Tunisia</option>
                                                  <option value="TO">TO - Tonga</option>
                                                  <option value="TR">TR - Turkey</option>
                                                  <option value="TT">TT - Trinidad Tobago</option>
                                                  <option value="TV">TV - Tuvalu</option>
                                                  <option value="TW">TW - Taiwan</option>
                                                  <option value="TZ">TZ - Tanzania</option>
                                                  <option value="UA">UA - Ukraine</option>
                                                  <option value="UG">UG - Uganda</option>
                                                  <option value="UY">UY - Uruguay</option>
                                                  <option value="UZ">UZ - Uzbekistan</option>
                                                  <option value="VA">VA - Vatican City</option>
                                                  <option value="VC">VC - St Vincent Grenadines</option>
                                                  <option value="VE">VE - Venezuela</option>
                                                  <option value="VG">VG - GB Virgin Islands</option>
                                                  <option value="VI">VI - US Virgin Islands</option>
                                                  <option value="VN">VN - Vietnam</option>
                                                  <option value="VU">VU - Vanuatu</option>
                                                  <option value="WS">WS - Samoa</option>
                                                  <option value="YE">YE - Yemen</option>
                                                  <option value="YU">YU - Yugoslavia</option>
                                                  <option value="ZA">ZA - South Africa</option>
                                                  <option value="ZM">ZM - Zambia</option>
                                                  <option value="ZW">ZW - Zimbabwe</option>


                                              </select>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-sm-5">
                                  <div class="form-group">
                                      <label for="dynamicAddForm">Postal Code </label>
                                      <input id="postal_code" name="postal_code" type="text" class="form-control" value ="<?php if(isset($userinfo->postal_code)){ echo $userinfo->postal_code;}?>" />
                                  </div>
                              </div>

                                <div class="clear"></div>

                                  <div class="col-sm-5">
                                      <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5 date date-picker" data-date="" data-date-format="dd-mm-yyyy" id="" >
                                        <label>Date of Birth</label>
                                      <input class="span2" size="16" type="text" value="" id="dob" name="dob">
                                      <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                  </div>
                                  <div class="col-sm-5">
                                      <div class="form-group mb-20">
                                          <label for="dynamicAddForm_#index#_level">Gender</label>
                                          <div class="btn-group bootstrap-select form-control dropup open">

                                              <select id="gender" name="gender" class="selectpicker form-control" data-live-search="false" tabindex="-98">
                                                  <option value="male">Male</option>
                                                  <option value="female">Female</option>

                                              </select>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-sm-6">

                                      <div class="form-group mb-5">
                                          <label for="dynamicAddForm_#index#_program">Address</label>
                                          <input id="address"  name="address" type="text" class="form-control" value="<?php if(isset($userinfo->address)) { echo $userinfo->address;}?> "/>
                                      </div>

                                      <div class="form-group mb-5">
                                          <label for="dynamicAddForm_#index#_program">Current Location</label>
                                          <input id="current_location"  name="current_location" type="text" class="form-control" value="<?php if(isset($userinfo->current_location)) { echo $userinfo->current_location;}?> "/>
                                      </div>


                                      <div class="form-group mb-5">
                                          <label for="dynamicAddForm_#index#_program">Industry</label>
                                          <div class="btn-group bootstrap-select form-control dropup open">

                                              <select id="industry" name="industry" class="selectpicker form-control" data-live-search="false" tabindex="-98">
                                              <?php foreach($industry as $key=>$value){?>
                                              <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                                  <?php }?>
                                              </select>
                                          </div>
                                          </div>

                                  </div>


                                  <div class="col-sm-12">

                                      <div class="form-group mb-20 bootstrap3-wysihtml5-wrapper">
                                          <label for="dynamicAddForm_#index#_extraInfo">About Me:</label>
                                          <textarea id="summary" name="summary" class="form-control" rows="5"><?php if(isset($employeeinfo[0]->summary)){ echo $employeeinfo[0]->summary;}?></textarea>

                                      </div>

                                  </div>

                              </div>



                          </div>



                      </div>

                  </div>



              </div>
              <!-- /Form template-->
              <div class="clear"></div>
              <!-- No forms template -->
<!--               <div id="msg_frm_basic_info" class="dynamic-add-form-empty clearfix"> -->

              </div>
              <!-- /No forms template-->
                <div id="msg_frm_basic_info"></div>
              <!-- Controls -->
              <div id="dynamicAddForm_controls" class="dynamic-add-form-action">
                  <div id="dynamicAddForm_add">
                      <input class="btn btn-primary btn-sm" type="button" name="update" id="update_basic_info" value="Update ">
                     </div>
              </div>
              <!-- /Controls -->

          </div>
      </div>

  </form>
  <div class="clear"></div>
<style>

    .file-thumb-progress .progress, .file-thumb-progress .progress-bar{
        height: 0px;;
    }
</style>

  <script>
      var pageURI = '';
      var request_data = '';
      var isScrLock = false;
      var html = '';

      var country = '<?php echo isset($userinfo->country)?$userinfo->country:'';?>';
      var phone_type = '<?php echo isset($userinfo->phone_type)?$userinfo->phone_type:'';?>';
      var industry = '<?php echo isset($userinfo->industry_id)?$userinfo->industry_id:'';?>';
      var gender = '<?php echo isset($userinfo->gender)?$userinfo->gender:'';?>';
      var dob = '<?php echo isset($userinfo->dob)?date('m/d/y', strtotime($userinfo->dob)):'';?>';

      $(document).ready(function () {
          $('#dob').keypress(function(){
              return false;
          });
          $('#dob').datepicker('setValue', dob);

          $('#dob').on('changeDate', function(ev){
              $(this).datepicker('hide');
          });
          if (gender != '') {
            $('#gender option[value="' + gender + '"]').prop('selected', true);
          }
          $('#country option[value="' + country + '"]').prop('selected', true);
          $('#phone_type option[value="' + phone_type + '"]').prop('selected', true);
          $('#industry option[value="' + industry + '"]').prop('selected', true);

          $('#update_basic_info').click(function () {
              $('.loader').show();
              html = '';
              pageURI = '/employee/update_basic_info';
              request_data = $('#frm_basic_info').serializeArray();
              mainAjax('frm_basic_info', request_data, 'POST',fillData);

          });

          function fillData(data)
          {
            if(data.status == 'ok')
            {
                $('#global_message').show().html(data.message).delay(4000).fadeOut();
            }            
          }

          $("#form-register-photo").fileinput({
              dropZoneTitle: '<i class="fa fa-photo"></i><span>Upload Photo</span>',
              uploadUrl: '/user/imageUpload?_token=' + $('meta[name="csrf-token"]').attr('content'),
              maxFileCount: 1,
              minFileCount: 1,
              uploadAsync: true,
              showUpload: true,
              showRemove: false,
              browseLabel: 'Browse',
              browseIcon: '',
              //removeLabel: 'Remove',
              removeLabel: false,
              removeIcon: '',
              uploadLabel: 'Upload',
              uploadIcon: '',
              autoReplace: true,
              showCaption: false,
              allowedFileTypes: ['image' ],
              allowedFileExtensions: ['jpg', 'gif', 'png', 'tiff'],
              initialPreview: [
                  '<img src="{{asset('assets/frontend/images/man/01.jpg')}}" class="file-preview-image" alt="The Moon" title="The Moon">',
              ],
              overwriteInitial: true,
              msgFilesTooLess:true,
              showPreview: false,
              //initialPreviewAsData: true
              elErrorContainer: '#kv-error-1'
          }).on('filebatchuploadsuccess', function(event, data, id, index) {

              console.log(data.jqXHR.responseJSON.code);
              if(data.jqXHR.responseJSON.code==200){
                $('#employee_image_1').attr('src',data.jqXHR.responseJSON.img);
                $('#employee_image_2').attr('src',data.jqXHR.responseJSON.img);
                 $('#img_upload').addClass('msg_ok');
                 $('#img_upload').show();
                 $('#img_upload').html('Image uploaded successfully');
                 $('#img_upload').fadeIn('slow');
                 $('#img_upload').delay(2000).fadeOut();
              }else {
                  $('#img_upload').addClass('msg_cancel');
                  $('#img_upload').show();
                  $('#img_upload').html('Invalid format please try again.');
                  $('#img_upload').fadeIn('slow');
                  $('#img_upload').delay(2000).fadeOut();
              }


          });


          /*var $input = $("#form-register-photo");
          $input.fileinput({
              uploadUrl: '/employee/imageUpload?_token=' + $('meta[name="csrf-token"]').attr('content'), // server upload action
              uploadAsync: false,
              showUpload: false, // hide upload button
              showRemove: false, // hide remove button
              minFileCount: 1,
              maxFileCount: 1
          }).on("filebatchselected", function(event, files) {
              // trigger upload method immediately after files are selected
              $input.fileinput("upload");
          });*/

         });

  </script>