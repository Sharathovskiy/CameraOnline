<?php

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/photo', 'PhotoController@uploadPhoto')->name('uploadPhoto');

Route::get('show-photos', 'PhotoController@showPhotosFromDb')->name('showPhotos');