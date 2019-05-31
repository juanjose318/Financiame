<?php

// Homepage 

Route::get('/', function () {
    return view('home');
});


// Operations for Posts

Route::resource('/posts','PostController');

// 

// Operations for Projects

Route::resource('/projects','ProjectController');


Route::get('image/uploader','ImageUploadController@index');

Route::post('/image/uploader','ImageUploadController@store')->name('postUpload');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
