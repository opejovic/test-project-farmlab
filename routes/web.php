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

Route::get('invitations/{code}', 'InvitationsController@show')->name('invitations.show');
Route::post('verify', 'Auth\VerificationController@verify')->name('auth.verify');

Route::middleware(['auth'])->group(function () {
	Route::get('/',					'HomeController@index')->name('home');
    Route::resource('members',		'LabMembersController')->middleware('farmlab.admin');
    Route::resource('files',		'FilesController')->middleware('farmlab');
    Route::resource('practices',	'PracticesController')->middleware('farmlab');
	Route::resource('vets', 		'VetsController')->middleware('practice.admin');
    Route::resource('labresults',	'LabResultsController')->middleware('practice');

    // Work in progress
    Route::get('vets/{vet}', 'VetsController@show')->name('vets.show')->middleware('practice');
});


