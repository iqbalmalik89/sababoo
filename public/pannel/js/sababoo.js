var Sababoo = Sababoo || {}; // "If Sababoo is not defined, make it equal to an empty object"
Sababoo.App = Sababoo.App || {};
Sababoo.Config = Sababoo.Config || {};

var localStorage;
var localStorageData = localStorage.getItem('sababoo_admin');
var jsonLocalStorageData = JSON.parse(localStorageData);

Sababoo.Config = (function(){
	if(window.location.host == 'localhost'){
		var apiUrl = window.location.protocol+'//'+window.location.host+'/sababoo/public/api/';
		var appUrl = window.location.protocol+'//'+window.location.host+'/sababoo/public/admin';
		var siteUrl = window.location.protocol+'//'+window.location.host+'/sababoo/public';
		var imageUrl = window.location.protocol+'//'+window.location.host+'/sababoo/public/pannel/images/';
	} else {
		var apiUrl = window.location.protocol+'//'+window.location.host+'/api/';
		var appUrl = window.location.protocol+'//'+window.location.host+'/admin';
		var siteUrl = window.location.protocol+'//'+window.location.host+'';
		var imageUrl = window.location.protocol+'//'+window.location.host+'/pannel/images/';
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

	return {
		getApiUrl:getApiUrl,
		getAppUrl:getAppUrl,
		getSiteUrl:getSiteUrl,
		getImageUrl:getImageUrl
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
						window.location.href = config.getAppUrl()+'/users';
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

	var list = function (page) {

		$('.spinner-section').show();
		var page 			= page || 1;
		var pagination 		= true;
		var filterByStatus 	= $('#filter_by_status').val() || '';
		var keyword 		= $('#user_search_keyword').val() || '';
		var limit 			= $('#user-list-limit').val() || 0;
		var data 			= {};
		var total_users 	= $('#total_users');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.filterByStatus = filterByStatus;
		
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
					
					if (typeof user.is_active != 'undefined' && typeof user.is_active !== null ) {
						if(user.is_active == 1){
							statusText = 'Active';
							is_active = 0;
							archiveText = 'In-Activate';
							archiveClass = 'green';
						}else{
							statusText = 'InActive';
							is_active = 1;
							archiveText = 'Activate';
							archiveClass = 'blue';
						}
					}
					
					html += '<tr>\
                                <td class="highlight"> '+user.id+' </td>\
                                <td class="hidden-xs"> '+user.name+' </td>\
                                <td> '+user.email+' </td>\
                                <td> '+statusText+' </td>\
                                <td>\
                                    <a href="'+config.getAppUrl()+'/user?id='+user.id+'" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-edit"></i> Edit </a>\
                                    <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delete_user" data-id="'+user.id+'">\
                                        <i class="fa fa-trash-o"></i> Delete </a>\
                                    <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+archiveClass+' user_status" data-id="'+user.id+'" data-status="'+is_active+'">\
                                        <i class="fa fa-trash-o"></i> '+archiveText+' </a>\
                                </td>\
                            </tr>';

				});
			} else {
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
				Sababoo.App.User.list(page);
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
					$('#update_status_text').text('In-Activate');
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

	var create = function (){

		var errors = [];
		var user_id = $('#updated_user_id').val();
		var name 	= $('#user_name');
		var email 	= $('#user_email');

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

		if (errors.length < 1) {

			var jsonData = {
								id:user_id,
								name:$.trim(name.val()),
								email:$.trim(email.val())																
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
		var id = $('#hidden_action_user_id').val();
		$('#user_remove_btn').addClass('prevent-click');
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
				    $('#user_remove_btn').removeClass('prevent-click');
				    $('#removeConfirmation').modal('hide');
				    Sababoo.App.User.list();	
			    });

			} else if (data.error) {

				var error = 'An error occurred while deleting this user.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#user_remove_btn').removeClass('prevent-click');
				$('#remove_msg_div').removeClass('alert-success');
				$('#remove_msg_div').html(error).addClass('alert-danger').show().delay(3000).fadeOut(function(){
				    $(this).html('');
				    $('#remove_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#user_remove_btn').removeClass('prevent-click');
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
		jsonData.id = $('#hidden_action_user_id').val();
		jsonData.status = $('#hidden_action_user_status').val();

		var request = $.ajax({
			url: userApiUrl+'/update-status',
			data: jsonData,
			type: 'put',
			dataType:'json'
		});

		$('#user_status_btn').addClass('prevent-click');
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
				    Sababoo.App.User.list();		
			    });

			} else if (data.error) {

				var error = 'An error occurred while updating user status.';
				if (data.error.messages && data.error.messages.length > 0) {
					error = data.error.messages[0];
				}
				$('#user_status_btn').removeClass('prevent-click');
				$('#status_msg_div').removeClass('alert-success');
				$('#status_msg_div').html(error).addClass('alert-danger').show().delay(2000).fadeOut(function(){
				    $(this).html('');
				    $('#status_msg_div').removeClass('alert-danger');
				});
			}
				
		});

		request.fail(function(jqXHR, textStatus){
			$('#user_status_btn').removeClass('prevent-click');
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
		list:list,
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
		var filterByStatus 	= $('#filter_by_status').val() || '';
		var keyword 		= $('#job_search_keyword').val() || '';
		var limit 			= $('#job-list-limit').val() || 0;
		var data 			= {};
		var total_jobs 	= $('#total_jobs');

		data.pagination 	= pagination;
		data.page 			= page;
		data.limit 			= limit;
		data.keyword 		= keyword;
		data.filterByStatus = filterByStatus;
		
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
		                                        <th> User Name </th>\
		                                        <th> Job Title </th>\
		                                        <th> Industry </th>\
		                                        <th> Type </th>\
		                                        <th> Salary </th>\
		                                        <th> Status </th>\
		                                        <th> Action</th>\
		                                    </tr>');

				$(jobs).each(function(index, job){

					var archiveText = '-';	
					var archiveClass = '';					
					var is_active = '';
					var statusText = 'N/A';

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
							archiveText = 'In-Activate';
							archiveClass = 'green';
						}else{
							statusText = 'InActive';
							is_active = 1;
							archiveText = 'Activate';
							archiveClass = 'blue';
						}
					}
					
					html += '<tr>\
                                <td class="highlight"> '+job.id+' </td>\
                                <td class="hidden-xs"> '+job.user_name+' </td>\
                                <td class="hidden-xs"> '+job.name+' </td>\
                                <td> '+job.industry_name+' </td>\
                                <td> '+job.type+' </td>\
                                <td> '+job.salary+' </td>\
                                <td> '+statusText+' </td>\
                                <td>\
                                	<a href="'+config.getAppUrl()+'/job?id='+job.id+'" target="_blank" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-eye"></i> View </a>\
                                    <a href="'+config.getSiteUrl()+'/job/post?id='+job.id+'" target="_blank" class="btn btn-outline btn-circle dark btn-sm black">\
                                        <i class="fa fa-edit"></i> Edit </a>\
                                    <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delete_job" data-id="'+job.id+'">\
                                        <i class="fa fa-trash-o"></i> Delete </a>\
                                    <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm '+archiveClass+' job_status" data-id="'+job.id+'" data-status="'+is_active+'">\
                                        <i class="fa fa-trash-o"></i> '+archiveText+' </a>\
                                </td>\
                            </tr>';

				});
			} else {
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
					$('#update_status_text').text('In-Activate');
				}
				$('#updateStatusConfirmation').modal('show');
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

	return {
		list:list,
		updateStatus:updateStatus,
		remove:remove
	}
}());

