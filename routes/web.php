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
<<<<<<< HEAD

=======
>>>>>>> 0d996f9d46a0e712ae15a3d187784fddb24469e2
Auth::routes();

Route::middleware(['auth'])->group(function () {
	Route::get('/',					'HomeController@index')->name('home');
    Route::resource('members',		'LabMembersController')->middleware('farmlab.admin');
    Route::resource('files',		'FilesController')->middleware('farmlab');
    Route::resource('practices',	'PracticesController')->middleware('farmlab');
	Route::resource('vets', 		'VetsController')->middleware('practice.admin');
    Route::resource('labresults',	'LabResultsController')->middleware('practice');
});


