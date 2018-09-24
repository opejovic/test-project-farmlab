<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/login', 'HomeController@create')->middleware('guest');
Route::post('/login', 'HomeController@store')->name('login')->middleware('guest');

Route::group(['middleware' => ['auth']], function ()
{
    Route::get('/logout', 'HomeController@destroy')->name('logout');

    Route::get('/farmlab/create', 'PracticeController@create')->name('farmlab.create');
    Route::post('/farmlab/create', 'PracticeController@store')->name('farmlab.store');

    Route::get('/vets', 'VetController@index')->name('vet.index')->middleware('practice.admin');
    Route::get('/practice/create/vet', 'VetController@create')->name('vet.create')->middleware('practice.admin');
    Route::post('/vets', 'VetController@store')->name('vet.store')->middleware('practice.admin');
    Route::get('/vets/{vet}', 'VetController@show')->name('vet.show')->middleware('practice.admin');

    Route::get('/file/upload', 'FileController@create')->name('file.create')->middleware('farmlab');
    Route::post('/file/upload', 'FileController@store')->name('file.store')->middleware('farmlab');

    Route::get('/labresults/index', 'LabResultController@index')->name('labresults.index')->middleware('practice');
    Route::get('/labresults/farmer/{farmerName}', 'LabResultController@index')->name('labresults.farmer')->middleware('practice');
    Route::get('/labresults/{result}', 'LabResultController@show')->name('labresults.show')->middleware('practice');
    Route::post('/labresults/{result}', 'LabResultController@update')->name('labresults.process')->middleware('practice');

});






