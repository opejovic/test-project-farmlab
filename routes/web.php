<?php

Route::get('/login', 'HomeController@create')->middleware('guest');
Route::post('/login', 'HomeController@store')->name('login')->middleware('guest');


Route::group(['middleware' => ['auth']], function ()
{
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index');
    Route::get('/logout', 'HomeController@destroy')->name('logout');

    Route::get('/farmlab/create', 'PracticeController@create')->name('create');
    Route::post('/farmlab/create', 'PracticeController@store');

    Route::get('/practice/create/vet', 'VetController@create')->name('vet.create');
    Route::post('/vet', 'VetController@store')->name('vet.store');

    Route::get('/file/upload', 'FileController@create')->name('file.create');
    Route::post('/file', 'FileController@store')->name('file.store');

    Route::get('/labresults/index', 'LabResultController@index')->name('labresults.index')->middleware('practice');
    Route::get('/labresults/farmer/{farmer}', 'LabResultController@index')->name('labresults.farmer');
    Route::get('/labresults/{result}', 'LabResultController@show')->name('labresults.show');
    Route::post('/labresults/{result}', 'LabResultController@update')->name('labresults.process');

});






