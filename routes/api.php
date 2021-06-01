<?php

use App\Models\Order;
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

Route::post('register' , 'AuthController@register')->name('register');
Route::post('login' , 'AuthController@login')->name('login');
Route::post('verify-account' , 'AuthController@verify_account');
Route::post('resend-code' , 'AuthController@resend_code');


Route::group(['middleware' => ['auth:user-api']] , function (){
    Route::post('logout' , 'AuthController@logout')->name('logout');
    Route::get('profile' , 'AuthController@profile');
    Route::post('change-phone-number' , 'AuthController@change_phone_number');
    Route::get('check-token' , 'AuthController@check_token');
    Route::post('update-profile' , 'AuthController@update_profile');
    Route::post('delete-account' , 'AuthController@delete_account');

});


