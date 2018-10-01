<?php

Auth::routes();

// Without this route, it throws a MethodNotAllowed exception when user types logout in the url
// if the user is already signed in.
Route::get('/logout', 'Auth\LoginController@getLogout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::middleware(['auth'])->group(function ()
{
    Route::middleware(['farmlab.admin'])->group(function () {
        Route::get('/members/create',                 'LabMemberController@create')->name('members.create');
        Route::post('/members/create',                'LabMemberController@store')->name('members.store');
    });
    
    Route::middleware(['farmlab'])->group(function () {
        Route::get('/practice/create',                'PracticeController@create')->name('practice.create');
        Route::post('/practice/create',               'PracticeController@store')->name('practice.store');
        Route::get('/file/upload',                    'FileController@create')->name('file.create');
        Route::post('/file/upload',                   'FileController@store')->name('file.store');
    });

    Route::middleware(['practice.admin'])->group(function () {
        Route::get('/vets',                           'VetController@index')->name('vet.index');
        Route::get('/vets/create',                    'VetController@create')->name('vet.create');
        Route::post('/vets',                          'VetController@store')->name('vet.store');
        Route::get('/vets/{vet}',                     'VetController@show')->name('vet.show');
    });

    Route::middleware(['practice'])->group(function () {
        Route::get('/labresults',                     'LabResultController@index')->name('labresults.index');
        Route::get('/labresults/farmer/{farmerName}', 'LabResultController@index')->name('labresults.farmer');
        Route::get('/labresults/{result}',            'LabResultController@show')->name('labresults.show');
        Route::post('/labresults/{result}',           'LabResultController@update')->name('labresults.process');
    });
});