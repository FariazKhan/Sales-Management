<?php

Route::resource('/', "HomeController");
// Product register routes

Route::resource('product', "ProductController");

// Sales register routes

Route::resource('sales', "SalesController");

// Profile routes
Route::resource('profile', "ProfileController");

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
