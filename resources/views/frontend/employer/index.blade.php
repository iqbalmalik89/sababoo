@extends('frontend.layouts.master')

@section('title', 'Employer')

@section('content')
	<script type="text/javascript" src="{{asset('assets/frontend/js/fileinput.min.js')}}"></script>


	<!-- start Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- start breadcrumb -->
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="">Employers</a></li>
						<li><span>Edit Employer</span></li>
					</ol>
					
				</div>
				
			</div>
			<!-- end breadcrumb -->
			
			<div class="admin-container-wrapper">

				<div class="container">
				
					<div class="GridLex-gap-15-wrappper">
					
						<div class="GridLex-grid-noGutter-equalHeight">
						
							<div class="GridLex-col-3_sm-4_xs-12">
							
								   @include('frontend.employer.side_bar',['userinfo'=>$userinfo])


							</div>
							
							<div class="GridLex-col-9_sm-8_xs-12">
							
								<div class="admin-content-wrapper">

									<div class="admin-section-title">
									
										<h2>Profile</h2>
										<p>Enquire explain another he in brandon enjoyed be service.</p>
										
									</div>
									
									<form id="frm_employee" class="post-form-wrapper">

										<input type="hidden" name="id" id="id" value="<?php echo $employer->id;?>">
										<input type="hidden" name="userid" id="userid" value="<?php echo $userinfo->id;?>">

											<div class="row gap-20">
										

												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-8">
												
													<div class="form-group">
														<label>Company Name:</label>
														<input type="text" class="form-control"  name="company_name" id="company_name" value="<?php echo $employer->company_name;?>">
													</div>
													
												</div>
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Established In:</label>
														<select name="esablish_in" id="esablish_in" class="form-control" data-live-search="false">
															<option value="">Year</option>
															<option value="0" selected >Select</option>
															<?php
															foreach(range(2000, 2042) as $year)
															{
																echo '<option value="'.$year.'">'.$year.'</option>';
															}
															?>
														</select>
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Type:</label>
															<select id="industry" name="industry" class="selectpicker form-control" data-live-search="false" tabindex="-98">
																<option value="">Select</option>

															<?php foreach($industry as $key=>$value){?>
																<option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
																<?php }?>

														</select>
													</div>
													
												</div>
												
												<div class="clear"></div>

												<div class="form-group">
													
													<div class="col-sm-6 col-md-4">
														<label>People:</label>
														<select name="people" id="people" class=" show-tick form-control mb-15" data-live-search="false">
															<option value="0">1-10</option>
															<option value="1">11-100</option>
															<option value="2">200+</option>
															<option value="3">300+</option>
															<option value="4">1000+ </option>
														</select>
													</div>

													<div class="col-sm-6 col-md-4">
														<label>Website:</label>
														<input type="text" class="form-control" value="<?php echo $employer->website;?>" id="website" name="website">
													</div>
														
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Address</label>
														<input type="text" class="form-control" value="<?php echo $userinfo->address; ?>" id="address" name="address">
													</div>
													
												</div>
												

												
												<div class="clear"></div>
												

												


												<div class="clear"></div>
												
												<div class="col-sm-6 col-md-4">

													<div class="form-group">
														<label for="dynamicAddForm">Postal Code </label>
														<input id="postal_code" name="postal_code" type="text" class="form-control" value ="<?php if(isset($userinfo->postal_code)){ echo $userinfo->postal_code;}?>" />
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Country</label>
														<select id="country" name="country" class="selectpicker show-tick form-control" data-live-search="false">
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
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Company background</label>
														<textarea id="description" name="description" class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"><?php echo $employer->description;?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Services</label>
														<textarea id="services" name="services" class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"><?php echo $employer->services;?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Expertise</label>
														<textarea id="expertise" name="expertise" class="bootstrap3-wysihtml5 form-control" placeholder="Enter text ..." style="height: 200px;"><?php echo $employer->expertise;?></textarea>
													</div>
													
												</div>
												<div id="msg_frm_employee"></div>
												
												<div class="clear"></div>

												<div class="col-sm-12 mt-10">
													<a href="#_" class="btn btn-primary" id="update_employer">Update</a>

												</div>

											</div>
											
										</form>
									
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

	var country = '<?php echo isset($userinfo->country)?$userinfo->country:'';?>';
	var phone_type = '<?php echo isset($userinfo->phone_type)?$userinfo->phone_type:'';?>';
	var industry = '<?php echo isset($userinfo->industry_id)?$userinfo->industry_id:'';?>';
	var esablish_in = '<?php echo isset($employer->eastablish_in)?$employer->eastablish_in:'';?>';
	var people = '<?php echo isset($employer->people)?$employer->people:'';?>';


	$(document).ready(function () {
		$('#country option[value="' + country + '"]').prop('selected', true);
		$('#phone_type option[value="' + phone_type + '"]').prop('selected', true);
		$('#industry option[value="' + industry + '"]').prop('selected', true);
		$('#$employer option[value="' + esablish_in + '"]').prop('selected', true);
		$('#people option[value="' + people + '"]').prop('selected', true);

		$('#update_employer').click(function () {
			$('.loader').show();
			html = '';
			pageURI = '/employer/update_employer';
			request_data = $('#frm_employee').serializeArray();
			mainAjax('frm_employee', request_data, 'POST',fillData);

		});

		function fillData(data)
		{
			if(data.status == 'ok')
			{
				$('#msg_frm_employee').hide();
				$('#global_message').show().html(data.message).delay(4000).fadeOut();
			}
		}

	});



</script>

@endsection

