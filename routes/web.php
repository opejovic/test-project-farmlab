<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/login', 'HomeController@create')->name('login');
Route::post('/login', 'HomeController@store');
Route::get('/logout', 'HomeController@destroy')->name('logout');

Route::get('/farmlab/create', 'PracticeController@create')->name('create');
Route::post('/farmlab/create', 'PracticeController@store');

Route::get('/practice/create/vet', 'VetController@create')->name('vet.create');
Route::post('/vet', 'VetController@store')->name('vet.store');

Route::get('/file/upload', 'FileController@create')->name('file.create');
Route::post('/file', 'FileController@store')->name('file.store');

Route::get('/labresults/index', 'LabResultController@index')->name('labresults.index');
Route::get('/labresults/{result}', 'LabResultController@show')->name('labresults.show');
Route::post('/labresults/{result}', 'LabResultController@edit')->name('labresults.process');




