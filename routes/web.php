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

Route::get('/login', function () {
    return view('frontend.auth.login');
});

Route::post('auth/login', 'UI\Auth\AuthController@postLogin');
Route::get('auth/logout', 'UI\Auth\AuthController@getLogout');



/*FORGOT PASSWORD */
Route::match(['get', 'post'], '/ui/forgotpw', ['uses' => 'ForgotPasswordController@index', 'as' => 'forgotpw']);


//Auth::routes();

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





    /************************************USERS ROUTE*************************************************/
Route::match(['get', 'post'], '/user/imageUpload', ['uses' => 'UI\UserController@uploadImage']);
// Password
Route::match(['get', 'post'], '/user/password_update', ['uses' => 'UI\UserController@passwordUpdate']);
Route::match(['get', 'post'], '/user/add_certification', ['uses' => 'UI\UserController@addCertification']);
Route::match(['get', 'post'], '/user/edit_certification', ['uses' => 'UI\UserController@editCertification']);

/************************************JOB POSTING *****************************************************/
Route::match(['get', 'post'], '/job/post', ['uses' => 'UI\JobPostController@jobPost']);
Route::match(['get', 'post'], '/job/job_create', ['uses' => 'UI\JobPostController@jobCreate']);
Route::match(['get', 'post'], '/job/user_job_list', ['uses' => 'UI\JobPostController@userJobList']);
Route::match(['get', 'post'], '/job/job_delete', ['uses' => 'UI\JobPostController@delJob']);
Route::match(['get', 'post'], '/job/getTerms', ['uses' => 'UI\JobPostController@getTerm']);

/************************************NETWORK*********************************************************/
 Route::match(['get', 'post'], '/network/connection', ['uses' => 'UI\NetworkController@myConnections']);
 Route::match(['get', 'post'], '/network/send_recom', ['uses' => 'UI\NetworkController@sendRecom']);
 Route::match(['get', 'post'], 'ui/network/get_recommendation/{id}', ['uses' => 'UI\NetworkController@getRecom']);
 Route::match(['get', 'post'], 'network/accept_recommendation/{id}', ['uses' => 'UI\NetworkController@acceptRecom']);
 Route::match(['get', 'post'], 'network/reject_recommendation/{id}', ['uses' => 'UI\NetworkController@rejectRecom']);
 Route::match(['get', 'post'], '/network/people_find', ['uses' => 'UI\NetworkController@getPeopleList']);



});
