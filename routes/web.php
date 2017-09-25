<?php

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::post('/photo', 'PhotoController@uploadPhoto')->name('uploadPhoto');

Route::delete('/photo/{photoId}', 'PhotoController@deletePhoto')->name('deletePhoto');

Route::get('show-photos', 'PhotoController@showPhotosFromDb')->name('showPhotos');

Route::get('/photo/{photoId}', 'PhotoController@showPhoto')->name('showPhoto');