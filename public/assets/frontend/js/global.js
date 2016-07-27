 function mainAjax(frm_id, request_data, method_type, fn, complete_callback) {

        $('.msg').hide();

        if (!method_type) {
            method_type = 'GET';
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        status = 'error';

        $.ajax({
            type: method_type,
            url: pageURI,
            data: request_data,
            dataType: 'json',
            timeout: 0,
            beforeSend: function () {
                $('#update_'+frm_id).prop('disabled', true);
                 toggleSrcLockForm(frm_id);
                $('.msg_ok , .msg_error').hide();
            },
            complete: function () {
               $('#update_'+frm_id).prop('disabled', false);
                toggleSrcLockForm(frm_id);
                if(typeof(complete_callback) == "function")
                {
                    complete_callback();
                }
            },
            success: function (response, textStatus, jqXHR) {

                status = 'error';
                msg = 'Invalid response from server. Please contact Sababoo.';
                key = '';
               response_data = null;
                if (typeof(jqXHR) == 'object') {
                    data = jQuery.parseJSON(jqXHR.responseText);
                    if (typeof(data.code) != 'undefined') {
                        status = data.status;
                        msg = data.msg;
                        key = data.key;

                        if (data.code == 200) {
                            response_data = data;
                        }
                        if (data.code == 301) {
                            if(msg=="Unauthorized"){
                                popLoginError('Error','Session Expired, taking you to login page again.',function(){window.location = data.url;});
                                return false;
                            }

                            window.location = data.url;
                        }
                    }

                }

                // Display message.
                remove_msg_class = 'ok';
                if (status == 'ok') remove_msg_class = 'cancel';

                if ( (msg != "") && (typeof(msg)!='undefined')) {
                     $('#' + "msg_" + frm_id).removeClass('msg_' + remove_msg_class +' ,msg_error').addClass('msg_' + status).css('display', 'block').html(msg);
                }
                if (fn)  fn(response_data);

            },

            error: function (jqXHR, textStatus, errorThrown) {

                remove_msg_class = 'ok';
                msg = 'Invalid response from server. Please contact Sababoo.';
                key = '';

                if (textStatus === "timeout") msg = 'Connection Timeout, Please retry.';

                $('#' + "msg_" + frm_id).removeClass('msg_' + remove_msg_class).addClass('msg_' + status).css('display', 'block').html(msg);

            }
        });
    }
	
	
function toggleSrcLock() {
	if(isScrLock) {
		isScrLock = false;
		$('.loader').hide();
		return;
	}
	isScrLock = true;
	$('.loader').show();
}
// Messages
function getFormatedMessages(msg){
    if(msg){
        all_mass =  msg.split("|");
        var err = "<ul>";
        for(i=0;i<all_mass.length;i++){
            if(all_mass[i]) {
                err += "<li>" + all_mass[i] + "</li>";
            }
        }
        err+="</ul>";
        return err;
    }
}


// Function for login with "Enter" key.
function submit_key(pass_fld, login_btn){
    $('#'+pass_fld).keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            $('#'+login_btn).trigger('click');
        }
    });
}

function set_focus_submit(pass_fld, login_btn){
    $('#'+pass_fld).focus();
    setTimeout(function() { $("#"+pass_fld).focus(); },2000);
    /*
    $('#'+pass_fld).keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            $('#'+login_btn).trigger('click');
        }
    });
    */
}

function goToByScroll(id){
    // Remove "link" from the ID
    // id = id.replace("link", "");
    // Scroll
    $('html,body').animate({
            scrollTop: $("#"+id).offset().top},
        1000);
}