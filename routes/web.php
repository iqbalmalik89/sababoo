<?php


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

Route::group(['middleware' => ['web']], function () {
   Route::get('/home', 'HomeController@showHome');

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

/************************************JOB POSTING *****************************************************/
Route::match(['get', 'post'], '/job/post', ['uses' => 'UI\JobPostController@jobPost'])->middleware(['acl.front:job.create']);
Route::match(['get', 'post'], '/job/job_create', ['uses' => 'UI\JobPostController@jobCreate'])->middleware(['acl.front:job.create']);
Route::match(['get', 'post'], '/job/user_job_list', ['uses' => 'UI\JobPostController@userJobList'])->middleware(['acl.front:job.list']);
Route::match(['get', 'post'], '/job/job_delete', ['uses' => 'UI\JobPostController@delJob'])->middleware(['acl.front:job.delete']);
Route::match(['get', 'post'], '/job/search_jobs', ['uses' => 'UI\JobPostController@searchJob'])->middleware(['acl.front:job.search']);
Route::match(['get', 'post'], '/job/view/{id}', ['uses' => 'UI\JobPostController@viewJob'])->middleware(['acl.front:job.view']);


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
 Route::match(['get', 'post'], ' /send_message/{id}', ['uses' => 'UI\ChatController@index']);
 Route::match(['get', 'post'], ' /user_send_message', ['uses' => 'UI\ChatController@SendMessage']);
 Route::match(['get', 'post'], ' /user_view_message', ['uses' => 'UI\ChatController@viewMessages']);
 Route::match(['get', 'post'], ' /user_view_message_jason', ['uses' => 'UI\ChatController@viewMessagesJason']);
 Route::match(['get', 'post'], ' /chat/get_users_message', ['uses' => 'UI\ChatController@getUserMessageById']);
 Route::match(['get', 'post'], ' /chat/save_user_messages', ['uses' => 'UI\ChatController@saveUserMessage']);
 Route::match(['get', 'post'], '/chat/get_logged_user_message', ['uses' => 'UI\ChatController@getLoggedUserMessage']);




/****** Admin Routes ******/
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware' =>[ 'web']], function(){
    Route::get('/',['uses'=>'HomeController@showLogin'])->middleware(['acl.admin.guest']);
	Route::get('/activation', ['uses'=>'HomeController@showActivation']);
	Route::get('/recover-password', ['uses'=>'HomeController@showRecover']);
	Route::get('/404', ['uses'=>'HomeController@showNotFound']);
	Route::get('/401', ['uses'=>'HomeController@showUnAuthorized']);

	Route::get('/users',['uses'=>'HomeController@showUsers'])->middleware(['acl.admin']);
	Route::get('/user',['uses'=>'HomeController@showUser'])->middleware(['acl.admin']);
	Route::get('/user-profile',['uses'=>'HomeController@showUserProfile'])->middleware(['acl.admin']);

	Route::get('/site-users',['uses'=>'HomeController@showSiteUsers'])->middleware(['acl.admin']);
	Route::get('/site-user',['uses'=>'HomeController@showSiteUser'])->middleware(['acl.admin']);

	Route::get('/jobs',['uses'=>'HomeController@showJobs'])->middleware(['acl.admin']);
	Route::get('/job',['uses'=>'HomeController@showJob'])->middleware(['acl.admin']);

	Route::get('/roles',['uses'=>'HomeController@showRoles'])->middleware(['acl.admin']);
	Route::get('/role',['uses'=>'HomeController@showRole'])->middleware(['acl.admin']);

	Route::get('/skills',['uses'=>'HomeController@showSkills'])->middleware(['acl.admin']);
	Route::get('/skill',['uses'=>'HomeController@showSkill'])->middleware(['acl.admin']);

	Route::get('/industries',['uses'=>'HomeController@showIndustries'])->middleware(['acl.admin']);
	Route::get('/industry',['uses'=>'HomeController@showIndustry'])->middleware(['acl.admin']);
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
	Route::get('/user/list',['as'=>'user:list', 'uses'=>'UserController@all']);
	Route::post('/user/create',['as'=>'user:create', 'uses'=>'UserController@create']);
	Route::put('/user/update',['as'=>'user:update', 'uses'=>'UserController@update']);
	Route::put('/user/update-status',['as'=>'user.update-status', 'uses'=>'UserController@updateStatus']);
	Route::delete('/user/remove',['as'=>'user.remove', 'uses'=>'UserController@remove']);
	Route::put('/user/update-password',['as'=>'user.update-password', 'uses'=>'UserController@updatePassword']);
	Route::put('/user/update-account',['as'=>'user.update-account', 'uses'=>'UserController@updatePersonalInfo']);

	// Site User Routes
	Route::get('/site-user/view',['as'=>'user:view', 'uses'=>'SiteUserController@view']);
	Route::get('/site-user/list',['as'=>'site-user:list', 'uses'=>'SiteUserController@all']);
	Route::put('/site-user/update',['as'=>'site-user:update', 'uses'=>'SiteUserController@update']);
	Route::put('/site-user/update-status',['as'=>'site-user.update-status', 'uses'=>'SiteUserController@updateStatus']);
	Route::delete('/site-user/remove',['as'=>'site-user.remove', 'uses'=>'SiteUserController@remove']);

	// Jobs Routes
	Route::get('/job/list',['as'=>'job:list', 'uses'=>'JobController@all']);
	Route::put('/job/update-status',['as'=>'job.update-status', 'uses'=>'JobController@updateStatus']);
	Route::delete('/job/remove',['as'=>'job.remove', 'uses'=>'JobController@remove']);

	// Role Routes
	Route::get('/role/view',['as'=>'role:view', 'uses'=>'RoleController@view']);
	Route::get('/role/list',['as'=>'role:list', 'uses'=>'RoleController@all']);
	Route::post('/role/create',['as'=>'role:create', 'uses'=>'RoleController@create']);
	Route::put('/role/update',['as'=>'role:update', 'uses'=>'RoleController@update']);
	Route::put('/role/update-status',['as'=>'role.update-status', 'uses'=>'RoleController@updateStatus']);
	Route::delete('/role/remove',['as'=>'role.remove', 'uses'=>'RoleController@remove']);
	Route::get('/role/list-modules',['as'=>'role.list-modules', 'uses'=>'RoleController@fetchAllModules']);

	// Skills Routes
	Route::get('/skill/view',['as'=>'skill:view', 'uses'=>'SkillsController@view']);
	Route::get('/skill/list',['as'=>'skill:list', 'uses'=>'SkillsController@all']);
	Route::post('/skill/create',['as'=>'skill:create', 'uses'=>'SkillsController@create']);
	Route::put('/skill/update',['as'=>'skill:update', 'uses'=>'SkillsController@update']);
	Route::put('/skill/update-status',['as'=>'skill.update-status', 'uses'=>'SkillsController@updateStatus']);
	Route::delete('/skill/remove',['as'=>'skill.remove', 'uses'=>'SkillsController@remove']);

	// Industries Routes
	Route::get('/industry/view',['as'=>'industry:view', 'uses'=>'IndustryController@view']);
	Route::get('/industry/list',['as'=>'industry:list', 'uses'=>'IndustryController@all']);
	Route::post('/industry/create',['as'=>'industry:create', 'uses'=>'IndustryController@create']);
	Route::put('/industry/update',['as'=>'industry:update', 'uses'=>'IndustryController@update']);
	Route::put('/industry/update-status',['as'=>'industry.update-status', 'uses'=>'IndustryController@updateStatus']);
	Route::delete('/industry/remove',['as'=>'industry.remove', 'uses'=>'IndustryController@remove']);
});


});
