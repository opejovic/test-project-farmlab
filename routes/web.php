<?php

Auth::routes();

// Without this route, it throws a MethodNotAllowed exception when user types logout in the url
// if the user is already signed in.
Route::get('/logout', 'Auth\LoginController@getLogout');

Route::middleware(['auth'])->group(function ()
{
	Route::get('/home',       	  'HomeController@index');
	Route::get('/',       		  'HomeController@index')->name('home');
    Route::resource('members',    'LabMembersController')->middleware('farmlab.admin');
    Route::resource('practices',  'PracticesController')->middleware('farmlab');
    Route::resource('files',      'FilesController')->middleware('farmlab');
	Route::resource('vets',       'VetsController')->middleware('practice.admin');
    Route::resource('labresults', 'LabResultsController')->middleware('practice');

    // tmp - without this farmlab members cant view vets.
    Route::get('vets/{vet}', 'VetsController@show')->name('vets.show');
});

