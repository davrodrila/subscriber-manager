<?php

use Illuminate\Http\Request;


Route::resource('/v1/subscribers', 'SubscriberController')->except(['create','edit']);
Route::resource('/v1/subscribers/{subscriber}/fields', 'SubscriberFieldsController')->except(['create','edit']);
Route::get('/v1/types', 'TypeController@index');