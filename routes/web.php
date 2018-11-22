<?php

Auth::routes(['verify' => true]);

// Without this route, it throws a MethodNotAllowed exception when user types logout in the url
// if the user is already signed in.
Route::get('/logout', 'Auth\LoginController@getLogout');

Route::middleware(['auth', 'verified'])->group(function ()
{
	Route::get('/home',       	  'HomeController@index');
	Route::get('/',       		  'HomeController@index')->name('home');
    Route::resource('members',    'LabMembersController')->middleware('farmlab.admin');
    Route::resource('practice',   'PracticesController')->middleware('farmlab');
    Route::resource('files',      'FilesController')->middleware('farmlab');
	Route::resource('vets',       'VetsController')->middleware('practice.admin');
    Route::resource('labresults', 'LabResultsController')->middleware('practice');
});
