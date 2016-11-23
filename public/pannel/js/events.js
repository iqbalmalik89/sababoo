$('#forget-password').click(function() {
    $('.login-form').hide();
    $('.forget-form').show();
});

$('#back-btn').click(function() {
    $('.login-form').show();
    $('.forget-form').hide();
});

$('#user_activation_btn').click(function(){
    Sababoo.App.User.createPassword();
});

$('#sign-in-btn').click(function(){
    Sababoo.App.User.login();
});

$('#user-logout').click(function(){
    Sababoo.App.User.logout();
});

$('#forgot_send').click(function(){
    Sababoo.App.User.forgotPassword();
});

$('#reset_btn').click(function(){
    Sababoo.App.User.resetPassword();
});

// user management events
$('#user-list-limit').change(function(){
    Sababoo.App.User.list();
});

$('#user_search_keyword').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.User.list();
    }
});

$('#user_submit_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.User.create();
});

$('#user_remove_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.User.remove();
});

$('#user_status_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.User.updateStatus();
});

$('#profile_password_submit_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.User.updatePassword();
});

$('#profile_submit_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.User.updateAccount();
});

