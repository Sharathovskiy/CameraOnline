<?php

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/photo', 'PhotoTaker@uploadPhoto')->name('photoTaken');