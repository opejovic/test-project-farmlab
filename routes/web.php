<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/login', 'HomeController@create');
Route::post('/login', 'HomeController@store');
Route::get('/logout', 'HomeController@destroy');

Route::get('/farmlab', 'PracticeController@index');
Route::get('/farmlab/create', 'PracticeController@create');
Route::post('/farmlab/create/user', 'PracticeController@store');

// Route::get('/practice', 'VetController@index');
Route::get('/practice/create/vet', 'VetController@create');
Route::post('/practice/create/vet', 'VetController@store');

Route::get('/labresults/index', 'LabResultController@index');
Route::get('/labresults/upload', 'LabResultController@create');
Route::post('/labresults/upload', 'LabResultController@store');
Route::get('/labresults/show', 'LabResultController@show');



