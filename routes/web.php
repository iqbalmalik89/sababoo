<?php


Route::get('/clear-cache', function() {
	$exitCode = Artisan::call('cache:clear');
	// return what you want
});


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|


*/
/*REGISTRATION ROUTE*/
Route::get('/signup', function () {
    return view('frontend.auth.signup');
});
Route::post('ui/createuser', 'RegisterController@createUser');
Route::get('/ui/activate', 'RegisterController@activateUser');

/*LOGIN ROUTE*/

/*Route::get('/login', function () {
    return view('frontend.auth.login');
});*/

Route::post('auth/login', 'UI\Auth\AuthController@postLogin');
Route::get('auth/logout', 'UI\Auth\AuthController@getLogout');



/*FORGOT PASSWORD */
Route::match(['get', 'post'], '/ui/forgotpw', ['uses' => 'ForgotPasswordController@index', 'as' => 'forgotpw']);


//Auth::routes();
Route::get('/login', 'HomeController@showLogin');
Route::get('/', 'HomeController@index');
Route::get('/about-us', 'HomeController@showAboutUs');
Route::get('/contact-us', 'HomeController@showContactUs');

Route::group(['middleware' => ['web']], function () {

Route::get('/home', 'HomeController@showHome');
Route::get('/payments', 'HomeController@showPayments');
Route::get('/success-payment', 'HomeController@showSuccessPayment');
Route::get('/failure-payment', 'HomeController@showFailurePayment');
Route::get('/profile-update', 'HomeController@showProfileUpdate');

/************************************EMPLOYEE********************************************/
Route::get('/employee', 'EmployeeController@index');
Route::match(['get', 'post'], '/employee/update_basic_info', ['uses' => 'EmployeeController@updateBasicInfo']);
Route::match(['get', 'post'], '/employee/add_education', ['uses' => 'EmployeeController@addEducation']);
Route::match(['get', 'post'], '/employee/edit_education', ['uses' => 'EmployeeController@editEducation']);
Route::match(['get', 'post'], '/employee/add_experience', ['uses' => 'EmployeeController@addExperience']);
Route::match(['get', 'post'], '/employee/edit_experience', ['uses' => 'EmployeeController@editExperience']);

    // Skill routes
Route::get('skill', 'UI\SkillController@get');
Route::put('user/skills', 'UI\SkillController@updateUserSkills');
Route::get('user/skills', 'UI\SkillController@getUserSkills');

//Language routes
Route::get('user/languages', 'UI\LanguageController@getUserLanguages');
Route::put('user/languages', 'UI\LanguageController@updateUserLanguages');
Route::put('user/interest', 'EmployeeController@updateUserInterest');
// Resume
Route::match(['get', 'post'], '/employee/upload_resume', ['uses' => 'EmployeeController@resumeUpload']);
Route::match(['get', 'post'], '/employee/download_resume/{name}', ['uses' => 'EmployeeController@downloadResume']);

Route::match(['get', 'post'], '/employee/view/{id}', ['uses' => 'EmployeeController@viewEmployee']);

	


/***********************************END OF EMPLOYEE*************************************/
/**********************************EMPLOYER ROUTE *************************************/

Route::match(['get', 'post'], '/employer/update_employer', ['uses' => 'UI\EmployerController@updateEmployer']);
Route::match(['get', 'post'], '/employer/password', ['uses' => 'UI\EmployerController@password']);
Route::match(['get', 'post'], '/employer/view/{id}', ['uses' => 'UI\EmployerController@viewEmployer']);


    /********************************TRADESMAN***********************************************/
Route::match(['get', 'post'], '/tradesman/update_basic_info', ['uses' => 'UI\TradesmanController@updateBasicInfo']);
Route::match(['get', 'post'], '/tradesman/view/{id}', ['uses' => 'UI\TradesmanController@viewTradesman']);


    /********************************Admin User***********************************************/
Route::match(['get', 'post'], '/admin_user/update_basic_info', ['uses' => 'UI\AdminUserController@updateBasicInfo']);





    /************************************USERS ROUTE*************************************************/
Route::match(['get', 'post'], '/user/imageUpload', ['uses' => 'UI\UserController@uploadImage']);
// Password
Route::match(['get', 'post'], '/user/password_update', ['uses' => 'UI\UserController@passwordUpdate']);
Route::match(['get', 'post'], '/user/add_certification', ['uses' => 'UI\UserController@addCertification']);
Route::match(['get', 'post'], '/user/edit_certification', ['uses' => 'UI\UserController@editCertification']);
Route::match(['get', 'post'], '/user/add_files', ['uses' => 'UI\UserController@addFiles']);
Route::match(['get', 'post'], '/user/delete_user_file', ['uses' => 'UI\UserController@DeleteUserFile']);
Route::match(['get', 'post'], '/user/download_files/{file_id}', ['uses' => 'UI\UserController@DownloadFiles']);

Route::match(['get', 'post'], '/user/list_users', ['uses'=>'UI\UserController@listUsers']);
Route::match(['get', 'post'], '/user/view-profile/{id}', ['uses'=>'UI\UserController@viewProfile']);

Route::post('contact-us', 'UI\JobPostController@contactUs');

/************************************JOB POSTING *****************************************************/
Route::match(['get', 'post'], '/job/post', ['uses' => 'UI\JobPostController@jobPost']);
Route::match(['get', 'post'], '/job/job_create', ['uses' => 'UI\JobPostController@jobCreate']);
Route::match(['get', 'post'], '/job/user_job_list', ['uses' => 'UI\JobPostController@userJobList']);
Route::match(['get', 'post'], '/job/job_delete', ['uses' => 'UI\JobPostController@delJob']);
Route::match(['get', 'post'], '/job/search_jobs', ['uses' => 'UI\JobPostController@searchJob']);
Route::match(['get', 'post'], '/job/view/{id}', ['uses' => 'UI\JobPostController@viewJob']);
Route::match(['get', 'post'], '/job/apply', ['uses' => 'UI\JobPostController@applyJob']);
Route::match(['get', 'post'], '/job/user_applied_jobs', ['uses' => 'UI\JobPostController@userAppliedJobs']);
Route::match(['get', 'post'], '/job/job-proposals/{id}', ['uses' => 'UI\JobPostController@jobProposalsList']);
Route::match(['get', 'post'], '/job/news/{id}', ['uses'=>'UI\JobPostController@getNewsByIndustry']);

/************************************* Job Work Stream *********************************************************/
 Route::match(['get', 'post'], ' /job/work-stream', ['uses' => 'UI\JobPostController@workStream']);

// PayPal
Route::post('job/paypal/payment',['uses'=>'UI\JobPostController@payment']);
Route::post('job/paypal/ask-refund',['uses'=>'UI\JobPostController@askRefund']);
Route::match(['get', 'post'], '/transactions', ['uses'=>'UI\JobPostController@userTransactions']);

Route::post('job/create-dispute',['uses'=>'UI\JobPostController@createDispute']);
Route::match(['get', 'post'], '/job/job-disputes/{id}', ['uses' => 'UI\JobPostController@jobDisputesList']);

Route::get('/companies', ['uses'=>'UI\JobPostController@getCompanies']);
Route::post('/companies', ['uses'=>'UI\JobPostController@getCompanies']);

/************************************NETWORK*********************************************************/
 Route::match(['get', 'post'], '/network/connection', ['uses' => 'UI\NetworkController@myConnections']);
 Route::match(['get', 'post'], '/network/send_recom', ['uses' => 'UI\NetworkController@sendRecom']);
 Route::match(['get', 'post'], 'ui/network/get_recommendation/{id}', ['uses' => 'UI\NetworkController@getRecom']);
 Route::match(['get', 'post'], 'network/accept_recommendation/{id}', ['uses' => 'UI\NetworkController@acceptRecom']);
 Route::match(['get', 'post'], 'network/reject_recommendation/{id}', ['uses' => 'UI\NetworkController@rejectRecom']);
 Route::match(['get', 'post'], '/network/people_find', ['uses' => 'UI\NetworkController@getPeopleList']);

/**************************************COMMENTS********************************************************/
 Route::match(['get', 'post'], ' /comments/getComments', ['uses' => 'UI\CommentController@getComments']);
 Route::match(['get', 'post'], ' /comments/add_comment', ['uses' => 'UI\CommentController@addComment']);
 Route::match(['get', 'post'], ' /comments/update_comment', ['uses' => 'UI\CommentController@updateComment']);
 Route::match(['get', 'post'], '/comments/delete_comment', ['uses' => 'UI\CommentController@deleteComment']);
 Route::match(['get', 'post'], '/comments/send_comment_email', ['uses' => 'UI\CommentController@sendCommentEmail']);


/*************************************CHAT**********************************************************************/
Route::get('/message-requests', ['uses'=>'UI\ChatController@allRequests']);
 Route::match(['get', 'post'], ' /send_message/{id}', ['uses' => 'UI\ChatController@index']);
 Route::match(['get', 'post'], ' /user_send_message', ['uses' => 'UI\ChatController@SendMessage']);
 Route::match(['get', 'post'], ' /user_view_message', ['uses' => 'UI\ChatController@viewMessages']);
 Route::match(['get', 'post'], ' /user_view_message_jason', ['uses' => 'UI\ChatController@viewMessagesJason']);
 Route::match(['get', 'post'], ' /chat/get_users_message', ['uses' => 'UI\ChatController@getUserMessageById']);
 Route::match(['get', 'post'], ' /chat/save_user_messages', ['uses' => 'UI\ChatController@saveUserMessage']);
 Route::match(['get', 'post'], '/chat/get_logged_user_message', ['uses' => 'UI\ChatController@getLoggedUserMessage']);


/*********** Message Request ************/
Route::get('message/check-request',['uses'=>'UI\ChatController@checkRequest']);
Route::post('message/send-request',['uses'=>'UI\ChatController@sendRequest']);
Route::post('message/action-request',['uses'=>'UI\ChatController@actionRequest']);

/****** Admin Routes ******/
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware' =>[ 'web']], function(){
    Route::get('/',['uses'=>'HomeController@showLogin'])->middleware(['acl.admin.guest']);
	Route::get('/activation', ['uses'=>'HomeController@showActivation']);
	Route::get('/recover-password', ['uses'=>'HomeController@showRecover']);
	Route::get('/404', ['uses'=>'HomeController@showNotFound']);
	Route::get('/401', ['uses'=>'HomeController@showUnAuthorized']);

	Route::get('/users',['uses'=>'HomeController@showUsers'])->middleware(['acl.admin:admin_user.list']);
	Route::get('/user',['uses'=>'HomeController@showUser'])->middleware(['acl.admin:admin_user.create']);
	Route::get('/user-profile',['uses'=>'HomeController@showUserProfile'])->middleware(['acl.admin:admin_user.update']);

	Route::get('/site-users',['uses'=>'HomeController@showSiteUsers'])->middleware(['acl.admin:site_user.list']);
	Route::get('/site-user',['uses'=>'HomeController@showSiteUser'])->middleware(['acl.admin:site_user.create']);

	Route::get('/jobs',['uses'=>'HomeController@showJobs'])->middleware(['acl.admin:job.list']);
	Route::get('/job',['uses'=>'HomeController@showJob'])->middleware(['acl.admin:job.list']);

	Route::get('/roles',['uses'=>'HomeController@showRoles'])->middleware(['acl.admin:role.list']);
	Route::get('/role',['uses'=>'HomeController@showRole'])->middleware(['acl.admin:role.create']);

	Route::get('/skills',['uses'=>'HomeController@showSkills'])->middleware(['acl.admin:skills.list']);
	Route::get('/skill',['uses'=>'HomeController@showSkill'])->middleware(['acl.admin:skills.create']);

	Route::get('/industries',['uses'=>'HomeController@showIndustries'])->middleware(['acl.admin:industry.list']);
	Route::get('/industry',['uses'=>'HomeController@showIndustry'])->middleware(['acl.admin:industry.create']);

	Route::get('/companies',['uses'=>'HomeController@showCompanies'])->middleware(['acl.admin:company.list']);
	Route::get('/company',['uses'=>'HomeController@showCompany'])->middleware(['acl.admin:company.create']);

	Route::get('/transactions',['uses'=>'HomeController@showTransactions'])->middleware(['acl.admin:transaction.list']);
	Route::get('/refunds',['uses'=>'HomeController@showRefunds'])->middleware(['acl.admin:refund.list']);
	Route::get('/disputes',['uses'=>'HomeController@showDisputes'])->middleware(['acl.admin:dispute.list']);
	Route::get('/dashboard',['uses'=>'HomeController@showReports'])->middleware(['acl.admin']);
	Route::get('/logs',['uses'=>'HomeController@showLogs'])->middleware(['acl.admin:log.list']);

	Route::get('/newses',['uses'=>'HomeController@showNewses'])->middleware(['acl.admin:news.list']);
	Route::get('/news',['uses'=>'HomeController@showNews'])->middleware(['acl.admin:news.create']);
});


// Admin API Routes
Route::group(['prefix'=>'api','namespace'=>'Api','middleware' =>[ 'web']], function(){

	// User Authentication Routes
	Route::post('/user/login',['as'=>'user.login', 'uses'=>'UserController@login']);
	Route::post('/user/logout',['as'=>'user.logout', 'uses'=>'UserController@logout']);
	Route::put('/user/create-password',['uses'=>'UserController@createPassword']);
	Route::post('/user/forgot-password',['uses'=>'UserController@forgotPassword']);
	Route::put('/user/reset-password',['uses'=>'UserController@resetPassword']);

	// User Routes
	Route::get('/user/view',['as'=>'user:view', 'uses'=>'UserController@view']);
	Route::get('/user/list',['as'=>'user:list', 'uses'=>'UserController@all'])->middleware(['acl.admin:admin_user.list']);
	Route::post('/user/create',['as'=>'user:create', 'uses'=>'UserController@create'])->middleware(['acl.admin:admin_user.create']);
	Route::put('/user/update',['as'=>'user:update', 'uses'=>'UserController@update'])->middleware(['acl.admin:admin_user.update']);
	Route::put('/user/update-status',['as'=>'user.update-status', 'uses'=>'UserController@updateStatus'])->middleware(['acl.admin:admin_user.update']);
	Route::delete('/user/remove',['as'=>'user.remove', 'uses'=>'UserController@remove'])->middleware(['acl.admin:admin_user.delete']);
	Route::put('/user/update-password',['as'=>'user.update-password', 'uses'=>'UserController@updatePassword']);
	Route::put('/user/update-account',['as'=>'user.update-account', 'uses'=>'UserController@updatePersonalInfo']);

	// Site User Routes
	Route::get('/site-user/view',['as'=>'user:view', 'uses'=>'SiteUserController@view'])->middleware(['acl.admin:site_user.list']);
	Route::get('/site-user/list',['as'=>'site-user:list', 'uses'=>'SiteUserController@all'])->middleware(['acl.admin:site_user.list']);
	Route::put('/site-user/update',['as'=>'site-user:update', 'uses'=>'SiteUserController@update'])->middleware(['acl.admin:site_user.update']);
	Route::put('/site-user/update-status',['as'=>'site-user.update-status', 'uses'=>'SiteUserController@updateStatus'])->middleware(['acl.admin:site_user.update']);
	Route::delete('/site-user/remove',['as'=>'site-user.remove', 'uses'=>'SiteUserController@remove'])->middleware(['acl.admin:site_user.delete']);

	// Jobs Routes
	Route::get('/job/list',['as'=>'job:list', 'uses'=>'JobController@all'])->middleware(['acl.admin:job.list']);
	Route::put('/job/update-status',['as'=>'job.update-status', 'uses'=>'JobController@updateStatus'])->middleware(['acl.admin:job.update']);
	Route::put('/job/update-job-status',['as'=>'job.update-job-status', 'uses'=>'JobController@updateJobStatus'])->middleware(['acl.admin:job.update']);
	Route::delete('/job/remove',['as'=>'job.remove', 'uses'=>'JobController@remove'])->middleware(['acl.admin:job.delete']);

	// Role Routes
	Route::get('/role/view',['as'=>'role:view', 'uses'=>'RoleController@view'])->middleware(['acl.admin:role.list']);
	Route::get('/role/list',['as'=>'role:list', 'uses'=>'RoleController@all'])->middleware(['acl.admin:role.list']);
	Route::post('/role/create',['as'=>'role:create', 'uses'=>'RoleController@create'])->middleware(['acl.admin:role.create']);
	Route::put('/role/update',['as'=>'role:update', 'uses'=>'RoleController@update'])->middleware(['acl.admin:role.update']);
	Route::put('/role/update-status',['as'=>'role.update-status', 'uses'=>'RoleController@updateStatus'])->middleware(['acl.admin:role.update']);
	Route::delete('/role/remove',['as'=>'role.remove', 'uses'=>'RoleController@remove'])->middleware(['acl.admin:role.delete']);
	Route::get('/role/list-modules',['as'=>'role.list-modules', 'uses'=>'RoleController@fetchAllModules']);

	// Skills Routes
	Route::get('/skill/view',['as'=>'skill:view', 'uses'=>'SkillsController@view'])->middleware(['acl.admin:skills.list']);
	Route::get('/skill/list',['as'=>'skill:list', 'uses'=>'SkillsController@all'])->middleware(['acl.admin:skills.list']);
	Route::post('/skill/create',['as'=>'skill:create', 'uses'=>'SkillsController@create'])->middleware(['acl.admin:skills.create']);
	Route::put('/skill/update',['as'=>'skill:update', 'uses'=>'SkillsController@update'])->middleware(['acl.admin:skills.update']);;
	Route::put('/skill/update-status',['as'=>'skill.update-status', 'uses'=>'SkillsController@updateStatus'])->middleware(['acl.admin:skills.update']);
	Route::delete('/skill/remove',['as'=>'skill.remove', 'uses'=>'SkillsController@remove'])->middleware(['acl.admin:skills.delete']);

	// Industries Routes
	Route::get('/industry/view',['as'=>'industry:view', 'uses'=>'IndustryController@view'])->middleware(['acl.admin:industry.list']);
	Route::get('/industry/list',['as'=>'industry:list', 'uses'=>'IndustryController@all'])->middleware(['acl.admin:industry.list']);
	Route::post('/industry/create',['as'=>'industry:create', 'uses'=>'IndustryController@create'])->middleware(['acl.admin:industry.create']);
	Route::put('/industry/update',['as'=>'industry:update', 'uses'=>'IndustryController@update'])->middleware(['acl.admin:industry.update']);
	Route::put('/industry/update-status',['as'=>'industry.update-status', 'uses'=>'IndustryController@updateStatus'])->middleware(['acl.admin:industry.update']);
	Route::delete('/industry/remove',['as'=>'industry.remove', 'uses'=>'IndustryController@remove'])->middleware(['acl.admin:industry.delete']);

	// Comapnies Routes
	Route::get('/company/view',['as'=>'company:view', 'uses'=>'CompanyController@view'])->middleware(['acl.admin:company.list']);
	Route::get('/company/list',['as'=>'company:list', 'uses'=>'CompanyController@all'])->middleware(['acl.admin:company.list']);
	Route::post('/company/create',['as'=>'company:create', 'uses'=>'CompanyController@create'])->middleware(['acl.admin:company.create']);
	Route::put('/company/update',['as'=>'company:update', 'uses'=>'CompanyController@update'])->middleware(['acl.admin:company.update']);
	Route::put('/company/update-status',['as'=>'company.update-status', 'uses'=>'CompanyController@updateStatus'])->middleware(['acl.admin:company.update']);
	Route::delete('/company/remove',['as'=>'company.remove', 'uses'=>'CompanyController@remove'])->middleware(['acl.admin:company.delete']);

	// Transactions Routes
	Route::get('/transaction/list',['as'=>'transaction:list', 'uses'=>'TransactionController@all'])->middleware(['acl.admin:transaction.list']);

	// Refunds Routes
	Route::get('/refund/list',['as'=>'refund:list', 'uses'=>'RefundController@all'])->middleware(['acl.admin:refund.list']);
	Route::put('/refund/update-status',['as'=>'refund.update-status', 'uses'=>'RefundController@updateStatus'])->middleware(['acl.admin:refund.update']);

	// Disputes Routes
	Route::get('/dispute/list',['as'=>'dispute:list', 'uses'=>'DisputeController@all'])->middleware(['acl.admin:dispute.list']);
	Route::put('/dispute/update-status',['as'=>'dispute.update-status', 'uses'=>'DisputeController@updateStatus'])->middleware(['acl.admin:dispute.update']);

	//Reports Routes
    Route::get('/report/user',['as'=>'report.user', 'uses'=>'ReportController@userReport']);
    Route::get('/report/job',['as'=>'report.job', 'uses'=>'ReportController@jobReport']);

    Route::get('/logs/list',['as'=>'logs.list', 'uses'=>'ActivityLogController@all']);

    // News Routes
	Route::get('/news/view',['as'=>'news:view', 'uses'=>'NewsController@view'])->middleware(['acl.admin:news.list']);
	Route::get('/news/list',['as'=>'news:list', 'uses'=>'NewsController@all'])->middleware(['acl.admin:news.list']);
	Route::post('/news/create',['as'=>'news:create', 'uses'=>'NewsController@create'])->middleware(['acl.admin:news.create']);
	Route::put('/news/update',['as'=>'news:update', 'uses'=>'NewsController@update'])->middleware(['acl.admin:news.update']);
	Route::put('/news/update-status',['as'=>'news.update-status', 'uses'=>'NewsController@updateStatus'])->middleware(['acl.admin:news.update']);
	Route::delete('/news/remove',['as'=>'news.remove', 'uses'=>'NewsController@remove'])->middleware(['acl.admin:news.delete']);

	// image upload
	Route::post('/image/upload',['uses'=>'UserController@upload']);
});
});


/****** V2 Routes ******/
Route::group(['prefix'=>'v2','namespace'=>'v2'], function(){
	Route::get('/login', 'HomeController@showLogin');
	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@showHome');
	Route::get('/about-us', 'HomeController@showAboutUs');
	Route::get('/contact-us', 'HomeController@showContactUs');
	Route::get('/signup', 'HomeController@showSignup');
	Route::get('/lost-password', 'HomeController@showLostPassword');
	Route::get('/logout', 'UI\Auth\AuthController@getLogout');

	Route::get('/companies', ['uses'=>'HomeController@showCompanies']);

	Route::post('/auth/login', 'UI\Auth\AuthController@postLogin');
	
});

Route::group(['prefix'=>'api/v2','namespace'=>'Api'], function(){
	Route::get('/companies', ['uses'=>'CompanyController@all']);

});