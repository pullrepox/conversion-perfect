<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'ProfileController@login')->name('login');
Route::post('/login', 'ProfileController@processLogin')->name('process.login');
Route::post('/logout', 'ProfileController@logout')->name('logout');

Route::get('/register', 'ProfileController@login')->name('register');
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
