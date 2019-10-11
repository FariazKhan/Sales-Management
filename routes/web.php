<?php

Route::resource('/', "HomeController");





/////////////////// Public routes
// Sales register routes

Route::resource('sales', "SalesController");

// Profile routes
Route::resource('profile', "ProfileController");
Route::get('profiles/resetpwd', "ProfileController@showResetForm");
Route::post('profiles/resetpwd', "ProfileController@resetpwd")->name('resetpwd');

Auth::routes();


//////////////////// Can only by accesed by Super Admins
// Product register routes
Route::resource('product', "ProductController");
Route::get('product/view/{id}', "ProductController@show")->name('viewProduct');

// User Controller routes
Route::resource('users', "ManageUsers");

// Notice Controller routes
Route::resource('notice', "ManageNotice");
Route::get('notices/{id}', "ViewNotice@show")->name('viewNotice');

// Discount Controller routes
Route::resource('discount', "ManageDiscount");

////////////////////////////////////////////////////////
