var Sababoo = Sababoo || {}; // "If Sababoo is not defined, make it equal to an empty object"
Sababoo.App = Sababoo.App || {};
Sababoo.Config = Sababoo.Config || {};

var localStorage;
var localStorageData = localStorage.getItem('sababoo_admin');
var jsonLocalStorageData = JSON.parse(localStorageData);

var hidden_operations_value = $('#hidden_operations').val();
if (typeof hidden_operations_value != 'undefined') {
	var hidden_operations = JSON.parse(hidden_operations_value);
} else {
	var hidden_operations = [];
}


Sababoo.Config = (function(){
	if(window.location.host == 'localhost'){
		var apiUrl = window.location.protocol+'//'+window.location.host+'/sababoo/public/api/';
		var appUrl = window.location.protocol+'//'+window.location.host+'/sababoo/public/admin';
		var siteUrl = window.location.protocol+'//'+window.location.host+'/sababoo/public';
		var imageUrl = window.location.protocol+'//'+window.location.host+'/sababoo/public/pannel/images/';
		var docUrl = window.location.protocol+'//'+window.location.host+'/sababoo/Docs/';
	} else {
		var apiUrl = window.location.protocol+'//'+window.location.host+'/api/';
		var appUrl = window.location.protocol+'//'+window.location.host+'/admin';
		var siteUrl = window.location.protocol+'//'+window.location.host+'';
		var imageUrl = window.location.protocol+'//'+window.location.host+'/pannel/images/';
		var docUrl = window.location.protocol+'//'+window.location.host+'/Docs/';
	}

	var getApiUrl = function(){
		return apiUrl;
	};
	var getAppUrl = function(){
		return appUrl;
	};
	var getSiteUrl = function(){
		return siteUrl;
	};
	var getImageUrl = function(){
		return imageUrl;
	};
	var getDocUrl = function(){
		return docUrl;
	};

	return {
		getApiUrl:getApiUrl,
		getAppUrl:getAppUrl,
		getSiteUrl:getSiteUrl,
		getImageUrl:getImageUrl,
		getDocUrl:getDocUrl
	}
}());

Sababoo.App = (function () {
	var config = Sababoo.Config;

	var init = function () {
		if (!window.console) window.console = {log: function(obj) {}};
		console.log('Application has been initialized...');
	};

	var pagination = function (data) {

		var classDisabledPrev = '';
		var classDisabledNext = '';
		var paginationShow = '';

		if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
			$('.general-pagination').hide();
			//$('.general-limit-div').hide();
		} else {
			if(data.pagination.current==data.pagination.first){
				classDisabledPrev="disable";
			}
			if(data.pagination.current==data.pagination.last){
				classDisabledNext="disable";
			}
			paginationShow+='<li >\
							      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+data.pagination.previous+' href="javascript:;">Previous</a>\
							    </li>';
			paginationShow+= '<li >\
							      <a class="general-pagination-click '+classDisabledNext+'" data-page='+data.pagination.next+' href="javascript:;">Next</a>\
							    </li>';
			paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

			$('.general-pagination').html(paginationShow);
			$('.general-pagination').show();
			$('.general-limit-div').show();
		}

	};

	var minLimit = function(min,value){
    	if(value.length < min) {
      		return false;
     	} else {
      		return true;
     	}
    };

	var toTitleCase = function(val){
	  var smallWords = /^(a|an|and|as|at|but|by|en|for|if|in|nor|of|on|or|per|the|to|vs?\.?|via)$/i;

	  return val.replace(/[A-Za-z0-9\u00C0-\u00FF]+[^\s-]*/g, function(match, index, title){
	    if (index > 0 && index + match.length !== title.length &&
	      match.search(smallWords) > -1 && title.charAt(index - 2) !== ":" &&
	      (title.charAt(index + match.length) !== '-' || title.charAt(index - 1) === '-') &&
	      title.charAt(index - 1).search(/[^\s-]/) < 0) {
	      return match.toLowerCase();
	    }

	    if (match.substr(1).search(/[A-Z]|\../) > -1) {
	      return match;
	    }

	    return match.charAt(0).toUpperCase() + match.substr(1);
	  });
	};

	var validateAlphabet = function(name) {

		var alphabetWithSpace = /^[a-zA-Z\s]*$/;
   		return alphabetWithSpace.test(name);
	}

	var isValidUrl = function (url){
		var expression = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;

		var regex = new RegExp(expression);
		if (!url.match(regex)) {
			return false;
		}
		return true;
	};

	var isNumberOnly = function (value) {
    	//var er = /^[0-9]*$/;
    	var er = /^\d*\.?\d*$/;
    	return er.test(value);
	};

	var isEmail=function(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}

	var validatePhone=function(phoneNumber) {

		var phoneNumberPattern = /^[\s0-9]*([0-9][\s()+-]*){6,20}$/;
   		return phoneNumberPattern.test(phoneNumber);
	}

    var getTodaysDate = function() {

    	var today = new Date();
	    var dd = today.getDate();
	    var mm = today.getMonth()+1; //January is 0!
	    var yyyy = today.getFullYear();

	    if(dd<10){
	        dd='0'+dd
	    }
	    if(mm<10){
	        mm='0'+mm
	    }

	  	//  var todayDate = yyyy+'-'+mm+'-'+dd;
	  	var todayDate = yyyy+'-'+mm+'-'+dd;
    	return todayDate;
    }

	return {
		init:init,
		pagination:pagination,
		minLimit:minLimit,
		validateAlphabet:validateAlphabet,
		isEmail:isEmail,
		validatePhone:validatePhone,
		isValidUrl:isValidUrl,
		isNumberOnly:isNumberOnly,
		isEmail:isEmail,
		validatePhone:validatePhone,
		getTodaysDate:getTodaysDate,
		toTitleCase:toTitleCase
	};
}());

/* User Management */
Sababoo.App.User = (function() {

	var config = Sababoo.Config;
	var userApiUrl = config.getApiUrl()+'user';

	var login = function () {

		var email = $('#user-login-email');
		var password = $('#user-login-password');
		var error_msg = $('#user-login-error-msg');
		var signin_btn = $('#sign-in-btn');
		
		error_msg.removeClass('alert-success').removeClass('alert-danger');

		var errors = [];

		if ($.trim(email.val()) == ''){
			errors.push('Please enter email address.');
			email.parent().addClass('has-error');
		} else if(!Sababoo.App.isEmail(email.val())){
			errors.push('Please enter valid email address.');
			email.parent().addClass('has-error');
		} else {
			email.parent().removeClass('has-error');
		}

		if ($.trim(password.val()) == ''){
			errors.push('Please enter password');
			password.parent().addClass('has-error');
		}  else {
			password.parent().removeClass('has-error');
		}

		if(errors.length < 1) {
			var jsonData = {
								email:$.trim(email.val()),
								password:$.trim(password.val()),
								is_admin:1
							}

			var request = $.ajax({
				url: userApiUrl+'/login',
				data: jsonData,
				type: 'POST',
				dataType:'json'
			});

			signin_btn.addClass('prevent-click');
			$('#sign-in-loader').show();

			request.done(function(data){
				signin_btn.removeClass('prevent-click');
				$('#sign-in-loader').hide();
				if(data.error) {
					error_msg.addClass('alert-danger').html(data.error.messages).show();
				} else {
					localStorage.setItem('sababoo_admin', JSON.stringify(data.data));
					error_msg.addClass('alert-success').html('You have been logged in successfully.').show().delay(2000).fadeOut(function(){
						$(this).html('');
						window.location.href = config.getAppUrl()+'/dashboard';
				    });
				}

			});

			request.fail(function(jqXHR, textStatus){
				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var html = '';
				for(var i in jsonResponse.error.messages) {
					html += jsonResponse.error.messages[i];
				}
				signin_btn.removeClass('prevent-click');
				$('#sign-in-loader').hide();
				error_msg.removeClass('alert-success');
				error_msg.html(html).addClass('alert-danger').show();

			});

		}else{
			signin_btn.removeClass('prevent-click');
			$('#sign-in-loader').hide();
			error_msg.removeClass('alert-success');
			error_msg.html(errors[0]).addClass('alert-danger').show();
		}
	};

	var logout = function(){
		var request = $.ajax({

			url: userApiUrl+'/logout',
			data: {is_admin:1},
			type: 'POST',
			dataType:'json'
		});

		request.done(function(data){
			window.localStorage.removeItem('sababoo_admin');
		    var url = config.getAppUrl();
		    window.location.href = url;
		});
	};

	var createPassword = function () {

		var code 				= '';	
		var password 			= $('#create_password');
		var confirm_password 	= $('#create_confirm_password');
		var create_btn			= $('#user_activation_btn');

		code = $('#activation_key');		
		
		var errors = [];

		if ($.trim(code.val()) == ''){
			errors.push('Activation code is not found.');
		} 

		if ($.trim(password.val()) == '') {
			errors.push('Please enter new password');
			$('#new_password').parent().parent().addClass('has-error');
		}  else {
			if (!Sababoo.App.minLimit(6,$.trim(password.val()))) {
	    		$('#new_password').parent().parent().addClass('has-error');
	    		errors.push('Password must be 6 characters long.');
	   		} else {
	   			$('#new_password').parent().parent().removeClass('has-error');
	   		}
		}

		if ($.trim(confirm_password.val()) == '') {
			errors.push('Please enter confirm password');
			$('#confirm_password').parent().parent().addClass('has-error');
		} else {
			if (!Sababoo.App.minLimit(6,$.trim(confirm_password.val()))) {
	    		$('#confirm_password').parent().parent().addClass('has-error');
	    		errors.push('Password must be 6 characters long.');
	   		} else if ($.trim(password.val()) != $.trim(confirm_password.val())) {
	   			$('#confirm_password').parent().parent().addClass('has-error');
	    		errors.push('Confirm Password must be same as New Password.');
	   		}else {
	    		$('#confirm_password').parent().parent().removeClass('has-error');
	   		}
		}
		
		if (errors.length < 1) {
			var jsonData = {
							code:$.trim(code.val()),
							password:$.trim(password.val()),
							confirm_password:$.trim(confirm_password.val()),
							}

			var request = $.ajax({
				
				url: userApiUrl+'/create-password',
				data: jsonData,
				type: 'PUT',
				dataType:'json'
			});

			create_btn.addClass('prevent-click');
			$('#submit_loader').show();
			request.done(function(data){
				$('#submit_loader').hide();
				if(data.response) {
				 	if(data.response.code == 200) {
				 		$('#msg_div').removeClass('alert-danger').addClass('alert-success').html(data.response.messages).show().delay(2000).fadeOut(function(){;
							$(this).html('');
							create_btn.removeClass('prevent-click');
							window.location.href = config.getAppUrl()+'';
				    	});
				 	}
				} else if(data.error) {
				 	if(data.error.code == 401) {
				 		$('#msg_div').removeClass('alert-success').addClass('alert-danger').html(data.error.messages).show().delay(2000).fadeOut(function(){;
							$(this).html('');
							window.location.href = config.getAppUrl()+'';
				    	});
				 	}
				 	create_btn.removeClass('prevent-click');
					var errors = 'An error occurred while creating your password.';
					if (data.error.messages && data.error.messages.length > 0) {
						errors = data.error.messages[0];
					}
				 	$('#msg_div').removeClass('alert-success').addClass('alert-danger').html(errors).show();
				}
				
			});

			request.fail(function(jqXHR, textStatus){
				create_btn.removeClass('prevent-click');
				$('#submit_loader').hide();

				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var error = 'An error occurred while creating your password.';
				if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#msg_div').removeClass('alert-success');		
				$('#msg_div').html(error).addClass('alert-danger');
			});
		}else{
			create_btn.removeClass('prevent-click');
			$('#submit_loader').hide();
			$('#msg_div').removeClass('alert-success');		
			$('#msg_div').html(errors[0]).addClass('alert-danger').show();
		}
	};

	var forgotPassword = function () {
		var email = $('#forgot_email');
		var forgot_btn=$('#forgot_send');
		var errors = [];

		if ($.trim(email.val()) == ''){
			errors.push('Please enter email');
			email.parent().addClass('has-error');
		} else if(!Sababoo.App.isEmail(email.val())){
			errors.push('Please enter valid email address.');
			email.parent().addClass('has-error');
		} else {
			email.parent().removeClass('has-error');
		}
		if(errors.length < 1) {
			var jsonData = {
								email:$.trim(email.val())
							}

			var request = $.ajax({
				url: userApiUrl+'/forgot-password',
				data: jsonData,
				type: 'POST',
				dataType:'json'
			});
			forgot_btn.addClass('prevent-click');
			$('#forgot-loader').show();
			request.done(function(data){
				forgot_btn.removeClass('show-spinner');
				$('#forgot-loader').hide();
				if(data.success) {
				 	if(data.success.code == 200) {
						$('#forgot-error-message').removeClass('alert-danger').addClass('alert-success').html(data.success.messages).show().delay(2000).fadeOut(function(){;
							$(this).html('');
							email.val('');
							forgot_btn.removeClass('prevent-click');
							$('.forget-form').hide();
							$('.login-form').show();
    						
							/*$('.forget-form').addClass('slideOutRight').removeClass('slideInRight show');
							$(".login-form").addClass('slideInLeft').removeClass('slideOutLeft hide');*/
					    });
				 	}
				} else if(data.error) {
					forgot_btn.removeClass('prevent-click');
						$('#forgot-error-message').removeClass('alert-success').addClass('alert-danger').html(data.error.messages).show().delay(2000).fadeOut(function(){;
							$(this).html('');
					    });
				}

			});

			request.fail(function(jqXHR, textStatus){
				forgot_btn.removeClass('prevent-click');
				$('#forgot-loader').hide();
				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var html = '';
				for(var i in jsonResponse.error.messages) {
					html += jsonResponse.error.messages[i];
				}
				$('#forgot-error-message').removeClass('alert-success');
				$('#forgot-error-message').html(html).addClass('alert-danger').show();
			});
		} else {
			forgot_btn.removeClass('prevent-click');
			$('#forgot-loader').hide();
			$('#forgot-error-message').removeClass('alert-success');
			$('#forgot-error-message').html(errors[0]).addClass('alert-danger').show();
		}
	};

	var resetPassword = function () {

		var code 				= '';
		var password 			= $('#new_password');
		var confirm_password 	= $('#confirm_password');
		var reset_btn			=$('#reset_btn');

		code = $('#recover_password_key');

		var errors = [];

		if ($.trim(code.val()) == ''){
			errors.push('Recover code is not found.');
		}

		if ($.trim(password.val()) == '') {
			errors.push('Please enter new password');
			password.parent().parent().addClass('has-error');
		}  else {
			if (!Sababoo.App.minLimit(6,$.trim(password.val()))) {
	    		password.parent().parent().addClass('has-error');
	    		errors.push('Password must be 6 characters long.');
	   		} else {
	   			password.parent().parent().removeClass('has-error');
	   		}
		}

		if ($.trim(confirm_password.val()) == '') {
			errors.push('Please enter confirm password');
			confirm_password.parent().parent().addClass('has-error');
		} else {
			if (!Sababoo.App.minLimit(6,$.trim(confirm_password.val()))) {
	    		confirm_password.parent().parent().addClass('has-error');
	    		errors.push('Password must be 6 characters long.');
	   		} else if ($.trim(password.val()) != $.trim(confirm_password.val())) {
	   			confirm_password.parent().parent().addClass('has-error');
	    		errors.push('Confirm Password must be same as New Password.');
	   		} else {
	    		confirm_password.parent().parent().removeClass('has-error');
	   		}
		}

		if (errors.length < 1) {
			var jsonData = {
							code:$.trim(code.val()),
							password:$.trim(password.val()),
							confirm_password:$.trim(confirm_password.val())
							}

			var request = $.ajax({
				url: userApiUrl+'/reset-password',
				data: jsonData,
				type: 'PUT',
				dataType:'json'
			});

			reset_btn.addClass('prevent-click');
			$('#reset_submit_loader').show();
			request.done(function(data){
				$('#reset_submit_loader').hide();
				if(data.response) {
				 	if(data.response.code == 200) {
				 		$('#user-reset-error-msg').removeClass('alert-danger').addClass('alert-success').html(data.response.messages).show().delay(2000).fadeOut(function(){;
							$(this).html('');
							reset_btn.removeClass('prevent-click');
							window.location.href = config.getAppUrl()+'';
				    	});
				 	}
				} else if(data.error) {
					var errors = 'An error occurred while resetting your password.';
					if (data.error.messages && data.error.messages.length > 0) {
						errors = data.error.messages[0];
					}
					reset_btn.removeClass('prevent-click');
				 	$('#user-reset-error-msg').removeClass('alert-success').addClass('alert-danger').html(errors).show();
				}

			});

			request.fail(function(jqXHR, textStatus){
				reset_btn.removeClass('prevent-click');
				$('#reset_submit_loader').hide();

				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var error = 'An error occurred while creating your password.';
				if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#user-reset-error-msg').removeClass('alert-success');		
				$('#user-reset-error-msg').html(error).addClass('alert-danger').show();
			});
		}else{
			reset_btn.removeClass('prevent-click');
			$('#user-reset-error-msg').removeClass('alert-success');
			$('#user-reset-error-msg').html(errors[0]).addClass('alert-danger').show();
		}
	};

	var listAdmin = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var filterByStatus 	= $('#user_filter_by_status').val() || '';
		var filterByRole 	= $('#user_filter_by_role').val() || 0;
		var keyword 		= $('#user_search_keyword').val() || '';
		var limit 			= $('#user-list-limit').val() || 0;
		var data 			= {};
		var total_users 	= $('#total_users');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.filter_by_status = filterByStatus;
		data.filter_by_role = filterByRole;
		data.is_admin 		= 1;
		
		var request = $.ajax({
			url: userApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var users = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_users.html(paginations.total);

			if(users.length > 0) {

				$('#users_list_head').html('<tr>\
		                                        <th> ID </th>\
		                                        <th> Full Name </th>\
		                                        <th> Email </th>\
		                                        <th> Role </th>\
		                                        <th> Status </th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(users).each(function(index, user){

					var archiveText = '-';	
					var archiveClass = '';					
					var is_active = '';
					var statusText = 'N/A';

					if (typeof user.name != 'undefined' && typeof user.name !== null && user.name!='' ) {
						user.name = user.name;
					} else {
						user.name = 'N/A';									
					}

					if (typeof user.email != 'undefined' && typeof user.email !== null && user.email!='' ) {
						user.email = user.email;
					} else {
						user.email = 'N/A';									
					}

					if (typeof user.role_title != 'undefined' && typeof user.role_title !== null && user.role_title!='' ) {
						user.role_title = user.role_title;
					} else {
						user.role_title = 'N/A';									
					}
					
					if (typeof user.status != 'undefined' && typeof user.status !== null ) {
						if(user.status == 'enabled'){
							statusText = 'Active';
							is_active = 'disabled';
							archiveText = 'Deactivate';
							archiveClass = 'blue';
						}else{
							statusText = 'InActive';
							is_active = 'enabled';
							archiveText = 'Activate';
							archiveClass = 'green-jungle';
						}
					}
					
					var can_update = '';
					if ($.inArray(6, hidden_operations) > -1) {
						can_update = '<a href="'+config.getAppUrl()+'/user?id='+user.id+'" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-edit"></i> Edit </a>';
					} else {
						can_update = '';
					}

					var can_update_status = '';
					if ($.inArray(6, hidden_operations) > -1) {
						can_update_status = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+archiveClass+' user_status" data-id="'+user.id+'" data-status="'+is_active+'">\
                                        <i class="fa fa-trash-o"></i> '+archiveText+' </a>';
					} else {
						can_update_status = '';
					}

					var can_delete = '';
					if ($.inArray(7, hidden_operations) > -1) {
						can_delete = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delete_user" data-id="'+user.id+'">\
                                        <i class="fa fa-trash-o"></i> Delete </a>';
					} else {
						can_delete = '';
					}
					html += '<tr>\
                                <td class="highlight"> '+user.id+' </td>\
                                <td class="hidden-xs"> '+user.name+' </td>\
                                <td> '+user.email+' </td>\
                                <td> '+user.role_title+' </td>\
                                <td> '+statusText+' </td>\
                                <td>\
                                    '+can_update+'\
                                    '+can_delete+'\
                                    '+can_update_status+'\
                                </td>\
                            </tr>';

				});
			} else {
				$('#users_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#users_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.user-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.User.listAdmin(page);
		    });

		    $('.delete_user').unbind('click').bind('click',function(e){
				e.preventDefault();
				var user_id  = $(this).attr('data-id');
				$('#hidden_action_user_id').val(user_id);
				$('#removeConfirmation').modal('show');
		    });

		    $('.user_status').unbind('click').bind('click',function(e){
				e.preventDefault();
				var user_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_user_id').val(user_id);
				$('#hidden_action_user_status').val(status);

				if (status == 1) {
					$('#update_status_text').text('Activate');
				} else if (status == 0) {
					$('#update_status_text').text('Deactivate');
				}
				$('#updateStatusConfirmation').modal('show');
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving users.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#users_list').html(html);
		});		
	};

	var listSite = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var filterByStatus 	= $('#site_user_filter_by_status').val() || '';
		var filterByRole 	= $('#site_user_filter_by_role').val() || '';
		var keyword 		= $('#site_user_search_keyword').val() || '';
		var limit 			= $('#site-user-list-limit').val() || 0;
		var data 			= {};
		var total_users 	= $('#total_users');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.filter_by_status = filterByStatus;
		data.filter_by_role = filterByRole;
		data.is_admin = 0;
		
		var request = $.ajax({
			url: userApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var users = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_users.html(paginations.total);

			if(users.length > 0) {

				$('#site_users_list_head').html('<tr>\
		                                        <th> ID </th>\
		                                        <th> Full Name </th>\
		                                        <th> Email </th>\
		                                        <th> Industry </th>\
		                                        <th> Role </th>\
		                                        <th> Status </th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(users).each(function(index, user){

					var archiveText = '-';	
					var archiveClass = '';					
					var is_active = '';
					var statusText = 'N/A';

					if (typeof user.email != 'undefined' && typeof user.email !== null && user.email!='' ) {
						user.email = user.email;
					} else {
						user.email = 'N/A';									
					}

					if (typeof user.industry_name != 'undefined' && typeof user.industry_name !== null && user.industry_name!='' ) {
						user.industry_name = user.industry_name;
					} else {
						user.industry_name = 'N/A';									
					}
					
					if (user.role == 'employee') {
						user.role = 'Professional';
					} else if (user.role == 'employer') {
						user.role = 'Employer';
					} else if (user.role == 'tradesman') {
						user.role = 'Sabman';
					}
					if (typeof user.status != 'undefined' && typeof user.status !== null ) {
						if(user.status == 'enabled'){
							statusText = 'Active';
							is_active = 'disabled';
							archiveText = 'Deactivate';
							archiveClass = 'blue';
						}else{
							statusText = 'InActive';
							is_active = 'enabled';
							archiveText = 'Activate';
							archiveClass = 'green-jungle';
						}
					}
					
					var can_update = '';
					if ($.inArray(10, hidden_operations) > -1) {
						can_update = '<a href="'+config.getAppUrl()+'/site-user?id='+user.id+'" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-eye"></i> View </a>';
					} else {
						can_update = '';
					}

					var can_update_status = '';
					if ($.inArray(10, hidden_operations) > -1) {
						can_update_status = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+archiveClass+' user_status" data-id="'+user.id+'" data-status="'+is_active+'">\
                                        <i class="fa fa-trash-o"></i> '+archiveText+' </a>';
					} else {
						can_update_status = '';
					}

					var can_delete = '';
					if ($.inArray(11, hidden_operations) > -1) {
						can_delete = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delete_user" data-id="'+user.id+'">\
                                        <i class="fa fa-trash-o"></i> Delete </a>';
					} else {
						can_delete = '';
					}

					html += '<tr>\
                                <td class="highlight"> '+user.id+' </td>\
                                <td class="hidden-xs"> '+user.first_name+' '+user.last_name+' </td>\
                                <td> '+user.email+' </td>\
                                <td> '+user.industry_name+' </td>\
                                <td> '+user.role+' </td>\
                                <td> '+statusText+' </td>\
                                <td>\
                                    '+can_update+'\
                                    '+can_delete+'\
                                    '+can_update_status+'\
                                </td>\
                            </tr>';

				});
			} else {
				$('#site_users_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#site_users_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.user-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.User.listSite(page);
		    });

		    $('.delete_user').unbind('click').bind('click',function(e){
				e.preventDefault();
				var user_id  = $(this).attr('data-id');
				$('#hidden_action_user_id').val(user_id);
				$('#removeConfirmation').modal('show');
		    });

		    $('.user_status').unbind('click').bind('click',function(e){
				e.preventDefault();
				var user_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_user_id').val(user_id);
				$('#hidden_action_user_status').val(status);

				if (status == 'enabled') {
					$('#update_status_text').text('Activate');
				} else if (status == 'disabled') {
					$('#update_status_text').text('Deactivate');
				}
				$('#updateStatusConfirmation').modal('show');
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving users.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#site_users_list').html(html);
		});		
	};

	var create = function (){

		var errors = [];
		var user_id = $('#updated_user_id').val();
		var name 	= $('#user_name');
		var email 	= $('#user_email');
		var role_id 	= $('#user_role');

		if ($.trim(name.val()) == '') {
			errors.push('Please enter full name.');
			name.parent().addClass('has-error');
		} else {
			name.parent().removeClass('has-error');	
		}

		if ($.trim(email.val()) == '') {
			errors.push('Please enter email.');
			email.parent().addClass('has-error');
		} else {
			if(!Sababoo.App.isEmail(email.val())){
				errors.push('Please enter valid email address.');
			} else {
				email.parent().removeClass('has-error');
			}			
		}

		if ($.trim(role_id.val()) == 0) {
			errors.push('Please select role.');
			role_id.parent().parent().addClass('has-error');
		} else {
			role_id.parent().parent().removeClass('has-error');	
		}

		if (errors.length < 1) {

			var jsonData = {
								id:user_id,
								name:$.trim(name.val()),
								email:$.trim(email.val()),
								role_id:$.trim(role_id.val())																
							}

			if (jsonData.id == 0) {
				var request = $.ajax({
					url: userApiUrl+'/create',
					data: jsonData,
					type: 'post',
					dataType:'json'
				});
			} else {
				var request = $.ajax({	
					url: userApiUrl+'/update',
					data: jsonData,
					type: 'put',
					dataType:'json'
				});
			}
			
			$('#user_submit_btn').addClass('prevent-click');
			$('#submit_loader').show();

			request.done(function(data){
				
				$('#submit_loader').hide();
				if(data.success) {		 
						$('#msg_div').removeClass('alert-danger');
						$('#msg_div').html(data.success.messages[0]).addClass('alert-success').show().delay(2000).fadeOut(function()
						{
							window.location.href = config.getAppUrl()+'/users';
					    });		 	
				} else if(data.error) {
					$('#user_submit_btn').removeClass('prevent-click');
					var message_error = data.error.messages[0];
					$('#msg_div').removeClass('alert-success');
					$('#msg_div').html(message_error).addClass('alert-danger').show();
				}
				
			});

			request.fail(function(jqXHR, textStatus){
				$('#user_submit_btn').removeClass('prevent-click');
				$('#submit_loader').hide();
				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var error = 'An error occurred.';
				if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
					error = jsonResponse.error.messages[0];
				}
				$('#msg_div').removeClass('alert-success');
				$('#msg_div').html(error).addClass('alert-danger').show();
			});	

		} else {
			$('#msg_div').removeClass('alert-success');
			$('#msg_div').html(errors[0]).addClass('alert-danger').show();
			$('#user_submit_btn').removeClass('prevent-click');
			$('#submit_loader').hide();
		}		
	};

	var remove = function (){
		var is_admin = $('#is_admin_hidden').val();
		var id = $('#hidden_action_user_id').val();
		$('#site_user_remove_btn').addClass('prevent-click');
		$('#remove_submit_loader').show();

		var request = $.ajax({
			url: userApiUrl+'/remove',
			data: {id:id},
			type: 'delete',
			dataType:'json'
		});

		request.done(function(data){
			
			$('#remove_submit_loader').hide();
			if (data.success) {
				var html = 'User has been deleted successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#remove_msg_div').removeClass('alert-danger');
		 		$('#remove_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#site_user_remove_btn').removeClass('prevent-click');
				    $('#removeConfirmation').modal('hide');
				    if (is_admin == 1) {
				    	Sababoo.App.User.listAdmin();	
				    } else {
				    	Sababoo.App.User.listSite();
				    }
			    });

			} else if (data.error) {

				var error = 'An error occurred while deleting this user.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#site_user_remove_btn').removeClass('prevent-click');
				$('#remove_msg_div').removeClass('alert-success');
				$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
				    $(this).html('');
				    $('#remove_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#site_user_remove_btn').removeClass('prevent-click');
			$('#remove_submit_loader').hide();

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while deleting this role.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	var updateStatus = function (){
		var is_admin = $('#is_admin_hidden').val();
		var jsonData = {};
		jsonData.id = $('#hidden_action_user_id').val();
		jsonData.status = $('#hidden_action_user_status').val();

		var request = $.ajax({
			url: userApiUrl+'/update-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#site_user_status_btn').addClass('prevent-click');
		$('#status_submit_loader').show();

		request.done(function(data){
			
			$('#status_submit_loader').hide();
			
			if (data.success) {
				var html = 'Status has been updates successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#status_msg_div').removeClass('alert-danger');
		 		$('#status_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#user_status_btn').removeClass('prevent-click');
				    $('#updateStatusConfirmation').modal('hide');
				    if (is_admin == 1) {
				    	Sababoo.App.User.listAdmin();	
				    } else {
				    	Sababoo.App.User.listSite();
				    }		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating user status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#site_user_status_btn').removeClass('prevent-click');
				$('#status_msg_div').removeClass('alert-success');
				$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#site_user_status_btn').removeClass('prevent-click');
			$('#status_submit_loader').hide();
			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while updating user status.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	var updatePassword = function (){
		var errors = [];

		var old_password 		= $('#old_password');
		var new_password 		= $('#new_password');
		var confirm_password 	= $('#confirm_password');
			
		if ($.trim(old_password.val()) == '') {
			errors.push('Please enter current password.');
			old_password.parent().addClass('has-error');    
		}else{
			old_password.parent().removeClass('has-error');
		}

		if ($.trim(new_password.val()) == '') {
			errors.push('Please enter new password.');
			new_password.parent().addClass('has-error');    
		}else{
			new_password.parent().removeClass('has-error');
		}

		if ($.trim(confirm_password.val()) == '') {
			errors.push('Please enter confirm password.');
			confirm_password.parent().addClass('has-error');    
		}else{
			confirm_password.parent().removeClass('has-error');
		}

		if($.trim(new_password.val()) != $.trim(confirm_password.val()) ){
			errors.push('Password does not match.');
		} else {
			if($.trim(new_password.val()).length < 6){
				errors.push('Password must be atleast 6 characters long.');
			}
		}
	
		if (errors.length < 1 ) {

			var jsonData = {};
			jsonData.old_password = $.trim(old_password.val());
			jsonData.new_password = $.trim(confirm_password.val());

			var request = $.ajax({	
				url: userApiUrl+'/update-password',
				data: jsonData,
				type: 'PUT',
				dataType:'json'
			});
            	
            $('#profile_password_submit_btn').addClass('prevent-click');
            $('#profile_password_submit_loader').show();
			request.done(function(data){
				$('#profile_password_submit_loader').hide();
				if(data.success) {		
					$('#save_account_password_msg').removeClass('alert-danger show-alert-message');
					$('#save_account_password_msg').html(data.success.messages[0]).addClass('alert-success').show().delay(2000).fadeOut(function() {
						$(this).html('');
				    	$(this).removeClass('alert-danger');
				    	$('#profile_password_submit_btn').removeClass('prevent-click');
				    	new_password.val('');
				    	old_password.val('');
				    	confirm_password.val('');
				    });		
				} else if(data.error) {
					$('#profile_password_submit_btn').removeClass('prevent-click');
					var message_error = data.error.messages[0];
					$('#save_account_password_msg').removeClass('alert-success');
					$('#save_account_password_msg').html(message_error).addClass('alert-danger').show();
				}
				
			});

			request.fail(function(jqXHR, textStatus){
				$('#profile_password_submit_btn').removeClass('prevent-click');
				$('#profile_password_submit_loader').hide();

				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var error = 'An error occurred while updating password.';
				if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
					error = jsonResponse.error.messages[0];
				}
				$('#save_account_password_msg').html(error).addClass('alert-danger').show();
			});

		} else {
			$('#profile_password_submit_btn').removeClass('prevent-click');
			$('#save_account_password_msg').removeClass('alert-success');
			$('#save_account_password_msg').html(errors[0]).addClass('alert-danger').show();
		}		
	};

	var updateAccount = function (){
		var errors = [];

		var name 		= $('#profile_name');
			
		if ($.trim(name.val()) == '') {
			errors.push('Please enter full name.');
			name.parent().addClass('has-error');    
		}else{
			name.parent().removeClass('has-error');
		}

		if (errors.length < 1 ) {

			var jsonData = {};
			jsonData.name = $.trim(name.val());

			var request = $.ajax({	
				url: userApiUrl+'/update-account',
				data: jsonData,
				type: 'PUT',
				dataType:'json'
			});
            	
            $('#profile_submit_btn').addClass('prevent-click');
            $('#profile_submit_loader').show();
			request.done(function(data){
				$('#profile_submit_loader').hide();
				if(data.success) {		
					$('#profile_msg').removeClass('alert-danger show-alert-message');
					$('#profile_msg').html(data.success.messages[0]).addClass('alert-success').show().delay(2000).fadeOut(function() {
						$(this).html('');
				    	$(this).removeClass('alert-danger');
				    	$('#profile_submit_btn').removeClass('prevent-click');
				    });		
				} else if(data.error) {
					$('#profile_submit_btn').removeClass('prevent-click');
					var message_error = data.error.messages[0];
					$('#profile_msg').removeClass('alert-success');
					$('#profile_msg').html(message_error).addClass('alert-danger').show();
				}
				
			});

			request.fail(function(jqXHR, textStatus){
				$('#profile_submit_btn').removeClass('prevent-click');
				$('#profile_submit_loader').hide();

				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var error = 'An error occurred while updating profile information.';
				if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
					error = jsonResponse.error.messages[0];
				}
				$('#profile_msg').html(error).addClass('alert-danger').show();
			});

		} else {
			$('#profile_submit_btn').removeClass('prevent-click');
			$('#profile_msg').removeClass('alert-success');
			$('#profile_msg').html(errors[0]).addClass('alert-danger').show();
		}		
	};

	return {
		createPassword:createPassword,
		forgotPassword:forgotPassword,
		resetPassword:resetPassword,
		listAdmin:listAdmin,
		listSite:listSite,
		create:create,
		remove:remove,
		updateStatus:updateStatus,
		login:login,
		logout:logout,
		updatePassword:updatePassword,
		updateAccount:updateAccount
	}
}());

/* Jobs Management */
Sababoo.App.Jobs = (function(){

	var config = Sababoo.Config;
	var jobApiUrl = config.getApiUrl()+'job';

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var filterByStatus 	= $('#job_filter_by_status').val() || '';
		var filterByJobStatus 	= $('#job_filter_by_job_status').val() || '';
		var keyword 		= $('#job_search_keyword').val() || '';
		var limit 			= $('#job-list-limit').val() || 0;
		var data 			= {};
		var total_jobs 	= $('#total_jobs');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.filter_by_status = filterByStatus;
		data.filter_by_job_status = filterByJobStatus;
		
		var request = $.ajax({
			url: jobApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var jobs = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_jobs.html(paginations.total);

			if(jobs.length > 0) {

				$('#jobs_list_head').html('<tr>\
		                                        <th> ID </th>\
		                                        <th> Job Title </th>\
		                                        <th> User Name </th>\
		                                        <th> Type </th>\
		                                        <th> Salary </th>\
		                                        <th> Status </th>\
		                                        <th> Job Status </th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(jobs).each(function(index, job){

					var archiveText = '-';	
					var archiveClass = '';					
					var is_active = '';
					var statusText = 'N/A';

					var completeText = '-';	
					var completeClass = '';					
					var is_complete = '';

					if (typeof job.industry_name != 'undefined' && typeof job.industry_name !== null && job.industry_name!='' ) {
						job.industry_name = job.industry_name;
					} else {
						job.industry_name = 'N/A';									
					}

					if (typeof job.name != 'undefined' && typeof job.name !== null && job.name!='' ) {
						job.name = job.name;
					} else {
						job.name = 'N/A';									
					}

					if (typeof job.job_status != 'undefined' && typeof job.job_status !== null && job.job_status!='' ) {
						job.job_status = job.job_status;
					} else {
						job.job_status = 'N/A';									
					}

					if (typeof job.user_name != 'undefined' && typeof job.user_name !== null && job.user_name!='' ) {
						job.user_name = job.user_name;
					} else {
						job.user_name = 'N/A';									
					}

					if (typeof job.type != 'undefined' && typeof job.type !== null && job.type!='' ) {
						job.type = job.type;
						if (job.type == 'full_time') {
							job.type = 'Full Time';
						} else if (job.type == 'part_time') {
							job.type = 'Part Time';
						}
						
					} else {
						job.type = 'N/A';									
					}
					
					if (typeof job.is_active != 'undefined' && typeof job.is_active !== null ) {
						if(job.is_active == 1){
							statusText = 'Active';
							is_active = 0;
							archiveText = 'Deactivate';
							archiveClass = 'blue';
						}else{
							statusText = 'InActive';
							is_active = 1;
							archiveText = 'Activate';
							archiveClass = 'green-jungle';
						}
					}
					
					if (typeof job.job_status != 'undefined' && typeof job.job_status !== null ) {
						if(job.job_status == 'COMPLETED'){
							is_complete = 'in-progress';
							completeText = 'IN-PROGRESS';
							completeClass = 'blue';
						}else if (job.job_status == 'IN-PROGRESS'){
							is_complete = 'completed';
							completeText = 'Complete';
							completeClass = 'green-jungle';
						}
					}


					var can_update = '';
					if ($.inArray(14, hidden_operations) > -1) {
						can_update = '<a href="'+config.getSiteUrl()+'/job/post?id='+job.id+'" target="_blank" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-edit"></i> Edit </a>';
					} else {
						can_update = '';
					}

					var can_update_status = '';
					if ($.inArray(14, hidden_operations) > -1  && job.job_status != 'IN-PROGRESS') {
						can_update_status = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+archiveClass+' job_status" data-id="'+job.id+'" data-status="'+is_active+'">\
                                        <i class="fa fa-trash-o"></i> '+archiveText+' </a>';
					} else {
						can_update_status = '';
					}

					var can_delete = '';
					if ($.inArray(15, hidden_operations) > -1 && job.job_status != 'IN-PROGRESS') {
						can_delete = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delete_job" data-id="'+job.id+'">\
                                        <i class="fa fa-trash-o"></i> Delete </a>';
					} else {
						can_delete = '';
					}

					var markComplete = '';
					if (job.job_status != 'PENDING') {
						markComplete = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+completeClass+' job_complete" data-id="'+job.id+'" data-status="'+is_complete+'">\
                                        <i class="fa fa-trash-o"></i> '+completeText+' </a>';
					} else {
						markComplete = '';
					}
					html += '<tr>\
                                <td class="highlight"> '+job.id+' </td>\
                                <td class="hidden-xs"> '+job.name+' </td>\
                                <td class="hidden-xs"> '+job.user_name+' </td>\
                                <td> '+job.type+' </td>\
                                <td> '+job.salary+' </td>\
                                <td> '+statusText+' </td>\
                                <td> '+job.job_status+' </td>\
                                <td>\
                                	<a href="'+config.getAppUrl()+'/job?id='+job.id+'" class="btn btn-outline btn-circle yellow btn-sm">\
                                        <i class="fa fa-eye"></i> View </a>\
                                    '+can_update+'\
                                    '+can_delete+'\
                                    '+can_update_status+'\
                                    '+markComplete+'\
                                </td>\
                            </tr>';

				});
			} else {
				$('#jobs_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#jobs_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.job-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.Jobs.list(page);
		    });

		    $('.delete_job').unbind('click').bind('click',function(e){
				e.preventDefault();
				var job_id  = $(this).attr('data-id');
				$('#hidden_action_job_id').val(job_id);
				$('#removeConfirmation').modal('show');
		    });

		    $('.job_status').unbind('click').bind('click',function(e){
				e.preventDefault();
				var job_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_job_id').val(job_id);
				$('#hidden_action_job_status').val(status);

				if (status == 1) {
					$('#update_status_text').text('Activate');
				} else if (status == 0) {
					$('#update_status_text').text('Deactivate');
				}
				$('#updateStatusConfirmation').modal('show');
		    });

		    $('.job_complete').unbind('click').bind('click',function(e){
				e.preventDefault();
				var job_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_job_id').val(job_id);
				$('#hidden_action_job_status').val(status);

				if (status == 'completed') {
					$('#update_job_status_text').text('Completed');
				} else if (status == 'in-progress') {
					$('#update_job_status_text').text('In-Progress');
				}
				$('#updateJobStatusConfirmation').modal('show');
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving jobs.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#jobs_list').html(html);
		});		
	};

	var remove = function (){
		var id = $('#hidden_action_job_id').val();
		$('#job_remove_btn').addClass('prevent-click');
		$('#remove_submit_loader').show();

		var request = $.ajax({
			url: jobApiUrl+'/remove',
			data: {id:id},
			type: 'delete',
			dataType:'json'
		});

		request.done(function(data){
			
			$('#remove_submit_loader').hide();
			if (data.success) {
				var html = 'Job has been deleted successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#remove_msg_div').removeClass('alert-danger');
		 		$('#remove_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#job_remove_btn').removeClass('prevent-click');
				    $('#removeConfirmation').modal('hide');
				    Sababoo.App.Jobs.list();	
			    });

			} else if (data.error) {

				var error = 'An error occurred while deleting this job.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#job_remove_btn').removeClass('prevent-click');
				$('#remove_msg_div').removeClass('alert-success');
				$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
				    $(this).html('');
				    $('#remove_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#job_remove_btn').removeClass('prevent-click');
			$('#remove_submit_loader').hide();

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while deleting this job.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	var updateStatus = function (){
		
		var jsonData = {};
		jsonData.id = $('#hidden_action_job_id').val();
		jsonData.status = $('#hidden_action_job_status').val();

		var request = $.ajax({
			url: jobApiUrl+'/update-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#job_status_btn').addClass('prevent-click');
		$('#status_submit_loader').show();

		request.done(function(data){
			
			$('#status_submit_loader').hide();
			
			if (data.success) {
				var html = 'Status has been updates successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#status_msg_div').removeClass('alert-danger');
		 		$('#status_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#job_status_btn').removeClass('prevent-click');
				    $('#updateStatusConfirmation').modal('hide');
				    Sababoo.App.Jobs.list();		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating job status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#job_status_btn').removeClass('prevent-click');
				$('#status_msg_div').removeClass('alert-success');
				$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#job_status_btn').removeClass('prevent-click');
			$('#status_submit_loader').hide();
			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while updating job status.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	var updateJobStatus = function (){
		
		var jsonData = {};
		jsonData.id = $('#hidden_action_job_id').val();
		jsonData.status = $('#hidden_action_job_status').val();

		var request = $.ajax({
			url: jobApiUrl+'/update-job-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#job_status_btn2').addClass('prevent-click');
		$('#status_submit_loader2').show();

		request.done(function(data){
			
			$('#status_submit_loader2').hide();
			
			if (data.success) {
				var html = 'Job status has been updated successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#status_msg_div2').removeClass('alert-danger');
		 		$('#status_msg_div2').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#job_status_btn2').removeClass('prevent-click');
				    $('#updateJobStatusConfirmation').modal('hide');
				    Sababoo.App.Jobs.list();		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating job status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#job_status_btn2').removeClass('prevent-click');
				$('#status_msg_div2').removeClass('alert-success');
				$('#status_msg_div2').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div2').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#job_status_btn2').removeClass('prevent-click');
			$('#status_submit_loader2').hide();
			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while updating job status.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#status_msg_div2').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	return {
		list:list,
		updateStatus:updateStatus,
		updateJobStatus:updateJobStatus,
		remove:remove
	}
}());

/* Role Management */
Sababoo.App.Role = (function() {

	var config = Sababoo.Config;
	var roleApiUrl = config.getApiUrl()+'role';

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var filterByStatus 	= $('#role_filter_by_status').val() || '';
		var keyword 		= $('#role_search_keyword').val() || '';
		var limit 			= $('#role-list-limit').val() || 0;
		var data 			= {};
		var total_roles 	= $('#total_roles');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.filter_by_status = filterByStatus;
		
		var request = $.ajax({
			url: roleApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var roles = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_roles.html(paginations.total);

			if(roles.length > 0) {

				$('#roles_list_head').html('<tr>\
		                                        <th> ID </th>\
		                                        <th> Title </th>\
		                                        <th> Associated Users </th>\
		                                        <th> Status </th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(roles).each(function(index, role){

					var archiveText = '-';	
					var archiveClass = '';					
					var is_active = '';
					var statusText = 'N/A';

					if (typeof role.title != 'undefined' && typeof role.title !== null && role.title!='' ) {
						role.title = role.title;
					} else {
						role.title = 'N/A';									
					}

					if (typeof role.total_users != 'undefined' && typeof role.total_users !== null && role.total_users!='' ) {
						role.total_users = role.total_users;
					} else {
						role.total_users = '0';									
					}
					
					if (typeof role.is_active != 'undefined' && typeof role.is_active !== null ) {
						if(role.is_active == 1){
							statusText = 'Active';
							is_active = 0;
							archiveText = 'Deactivate';
							archiveClass = 'blue';
						}else{
							statusText = 'InActive';
							is_active = 1;
							archiveText = 'Activate';
							archiveClass = 'green-jungle';
						}
					}
					
					var can_update = '';
					if ($.inArray(2, hidden_operations) > -1) {
						can_update = '<a href="'+config.getAppUrl()+'/role?id='+role.id+'" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-edit"></i> Edit </a>';
					} else {
						can_update = '';
					}

					var can_update_status = '';
					if ($.inArray(2, hidden_operations) > -1) {
						if (role.id == 1) {
							can_update_status = '';
						} else {
							can_update_status = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+archiveClass+' role_status" data-id="'+role.id+'" data-status="'+is_active+'">\
                                        <i class="fa fa-trash-o"></i> '+archiveText+' </a>';
						}
						
					} else {
						can_update_status = '';
					}

					var can_delete = '';
					if ($.inArray(3, hidden_operations) > -1) {
						if (role.id == 1) {
							can_delete = '';
						} else {
							can_delete = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delete_role" data-id="'+role.id+'">\
                                        <i class="fa fa-trash-o"></i> Delete </a>';
						}
						
					} else {
						can_delete = '';
					}

					html += '<tr>\
                                <td class="highlight"> '+role.id+' </td>\
                                <td class="hidden-xs"> '+role.title+' </td>\
                                <td> '+role.total_users+' </td>\
                                <td> '+statusText+' </td>\
                                <td>\
                                    '+can_update+'\
                                    '+can_delete+'\
                                    '+can_update_status+'\
                                </td>\
                            </tr>';

				});
			} else {
				$('#roles_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#roles_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.role-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.Role.list(page);
		    });

		    $('.delete_role').unbind('click').bind('click',function(e){
				e.preventDefault();
				var role_id  = $(this).attr('data-id');
				$('#hidden_action_role_id').val(role_id);
				$('#removeConfirmation').modal('show');
		    });

		    $('.role_status').unbind('click').bind('click',function(e){
				e.preventDefault();
				var role_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_role_id').val(role_id);
				$('#hidden_action_role_status').val(status);

				if (status == 1) {
					$('#update_status_text').text('Activate');
				} else if (status == 0) {
					$('#update_status_text').text('Deactivate');
				}
				$('#updateStatusConfirmation').modal('show');
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving roles.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#roles_list').html(html);
		});		
	};

	var fetchModules = function(){
			
		var role_id = $('#updated_role_id').val();

		var request = $.ajax({
			url: roleApiUrl+'/list-modules',
			data: {},
			type: 'GET',
			dataType:'json'
		});
		request.done(function(data){
			
			var data = data.data;
			var html = '';
			var custom_html = '';
			if (data.length > 0) {
				$(data).each(function(index, module){
					
					html += '<tr><td width="30%">'+module.name+'</td>';
					if (module.operations.length > 0) {
						html += '<td width="70%"><div class="row text-center">';
						$(module.operations).each(function(index2, operation) {
							var name = 'role_operations';
							
							custom_html = '';
							if (operation.is_applied == 1) {
								custom_html +='<div class="auto-grid role-checkbox">\
	                                                <label title="'+operation.id+'" class="custom-checkbox-1"><input type="checkbox" class="'+name+'" name="'+name+'" value="'+operation.id+'" data-module_id="'+operation.module_id+'"></label>\
	                                            </div>';
							} else {
								custom_html += '<div class="auto-grid"></div>';
							}
							
							html += custom_html;
				        });
						html +='</div></td>';
					} else {
						html += '<td width="70%"><div class="row text-center">No Operation Found</div</td>';
					}
					
				});
				html += '</tr>';		
			} else {
				html += '<tr><td width="30%">No Module Found</td></tr>';
			}
			$('#modules_list').html(html);	
			
			if (role_id > 0) {
				Sababoo.App.Role.view(role_id);
			}
		});
	};

	var create = function (){

		var errors = [];
		var role_id = $('#updated_role_id').val();
		var title 	= $('#role_title');

		if ($.trim(title.val()) == '') {
			errors.push('Please enter title.');
			title.parent().addClass('has-error');
		} else {
			title.parent().removeClass('has-error');	
		}

		var operations = [];
    	$('.role_operations').each(function(){
    		if ($(this).prop("checked")) {
    			operations.push($(this).val());
    		}
    	});

    	if (operations.length == 0) {
    		errors.push('Please select atleast one operation.');
    	}

		if (errors.length < 1) {

			var jsonData = {
								id:role_id,
								title:$.trim(title.val()),
								operations:operations														
							}

			if (jsonData.id == 0) {
				var request = $.ajax({
					url: roleApiUrl+'/create',
					data: jsonData,
					type: 'post',
					dataType:'json'
				});
			} else {
				var request = $.ajax({	
					url: roleApiUrl+'/update',
					data: jsonData,
					type: 'put',
					dataType:'json'
				});
			}
			
			$('#role_submit_btn').addClass('prevent-click');
			$('#submit_loader').show();

			request.done(function(data){
				
				$('#submit_loader').hide();
				if(data.success) {		 
						$('#msg_div').removeClass('alert-danger');
						$('#msg_div').html(data.success.messages[0]).addClass('alert-success').show().delay(2000).fadeOut(function()
						{
							window.location.href = config.getAppUrl()+'/roles';
					    });		 	
				} else if(data.error) {
					$('#role_submit_btn').removeClass('prevent-click');
					var message_error = data.error.messages[0];
					$('#msg_div').removeClass('alert-success');
					$('#msg_div').html(message_error).addClass('alert-danger').show();
				}
				
			});

			request.fail(function(jqXHR, textStatus){
				$('#role_submit_btn').removeClass('prevent-click');
				$('#submit_loader').hide();
				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var error = 'An error occurred.';
				if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
					error = jsonResponse.error.messages[0];
				}
				$('#msg_div').removeClass('alert-success');
				$('#msg_div').html(error).addClass('alert-danger').show();
			});	

		} else {
			$('#msg_div').removeClass('alert-success');
			$('#msg_div').html(errors[0]).addClass('alert-danger').show();
			$('#role_submit_btn').removeClass('prevent-click');
			$('#submit_loader').hide();
		}		
	};

	var view = function(id){
        var jsonData = {id:id};
		var request = $.ajax({
			url: roleApiUrl+'/view',
			data: jsonData,
			type: 'GET',
			dataType:'json'
		});

		request.success(function(data){
			$('#role_title').val(data.title)
			$("input[name=role_operations]").prop('checked', false);
			if (data.operations.length > 0) {
				$(data.operations).each(function(index, operationId) {
					$("input[name=role_operations][value="+operationId+"]").prop('checked', true);
				});
			} 
		});

		request.fail(function(jqXHR, textStatus){
			// do something
		});
    };

	var remove = function (){
		var id = $('#hidden_action_role_id').val();
		$('#role_remove_btn').addClass('prevent-click');
		$('#remove_submit_loader').show();

		var request = $.ajax({
			url: roleApiUrl+'/remove',
			data: {id:id},
			type: 'delete',
			dataType:'json'
		});

		request.done(function(data){
			
			$('#remove_submit_loader').hide();
			if (data.success) {
				var html = 'Role has been deleted successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#remove_msg_div').removeClass('alert-danger');
		 		$('#remove_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#role_remove_btn').removeClass('prevent-click');
				    $('#removeConfirmation').modal('hide');
				    Sababoo.App.Role.list();	
			    });

			} else if (data.error) {

				var error = 'An error occurred while deleting this role.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#role_remove_btn').removeClass('prevent-click');
				$('#remove_msg_div').removeClass('alert-success');
				$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
				    $(this).html('');
				    $('#remove_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#role_remove_btn').removeClass('prevent-click');
			$('#remove_submit_loader').hide();

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while deleting this role.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	var updateStatus = function (){
		
		var jsonData = {};
		jsonData.id = $('#hidden_action_role_id').val();
		jsonData.status = $('#hidden_action_role_status').val();

		var request = $.ajax({
			url: roleApiUrl+'/update-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#role_status_btn').addClass('prevent-click');
		$('#status_submit_loader').show();

		request.done(function(data){
			
			$('#status_submit_loader').hide();
			
			if (data.success) {
				var html = 'Status has been updates successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#status_msg_div').removeClass('alert-danger');
		 		$('#status_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#role_status_btn').removeClass('prevent-click');
				    $('#updateStatusConfirmation').modal('hide');
				    Sababoo.App.Role.list();		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating role status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#role_status_btn').removeClass('prevent-click');
				$('#status_msg_div').removeClass('alert-success');
				$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#role_status_btn').removeClass('prevent-click');
			$('#status_submit_loader').hide();
			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while updating role status.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	return {
		list:list,
		create:create,
		remove:remove,
		updateStatus:updateStatus,
		fetchModules:fetchModules,
		view:view
	}
}());

/* Skills Management */
Sababoo.App.Skills = (function() {

	var config = Sababoo.Config;
	var skillApiUrl = config.getApiUrl()+'skill';

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var filterByStatus 	= $('#skill_filter_by_status').val() || '';
		var keyword 		= $('#skill_search_keyword').val() || '';
		var limit 			= $('#skill-list-limit').val() || 0;
		var data 			= {};
		var total_skills 	= $('#total_skills');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.filter_by_status = filterByStatus;
		
		var request = $.ajax({
			url: skillApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var skills = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_skills.html(paginations.total);

			if(skills.length > 0) {

				$('#skills_list_head').html('<tr>\
		                                        <th> ID </th>\
		                                        <th> Title </th>\
		                                        <th> Associated Users </th>\
		                                        <th> Status </th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(skills).each(function(index, skill){

					var archiveText = '-';	
					var archiveClass = '';					
					var is_active = '';
					var statusText = 'N/A';

					if (typeof skill.skill != 'undefined' && typeof skill.skill !== null && skill.skill!='' ) {
						skill.skill = skill.skill;
					} else {
						skill.skill = 'N/A';									
					}

					if (typeof skill.total_users != 'undefined' && typeof skill.total_users !== null && skill.total_users!='' ) {
						skill.total_users = skill.total_users;
					} else {
						skill.total_users = '0';									
					}
					
					if (typeof skill.status != 'undefined' && typeof skill.status !== null ) {
						if(skill.status == 'enable'){
							statusText = 'Active';
							is_active = 'disable';
							archiveText = 'Deactivate';
							archiveClass = 'blue';
						}else if (skill.status == 'disable'){
							statusText = 'InActive';
							is_active = 'enable';
							archiveText = 'Activate';
							archiveClass = 'green-jungle';
						}
					}
					
					var can_update = '';
					if ($.inArray(18, hidden_operations) > -1) {
						can_update = '<a href="'+config.getAppUrl()+'/skill?id='+skill.id+'" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-edit"></i> Edit </a>';
					} else {
						can_update = '';
					}

					var can_update_status = '';
					if ($.inArray(18, hidden_operations) > -1) {
						can_update_status = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+archiveClass+' skill_status" data-id="'+skill.id+'" data-status="'+is_active+'">\
                                        <i class="fa fa-trash-o"></i> '+archiveText+' </a>';
					} else {
						can_update_status = '';
					}

					var can_delete = '';
					if ($.inArray(19, hidden_operations) > -1) {
						can_delete = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delete_skill" data-id="'+skill.id+'">\
                                        <i class="fa fa-trash-o"></i> Delete </a>';
					} else {
						can_delete = '';
					}

					html += '<tr>\
                                <td class="highlight"> '+skill.id+' </td>\
                                <td class="hidden-xs"> '+skill.skill+' </td>\
                                <td> '+skill.total_users+' </td>\
                                <td> '+statusText+' </td>\
                                <td>\
                                    '+can_update+'\
                                    '+can_delete+'\
                                    '+can_update_status+'\
                                </td>\
                            </tr>';

				});
			} else {
				$('#skills_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#skills_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.skill-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.Skills.list(page);
		    });

		    $('.delete_skill').unbind('click').bind('click',function(e){
				e.preventDefault();
				var skill_id  = $(this).attr('data-id');
				$('#hidden_action_skill_id').val(skill_id);
				$('#removeConfirmation').modal('show');
		    });

		    $('.skill_status').unbind('click').bind('click',function(e){
				e.preventDefault();
				var skill_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_skill_id').val(skill_id);
				$('#hidden_action_skill_status').val(status);

				if (status == 'enable') {
					$('#update_status_text').text('Activate');
				} else if (status == 'disable') {
					$('#update_status_text').text('Deactivate');
				}
				$('#updateStatusConfirmation').modal('show');
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving skills.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#skills_list').html(html);
		});		
	};

	var create = function (){

		var errors = [];
		var skill_id = $('#updated_skill_id').val();
		var title 	= $('#skill_title');

		if ($.trim(title.val()) == '') {
			errors.push('Please enter title.');
			title.parent().addClass('has-error');
		} else {
			title.parent().removeClass('has-error');	
		}

		if (errors.length < 1) {

			var jsonData = {
								id:skill_id,
								title:$.trim(title.val())														
							}

			if (jsonData.id == 0) {
				var request = $.ajax({
					url: skillApiUrl+'/create',
					data: jsonData,
					type: 'post',
					dataType:'json'
				});
			} else {
				var request = $.ajax({	
					url: skillApiUrl+'/update',
					data: jsonData,
					type: 'put',
					dataType:'json'
				});
			}
			
			$('#skill_submit_btn').addClass('prevent-click');
			$('#submit_loader').show();

			request.done(function(data){
				
				$('#submit_loader').hide();
				if(data.success) {		 
						$('#msg_div').removeClass('alert-danger');
						$('#msg_div').html(data.success.messages[0]).addClass('alert-success').show().delay(2000).fadeOut(function()
						{
							window.location.href = config.getAppUrl()+'/skills';
					    });		 	
				} else if(data.error) {
					$('#skill_submit_btn').removeClass('prevent-click');
					var message_error = data.error.messages[0];
					$('#msg_div').removeClass('alert-success');
					$('#msg_div').html(message_error).addClass('alert-danger').show();
				}
				
			});

			request.fail(function(jqXHR, textStatus){
				$('#skill_submit_btn').removeClass('prevent-click');
				$('#submit_loader').hide();
				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var error = 'An error occurred.';
				if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
					error = jsonResponse.error.messages[0];
				}
				$('#msg_div').removeClass('alert-success');
				$('#msg_div').html(error).addClass('alert-danger').show();
			});	

		} else {
			$('#msg_div').removeClass('alert-success');
			$('#msg_div').html(errors[0]).addClass('alert-danger').show();
			$('#skill_submit_btn').removeClass('prevent-click');
			$('#submit_loader').hide();
		}		
	};

	var view = function(id){
        var jsonData = {id:id};
		var request = $.ajax({
			url: skillApiUrl+'/view',
			data: jsonData,
			type: 'GET',
			dataType:'json'
		});

		request.success(function(data){
			$('#skill_title').val(data.skill)
			
		});

		request.fail(function(jqXHR, textStatus){
			// do something
		});
    };

	var remove = function (){
		var id = $('#hidden_action_skill_id').val();
		$('#skill_remove_btn').addClass('prevent-click');
		$('#remove_submit_loader').show();

		var request = $.ajax({
			url: skillApiUrl+'/remove',
			data: {id:id},
			type: 'delete',
			dataType:'json'
		});

		request.done(function(data){
			
			$('#remove_submit_loader').hide();
			if (data.success) {
				var html = 'Skill has been deleted successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#remove_msg_div').removeClass('alert-danger');
		 		$('#remove_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#skill_remove_btn').removeClass('prevent-click');
				    $('#removeConfirmation').modal('hide');
				    Sababoo.App.Skills.list();	
			    });

			} else if (data.error) {

				var error = 'An error occurred while deleting this skill.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#skill_remove_btn').removeClass('prevent-click');
				$('#remove_msg_div').removeClass('alert-success');
				$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
				    $(this).html('');
				    $('#remove_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#skill_remove_btn').removeClass('prevent-click');
			$('#remove_submit_loader').hide();

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while deleting this skill.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	var updateStatus = function (){
		
		var jsonData = {};
		jsonData.id = $('#hidden_action_skill_id').val();
		jsonData.status = $('#hidden_action_skill_status').val();

		var request = $.ajax({
			url: skillApiUrl+'/update-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#skill_status_btn').addClass('prevent-click');
		$('#status_submit_loader').show();

		request.done(function(data){
			
			$('#status_submit_loader').hide();
			
			if (data.success) {
				var html = 'Status has been updates successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#status_msg_div').removeClass('alert-danger');
		 		$('#status_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#skill_status_btn').removeClass('prevent-click');
				    $('#updateStatusConfirmation').modal('hide');
				    Sababoo.App.Skills.list();		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating skill status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#skill_status_btn').removeClass('prevent-click');
				$('#status_msg_div').removeClass('alert-success');
				$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#skill_status_btn').removeClass('prevent-click');
			$('#status_submit_loader').hide();
			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while updating skill status.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	return {
		list:list,
		create:create,
		remove:remove,
		updateStatus:updateStatus,
		view:view
	}
}());

/* Industries Management */
Sababoo.App.Industry = (function() {

	var config = Sababoo.Config;
	var industryApiUrl = config.getApiUrl()+'industry';

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var filterByStatus 	= $('#industry_filter_by_status').val() || '';
		var keyword 		= $('#industry_search_keyword').val() || '';
		var limit 			= $('#industry-list-limit').val() || 0;
		var data 			= {};
		var total_industries 	= $('#total_industries');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.filter_by_status = filterByStatus;
		
		var request = $.ajax({
			url: industryApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var industries = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_industries.html(paginations.total);

			if(industries.length > 0) {

				$('#industries_list_head').html('<tr>\
		                                        <th> ID </th>\
		                                        <th> Name </th>\
		                                        <th> Associated Users </th>\
		                                        <th> Status </th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(industries).each(function(index, industry){

					var archiveText = '-';	
					var archiveClass = '';					
					var is_active = '';
					var statusText = 'N/A';

					if (typeof industry.name != 'undefined' && typeof industry.name !== null && industry.name!='' ) {
						industry.name = industry.name;
					} else {
						industry.name = 'N/A';									
					}

					if (typeof industry.total_users != 'undefined' && typeof industry.total_users !== null && industry.total_users!='' ) {
						industry.total_users = industry.total_users;
					} else {
						industry.total_users = '0';									
					}
					
					if (typeof industry.status != 'undefined' && typeof industry.status !== null ) {
						if(industry.status == 1){
							statusText = 'Active';
							is_active = 2;
							archiveText = 'Deactivate';
							archiveClass = 'blue';
						}else if (industry.status == 2){
							statusText = 'InActive';
							is_active = 1;
							archiveText = 'Activate';
							archiveClass = 'green-jungle';
						}
					}
					
					var can_update = '';
					if ($.inArray(22, hidden_operations) > -1) {
						can_update = '<a href="'+config.getAppUrl()+'/industry?id='+industry.id+'" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-edit"></i> Edit </a>';
					} else {
						can_update = '';
					}

					var can_update_status = '';
					if ($.inArray(22, hidden_operations) > -1) {
						can_update_status = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+archiveClass+' industry_status" data-id="'+industry.id+'" data-status="'+is_active+'">\
                                        <i class="fa fa-trash-o"></i> '+archiveText+' </a>';
					} else {
						can_update_status = '';
					}

					var can_delete = '';
					if ($.inArray(23, hidden_operations) > -1) {
						can_delete = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delete_industry" data-id="'+industry.id+'">\
                                        <i class="fa fa-trash-o"></i> Delete </a>';
					} else {
						can_delete = '';
					}

					html += '<tr>\
                                <td class="highlight"> '+industry.id+' </td>\
                                <td class="hidden-xs"> '+industry.name+' </td>\
                                <td> '+industry.total_users+' </td>\
                                <td> '+statusText+' </td>\
                                <td>\
                                    '+can_update+'\
                                    '+can_delete+'\
                                    '+can_update_status+'\
                                </td>\
                            </tr>';

				});
			} else {
				$('#industries_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#industries_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.industry-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.Industry.list(page);
		    });

		    $('.delete_industry').unbind('click').bind('click',function(e){
				e.preventDefault();
				var industry_id  = $(this).attr('data-id');
				$('#hidden_action_industry_id').val(industry_id);
				$('#removeConfirmation').modal('show');
		    });

		    $('.industry_status').unbind('click').bind('click',function(e){
				e.preventDefault();
				var industry_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_industry_id').val(industry_id);
				$('#hidden_action_industry_status').val(status);

				if (status == 1) {
					$('#update_status_text').text('Activate');
				} else if (status == 2) {
					$('#update_status_text').text('Deactivate');
				}
				$('#updateStatusConfirmation').modal('show');
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving industries.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#industries_list').html(html);
		});		
	};

	var create = function (){

		var errors = [];
		var industry_id = $('#updated_industry_id').val();
		var name 	= $('#industry_name');

		if ($.trim(name.val()) == '') {
			errors.push('Please enter name.');
			name.parent().addClass('has-error');
		} else {
			name.parent().removeClass('has-error');	
		}

		if (errors.length < 1) {

			var jsonData = {
								id:industry_id,
								name:$.trim(name.val())														
							}

			if (jsonData.id == 0) {
				var request = $.ajax({
					url: industryApiUrl+'/create',
					data: jsonData,
					type: 'post',
					dataType:'json'
				});
			} else {
				var request = $.ajax({	
					url: industryApiUrl+'/update',
					data: jsonData,
					type: 'put',
					dataType:'json'
				});
			}
			
			$('#industry_submit_btn').addClass('prevent-click');
			$('#submit_loader').show();

			request.done(function(data){
				
				$('#submit_loader').hide();
				if(data.success) {		 
						$('#msg_div').removeClass('alert-danger');
						$('#msg_div').html(data.success.messages[0]).addClass('alert-success').show().delay(2000).fadeOut(function()
						{
							window.location.href = config.getAppUrl()+'/industries';
					    });		 	
				} else if(data.error) {
					$('#industry_submit_btn').removeClass('prevent-click');
					var message_error = data.error.messages[0];
					$('#msg_div').removeClass('alert-success');
					$('#msg_div').html(message_error).addClass('alert-danger').show();
				}
				
			});

			request.fail(function(jqXHR, textStatus){
				$('#industry_submit_btn').removeClass('prevent-click');
				$('#submit_loader').hide();
				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var error = 'An error occurred.';
				if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
					error = jsonResponse.error.messages[0];
				}
				$('#msg_div').removeClass('alert-success');
				$('#msg_div').html(error).addClass('alert-danger').show();
			});	

		} else {
			$('#msg_div').removeClass('alert-success');
			$('#msg_div').html(errors[0]).addClass('alert-danger').show();
			$('#industry_submit_btn').removeClass('prevent-click');
			$('#submit_loader').hide();
		}		
	};

	var view = function(id){
        var jsonData = {id:id};
		var request = $.ajax({
			url: industryApiUrl+'/view',
			data: jsonData,
			type: 'GET',
			dataType:'json'
		});

		request.success(function(data){
			$('#industry_name').val(data.name)
			
		});

		request.fail(function(jqXHR, textStatus){
			// do something
		});
    };

	var remove = function (){
		var id = $('#hidden_action_industry_id').val();
		$('#industry_remove_btn').addClass('prevent-click');
		$('#remove_submit_loader').show();

		var request = $.ajax({
			url: industryApiUrl+'/remove',
			data: {id:id},
			type: 'delete',
			dataType:'json'
		});

		request.done(function(data){
			
			$('#remove_submit_loader').hide();
			if (data.success) {
				var html = 'Industry has been deleted successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#remove_msg_div').removeClass('alert-danger');
		 		$('#remove_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#industry_remove_btn').removeClass('prevent-click');
				    $('#removeConfirmation').modal('hide');
				    Sababoo.App.Industry.list();	
			    });

			} else if (data.error) {

				var error = 'An error occurred while deleting this industry.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#industry_remove_btn').removeClass('prevent-click');
				$('#remove_msg_div').removeClass('alert-success');
				$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
				    $(this).html('');
				    $('#remove_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#industry_remove_btn').removeClass('prevent-click');
			$('#remove_submit_loader').hide();

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while deleting this industry.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	var updateStatus = function (){
		
		var jsonData = {};
		jsonData.id = $('#hidden_action_industry_id').val();
		jsonData.status = $('#hidden_action_industry_status').val();

		var request = $.ajax({
			url: industryApiUrl+'/update-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#industry_status_btn').addClass('prevent-click');
		$('#status_submit_loader').show();

		request.done(function(data){
			
			$('#status_submit_loader').hide();
			
			if (data.success) {
				var html = 'Status has been updates successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#status_msg_div').removeClass('alert-danger');
		 		$('#status_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#industry_status_btn').removeClass('prevent-click');
				    $('#updateStatusConfirmation').modal('hide');
				    Sababoo.App.Industry.list();		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating industry status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#industry_status_btn').removeClass('prevent-click');
				$('#status_msg_div').removeClass('alert-success');
				$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#industry_status_btn').removeClass('prevent-click');
			$('#status_submit_loader').hide();
			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while updating industry status.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	return {
		list:list,
		create:create,
		remove:remove,
		updateStatus:updateStatus,
		view:view
	}
}());

/* Transactions History */
Sababoo.App.Transaction = (function() {

	var config = Sababoo.Config;
	var transactionApiUrl = config.getApiUrl()+'transaction';

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var keyword 		= $('#transaction_search_keyword').val() || '';
		var limit 			= $('#transaction-list-limit').val() || 0;
		var start_date 		= $('#start_date').val() || '';
		var end_date 		= $('#end_date').val() || '';
		var data 			= {};
		var total_transactions 	= $('#total_transactions');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.start_date 	= start_date;
		data.end_date 		= end_date;
		
		var request = $.ajax({
			url: transactionApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var transactions = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_transactions.html(paginations.total);

			if(transactions.length > 0) {

				$('#transactions_list_head').html('<tr>\
		                                        <th> Payment Id </th>\
		                                        <th> Payment Amount</th>\
		                                        <th> Job Name </th>\
		                                        <th> Payer Id </th>\
		                                        <th> Payer Name</th>\
		                                        <th> Payment Date</th>\
		                                    </tr>');

				$(transactions).each(function(index, transaction){

					if (typeof transaction.job_name != 'undefined' && typeof transaction.job_name !== null && transaction.job_name!='' ) {
						transaction.job_name = transaction.job_name;
					} else {
						transaction.job_name = 'N/A';									
					}

					html += '<tr>\
                                <td class="highlight"> '+transaction.payment_id+' </td>\
                                <td class="hidden-xs"> $'+transaction.payment_amount+' </td>\
                                <td> '+transaction.job_name+' </td>\
                                <td> '+transaction.payer_id+' </td>\
                                <td> '+transaction.payer_name+' </td>\
                                <td> '+transaction.createdtime+' </td>\
                            </tr>';

				});
			} else {
				$('#transactions_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#transactions_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.transaction-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.Transaction.list(page);
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving transaction.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#transactions_list').html(html);
		});		
	};

	return {
		list:list
	}
}());

/* Refund */
Sababoo.App.Refunds = (function() {

	var config = Sababoo.Config;
	var refundApiUrl = config.getApiUrl()+'refund';

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var limit 			= $('#refund-list-limit').val() || 0;
		var filterByStatus 	= $('#refunds_filter_by_status').val() || '';
		var start_date 		= $('#start_date').val() || '';
		var end_date 		= $('#end_date').val() || '';
		var data 			= {};
		var total_refunds 	= $('#total_refunds');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.start_date 	= start_date;
		data.end_date 		= end_date;
		data.filter_by_status	= filterByStatus;
		
		var request = $.ajax({
			url: refundApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var refunds = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_refunds.html(paginations.total);

			if(refunds.length > 0) {

				$('#refunds_list_head').html('<tr>\
		                                        <th> ID </th>\
		                                        <th> Job Name</th>\
		                                        <th> Reason </th>\
		                                        <th> Amount </th>\
		                                        <th> Requested User </th>\
		                                        <th> Payment Id </th>\
		                                        <th> Payment Date</th>\
		                                        <th> Status</th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(refunds).each(function(index, refund){

					if (typeof refund.job_name != 'undefined' && typeof refund.job_name !== null && refund.job_name!='' ) {
						refund.job_name = refund.job_name;
					} else {
						refund.job_name = 'N/A';									
					}

					if (typeof refund.requested_user_name != 'undefined' && typeof refund.requested_user_name !== null && refund.requested_user_name!='' ) {
						refund.requested_user_name = refund.requested_user_name;
					} else {
						refund.requested_user_name = 'N/A';									
					}

					var action = '';
					if ($.inArray(30, hidden_operations) > -1) {
						if (refund.status == 'PENDING') {
							action = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm green-jungle take_action" data-id="'+refund.id+'" data-status="approved">Approve</a>\
							<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red take_action" data-id="'+refund.id+'" data-status="rejected">Reject</a>';
						} /*else if (refund.status == 'REJECTED') {
							action = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm green-jungle take_action" data-id="'+refund.id+'" data-status="approved">Approve</a>';
						}*/ else if (refund.status == 'APPROVED' || refund.status == 'REJECTED') {
							action = 'Action Taken';
						}
					} else {
						action = '-';
					}
					
					html += '<tr>\
                                <td class="highlight"> '+refund.id+' </td>\
                                <td class="hidden-xs"> '+refund.job_name+' </td>\
                                <td> '+refund.reason+' </td>\
                                <td> $'+refund.payment.payment_amount+' </td>\
                                <td> '+refund.requested_by_name+' </td>\
                                <td> '+refund.payment.payment_id+' </td>\
                                <td> '+refund.payment.createdtime+' </td>\
                                <td> '+refund.status+' </td>\
                                <td>'+action+'</td>\
                            </tr>';

				});
			} else {
				$('#refunds_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#refunds_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.transaction-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.Refunds.list(page);
		    });

		    $('.take_action').unbind('click').bind('click',function(e){
				e.preventDefault();
				var refund_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_request_id').val(refund_id);
				$('#hidden_action_request_status').val(status);

				if (status == 'approved') {
					$('#update_status_text').text('Approved');
				} else if (status == 'rejected') {
					$('#update_status_text').text('Reject');
				}
				$('#updateStatusConfirmation').modal('show');
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving refunds.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#refunds_list').html(html);
		});		
	};

	var updateStatus = function (){
		
		var jsonData = {};
		jsonData.id = $('#hidden_action_request_id').val();
		jsonData.status = $('#hidden_action_request_status').val();

		var request = $.ajax({
			url: refundApiUrl+'/update-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#refund_status_btn').addClass('prevent-click');
		$('#status_submit_loader').show();

		request.done(function(data){
			
			$('#status_submit_loader').hide();
			
			if (data.success) {
				var html = 'Status has been updates successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#status_msg_div').removeClass('alert-danger');
		 		$('#status_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#refund_status_btn').removeClass('prevent-click');
				    $('#updateStatusConfirmation').modal('hide');
				    Sababoo.App.Refunds.list();		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating request status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#refund_status_btn').removeClass('prevent-click');
				$('#status_msg_div').removeClass('alert-success');
				$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#refund_status_btn').removeClass('prevent-click');
			$('#status_submit_loader').hide();
			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while updating request status.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	return {
		list:list,
		updateStatus:updateStatus
	}
}());

/* Disputes */
Sababoo.App.Disputes = (function() {

	var config = Sababoo.Config;
	var disputeApiUrl = config.getApiUrl()+'dispute';

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var limit 			= $('#dispute-list-limit').val() || 0;
		var filterByStatus 	= $('#disputes_filter_by_status').val() || '';
		var start_date 		= $('#start_date').val() || '';
		var end_date 		= $('#end_date').val() || '';
		var data 			= {};
		var total_disputes 	= $('#total_disputes');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.start_date 	= start_date;
		data.end_date 		= end_date;
		data.filter_by_status	= filterByStatus;
		
		var request = $.ajax({
			url: disputeApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var disputes = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_disputes.html(paginations.total);

			if(disputes.length > 0) {

				$('#disputes_list_head').html('<tr>\
		                                        <th> ID </th>\
		                                        <th> Job Name</th>\
		                                        <th> Discription </th>\
		                                        <th> Amount </th>\
		                                        <th> Creator </th>\
		                                        <th> Dispute Date</th>\
		                                        <th> Status</th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(disputes).each(function(index, dispute){

					if (typeof dispute.job_name != 'undefined' && typeof dispute.job_name !== null && dispute.job_name!='' ) {
						dispute.job_name = dispute.job_name;
					} else {
						dispute.job_name = 'N/A';									
					}

					if (typeof dispute.created_user_name != 'undefined' && typeof dispute.created_user_name !== null && dispute.created_user_name!='' ) {
						dispute.created_user_name = dispute.created_user_name;
					} else {
						dispute.created_user_name = 'N/A';									
					}

					var action = '';
					if ($.inArray(42, hidden_operations) > -1) {
						if (dispute.status == 'PENDING') {
							action = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm green-jungle take_action" data-id="'+dispute.id+'" data-status="approved">Approve</a>\
							<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red take_action" data-id="'+dispute.id+'" data-status="rejected">Reject</a>';
						} /*else if (dispute.status == 'REJECTED') {
							action = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm green-jungle take_action" data-id="'+dispute.id+'" data-status="approved">Approve</a>';
						}*/ else if (dispute.status == 'APPROVED' || dispute.status == 'REJECTED') {
							action = 'Action Taken';
						}
					} else {
						action = '-';
					}
					
					html += '<tr>\
                                <td class="highlight"> '+dispute.id+' </td>\
                                <td class="hidden-xs"> '+dispute.job_name+' </td>\
                                <td> '+dispute.description+' </td>\
                                <td> $'+dispute.amount+' </td>\
                                <td> '+dispute.created_by_name+' </td>\
                                <td> '+dispute.created_at+' </td>\
                                <td> '+dispute.status+' </td>\
                                <td>'+action+'</td>\
                            </tr>';

				});
			} else {
				$('#disputes_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#disputes_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.transaction-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.Disputes.list(page);
		    });

		    $('.take_action').unbind('click').bind('click',function(e){
				e.preventDefault();
				var dispute_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_dispute_id').val(dispute_id);
				$('#hidden_action_dispute_status').val(status);

				if (status == 'approved') {
					$('#update_status_text').text('Approved');
				} else if (status == 'rejected') {
					$('#update_status_text').text('Reject');
				}
				$('#updateStatusConfirmation').modal('show');
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving disputes.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#disputes_list').html(html);
		});		
	};

	var updateStatus = function (){
		
		var jsonData = {};
		jsonData.id = $('#hidden_action_dispute_id').val();
		jsonData.status = $('#hidden_action_dispute_status').val();

		var request = $.ajax({
			url: disputeApiUrl+'/update-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#dispute_status_btn').addClass('prevent-click');
		$('#status_submit_loader').show();

		request.done(function(data){
			
			$('#status_submit_loader').hide();
			
			if (data.success) {
				var html = 'Status has been updated successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#status_msg_div').removeClass('alert-danger');
		 		$('#status_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#dispute_status_btn').removeClass('prevent-click');
				    $('#updateStatusConfirmation').modal('hide');
				    Sababoo.App.Disputes.list();		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating dispute status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#dispute_status_btn').removeClass('prevent-click');
				$('#status_msg_div').removeClass('alert-success');
				$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#dispute_status_btn').removeClass('prevent-click');
			$('#status_submit_loader').hide();
			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while updating dispute status.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	return {
		list:list,
		updateStatus:updateStatus
	}
}());

Sababoo.App.Reports = (function() {

	var config = Sababoo.Config;
	var reportApiUrl = config.getApiUrl()+'report';

	var userReport = function(){

		$('.spinner-section').show();

		var jsonData = {};
		jsonData.start_date = $('#start_date').val() || '';
		jsonData.end_date = $('#end_date').val() || '';

		var request = $.ajax({
			url: reportApiUrl+'/user',
			data: jsonData,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			
			var emplpoyee_title = $('#employee_title').val();
			var emplpoyer_title = $('#employer_title').val();
			var tradesman_title = $('#tradesman_title').val();
			AmCharts.makeChart("userChart",{
							"type": "serial",
							"categoryField": "category",
							"startDuration": 1,
							"categoryAxis": {
								"gridPosition": "start"
							},
							"trendLines": [],
							"graphs": [
								{
									"balloonText": "[[title]]:[[value]]",
									"fillAlphas": 1,
									"id": "AmGraph-1",
									"title": "Total Users",
									"type": "column",
									"valueField": "column-1"
								},
								{
									"balloonText": "[[title]]:[[value]]",
									"fillAlphas": 1,
									"id": "AmGraph-2",
									"title": "Total "+emplpoyee_title,
									"type": "column",
									"valueField": "column-2"
								},
								{
									"balloonText": "[[title]]:[[value]]",
									"fillAlphas": 1,
									"id": "AmGraph-3",
									"title": "Total "+emplpoyer_title,
									"type": "column",
									"valueField": "column-3"
								},
								{
									"balloonText": "[[title]]:[[value]]",
									"fillAlphas": 1,
									"id": "AmGraph-4",
									"title": "Total "+tradesman_title,
									"type": "column",
									"valueField": "column-4"
								}
							],
							"guides": [],
							"valueAxes": [
								{
									"id": "ValueAxis-1",
									"title": ""
								}
							],
							"allLabels": [],
							"balloon": {},
							"legend": {
								"enabled": true,
								"useGraphSettings": true
							},
							/*"titles": [
								{
									"id": "Title-1",
									"size": 15,
									"text": "Chart Title"
								}
							],*/
							"dataProvider": [
								{
									"category": "Users",
									"column-1": data.data.total_users,
									"column-2": data.data.total_employees,
									"column-3": data.data.total_employers,
									"column-4": data.data.total_tradesman
								}
							]
						});

		});
	};

	var jobReport = function(){

		$('.spinner-section').show();

		var jsonData = {};
		jsonData.start_date = $('#start_date').val() || '';
		jsonData.end_date = $('#end_date').val() || '';

		var request = $.ajax({
			url: reportApiUrl+'/job',
			data: jsonData,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			
			AmCharts.makeChart("jobChart",{
							"type": "serial",
							"categoryField": "category",
							"colors": [
							"#2A0CD0",
							"#8A0CCF",
							"#CD0D74",
							"#754DEB"],
							"startDuration": 1,
							"categoryAxis": {
								"gridPosition": "start"
							},
							"trendLines": [],
							"graphs": [
								{
									"balloonText": "[[title]]:[[value]]",
									"fillAlphas": 1,
									"id": "AmGraph-1",
									"title": "Posted Jobs",
									"type": "column",
									"valueField": "column-1"
								},
								{
									"balloonText": "[[title]]:[[value]]",
									"fillAlphas": 1,
									"id": "AmGraph-2",
									"title": "Applied Jobs",
									"type": "column",
									"valueField": "column-2"
								},
								{
									"balloonText": "[[title]]:[[value]]",
									"fillAlphas": 1,
									"id": "AmGraph-3",
									"title": "Completed Jobs",
									"type": "column",
									"valueField": "column-3"
								}
							],
							"guides": [],
							"valueAxes": [
								{
									"id": "ValueAxis-1",
									"title": ""
								}
							],
							"allLabels": [],
							"balloon": {},
							"legend": {
								"enabled": true,
								"useGraphSettings": true
							},
							/*"titles": [
								{
									"id": "Title-1",
									"size": 15,
									"text": "Chart Title"
								}
							],*/
							"dataProvider": [
								{
									"category": "Jobs",
									"column-1": data.data.posted_jobs,
									"column-2": data.data.applied_jobs,
									"column-3": data.data.completed_jobs,
								}
							]
						});

		});
	};

	return {
		userReport:userReport,
		jobReport:jobReport
	}

}());

/* Logs */
Sababoo.App.Logs = (function() {

	var config = Sababoo.Config;
	var logApiUrl = config.getApiUrl()+'logs';

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var limit 			= $('#log-list-limit').val() || 0;
		var filterByModule 	= $('#logs_filter_by_module').val() || '';
		var filterByUser 	= $('#logs_filter_by_user').val() || 0;
		var start_date 		= $('#start_date').val() || '';
		var end_date 		= $('#end_date').val() || '';
		var data 			= {};
		var total_logs 	= $('#total_logs');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.start_date 	= start_date;
		data.end_date 		= end_date;
		data.filter_by_module	= filterByModule;
		data.filter_by_user	= filterByUser;
		
		var request = $.ajax({
			url: logApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var logs = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_logs.html(paginations.total);

			if(logs.length > 0) {

				$('#logs_list_head').html('<tr>\
		                                        <th width="21%"> Activity Date </th>\
		                                        <th> Activity</th>\
		                                    </tr>');

				$(logs).each(function(index, log){

					if (typeof log.activity != 'undefined' && typeof log.activity !== null && log.activity!='' ) {
						log.activity = log.activity;
					} else {
						log.activity = 'N/A';									
					}
					
					html += '<tr>\
                                <td class="highlight" width="21%"> '+log.created_at+' </td>\
                                <td class="hidden-xs"> '+log.activity+' </td>\
                            </tr>';

				});
			} else {
				$('#logs_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#logs_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.transaction-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.Logs.list(page);
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving logs.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#logs_list').html(html);
		});		
	};

	return {
		list:list
	}
}());

/* News Management */
Sababoo.App.News = (function() {

	var config = Sababoo.Config;
	var newsApiUrl = config.getApiUrl()+'news';

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var filterByStatus 	= $('#news_filter_by_status').val() || '';
		var filterByIndustry 	= $('#news_filter_by_industry').val() || 0;
		var keyword 		= $('#news_search_keyword').val() || '';
		var limit 			= $('#news-list-limit').val() || 0;
		var data 			= {};
		var total_news 		= $('#total_news');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.filter_by_status = filterByStatus;
		data.filter_by_industry = filterByIndustry;
		
		var request = $.ajax({
			url: newsApiUrl+'/list?page='+page,
			data:data,
			type: 'GET',
			dataType:'json'
		});

		request.done(function(data){
			$('.spinner-section').hide();
			var html = '';
			var paginationShow = '';
			var newses = data.data;
			var classDisabledPrev = "";
			var classDisabledNext = "";
			var paginations = data.pagination;
			total_news.html(paginations.total);

			if(newses.length > 0) {

				$('#news_list_head').html('<tr>\
		                                        <th> ID </th>\
		                                        <th> Title </th>\
		                                        <th> Description </th>\
		                                        <th> Industry </th>\
		                                        <th> Associated Jobs </th>\
		                                        <th> Status </th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(newses).each(function(index, news){

					var archiveText = '-';	
					var archiveClass = '';					
					var is_active = '';
					var statusText = 'N/A';

					if (typeof news.title != 'undefined' && typeof news.title !== null && news.title!='' ) {
						news.title = news.title;
					} else {
						news.title = 'N/A';									
					}

					if (typeof news.description != 'undefined' && typeof news.description !== null && news.description!='' ) {
						news.description = news.description;
					} else {
						news.description = 'N/A';									
					}

					if (typeof news.industry_name != 'undefined' && typeof news.industry_name !== null && news.industry_name!='' ) {
						news.industry_name = news.industry_name;
					} else {
						news.industry_name = 'N/A';									
					}

					if (typeof news.total_jobs != 'undefined' && typeof news.total_jobs !== null && news.total_jobs!='' ) {
						news.total_jobs = news.total_jobs;
					} else {
						news.total_jobs = '0';									
					}
					
					if (typeof news.is_active != 'undefined' && typeof news.is_active !== null ) {
						if(news.is_active == 1){
							statusText = 'Active';
							is_active = 0;
							archiveText = 'Deactivate';
							archiveClass = 'blue';
						}else{
							statusText = 'InActive';
							is_active = 1;
							archiveText = 'Activate';
							archiveClass = 'green-jungle';
						}
					}
					
					var can_update = '';
					if ($.inArray(38, hidden_operations) > -1) {
						can_update = '<a href="'+config.getAppUrl()+'/news?id='+news.id+'" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-edit"></i> Edit </a>';
					} else {
						can_update = '';
					}

					var can_update_status = '';
					if ($.inArray(38, hidden_operations) > -1) {
						can_update_status = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+archiveClass+' news_status" data-id="'+news.id+'" data-status="'+is_active+'">\
                                        <i class="fa fa-trash-o"></i> '+archiveText+' </a>';
					} else {
						can_update_status = '';
					}

					var can_delete = '';
					if ($.inArray(39, hidden_operations) > -1) {
						can_delete = '<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delete_news" data-id="'+news.id+'">\
                                        <i class="fa fa-trash-o"></i> Delete </a>';
					} else {
						can_delete = '';
					}

					html += '<tr>\
                                <td class="highlight"> '+news.id+' </td>\
                                <td class="hidden-xs"> '+news.title+' </td>\
                                <td class="hidden-xs"> '+news.description+' </td>\
                                <td class="hidden-xs"> '+news.industry_name+' </td>\
                                <td> '+news.total_jobs+' </td>\
                                <td> '+statusText+' </td>\
                                <td>\
                                    '+can_update+'\
                                    '+can_delete+'\
                                    '+can_update_status+'\
                                </td>\
                            </tr>';

				});
			} else {
				$('#news_list_head').html('');
				html  += '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>Nothing Here Yet.</h3>\
                    <p>We couldn\'t find any record related to the defined criteria. Please try again later.</p></div>';
			}

			$('#news_list').html(html);

            if(data.pagination.current >= data.pagination.next && data.pagination.current==1) {
				$('.general-pagination').hide();
				$('.role-pagination-limit').hide();
			} else {
				if(data.pagination.current==data.pagination.first){
					classDisabledPrev="disable";
				}
				if(data.pagination.current==data.pagination.last){
					classDisabledNext="disable";
				}
				paginationShow+='<li >\
								      <a class="general-pagination-click  '+classDisabledPrev+'" data-page='+paginations.previous+' href="javascript:;">Previous</a>\
								    </li>';
				paginationShow+= '<li >\
								      <a class=" general-pagination-click '+classDisabledNext+'" data-page='+paginations.next+' href="javascript:;">Next</a>\
								    </li>';
				paginationShow+= '<li class="hidden-xs">Showing '+data.pagination.to+' - '+data.pagination.from+' of total '+data.pagination.total+' records</li>';

				$('.general-pagination').html(paginationShow);
				$('.general-pagination').show();
				$('.general-pagination-limit').show();
			}

			$('.general-pagination-click').unbind('click').bind('click',function(e){
				e.preventDefault();
				var page  = $(this).data('page');
				Sababoo.App.News.list(page);
		    });

		    $('.delete_news').unbind('click').bind('click',function(e){
				e.preventDefault();
				var news_id  = $(this).attr('data-id');
				$('#hidden_action_news_id').val(news_id);
				$('#removeConfirmation').modal('show');
		    });

		    $('.news_status').unbind('click').bind('click',function(e){
				e.preventDefault();
				var news_id  = $(this).attr('data-id');
				var status  = $(this).attr('data-status');
				$('#hidden_action_news_id').val(news_id);
				$('#hidden_action_news_status').val(status);

				if (status == 1) {
					$('#update_status_text').text('Activate');
				} else if (status == 0) {
					$('#update_status_text').text('Deactivate');
				}
				$('#updateStatusConfirmation').modal('show');
		    });
		});

		request.fail(function(jqXHR, textStatus){

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while retrieving news.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}

			var html = '<div class="blank-data">\
                	<img src="'+config.getImageUrl()+'emptystate@2x.png" class="img-responsive">\
                    <h3>'+error+'</h3></div>';
            $('#news_list').html(html);
		});		
	};

	var create = function (){

		var errors = [];
		var news_id = $('#updated_news_id').val();
		var title 	= $('#news_title');

		var industry_id 	= $('#news_industry');

		if ($.trim(industry_id.val()) == 0) {
			errors.push('Please select industry.');
			industry_id.parent().parent().addClass('has-error');
		} else {
			industry_id.parent().parent().removeClass('has-error');	
		}

		if ($.trim(title.val()) == '') {
			errors.push('Please enter title.');
			title.parent().addClass('has-error');
		} else {
			title.parent().removeClass('has-error');	
		}

		var description 	= $('#news_description');

		if ($.trim(description.val()) == '') {
			errors.push('Please enter description.');
			description.parent().addClass('has-error');
		} else {
			description.parent().removeClass('has-error');	
		}

		

		if (errors.length < 1) {

			var jsonData = {
								id:news_id,
								title:$.trim(title.val()),
								description:$.trim(description.val()),
								industry_id:$.trim(industry_id.val())													
							}

			if (jsonData.id == 0) {
				var request = $.ajax({
					url: newsApiUrl+'/create',
					data: jsonData,
					type: 'post',
					dataType:'json'
				});
			} else {
				var request = $.ajax({	
					url: newsApiUrl+'/update',
					data: jsonData,
					type: 'put',
					dataType:'json'
				});
			}
			
			$('#news_submit_btn').addClass('prevent-click');
			$('#submit_loader').show();

			request.done(function(data){
				
				$('#submit_loader').hide();
				if(data.success) {		 
						$('#msg_div').removeClass('alert-danger');
						$('#msg_div').html(data.success.messages[0]).addClass('alert-success').show().delay(2000).fadeOut(function()
						{
							window.location.href = config.getAppUrl()+'/newses';
					    });		 	
				} else if(data.error) {
					$('#news_submit_btn').removeClass('prevent-click');
					var message_error = data.error.messages[0];
					$('#msg_div').removeClass('alert-success');
					$('#msg_div').html(message_error).addClass('alert-danger').show();
				}
				
			});

			request.fail(function(jqXHR, textStatus){
				$('#news_submit_btn').removeClass('prevent-click');
				$('#submit_loader').hide();
				var jsonResponse = $.parseJSON(jqXHR.responseText);
				var error = 'An error occurred.';
				if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
					error = jsonResponse.error.messages[0];
				}
				$('#msg_div').removeClass('alert-success');
				$('#msg_div').html(error).addClass('alert-danger').show();
			});	

		} else {
			$('#msg_div').removeClass('alert-success');
			$('#msg_div').html(errors[0]).addClass('alert-danger').show();
			$('#news_submit_btn').removeClass('prevent-click');
			$('#submit_loader').hide();
		}		
	};

	var view = function(id){
        var jsonData = {id:id};
		var request = $.ajax({
			url: newsApiUrl+'/view',
			data: jsonData,
			type: 'GET',
			dataType:'json'
		});

		request.success(function(data){
			$('#news_title').val(data.title);
			$('#news_description').val(data.description);
			$('#news_industry').val(data.industry_id);
		});

		request.fail(function(jqXHR, textStatus){
			// do something
		});
    };

	var remove = function (){
		var id = $('#hidden_action_news_id').val();
		$('#news_remove_btn').addClass('prevent-click');
		$('#remove_submit_loader').show();

		var request = $.ajax({
			url: newsApiUrl+'/remove',
			data: {id:id},
			type: 'delete',
			dataType:'json'
		});

		request.done(function(data){
			
			$('#remove_submit_loader').hide();
			if (data.success) {
				var html = 'News has been deleted successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#remove_msg_div').removeClass('alert-danger');
		 		$('#remove_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#news_remove_btn').removeClass('prevent-click');
				    $('#removeConfirmation').modal('hide');
				    Sababoo.App.News.list();	
			    });

			} else if (data.error) {

				var error = 'An error occurred while deleting this news.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#news_remove_btn').removeClass('prevent-click');
				$('#remove_msg_div').removeClass('alert-success');
				$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
				    $(this).html('');
				    $('#remove_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#news_remove_btn').removeClass('prevent-click');
			$('#remove_submit_loader').hide();

			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while deleting this news.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	var updateStatus = function (){
		
		var jsonData = {};
		jsonData.id = $('#hidden_action_news_id').val();
		jsonData.status = $('#hidden_action_news_status').val();

		var request = $.ajax({
			url: newsApiUrl+'/update-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#news_status_btn').addClass('prevent-click');
		$('#status_submit_loader').show();

		request.done(function(data){
			
			$('#status_submit_loader').hide();
			
			if (data.success) {
				var html = 'Status has been updates successfully.';
				
				if (data.success.messages && data.success.messages.length > 0 ) {
					html = data.success.messages[0];
				}

				$('#status_msg_div').removeClass('alert-danger');
		 		$('#status_msg_div').html(html).addClass('alert-success').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $(this).removeClass('alert-success');
				    $('#news_status_btn').removeClass('prevent-click');
				    $('#updateStatusConfirmation').modal('hide');
				    Sababoo.App.News.list();		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating news status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#news_status_btn').removeClass('prevent-click');
				$('#status_msg_div').removeClass('alert-success');
				$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#news_status_btn').removeClass('prevent-click');
			$('#status_submit_loader').hide();
			var jsonResponse = $.parseJSON(jqXHR.responseText);
			var error = 'An error occurred while updating news status.';
			if (jsonResponse.error.messages && jsonResponse.error.messages.length > 0) {
				error = jsonResponse.error.messages[0];
			}
			$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
			    $(this).html('');
			    $(this).removeClass('alert-danger');
			});
		});		
	};

	return {
		list:list,
		create:create,
		remove:remove,
		updateStatus:updateStatus,
		view:view
	}
}());

