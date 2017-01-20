var isScrLock2 = false;
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
        

            preloaderToggleSrcLock();
            $('.msg_ok , .msg_error').hide();
        },
        complete: function () {

           // toggleSrcLock();
            preloaderToggleSrcLock();
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
                    response_data = data;
                    if (data.code == 200) {

                        response_data = data;
                        hideSucessDiv();
                    }
                    if (data.code == 301) {
                        if(msg=="Unauthorized"){                            
                            // popup_session('Error','Session Expired, taking you to login page again.',function(){window.location = data.url;});
                            popup("session_expire",350);
                            $("#session_expire").dialog("open");
                            window.location = data.url;
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
                $('#' + "msg_" + frm_id).removeClass('msg_' + remove_msg_class +' ,msg_error').addClass('msg_' + status).css('display', 'block').html(getFormatedMessages(msg));
            }

            if (fn)  fn(response_data);

        },

        error: function (jqXHR, textStatus, errorThrown) {

            remove_msg_class = 'ok';
            msg = 'Invalid response from server. Please contact Sababoo.';
            key = '';

            if (textStatus === "timeout") msg = 'Connection Timeout, Please retry.';

            $('#' + "msg_" + frm_id).removeClass('msg_' + remove_msg_class).addClass('msg_' + status).css('display', 'block').html(getFormatedMessages(msg));

        }
    });
}

function imgError(image) {
        image.onerror = "";
        image.src = "/assets/frontend/images/site/dummy-user.jpg";
        return true;
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

function preloaderToggleSrcLock() {

    if(isScrLock2) {
        isScrLock2 = false;
        $('.preloader').hide();
        return;
    }
    isScrLock2 = true;
    $('.preloader').show();
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
function hideSucessDiv(){
    setTimeout(function() {
        try {
            $(".msg_ok").hide('blind', {}, 500)
        }
        catch($e)
        {

        }
    }, 5000);
}

function readonlyTokenField(id)
{
    $(id).keypress(function(e) { 
        $(this).val('');
        e.preventDefault();
    });    
}

readonlyTokenField('#user_skills-tokenfield');
readonlyTokenField('#user_skills');
$( document ).ready(function() {

    getUserLanguages();






    $.getJSON( "user/skills", function( data ) {
        $('#user_skills').tokenfield();
        $('#user_skills').tokenfield('setTokens', data);

        readonlyTokenField('#user_skills-tokenfield');

    });

   
    $.getJSON( "skill", function( data ) {
        var stocks = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('skill'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: data
        });

        stocks.initialize();

        $('#all_skills').typeahead(
            null, {
            name: 'skills',
            displayKey: 'skill',
            source: stocks.ttAdapter()
        }).on('typeahead:selected', function(event, data){

            setTimeout(function(){
                $('#all_skills').val('');
            }, 100);


        var userSkills = $('#user_skills').tokenfield('getTokensList');


        if( userSkills.split(',').indexOf(data.id.toString()) > -1 ) 
        {
            alert('Skill already exsits')
        }
        else
        {
            $('#user_skills').tokenfield('createToken', { value: data.id, label: data.skill });
            userSkills = userSkills.replace(/\s/g,"");;            
        }




        




        });

    });


});


function saveSkills()
{
    //var request_data = {"user_skills":$('#user_skills').tokenfield('getTokensList')};
    pageURI = 'user/skills';
    var request_data = $('#user_skills').serializeArray();
    mainAjax('skill_form', request_data, 'PUT',skillCallback);
}

function saveUserLanguages()
{
    // var request_data = {"user_skills":$('#user_skills').tokenfield('getTokensList')};
    pageURI = 'languages';
    var request_data = $('#language_form').serializeArray();
    mainAjax('#language_form', request_data, 'PUT',languagesCallback);
}

function languagesCallback(data)
{
    if(data.status == 'ok')
    {
        $('#global_message').show().html(data.message).delay(4000).fadeOut();
    }
}


function saveInterests()
{
    // var request_data = {"user_skills":$('#user_skills').tokenfield('getTokensList')};
    pageURI = 'user/interest';
    var request_data = {"interests":$('#interests').val()};
    mainAjax('#language_form', request_data, 'PUT',interestCallback);
}

function interestCallback(data)
{

    if(data.status == 'ok')
    {

        $('#global_message').show().html(data.msg).delay(4000).fadeOut();
    }
}


function skillCallback(data)
{
    if(data.status == 'ok')
    {
        $('#global_message').show().html(data.message).delay(4000).fadeOut();
    }
}


function getUserLanguages()
{
    pageURI = 'user/languages';
    mainAjax('', {}, 'GET',languageRender);
}

function languageRender(data)
{
    if(data.data.length > 0)
    {
        $.each(data.data, function( index, language ) {                
            addMoreLanguage(index, language.language, language.proficiency);            
        });
    }
    else
    {
        addMoreLanguage(0, '', '');
    }
}
function removeLanguage(obj)
{
    $(obj).next().remove();
    $(obj).next().remove();
    $(obj).remove();
}

function addMoreLanguage(mode, language, proficiency)
{
    var cancelHtml = '';
    var optionsObj = {"": "Proficiency...", "elementary":"Elementary proficiency",
                  "limited_working": "Limited working proficiency", "professional_working":"Professional working proficiency",
                  "full_professional": "Full professional proficiency", "native_or_bilingual":"Native or bilingual proficiency"};

    var options = '';
    $.each(optionsObj, function( index, value ) {
        if(index == proficiency)
            var selected = 'selected';
        else
            var selected = '';

        options += '<option '+selected+' value="'+index+'">'+value+'</option>';

    });

    if(mode != 0)
    {
        cancelHtml = '<span onclick="removeLanguage(this);" class="dynamic-add-form-close add-more-cancel">\
                        <i class="fa fa-times" aria-hidden="true"></i>\
                        </span>';

    }

    var html =  cancelHtml + '<div class="col-sm-4"> \
                    <div class="form-group">\
                        <label>Langauage</label>\
                        <input type="text" value="'+language+'" class="form-control" name="user_language[]">\
                    </div>\
                </div>\
                \
                <div class="col-sm-4">\
                    <div class="form-group">\
                        <label>Proficiency</label>\
                            <select class="form-control" name="language_proficiency[]">\
                            '+options+'\
                            </select>\
                    </div>\
                </div> <div  style="clear:both;"></div>';





    $( "#language_container"  ).append( html);
}



