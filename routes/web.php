<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/login', 'HomeController@create');
Route::post('/login', 'HomeController@store');
Route::get('/logout', 'HomeController@destroy');

Route::get('/farmlab/create', 'PracticesController@index');
// Route::get('/farmlab/dashboard/create', 'PracticeController@create');
Route::post('/farmlab/create/user', 'PracticesController@store');

Route::get('/practice/create', 'VetsController@index');
Route::get('/practice/create/vet', 'VetsController@create');
Route::post('/practice/create/vet', 'VetsController@create');


