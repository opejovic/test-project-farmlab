<?php

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
	
	Route::get('/home',       	  				 		'HomeController@index');
	Route::get('/',       		  				 		'HomeController@index')->name('home');
    Route::resource('members',    				 		'LabMembersController')->middleware('farmlab.admin');
    Route::resource('files',      				 		'FilesController')->middleware('farmlab');
    Route::resource('practices',  				 		'PracticesController')->middleware('farmlab');
	Route::resource('practices/{practice}/vets', 		'PracticeVetsController')->middleware('practice.admin');
    Route::resource('practices/{practice}/labresults',	'PracticeLabResultsController')->middleware('practice');

    // tmp - without this farmlab members cant view vets.
    Route::get('/practices/{practice}/vets/{vet}', 		'PracticeVetsController@show')->name('vets.show');
});

