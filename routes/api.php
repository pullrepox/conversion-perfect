<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    return 'This is test api';
});

Route::get('/reset-main-db', 'Api\DatabaseController@mainDbReset');
Route::get('/cp-embed-script/{id}', 'Api\OverlaysController@getCBScriptCode')->name('conversion.get-scripts-code-for-embed');
Route::get('/cp-embed-frame-code/{id}', 'Api\OverlaysController@getScriptFrameCode')->name('conversion.get-scripts-frame-code');
Route::post('/cp-cta-set-subscribers/{bar_id}', 'Api\BarOptionsApiController@setSubscribersOfLists')->name('conversion.set-lead-capture-subscribers');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
