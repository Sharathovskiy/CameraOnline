<?php

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('show-photos', 'PhotoController@showPhotosFromDb')->name('showPhotos');

Route::prefix('photo')->group(function () {
    Route::post('/', 'PhotoController@uploadPhoto')->name('uploadPhoto');
    
    Route::get('/{photoId}', 'PhotoController@showPhoto')->name('showPhoto');
    
    Route::delete('/{photoId}', 'PhotoController@deletePhoto')->name('deletePhoto');
});