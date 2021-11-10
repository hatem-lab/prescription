<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


const PAGINATION_COUNT=10;
Auth::routes();
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
    {
Route::group(['prefix' => 'admin','middleware' => 'auth:admin'], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');
    Route::group(['prefix' => 'profile'], function () {
    Route::get('edit', 'ProfileController@editProfile')->name('edit.profile');
    Route::put('update', 'ProfileController@updateprofile')->name('update.profile');
    });
});
        Route::group(['prefix' => 'courses'], function () {
            Route::get('/', 'CourseTypeController@index')->name('admin.courses');
            Route::get('create', 'CourseTypeController@create')->name('admin.courses.create');
            Route::post('store', 'CourseTypeController@store')->name('admin.courses.store');
            Route::get('edit/{id}', 'CourseTypeController@edit')->name('admin.courses.edit');
            Route::post('update/{id}', 'CourseTypeController@update')->name('admin.courses.update');
            Route::get('delete/{id}', 'CourseTypeController@destroy')->name('admin.courses.delete');
        });
Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UsersController@index')->name('admin.users.index');
    Route::get('/create', 'UsersController@create')->name('admin.users.create');
    Route::post('/store', 'UsersController@store')->name('admin.users.store');
    Route::get('/edit/{id}', 'UsersController@edit')->name('admin.users.edit');
    Route::post('/update/{id}', 'UsersController@update')->name('admin.users.update');
    Route::get('/delete/{id}', 'UsersController@destroy')->name('admin.users.delete');
});
Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('/login', 'LoginController@getLogin')->name('admin.getLogin');
    Route::post('/login', 'LoginController@login')->name('admin.login');

});

});


