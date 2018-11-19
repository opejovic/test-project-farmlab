<?php

Auth::routes(['verify' => true]);

// Without this route, it throws a MethodNotAllowed exception when user types logout in the url
// if the user is already signed in.
Route::get('/logout', 'Auth\LoginController@getLogout');

Route::middleware(['auth', 'verified'])->group(function ()
{
	Route::get('/home',   		  'HomeController@index');
	Route::get('/',       		  'HomeController@index')->name('home');
    Route::resource('members',    'LabMemberController')->middleware('farmlab.admin');
    Route::resource('practice',   'PracticeController')->middleware('farmlab');
    Route::resource('files',      'FileController')->middleware('farmlab');
	Route::resource('vets',       'VetController')->middleware('practice.admin');
    Route::resource('labresults', 'LabResultController')->middleware('practice');

    Route::get('/labresults/farmer/{farmerName}', 'LabResultController@index')->name('labresults.farmer')->middleware('practice');
});
