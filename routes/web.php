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
Route::get('/','ProfileController@login')->name('home');

Route::get('/login', 'ProfileController@login')->name('login');
Route::post('/login', 'ProfileController@processLogin')->name('process.login');
Route::post('/logout', 'ProfileController@logout')->name('logout');
Route::get('/reset','ProfileController@showResetForm')->name('reset-form');
Route::post('/reset','ProfileController@resetPassword')->name('reset-password');

Route::get('/register', 'ProfileController@login')->name('register');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/pages/{slug}','PageController@show')->name('pages.show');

    Route::resource('sliders','SliderController');
    Route::post('/sliders/update','SliderController@updateSection')->name('sliders.update.ajax');
    Route::post('/sliders/{slider}/toggle-status','SliderController@toggleSliderStatus')->name('sliders.toggle-status');
    Route::get('/sliders/{slider}/preview','SliderController@previewSlider')->name('sliders.preview');
    Route::get('/sliders/{slider}/clone','SliderController@cloneSlider')->name('sliders.clone');
    Route::get('/sliders/{slider}/clear-stats','SliderController@clearStats')->name('sliders.clear-stats');
});
