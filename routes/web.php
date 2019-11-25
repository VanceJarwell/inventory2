<?php



Route::get('/items', 'ItemsController@index');
Route::get('/items/add', 'ItemsController@create');
Route::post('/items/store', 'ItemsController@store');
Route::get('/items/{item}/edit', 'ItemsController@edit');
Route::post('/items/{item}/update', 'ItemsController@update');
Route::get('/items/{item}/delete', 'ItemsController@destroy');
Route::get('/word', 'ReportsController@word');
Route::get('/excel', 'ReportsController@excel');

