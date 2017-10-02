<?php

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('show-photos', 'PhotoController@showAuthUserPhotos')->name('showPhotos')->middleware('auth');

Route::group(['prefix' => 'photo', 'middleware' => 'auth'], function () {
    Route::post('/', 'PhotoController@uploadPhoto')->name('uploadPhoto');

    Route::get('/{photoId}', 'PhotoController@showPhoto')->name('showPhoto');

    Route::delete('/{photoId}', 'PhotoController@deletePhoto')->name('deletePhoto');
});

Auth::routes();
