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


//const PAGINATION_COUNT=10;
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
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoryController@index')->name('admin.categories');
            Route::get('create', 'CategoryController@create')->name('admin.categories.create');
            Route::post('store', 'CategoryController@store')->name('admin.categories.store');
            Route::get('edit/{id}', 'CategoryController@edit')->name('admin.categories.edit');
            Route::post('update/{id}', 'CategoryController@update')->name('admin.categories.update');
            Route::get('delete/{id}', 'CategoryController@destroy')->name('admin.categories.delete');
            Route::get('show/{id}','CategoryController@show') -> name('admin.categories.show');
        });
        Route::group(['prefix' => 'companies'], function () {
            Route::get('/', 'CompaniesController@index')->name('admin.companies');
            Route::get('create', 'CompaniesController@create')->name('admin.companies.create');
            Route::post('store', 'CompaniesController@store')->name('admin.companies.store');
            Route::get('edit/{id}', 'CompaniesController@edit')->name('admin.companies.edit');
            Route::post('update/{id}', 'CompaniesController@update')->name('admin.companies.update');
            Route::get('delete/{id}', 'CompaniesController@destroy')->name('admin.companies.delete');
            Route::get('show/{id}','CompaniesController@show') -> name('admin.companies.show');
        });
        Route::group(['prefix' => 'contraindications'], function () {
            Route::get('/', 'ContraindicationsController@index')->name('admin.contraindications');
            Route::get('create', 'ContraindicationsController@create')->name('admin.contraindications.create');
            Route::post('store', 'ContraindicationsController@store')->name('admin.contraindications.store');
            Route::get('edit/{id}', 'ContraindicationsController@edit')->name('admin.contraindications.edit');
            Route::post('update/{id}', 'ContraindicationsController@update')->name('admin.contraindications.update');
            Route::get('delete/{id}', 'ContraindicationsController@destroy')->name('admin.contraindications.delete');
            Route::get('show/{id}','ContraindicationsController@show') -> name('admin.contraindications.show');
        });

        Route::group(['prefix' => 'medications'], function () {
            Route::get('/', 'MedicationsController@index')->name('admin.medications');
            Route::get('create', 'MedicationsController@create')->name('admin.medications.create');
            Route::post('store', 'MedicationsController@store')->name('admin.medications.store');
            Route::get('edit/{id}', 'MedicationsController@edit')->name('admin.medications.edit');
            Route::post('update/{id}', 'MedicationsController@update')->name('admin.medications.update');
            Route::get('delete/{id}', 'MedicationsController@destroy')->name('admin.medications.delete');
            Route::get('show/{id}','MedicationsController@show') -> name('admin.medications.show');

        });
        Route::group(['prefix' => 'prescriptions'], function () {
            Route::get('/', 'PrescriptionsController@index')->name('admin.prescriptions');
            Route::get('create', 'PrescriptionsController@create')->name('admin.prescriptions.create');
            Route::post('store', 'PrescriptionsController@store')->name('admin.prescriptions.store');
            Route::get('edit/{id}', 'PrescriptionsController@edit')->name('admin.prescriptions.edit');
            Route::post('update/{id}', 'PrescriptionsController@update')->name('admin.prescriptions.update');
            Route::get('delete/{id}', 'PrescriptionsController@destroy')->name('admin.prescriptions.delete');
            Route::get("/loadcategories", "PrescriptionsController@loadCategories")->name('admin.prescriptions.loadCategories');
            Route::get('show/{id}','PrescriptionsController@show') -> name('admin.prescriptions.show');

        });



        Route::group(['prefix' => 'shapes'], function () {
            Route::get('/', 'ShapesController@index')->name('admin.shapes');
            Route::get('create', 'ShapesController@create')->name('admin.shapes.create');
            Route::post('store', 'ShapesController@store')->name('admin.shapes.store');
            Route::get('edit/{id}', 'ShapesController@edit')->name('admin.shapes.edit');
            Route::post('update/{id}', 'ShapesController@update')->name('admin.shapes.update');
            Route::get('delete/{id}', 'ShapesController@destroy')->name('admin.shapes.delete');
            Route::get('show/{id}','ShapesController@show') -> name('admin.shapes.show');

        });
        Route::group(['prefix' => 'doses'], function () {
            Route::get('/', 'DosesController@index')->name('admin.doses');
            Route::get('create', 'DosesController@create')->name('admin.doses.create');
            Route::post('store', 'DosesController@store')->name('admin.doses.store');
            Route::get('edit/{id}', 'DosesController@edit')->name('admin.doses.edit');
            Route::post('update/{id}', 'DosesController@update')->name('admin.doses.update');
            Route::get('delete/{id}', 'DosesController@destroy')->name('admin.doses.delete');
            Route::get('show/{id}','DosesController@show') -> name('admin.doses.show');

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


