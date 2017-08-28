<?php

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/photo', 'PhotoController@uploadPhoto')->name('photoTaken');