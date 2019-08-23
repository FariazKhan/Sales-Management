<?php

Route::resource('/', "HomeController");
// Product register routes

Route::resource('product', "ProductController");

// Sales register routes

Route::resource('sales', "SalesController");
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
