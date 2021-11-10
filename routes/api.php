<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

////////////////////////////////////////////// Auth ///////////////////////////////////////////////
Route::group(['prefix' => 'student'] , function () {
Route::post('register' , 'AuthController@register')->name('register');
Route::post('login' , 'AuthController@login')->name('login');

Route::group(['middleware' => ['auth:user-api']] , function (){

        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::get('profile', 'AuthController@profile');
        Route::post('update-profile', 'AuthController@update_profile');

    });
});





Route::group(['prefix' => 'teacher'] , function () {
    Route::post('register' , 'AuthTeacherController@register')->name('register');
    Route::post('login' , 'AuthTeacherController@login')->name('login');
    Route::group(['middleware' => ['auth:user-api']] , function (){
        Route::post('logout', 'AuthTeacherController@logout')->name('logout');
        Route::get('profile', 'AuthTeacherController@profile');
        Route::post('update-profile', 'AuthTeacherController@update_profile');

    });

});

Route::group(['prefix' => 'lists'] , function () {
    Route::get('Courses-Type', 'ListsController@courses_type');
    Route::get('Teachers', 'ListsController@Teachers');
});



    Route::group(['prefix' => 'services'], function () {

        Route::post('create-course', 'ServicesController@create_course');
        Route::post('update-course', 'ServicesController@update_course');
        Route::post('delete-course', 'ServicesController@delete_course');
        Route::get('all-courses', 'ServicesController@all_courses');
        Route::get('course-details', 'ServicesController@course_details');
    });

Route::group(['middleware' => ['auth:user-api']] , function () {
    Route::group(['prefix' => 'services'], function ()
    {
        Route::get('courses-student', 'ServicesController@courses_student');
    });
});

