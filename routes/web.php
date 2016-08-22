<?php

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
Route::match(['get', 'post'], '/employee/imageUpload', ['uses' => 'EmployeeController@uploadImage']);
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





    Route::match(['get', 'post'], '/employee/view/{id}', ['uses' => 'EmployeeController@viewEmployee']);



/***********************************END OF EMPLOYEE*************************************/


});
