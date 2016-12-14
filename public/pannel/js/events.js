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

$('#user-login-email').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.User.login();
    }
});

$('#user-login-password').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.User.login();
    }
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
    Sababoo.App.User.listAdmin();
});

$('#user_filter_by_role').change(function(){
    Sababoo.App.User.listAdmin();
});

$('#user_filter_by_status').change(function(){
    Sababoo.App.User.listAdmin();
});

$('#user_search_keyword').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.User.listAdmin();
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

// site users
$('#site-user-list-limit').change(function(){
    Sababoo.App.User.listSite();
});

$('#site_user_filter_by_role').change(function(){
    Sababoo.App.User.listSite();
});

$('#site_user_filter_by_status').change(function(){
    Sababoo.App.User.listSite();
});

$('#site_user_search_keyword').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.User.listSite();
    }
});

$('#site_user_remove_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.User.remove();
});

$('#site_user_status_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.User.updateStatus();
});

// job events
$('#job-list-limit').change(function(){
    Sababoo.App.Jobs.list();
});

$('#job_filter_by_status').change(function(){
    Sababoo.App.Jobs.list();
});

$('#job_remove_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Jobs.remove();
});

$('#job_status_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Jobs.updateStatus();
});

$('#job_search_keyword').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.Jobs.list();
    }
});

// Role events
$('#role-list-limit').change(function(){
    Sababoo.App.Role.list();
});

$('#role_filter_by_status').change(function(){
    Sababoo.App.Role.list();
});

$('#role_submit_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Role.create();
}); 

$('#role_remove_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Role.remove();
});

$('#role_status_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Role.updateStatus();
});

$('#role_search_keyword').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.Role.list();
    }
});


// Skills events
$('#skill-list-limit').change(function(){
    Sababoo.App.Skills.list();
});

$('#skill_filter_by_status').change(function(){
    Sababoo.App.Skills.list();
});

$('#skill_submit_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Skills.create();
}); 

$('#skill_remove_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Skills.remove();
});

$('#skill_status_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Skills.updateStatus();
});

$('#skill_search_keyword').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.Skills.list();
    }
});

// Industries events
$('#industry-list-limit').change(function(){
    Sababoo.App.Industry.list();
});

$('#industry_filter_by_status').change(function(){
    Sababoo.App.Industry.list();
});

$('#industry_submit_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Industry.create();
}); 

$('#industry_remove_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Industry.remove();
});

$('#industry_status_btn').click(function(e){
    e.preventDefault();
    Sababoo.App.Industry.updateStatus();
});

$('#industry_search_keyword').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.Industry.list();
    }
});

$('#cv_download_btn').click(function(e){
    e.preventDefault();
    var cv_name = $(this).attr('data-name');
    $('#cv_iframe').attr('src', Sababoo.Config.getDocUrl()+'users_cv/'+cv_name)
});


// transactions
$('#transaction-list-limit').change(function(){
    Sababoo.App.Transaction.list();
});

$('#transaction_search_keyword').keypress(function(event){
    if(event.which == '13'){
        Sababoo.App.Transaction.list();
    }
});

$('#transaction_filter_date_btn').click(function(){
    Sababoo.App.Transaction.list();
});

